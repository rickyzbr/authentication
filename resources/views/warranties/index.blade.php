@section('title', 'Garantia | Lista de Laudos')

@extends ('layouts.app')

@section('content_header')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Garantia do Produto</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Gerenciamento da Garantia do Produto !</li>
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
                        <h6 class="text-uppercase verti-label text-white-50">Garantias</h6>
                        <div class="text-white">
                            <h6 class="text-uppercase mt-0 text-white-50">Total Laudos</h6>
                            <h3 class="mb-3 mt-0">{{$totalWarranties}}</h3>                                                    
                        </div>
                        <div class="mini-stat-icon">
                            <i class="mdi mdi-cube-outline display-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>                                
        <div class="col-xl-9 col-md-6">                                
            <div class="card m-b-30">
                <div class="card-body">                
                    <h4 class="mt-0 header-title">Açoes</h4>
                        <div class="button-items  float-right"> 
                        <a href="{{ route('warranty.create') }}" class="btn btn-success waves-effect waves-light"><i class="far fa-plus-square"></i>  Novo Laudo</a>
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-search-plus"></i> Busca</a>
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
                            <h4 class="mt-0 header-title mb-4">Lista das Laudos da Garantia</h4>
                            <div class="table-responsive">
                            <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                             @include ('modals.search_warranties')
                    </div>
                </div>
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                        <th style="width: 40px">(#)</th>
                                        <th style="width: 350px">Cliente</th>
                                        <th style="width: 300px">Produto</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Açoes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($warranties as $warranty)
                                        <tr>
                                        <th scope="row">#{{$warranty->id}}</th>
                                        <td>@if($warranty->client_id)
                                        <h6><small class="text-muted">{{$warranty->client->name}}</small></h6> 
                                            @else
                                            -
                                            @endif</td>
                                        <td>@if($warranty->product_id)
                                        <small class="text-muted">{{$warranty->product->name}}</small></h6>
                                            @else
                                            -
                                            @endif</td>
                                        
                                        <td>
                                            <div class="btn-group ml-1 mo-mb-6">
                                            @if($warranty->status_id)
                                                @if($warranty->status->color_id)
                                            <button class="btn btn-{{ $warranty->status->colors->color }} waves-effect waves-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{$warranty->status->name}}
                                                @endif
                                            </button>
                                            @endif
                                                <div class="dropdown-menu">
                                                    @foreach($warrantiesStatus as $status)
                                                        @if($status->color_id)
                                                        <form method="POST" enctype="multipart/form-data" action="{{ route('warranty.updatestatus', $warranty->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status_id" value="{{ $status->id }}">                                                            
                                                            <button class="dropdown-item btn btn-{{ $status->colors->color }} btn-sm">{{ $status->name }}</button>
                                                        </form>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div></td>                                                        
                                        <td>
                                        <div>
                                            <a href="{{route('warranty.show', $warranty->id)}}" class="btn btn-success btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Visualizar"><i class="far fa-eye"></i></a>
                                            <a href="{{route('warranty.images', $warranty->id)}}" class="btn btn-danger btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Imagens"><i class="far fa-file-image"></i></a>
                                            <a href="{{route('stepswarranties.index', $warranty->id)}}" class="btn btn-info btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Etapas"><i class="fas fa-tasks"></i></a>
                                            <a href="{{route('warranty.edit', $warranty->id)}}" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
                                            <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal" data-target="#delWan{{ $warranty->id }}"  data-placement="top" title="Apagar"><i class="far fa-trash-alt"></i></button>
                                        </div>
                                        </td>
                                        </tr>
                                        @include ('modals.delete_warranty')
                                        @endforeach   
                                    </tbody>
                                </table>
                                <br>
                            </div>
                            @if (isset($dataForm))
                                {!! $warranties->appends($dataForm)->links("pagination::bootstrap-4") !!}
                            @else
                                {!! $warranties->links("pagination::tailwind") !!}   
                            @endif
                        </div>
                    </div>
                </div>                                
            </div>
    </div> <!-- container-fluid -->
</div> <!-- content -->
@stop