@section('title', 'Clientes | Lista de Contatos')

@extends ('layouts.app')

@section('content_header')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">{{ $client->name }}</h4>
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

                    @if ($client->image != null)
                    <div class="col-xl-1s">
                        <img class="img-thumbnail shadow" src="{{ url('storage/'.$client->image) }}" alt="{{ $client->image }}" style="max-width: 200px;" data-holder-rendered="true">
                    </div>
                        @else
                    <div class="col-xl-1s">
                        <img class="img-thumbnail shadow" src="{{ url('assets/images/default_img.png') }}" alt="Sem Imagem" style="max-width: 200px;" data-holder-rendered="true">
                    </div>
                    @endif
            </div>
        </div>
    </div>    
    <div class="col-xl-9 col-md-">                                
        <div class="card m-b-30">
            <div class="card-body">                
                <h4 class="mt-0 header-title">Açoes</h4>
                    <div class="button-items float-right"> 
                    <a href="" class="btn-lg  btn-warning waves-effect waves-light" data-toggle="modal" data-target="#add_contact"><i class="far fa-user-circle"></i> Add Contato</a>
                    <a href="" class="btn-lg  btn-danger waves-effect waves-light" data-toggle="modal" data-target="#add_cargo"><i class="fas fa-user-cog"></i> Add Cargo</a>
                    <a href="{{ route('clients.index') }}" class="btn-lg  btn-success waves-effect waves-light"><i class="fas fa-chevron-circle-left"></i> Voltar</a>
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
                                        <th style="width: 250px">Nome</th>
                                        <th style="width: 350px">Cargo</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col">Açoes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($contacts = $client->contactsClient)
                                     @foreach($contacts as $contact)
                                        <tr>
                                        <th scope="row">{{$contact->name}}</th>
                                        <td>@if($contact->cargo_id)
                                                {{$contact->cargo->name}}
                                            @else
                                            -
                                            @endif</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->phone}}</td>
                                        <td>
                                            <div>                                          
                                                <a href="{{route('client.edit', $contact->id)}}" class="btn btn-warning waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"  data-placement="top" title="Apagar"><i class="far fa-trash-alt"></i></button>
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

@include ('modals.new_contactclient')
@include ('modals.new_cargo')

@stop
