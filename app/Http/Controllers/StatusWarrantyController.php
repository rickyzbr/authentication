<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WarrantyStatus;
use App\Models\ColorStatus;
use Illuminate\Support\Str;
use Carbon\Carbon;
use files;
use DB;

class StatusWarrantyController extends Controller
{
    private $warrantystatus;
    private $totalPage = 12;  

    public function __construct(WarrantyStatus $warrantystatus)
    {
        $this->warrantystatus = $warrantystatus;
    }  

    public function index(WarrantyStatus $warrantystatus)
    {
        //$banners = auth()->user()->bannerCreate()->paginate($this->totalPage);
        $warrantystatus = $this->warrantystatus->paginate($this->totalPage);
        $totalStatus = WarrantyStatus::count();
        return view('warrantystatus.index', compact ('warrantystatus', 'totalStatus'));   
    }

    public function create()
    {
        $totalStatus = WarrantyStatus::count();
        $colors = ColorStatus::all();
        return view ('warrantystatus.create', compact ('totalStatus', 'colors'));
    }

    public function store(Request $request)
    {
        
        DB::beginTransaction();

        $dataForm = $request->except('_token');

        $insert = auth()->user()->warrantystatus()->create($dataForm);
                
        if ($insert){

            DB::commit();
        
            return redirect()
                        ->route ('warrantiesstatus.index')
                        ->with('success', 'O Novo Estatus foi Adicionado com Sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function edit($id)
    {
        if (!$status = WarrantyStatus::find($id)){
            return redirect()->back();
        }

        $totalStatus = WarrantyStatus::count();
        $colors = ColorStatus::all();
        return view ('warrantystatus.edit', compact('status', 'colors', 'totalStatus'));      
    }

    public function update(Request $request, $id)
    {
        
        if (!$status = WarrantyStatus::find($id)){
            return redirect()->back();
        }
       
        $dataForm = $request->except('_token');

        $update = $status->update($dataForm);
                
        if ($update){

            DB::commit();
        
            return redirect()
                        ->route ('warrantiesstatus.index')
                        ->with('success', 'Você Atualizou o Estatus Selecionado com Sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function destroy($id)
    {
        if (!$status = WarrantyStatus::find($id)){
            return redirect()->back();
        }
        $status->delete();
        
        return redirect()->route('warrantiesstatus.index')->with('success', 'O Estatus foi Deletado com sucesso ! ');
    }
}
