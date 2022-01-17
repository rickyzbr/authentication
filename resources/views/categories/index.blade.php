@section('title', 'Categorias | Lista de Clientes')

@extends ('layouts.app')

@section('content_header')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Cadasto de Categorias</h4>
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
                        <!-- end row -->
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
                                <h3 class="mb-3 mt-0">{{$totalCategories}}</h3>                                                    
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
                            <a href="{{ route('category.create') }}" class="btn btn-success waves-effect waves-light"><i class="far fa-plus-square"></i>  Add Categoria</a>
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
                            <h4 class="mt-0 header-title mb-4">Lista de Categorias Cadastradas</h4>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                        <th style="width: 20px">(#) Id</th>
                                        <th style="width: 100px">Imagem</th>
                                        <th style="width: 500px">Nome</th>
                                        <th scope="col">Autor</th>
                                        <th scope="col">Position</th>
                                        <th scope="col">Açoes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                        <th scope="row">#{{$category->id}}</th>
                                        <td>@if ($category->image != null)                  
                                            <img img class="img-thumbnail shadow" src="{{ url('storage/'.$category->image) }}" alt="{{ $category->name }}" style="max-width: 80px;">
                                            @else
                                            <img img class="img-thumbnail shadow" src="{{ url('assets/images/default_imgproduct.png') }}" alt="{{ $category->name }}" style="max-width: 8px;">
                                            @endif
                                        </td>
                                        <td>{{$category->name}}</td>
                                        <td>@if($category->user_id)
                                                {{$category->user->name}}
                                            @else
                                            -
                                            @endif</td>
                                        <td>{{$category->position}}</td>                                                        
                                        <td>
                                            <div>
                                                <a href="{{route('category.view', $category->id)}}" class="btn btn-success waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Visualizar"><i class="far fa-eye"></i></a>
                                                <a href="{{route('category.edit', $category->id)}}" class="btn btn-warning waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"  data-placement="top" title="Apagar"><i class="far fa-trash-alt"></i></button>
                                            </div>
                                        </td>
                                        </tr>
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