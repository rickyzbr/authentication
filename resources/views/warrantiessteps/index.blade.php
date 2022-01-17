@section('title', 'Garantia | Etapas da Garantia')

@extends ('layouts.app')

@section('content_header')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">@if($warranty->client_id)
                                                {{$warranty->client->name}} @endif</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Gerencie aqui os Contatos do seu Cliente !</li>
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
        <div class="col-xl-3 col-md-">
            <div class="card m-b-30">
                <div class="card-body" align="central">
                @if($warranty->product_id)
                        @if ($warranty->product->image != null)
                        <div class="col-xl-1">
                            <img class="img-thumbnail shadow" src="{{ url('storage/products/'.$warranty->product->image) }}" alt="{{ $warranty->product->image }}" style="max-width: 170px;" data-holder-rendered="true">
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
                    <div class="button-items float-right float-bottom"> 
                    @if ($warranty->stepsWarranty->count() > 3)
                    <a href class="btn-lg  btn-danger waves-effect waves-light"
                            data-container="body" data-toggle="popover" data-placement="bottom"
                            data-content="Ops! Você Já Cadastrou as 4 Etapas desse Laudo ! ">
                            <i class="fas fa-user-cog"></i> Nova Etapa </a>
                        @else
                    <a href="{{ route('stepswarranty.create', $warranty->id) }}" class="btn-lg  btn-danger waves-effect waves-light" ><i class="fas fa-user-cog"></i> Nova Etapa</a>
                    @endif
                    <a href="{{ route('warranties.index') }}" class="btn-lg  btn-success waves-effect waves-light"><i class="fas fa-chevron-circle-left"></i> Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
        @include('includes.alerts')
        
        <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Lista de Etapas do Produto</h4>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                        <th style="width: 300px">Etapa</th>
                                        <th style="width: 600px">Descriçãos</th>
                                        <th scope="col">Açoes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($steps = $warranty->stepsWarranty)
                                        @foreach($steps as $step)
                                            <tr>
                                            <th scope="row">{{ $step->type($step->type) }}</th>
                                            <td>{!! $step->description !!}</td>
                                            <td>
                                                <div>                                          
                                                    <a href="{{route('stepswarranty.edit', $step->id)}}" class="btn btn-warning waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
                                                </div>
                                            </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

    </div> <!-- container-fluid -->

</div> <!-- content -->

@stop
