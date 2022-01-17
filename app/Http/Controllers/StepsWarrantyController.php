<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Warranty;
use App\Models\Clients;
use App\Models\WarrantyStatus;
use App\Models\WarrantySteps;
use Illuminate\Support\Str;
use Carbon\Carbon;
use files;
use DB;

class StepsWarrantyController extends Controller
{
    private $warranties;
    private $totalPage = 12;  
    private $path = 'steps_warranty'; 

    public function __construct(WarrantySteps $warrantysteps)
    {
        $this->warrantysteps = $warrantysteps;
    }


    public function index(WarrantySteps $warrantysteps, $id)
    {
        if (!$warranty = Warranty::find($id)){
            return redirect()->back();
        }

        $types = $warrantysteps->type();

        $totalWarranties = Warranty::count();
        return view('warrantiessteps.index', compact ('warranty', 'types', 'totalWarranties'));   
    }

    public function create($id)
    {
        if (!$warranty = Warranty::find($id)){
            return redirect()->back();
        }

        $steps = WarrantySteps::where('warranty_id', $warranty->id);
        $totalWarranties = Warranty::count();
        $clients = Clients::all();
        return view ('warrantiessteps.create', compact ('warranty', 'totalWarranties', 'clients', 'steps'));
    }

    public function store(Request $request, $id)
    {
        if (!$warranty = Warranty::find($id)){
            return redirect()->back();
        }

        DB::beginTransaction();

        
        $dataForm = $request->except('_token');
        $dataForm['warranty_id'] = $warranty->id;

        $insert = auth()->user()->warrantysteps()->create($dataForm);
                
        if ($insert){

            DB::commit();
        
            return redirect()
                        ->route ('stepswarranties.index', $warranty->id)
                        ->with('success', 'Você  Incluiu uma nova Etapa ao Laudo de Análise Técnica !! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function edit($id)
    {
        if (!$step = WarrantySteps::find($id)){
            return redirect()->back();
        }

        return view ('warrantiessteps.edit', compact('step'));      
    }

    public function update(Request $request, $id)
    {
        
        if (!$step = WarrantySteps::find($id)){
            return redirect()->back();
        }
       
        $dataForm = $request->except('_token');

        $update = $step->update($dataForm);
                
        if ($update){

            DB::commit();
        
            return redirect()
                        ->route ('stepswarranties.index', $step->warranty->id)
                        ->with('success', 'Você Atualizou a Etapa Selecionada com Sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function destroy($id)
    {
        if (!$step = WarrantySteps::find($id)){
            return redirect()->back();
        }
        $step->delete();
        
        return redirect()
                ->route('stepswarranties.index', $step->warranty->id)
                ->with('success', 'A Etapa foi Deletado com sucesso ! ');
    }
}
