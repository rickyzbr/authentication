@extends ('layouts.app')

@section('title', 'Garantia | Edição de Etapas da Garantia')

@section('content_header')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Cadasto de Clientes</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Gerencie aqui as Informações Gerais dos Seus Clientes...</li>
            </ol>

            <div class="state-information d-none d-sm-block">
                <div class="state-graph">
                    <div id="header-chart-1"></div>
                    <div class="info">Balance $ 2,317</div>
                </div>
                <div class="state-graph">
                    <div id="header-chart-2"></div>
                    <div class="info">Item Sold 1230</div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
                        <!-- end row -->
@section('content')
<div class="page-content-wrapper">
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card m-b-30">
                <div class="card-body">
                    @if($step->warranty->product_id)
                        @if ($step->warranty->product->image != null)
                        <div class="col-xl-1">
                            <img class="img-thumbnail shadow" src="{{ url('storage/products/'.$step->warranty->product->image) }}" alt="{{ $step->warranty->product->image }}" style="max-width: 170px;" data-holder-rendered="true">
                        </div>
                            @else
                        <div class="col-xl-1">
                            <img class="img-thumbnail shadow" src="{{ url('assets/images/default_img.png') }}" alt="Sem Imagem" style="max-width: 170px;" data-holder-rendered="true">
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    
        <div class="col-xl-9 col-md-">                                
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Açoes</h4>
                    <div class="button-items float-right"> 
                        <a href="{{ route('stepswarranties.index', $step->warranty->id) }}" class="btn btn-success waves-effect waves-light"><i class="fas fa-chevron-circle-left"></i> Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            <div class="card-body">            
                <h4 class="mt-0 header-title">Atualizar Etapas</h4>
                <p class="text-muted m-b-30">`Você está atualizando os dados do {{ $step->type($step->type) }} !</p>            
                    <div class="color-picker-inputs">
                    @include('includes.alerts')
                    </div>
                        <form method="POST" enctype="multipart/form-data" action="{{ route('stepswarranty.update', $step->id) }}">

                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <div class="form-group col-xl-12">
                                <label for="Frase">Anotações Extras</label>
                                <textarea id="elm1" name="description" value="{{$step->description}}">{{$step->description}}</textarea>
                                </textarea>
                            </div>
                            
                            <div class="form-group col-xl-10">
                                <button type="submit" class="btn btn-success">Atualizar</button>
                            </div>
                        </div>
                        </form>
                    </div>            
                </div>
            </div>
        </div>                                
    </div>

@stop

