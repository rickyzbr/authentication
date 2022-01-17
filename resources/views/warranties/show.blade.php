@section('title', 'Garantia | Relatório')

@extends ('layouts.app')

@section('content_header')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">@if($warranty->client_id)
                                                {{$warranty->client->name}} @endif</h4>
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
                    <div class="button-items float-right"> 
                    <a href="{{route('warranty.pdf', $warranty->id)}}" class="btn btn-info waves-effect waves-light"><i class="far fa-file-pdf"></i> Gerar PDF</a>
                    <a href="{{ route('warranties.index') }}" class="btn btn-success waves-effect waves-light"><i class="fas fa-chevron-circle-left"></i> Voltar</a>
                </div>
            </div>
        </div>
    </div>

        <div class="col-xl-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="invoice-title">
                                <h4 class="float-right font-12"><strong>Cadastro : {{ $warranty->created_at->formatLocalized('%A, %d de %B de %Y') }} - {{ $warranty->created_at->diffForHumans() }}</strong></h4>
                                <h3 class="mt-0">
                                Identificação do Laudo # {{ $warranty->id }}
                                
                                @if($warranty->status_id)
                                    @if($warranty->status->color_id)
                                <button class="btn btn-{{ $warranty->status->colors->color }} waves-effect waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$warranty->status->name}}
                                    @endif
                                </button>
                                @endif
                                </h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <address>
                                    @if($warranty->client_id)
                                        <strong>Endereço :</strong> {{ $warranty->client->address }}, {{ $warranty->client->number }} <strong>CEP :</strong> {{ $warranty->client->cep }}<br>
                                        <strong>E-mail :</strong> {{ $warranty->client->email }}<br>
                                        <strong>Telefone :</strong> {{ $warranty->client->phone }}<br>
                                        <strong>CNPJ :</strong> {{ $warranty->client->cnpj }} <strong>Inscrição Estadual :</strong> {{ $warranty->client->insc }}<br>
                                        <strong>{{ $warranty->client->country }} - {{ $warranty->client->city }} - {{ $warranty->client->state }}</strong>
                                    @endif
                                    </address>
                                </div>
                                <div class="col-6 text-right">
                                    <address>
                                        <strong>Cadastrado Por :</strong><br>
                                        @if($warranty->user_id)
                                                {{$warranty->user->name}} @endif<br>
                                        Técnico - KGM<br>
                                        Apt. 4B<br>
                                        Springfield, ST 54321
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 m-t-30">
                                    <address>
                                        <strong>Relato do Cliente :</strong><br>
                                        {!! $warranty->description !!}
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div>
                                <div class="p-2">
                                    <h3 class="font-16"><strong>Produto</strong></h3>
                                </div>
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <td><strong>Nome</strong></td>
                                                <td><strong>Cod. KGM</strong></td>
                                                <td><strong>Cod. Original</strong></td>
                                                <td><strong>Serial</strong></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($warranty->product_id)
                                        <tr>
                                        <th scope="row">{{$warranty->product->name}}</th>
                                        <td>{{$warranty->product->cod_kgm}}</td>
                                        <td>{{$warranty->product->cod_original}}</td>
                                        <td>{{$warranty->serial}}</td>
                                        </tr>
                                        @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            @if($images = $warranty->imagesWarranty)
                                @foreach($images as $image) 
                                <img class="img-thumbnail shadow " alt="400x400" width="248" src="{{ url('storage/'.$image->filename) }}" data-holder-rendered="true">
                                @endforeach
                            @endif
                        </div>
                    </div> <!-- end row -->
<br>
<br>
                    @if($steps = $warranty->stepsWarranty)
                                @foreach($steps as $step) 
                                <div class="row">
                        <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-header">
                                        <strong>{{ $step->type($step->type) }}</strong>
                                        </div>
                                        <div class="card-body">
                                            <blockquote class="card-blockquote mb-0">
                                            {!! $step->description !!}
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
</div>
                                @endforeach
                            @endif
                </div>
            </div>
        </div> <!-- end col -->

       
@stop
