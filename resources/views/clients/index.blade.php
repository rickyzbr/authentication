@section('title', 'Produtos | Lista de Categorias')

@extends ('layouts.app')
@section('content_header')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Cadasto de Categorias</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Gerencie aqui as Catgorias dos Seus Produtos...</li>
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
                        <h6 class="text-uppercase verti-label text-white-50">Clientes</h6>
                        <div class="text-white">
                            <h6 class="text-uppercase mt-0 text-white-50">Total Clientes</h6>
                            <h3 class="mb-3 mt-0">{{$totalClients}}</h3>                                                    
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
                        <a href="{{ route('client.create') }}" class="btn btn-success waves-effect waves-light"><i class="far fa-plus-square"></i>  Add Cliente</a>
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
                                            <h4 class="mt-0 header-title mb-4">Lista de Clientes Cadastrados</h4>
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                      <tr>
                                                        <th scope="col">(#) Id</th>
                                                        <th style="width: 500px">Nome</th>
                                                        <th scope="col">Telefone</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Açoes</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($clients as $client)
                                                      <tr>
                                                        <th scope="row">#{{$client->id}}</th>
                                                        <td>{{$client->name}}</td>
                                                        <td>{{$client->phone}}</td>
                                                        <td>
                                                        @if ( $client->active == '1')
                                                        <span class="badge badge-success">Ativado</span>
                                                        @else
                                                        <span class="badge badge-primary">Desativado</span>@endif
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <a href="{{route('client.view', $client->id)}}" class="btn btn-success waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Visualizar"><i class="far fa-eye"></i></a>
                                                                <a href="{{route('client.contacts', $client->id)}}" class="btn btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Contatos"><i class="far fa-user-circle"></i></a>
                                                                <a href="{{route('client.attachments', $client->id)}}" class="btn btn-info waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Arquivos"><i class="fas fa-paperclip"></i></a>
                                                                <a href="{{route('client.edit', $client->id)}}" class="btn btn-warning waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
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

                @include ('modals.delete_client')
                @stop
