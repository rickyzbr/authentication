<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use App\Models\Categories;
use App\Models\SubCategories;
use Symfony\Component\HttpFoundation\Response;
use DB;

class SubCategoriesController extends Controller
{
    public function index()
    {
        $totalSubCategories = SubCategories::count();

        $categories = Categories::with('sub_categories')
            ->orderBy('position', 'asc')
            ->get();

        return view('subcategories.index', compact('categories', 'totalSubCategories'));
    }

    public function create()
    {
        $categories = Categories::all();
        $totaSublCategories = SubCategories::count();
        return view ('subcategories.create', compact ('totaSublCategories', 'categories'));
    }

    public function store(Request $request)
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

        $insert = auth()->user()->subcategories()->create($dataForm);
                
        if ($insert){

            DB::commit();
        
            return redirect()
                        ->route ('subcategories.index')
                        ->with('success', 'A Nova Sub-Categoria foi Adicionado com Sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function reorder(Request $request)
    {
        $request->except('_token');
        $request->validate([
            'ids'         => 'required|array',
            'ids.*'       => 'integer',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        foreach ($request->ids as $index => $id) {
            DB::table('sub_categories')
                ->where('id', $id)
                ->update([
                    'position' => $index + 1,
                    'category_id' => $request->category_id
                ]);
        }

        $positions = Categories::find($request->category_id)
            ->sub_categories()
            ->pluck('position', 'id');

        return response(compact('positions'), Response::HTTP_OK);
    }
}
