@extends ('layouts.app')

@section('title', 'Garantia | Edição de Estatus')

@section('content_header')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Edição dos Estatus</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Gerenciamento das Estatus da Analise Técnica do Seus Produtos !</li>
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
            <div class="card bg-primary mini-stat position-relative">
                <div class="card-body">
                    <div class="mini-stat-desc">
                        <h6 class="text-uppercase verti-label text-white-50">Estatus</h6>
                        <div class="text-white">
                            <h6 class="text-uppercase mt-0 text-white-50">Total Estatus</h6>
                            <h3 class="mb-3 mt-0">{{$totalStatus}}</h3>                                                    
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
                    <div class="button-items"> 
                        <a href="{{ route('warrantiesstatus.index') }}" class="btn btn-success waves-effect waves-light"><i class="fas fa-chevron-circle-left"></i> Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-20">
                <div class="card-body">            
                    <h4 class="mt-0 header-title">Atualizar Estatus</h4>
                    <p class="text-muted m-b-30">`Você está atualizando os dados do Estatus : <strong>{{$status->name}}</strong> !</p>            
                        <div class="color-picker-inputs">
                            @include('includes.alerts')
                        </div>
                        
                        <form method="POST" enctype="multipart/form-data" action="{{ route('warrantystatus.update', $status->id) }}">

                        @csrf
                        @method('PUT')

                            <div class="form-group row">
                                <div class="form-group col-xl-8">
                                    <label for="Nome">Nome</label>
                                    <input type="text" name="name"  value="{{ $status->name }}" class="form-control">
                                </div>

                                <div class="form-group col-xl-4">
                                    <label for="titulo">Cores</label>
                                    <select name="color_id" class="form-control">
                                        <option value="">Escolha a Cor</option>
                                        @foreach($colors as $color)
                                        <option value="{{$color->id}}"
                                                @if( isset($status) && $status->color_id ==$color->id )
                                                    selected
                                                @endif
                                                >{{$color->name}}</option>
                                        @endforeach
                                    </select>
                                </div>                     

                                <div class="form-group col-xl-12">
                                    <label for="Frase">Anotações Extras</label>
                                    <textarea id="elm1" name="description" value="{{$status->description}}">{{$status->description}}</textarea>
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
</div>

@stop

