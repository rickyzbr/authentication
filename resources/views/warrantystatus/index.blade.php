@section('title', 'Garantia | Lista de Status')

@extends ('layouts.app')

@section('content_header')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Cadasto dos Status da Garantia</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Gerenciamento dps Status da Garantia do Produto !</li>
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
                            <a href="{{ route('warrantystatus.create') }}" class="btn btn-success waves-effect waves-light"><i class="far fa-plus-square"></i>  Add Estatus</a>
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
                            <h4 class="mt-0 header-title mb-4">Lista dos Estatus Cadastrados</h4>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                        <th style="width: 40px">(#)</th>
                                        <th style="width: 500px">Nome</th>
                                        <th scope="col">Exemplo</th>
                                        <th scope="col">Autor</th>
                                        <th scope="col">Açoes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($warrantystatus as $status)
                                        <tr>
                                        <th scope="row">#{{$status->id}}</th>
                                        <td>{{$status->name}}</td>
                                        <td>@if($status->color_id)
                                        <button type="button" class="btn btn-{{$status->colors->color}} btn-sm waves-effect">{{$status->colors->name}}</button>
                                        @endif
                                        </td>
                                        <td>@if($status->user_id)
                                                {{$status->user->name}}
                                            @else
                                            -
                                            @endif</td>                                                        
                                        <td>
                                            <div>                                            
                                                <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#view{{$status->id}}"  data-placement="top" title="Apagar"><i class="far fa-eye"></i></button>
                                                <a href="{{route('warrantystatus.edit', $status->id)}}" class="btn btn-warning waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#del{{$status->id}}"  data-placement="top" title="Apagar"><i class="far fa-trash-alt"></i></button>
                                            </div>
                                        </td>
                                        </tr>
                                        @include ('modals.delete_statuses')
                                        @include ('modals.view_statuses')
                                        @endforeach                                     
                                        
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