@extends ('layouts.app')

@section('title', 'Garantia | Cadastro de Laudo')

@section('content_header')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Cadasto de Laudo</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Gerenciamento das Categorias dos seus Produtos Aqui !</li>
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

@section('content')
<div class="page-content-wrapper">
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary mini-stat position-relative">
                <div class="card-body">
                    <div class="mini-stat-desc">
                        <h6 class="text-uppercase verti-label text-white-50">Garantias</h6>
                        <div class="text-white">
                            <h6 class="text-uppercase mt-0 text-white-50">Cadastro de Laudo</h6>
                            <h3 class="mb-3 mt-0">{{$totalWarranties}}</h3>                                                    
                        </div>
                        <div class="mini-stat-icon">
                            <i class="mdi mdi-cube-outline display-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                            
        <div class="col-xl-9 col-md-">                                
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Açoes</h4>
                    <div class="button-items  float-right"> 
                        <a href="{{ route('warranties.index') }}" class="btn btn-success waves-effect waves-light"><i class="fas fa-chevron-circle-left"></i> Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
                <div class="card m-b-20">
                    <div class="card-body">            
                        <h4 class="mt-0 header-title">Cadastrar Novo Laudo</h4>
                        <p class="text-muted m-b-30">Por Favor, insira os dados para Cadastrar um Novo Laudo </p>            
                        <div class="color-picker-inputs">
                        @include('includes.alerts')
                        <form method="POST" enctype="multipart/form-data" action="{{ route('warranty.store') }}">

                    {!! csrf_field() !!}

                    <div class="form-group row">                    
                    <div class="form-group col-xl-6">
                            <label for="Cargo">Cliente</label>
                            <select name="client_id" class="form-control js-clients">
                                    <option value="-1">Escolha o Cliente</option>
                                    @foreach($clients as $client)
                                    <option value="{{$client->id}}"
                                            @if( isset($warranty) && $warranty->client_id == $client->id )
                                                selected
                                            @endif
                                            >{{$client->name}}</option> 
                                    @endforeach
                            </select>
                        </div>  
                        <div class="form-group col-xl-6">
                            <label for="Cargo">Contato</label>
                            <select name="email" class="form-control js-contacts">
                                    <option value="-1">Escolha o Contato</option>
                                    {{-- @foreach($contacts as $contact)
                                    <option value="{{$client->id}}"
                                            @if( isset($warranty) && $warranty->client_id == $client->id )
                                                selected
                                            @endif
                                            >{{$contact->name}} - {{$contact->email}}</option>
                                    @endforeach --}}
                            </select>
                        </div>              

                        <div class="form-group col-xl-12">
                                    <label for="Produto">Produto</label>
                                    <select name="product_id" class="form-control">
                                            <option value="">Escolha o Produto</option>
                                            @foreach($products as $product)
                                            <option value="{{$product->id}}"
                                                    @if( isset($warranty) && $warranty->product == $product->name )
                                                        selected
                                                    @endif
                                                    >{{$product->cod_kgm}} - {{$product->name}}</option>
                                            @endforeach
                                    </select>
                                </div> 

                        <div class="form-group col-xl-12">
                            <label for="Nome">Serial</label>
                            <input type="text" name="serial" value="{{ old('serial') }}" class="form-control">
                        </div>      
                        
                        <div class="form-group col-xl-12">
                            <label for="Frase">Descrição do Ciente</label>
                            <textarea id="elm1" name="description">{{ old('description') }}</textarea>
                            </textarea>
                        </div>

                        <div class="form-group col-xl-12">
                            <label>Nota Fiscal do Produto</label>
                            <input type="file" name="file" class="filestyle" data-buttonname="btn-secondary">
                        </div>

                        <div class="form-group col-xl-10">
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                        </div>
                    </div>
                </form>
                </div>            
            </div>
        </div>
    </div>                                
</div>

@stop


@section('scripts')
@parent
<!-- SELECT -->
<script src="{{ asset('assets/js/site.js') }}"></script>
@endsection
