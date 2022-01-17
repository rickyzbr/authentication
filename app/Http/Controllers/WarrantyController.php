<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Warranty;
use App\Models\Clients;
use App\Models\WarrantyStatus;
use App\Models\Products;
use App\Models\ImagesWarranty;
use App\Models\ContactsClients;
use App\Notifications\StatusWarranties;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use files;
use DB;
use Illuminate\Support\Facades\Storage;

class WarrantyController extends Controller
{
    private $warranties;
    private $totalPage = 10;  
    private $path = 'images_warranty'; 

    public function __construct(Warranty $warranties)
    {
        $this->warranties = $warranties;
    }  

    public function index(Warranty $warranties)
    {
        //$banners = auth()->user()->bannerCreate()->paginate($this->totalPage);
        $warranties = $this->warranties->paginate($this->totalPage);
        $warrantiesStatus = WarrantyStatus::all();
        $totalWarranties = Warranty::count();
        $clients = Clients::all();
        $products = Products::all();
        return view('warranties.index', compact ('warranties', 'totalWarranties', 'warrantiesStatus', 'clients', 'products'));   
    }

    public function create()
    {
        $totalWarranties = Warranty::count();
        $clients = Clients::all();
        $products = Products::all();
        return view ('warranties.create', compact ('totalWarranties', 'clients', 'products'));
    }

    public function store(Request $request)
    {
        
        DB::beginTransaction();

        $dataForm = $request->except('_token');
        $dataForm['active'] = ( !isset($dataForm['active']) ) ? 0 : 1;
        $dataForm['date'] = date('Ymd');

        if ($request->hasFile('file') && $request->file('file')->isValid()) {

            // Define finalmente o nome
            $nameFile = Str::slug($request->file) . '.' . $request->file->getClientOriginalExtension();
           
    
            // Faz o upload:
            $upload = $request->file->storeAs($this->path, $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
            $dataForm['file'] = $upload;
            // Verifica se NÃO deu certo o upload
            if (!$upload)
                    return redirect()
                                ->back()
                                ->with('error', 'Falha ao fazer o upload da imagem');
        }

        $insert = auth()->user()->warranty()->create($dataForm);
                
        if ($insert){

            DB::commit();
        
            return redirect()
                        ->route ('warranties.index')
                        ->with('success', 'Você Cadastrou um novo Laudo de Garantia Com Sucesso !! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function edit($id)
    {
        if (!$warranty = Warranty::find($id)){
            return redirect()->back();
        }

        $clients = Clients::all();
        $products = Products::all();
        $totalWarranties = Warranty::count();
        return view ('warranties.edit', compact('warranty', 'totalWarranties', 'clients', 'products'));      
    }

    public function update(Request $request, $id)
    {
        
        if (!$warranty = Warranty::find($id)){
            return redirect()->back();
        }

        $dataForm = $request->except('_token');

       // Verifica se informou a imagem para upload
       if ($request->hasFile('file') && $request->file('file')->isValid()) {

        // Define finalmente o nome
        $nameFile = Str::slug($request->file) . '.' . $request->file->getClientOriginalExtension();
       

        // Faz o upload:
        $upload = $request->file->storeAs($this->path, $nameFile);
        // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
        $dataForm['file'] = $upload;
        // Verifica se NÃO deu certo o upload
        if (!$upload)
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer o upload da imagem');
       }


        $update = $warranty->update($dataForm);
                
        if ($update){

            DB::commit();
        
            return redirect()
                        ->back()
                        ->with('success', 'O Laudo selecionado foi atualizado com sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function show($id)
    {
        if (!$warranty = Warranty::find($id)){
            return redirect()->back();
        }
        
        return view ('warranties.show', compact('warranty'));      
    }

    public function showPdf($id)
    {
        if (!$warranty = Warranty::find($id)){
            return redirect()->back();
        }
        return PDF::loadView('warranties.pdf', compact('warranty'))
            ->stream();
    }

    public function photos($id)
    {
        if (!$warranty = Warranty::find($id)){
            return redirect()->back();
        }
        
        return view ('warranties.photos', compact('warranty'));      
    }

    public function uploadPhotos(Request $request, $id)
    {

        if (!$warranty = Warranty::find($id)){
            return redirect()->back();
        }

        $dataForm = $request->except('_token');

        $image = $request->file('file');
        // Define finalmente o nome
        $nameFile = $image->getClientOriginalName();

        // Faz o upload:
        $upload = $image->storeAs($this->path, $nameFile);
        $dataForm['filename'] = $upload;
        $dataForm['warranty_id'] = $warranty->id;
        

        $insert = auth()->user()->imageWarranty()->create($dataForm);

        if ($insert){

            DB::commit();
        
            return response()->json(['success'=>$nameFile]);

        }
         
    }

    public function destroyPhotos($id)
    {
        if (!$file = ImagesWarranty::find($id)){
            return redirect()->back();
        }

        // Deleta o registro do usuário
        if ( $file->delete() ) {
            // Deleta a imagem (Não esqueça: use Illuminate\Support\Facades\Storage;)
            Storage::delete("{$file->filename}"); // true ou false

        // Redireciona, informando que deu tudo certo!
        return redirect()->back()->with('success', 'A Imagem foi Apagada Com sucesso ! ');
        }       

        // Em caso de falhas redireciona o usuário de vola e informa que não foi possível deletar
        return redirect()
                    ->back()
                    ->with('error', 'Falha ao deletar!');
    }

      
    


    public function statusChange(Request $request, $id)
    {
        if (!$warranty = Warranty::find($id)){
            return redirect()->back();
        }
        
        $dataForm = $request->except('_token');

        $warranty->status_id = $dataForm['status_id'];

        $contact = $warranty;
        $contact->notify(new StatusWarranties($warranty));
       
        $update = $warranty->save();
                
        
        if ($update){

            DB::commit();
        
            return redirect()
                        ->back()
                        ->with('success', 'Você Atualizou o Estatus da Laudo de Garantia !');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function destroy($id)
    {
        if (!$warranty = Warranty::find($id)){
            return redirect()->back();
        }

        $warranty->delete();
        
        return redirect()->route('warranties.index')->with('success', 'O Laudo Selecionado foi Deletado com sucesso ! ');
    }

    public function loadContacts($ContactId)    
    {
        $contacts= ContactsClients::where('client_id', '=', $ContactId)->get(['id', 'name', 'email']);
        return response()->json($contacts);
    }


    public function searchWarranty(Request $request, Warranty $warranty)
    {
        
        $totalWarranties = Warranty::count();
        $clients = Clients::all();
        $products = Products::all();
        $warrantiesStatus = WarrantyStatus::all();
        $dataForm = $request->except('_token');
        $warranties = $warranty->search($dataForm, $this->totalPage);

        return view('warranties.index', compact('warranties', 'clients', 'products', 'warrantiesStatus', 'totalWarranties', 'dataForm'));
    }
}
