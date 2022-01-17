@section('title', 'Vistualização do Cliente')

@extends ('layouts.app')

@section('content_header')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">{{ $client->name }}</h4>
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
                    <a href="{{ route('clients.index') }}" class="btn btn-success waves-effect waves-light"><i class="fas fa-chevron-circle-left"></i> Voltar</a>
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
                                <h4 class="float-right font-12"><strong>Cadastro : {{ $client->created_at->formatLocalized('%A, %d de %B de %Y') }} - {{ $client->created_at->diffForHumans() }}</strong></h4>
                                <h3 class="mt-0">
                                Cliente ID # {{ $client->id }}
                                </h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <address>
                                        <strong>Endereço :</strong> {{ $client->address }}, {{ $client->number }} <strong>CEP :</strong> {{ $client->cep }}<br>
                                        <strong>E-mail :</strong> {{ $client->email }}<br>
                                        <strong>Telefone :</strong> {{ $client->phone }}<br>
                                        <strong>CNPJ :</strong> {{ $client->cnpj }} <strong>Inscrição Estadual :</strong> {{ $client->insc }}<br>
                                        <strong>{{ $client->country }} - {{ $client->city }} - {{ $client->state }}</strong>
                                    </address>
                                </div>
                                <div class="col-6 text-right">
                                    <address>
                                        <strong>Cadastrado Por :</strong><br>
                                        Kenny Rigdon<br>
                                        1234 Main<br>
                                        Apt. 4B<br>
                                        Springfield, ST 54321
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 m-t-30">
                                    <address>
                                        <strong>Observações sobre a Empresa:</strong><br>
                                        {!! $client->description !!}
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div>
                                <div class="p-2">
                                    <h3 class="font-16"><strong>Contatos Cadastrados na Empresa</strong></h3>
                                </div>
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <td><strong>Nome</strong></td>
                                                <td><strong>Cargo</strong></td>
                                                <td><strong>E-mail</strong></td>
                                                <td><strong>Telefone</strong></td>
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
                                        </tr>
                                        @endforeach
                                        @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-print-none">
                                        <div class="float-right">
                                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                            <a href="#" class="btn btn-primary waves-effect waves-light">Send</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end row -->

                </div>
            </div>
        </div> <!-- end col -->

        
@stop
