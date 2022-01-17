<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use files;
use App\User;
use App\Models\Clients;
use App\Models\AttachmentsClients;
use App\Models\Cargo;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

class ClientController extends Controller
{
    private $clients;
    private $totalPage = 12;
    private $path = 'clients';   

    public function __construct(AttachmentsClients $AttachmentsClients, Clients $clients)
    {
        $this->AttachmentsClients = $AttachmentsClients;
        $this->clients = $clients;


    }  

    public function index(Clients $clients)
    {
        //$banners = auth()->user()->bannerCreate()->paginate($this->totalPage);
        $clients = $this->clients->paginate($this->totalPage);
        $totalClients = Clients::count();
        $cargos = Cargo::all();
        return view('clients.index', compact ('clients', 'totalClients', 'cargos'));   
    }

    public function create()
    {
        $totalClients = Clients::count();
        return view ('clients.create', compact ('totalClients'));
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

        $insert = auth()->user()->clients()->create($dataForm);
                
        if ($insert){

            DB::commit();
        
            return redirect()
                        ->route ('clients.index')
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
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }
        $totalClients = Clients::count();
        return view ('clients.edit', compact('client', 'totalClients'));      
    }

    public function update(Request $request, $id)
    {
        
        if (!$client = Clients::find($id))
            return redirect()->route('clients.index');
       
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


        $update = $client->update($dataForm);
                
        if ($update){

            DB::commit();
        
            return redirect()
                        ->route ('clients.index')
                        ->with('success', 'O Produto foi atualizado com sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function show($id)
    {
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }
        
        return view ('clients.show', compact('client'));      
    }

    public function destroy($id)
    {
        if (!$client = Clients::find($id))
            return redirect()->route('clients.index');

        $client->delete();
        
        return redirect()->route('clients.index')->with('success', 'O Cliente foi Deletado com sucesso ! ');
    }

    public function uploadFiles($id, Request $request)
    {

            
        //$client = $this->clients->find($id);
        $client  = $this->clients->find($id); 

        //        image upload
        $image=$request->file('file');

        if($image){
            $imageName=time(). $image->getClientOriginalName();
            $image->move('images',$imageName);
            $imagePath = "$imageName";

            $client->files()->create(['image_path'=>$imagePath]);
        }

        return "done";
        // Product::create($formInput);
    }

}
