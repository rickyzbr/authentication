@extends ('layouts.app')

@section('title', 'Garantia | Edição de Laudo')

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

@section('content')
<div class="page-content-wrapper">
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary mini-stat position-relative">
                <div class="card-body">
                    <div class="mini-stat-desc">
                        <h6 class="text-uppercase verti-label text-white-50">Categorias</h6>
                        <div class="text-white">
                            <h6 class="text-uppercase mt-0 text-white-50">Total Categorias</h6>
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
                    <div class="button-items float-right"> 
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
                    <h4 class="mt-0 header-title">Atualizar Laudo</h4>
                    <p class="text-muted m-b-30">`Você está atualizando os dados do {{$warranty->id}} !</p>            
                        <div class="color-picker-inputs">
                            @include('includes.alerts') 
                        </div>      
                    <form method="POST" enctype="multipart/form-data" action="{{ route('warranty.update', $warranty->id) }}">

                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <div class="form-group col-xl-6">
                                <label for="Cargo">Cliente</label>
                                <select name="client_id" class="form-control js-clients">
                                        <option value="">Escolha o Cliente</option>
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
                                    <option value="">Escolha o Contato</option>
                                    {{-- @foreach($contacts as $contact)
                                    <option value="{{$client->id}}"
                                            @if( isset($warranty) && $warranty->client_id == $client->id )
                                                selected
                                            @endif
                                            >{{$client->name}} - {{$client->email}}</option>
                                    @endforeach --}}
                            </select>
                            </div>
                            <div class="form-group col-xl-12">
                                <label for="Cargo">Produto</label>
                                <select name="product_id" class="form-control">
                                        <option value="">Escolha o Produto</option>
                                        @foreach($products as $product)
                                        <option value="{{$product->id}}"
                                                @if( isset($warranty) && $warranty->product_id == $product->id )
                                                    selected
                                                @endif
                                                >{{$product->cod_kgm}} - {{$product->name}}</option>
                                        @endforeach
                                </select>
                            </div> 

                            <div class="form-group col-xl-12">
                                <label for="Nome">Serial</label>
                                <input type="text" name="serial" value="{{$warranty->serial}}" class="form-control">
                            </div>      
                            
                            <div class="form-group col-xl-12">
                                <label for="Frase">Descrição do Ciente</label>
                                <textarea id="elm1" name="description" value="{{$warranty->description}}">{{$warranty->description}}</textarea>
                                </textarea>
                            </div>

                            @if( isset($warranty->file) )
                            <div class="col-xl-3">
                                <div class="alert alert-success" role="alert">
                                    <strong>Nota fiscal Cadastrada</strong>
                                </div>
                            </div>
                            @else
                            <div class="col-xl-3">
                                <div class="alert alert-primary" role="alert">
                                    <strong>Sem Nota fiscal Cadastrada</strong>
                                </div>
                            </div>
                            @endif

                            <div class="form-group col-xl-12">
                                <label>Nota Fiscal do Produto</label>
                                <input type="file" name="file" class="filestyle" data-buttonname="btn-secondary">
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
</div>

@stop

@section('scripts')
@parent
<!-- SELECT -->
<script src="{{ asset('assets/js/site.js') }}"></script>
@endsection