<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Clients;
use App\Models\ContactsClients;
use DB;

class CargoController extends Controller
{
    public function index()
    {
        return view ('admin.clients.contacts', compact('client'));      
    }

    public function store(Request $request)
    {
        
        DB::beginTransaction();

        $dataForm = $request->except('_token');
        
        $insert = auth()->user()->cargo()->create($dataForm);
                
        if ($insert){

            DB::commit();
        
            return redirect()
                        ->back()
                        ->with('success', 'O Cargo foi cadastrado com sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function update(Request $request, $id)
    {
        $contact = $this->contact_client->find($id);
        $dataForm = $request->except('_token');

               
        $update = $contact->update($dataForm);
                
        if ($update){

            DB::commit();
        
            return redirect()
                        ->back()
                        ->with('success', 'O Cidade selecionada foi atualizada com sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function destroy($id)
    {
        $contact = $this->contact_client->find($id);
        
        $delete = $contact->delete();
        
        if ($delete){

            DB::commit();
        
            return redirect()
                        ->back()
                        ->with('success', 'O Contato foi deletado com sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }
    }
}
