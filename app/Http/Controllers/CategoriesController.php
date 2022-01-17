<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUpdateCategories;
use App\Models\Categories;
use App\Models\User;
use App\Models\Clients;
use Illuminate\Support\Str;
use Carbon\Carbon;
use files;
use DB;

class CategoriesController extends Controller
{
    private $categories;
    private $totalPage = 12;
    private $path = 'categories';   

    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }  

    public function index(Categories $categories)
    {
        //$banners = auth()->user()->bannerCreate()->paginate($this->totalPage);
        $categories = $this->categories->paginate($this->totalPage);
        $totalCategories = Categories::count();
        return view('categories.index', compact ('categories', 'totalCategories'));   
    }

    public function create()
    {
        $totalCategories = Categories::count();
        return view ('categories.create', compact ('totalCategories'));
    }

    public function store(CreateUpdateCategories $request)
    {
        
        DB::beginTransaction();

        $dataForm = $request->except('_token');
        $dataForm['active'] = ( !isset($dataForm['active']) ) ? 0 : 1;

        // Verifica se informou a imagem para upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

        // Define finalmente o nome
        $nameFile = Str::slug($request->name) . '.' . $request->image->getClientOriginalExtension();
       

        // Faz o upload:
        $upload = $request->image->storeAs($this->path, $nameFile);
        // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
        $dataForm['image'] = $upload;
        // Verifica se NÃO deu certo o upload
        if (!$upload)
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer o upload da imagem');


        }

        $insert = auth()->user()->categories()->create($dataForm);
                
        if ($insert){

            DB::commit();
        
            return redirect()
                        ->route ('categories.index')
                        ->with('success', 'O Novo Cliente foi Adicionado com Sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function edit($id)
    {
        if (!$category = Categories::find($id)){
            return redirect()->back();
        }
        $totalCategories = Categories::count();
        return view ('categories.edit', compact('category', 'totalCategories'));      
    }

    public function update(CreateUpdateCategories $request, $id)
    {
        
        if (!$category = Categories::find($id))
            return redirect()->route('categories.index');
       
        $dataForm = $request->except('_token');
        $dataForm['active'] = ( !isset($dataForm['active']) ) ? 0 : 1;

       // Verifica se informou a imagem para upload
       // Verifica se informou a imagem para upload
       if ($request->hasFile('image') && $request->file('image')->isValid()) {

        // Define finalmente o nome
        $nameFile = Str::slug($request->name) . '.' . $request->image->getClientOriginalExtension();
       

        // Faz o upload:
        $upload = $request->image->storeAs($this->path, $nameFile);
        // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
        $dataForm['image'] = $upload;
        // Verifica se NÃO deu certo o upload
        if (!$upload)
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer o upload da imagem');
       }


        $update = $category->update($dataForm);
                
        if ($update){

            DB::commit();
        
            return redirect()
                        ->route ('categories.index')
                        ->with('success', 'A Categoria foi atualizada com sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function show($id)
    {
        if (!$category = Categories::find($id)){
            return redirect()->back();
        }
        
        return view ('categories.show', compact('category'));      
    }

    public function destroy($id)
    {
        if (!$category = Categories::find($id))
            return redirect()->route('categories.index');

        $client->delete();
        
        return redirect()->route('categories.index')->with('success', 'A Categoria foi Deletado com sucesso ! ');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer',
        ]);

        foreach ($request->ids as $index => $id) {
            DB::table('categories')
                ->where('id', $id)
                ->update([
                    'position' => $index + 1
                ]);
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
