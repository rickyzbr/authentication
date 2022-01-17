        @extends ('layouts.app')
        @section('title', 'Admin | Cadastro de Clientes')
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
                                                    <a href="{{ route('clients.index') }}" class="btn btn-success waves-effect waves-light"><i class="fas fa-chevron-circle-left"></i> Voltar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-12">
                                    <div class="card m-b-20">
                                        <div class="card-body">            
                                            <h4 class="mt-0 header-title">Atualizar Cliente</h4>
                                            <p class="text-muted m-b-30">`Você está atualizando os dados do {{$client->name}} !</p>            
                                            <div class="color-picker-inputs">
                                            @include('includes.alerts')
                                            <form method="POST" enctype="multipart/form-data" action="{{ route('client.update', $client->id) }}">
   
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <div class="form-group col-xl-9">  
                        <label for="active" class="control-label">Cliente Ativo ? </label> <br>
                        <input type="checkbox" name="active"  id="switch6" switch="primary" value="1" @if ( isset($client) && $client->active == '1') checked @endif>
                        <label for="switch6" data-on-label="Sim"  data-off-label="Não"></label>
                    </div>
                    
                    
                    <div class="form-group col-xl-12">
                        <label for="Nome">Nome</label>
                        <input type="text" name="name"  value="{{ $client->name }}" class="form-control">
                    </div>

                    <div class="form-group col-xl-2">
                        <label for="CEP">CEP</label>
                        <input type="text" name="cep"  value="{{ $client->cep }}" class="form-control">
                    </div>

                    <div class="form-group col-xl-5">
                        <label for="Endereco">Endereço</label>
                        <input type="text" name="address"  value="{{$client->address}}" class="form-control">
                    </div>

                    <div class="form-group col-xl-1">
                        <label for="Numero">Numero</label>
                        <input type="text" name="number"  value="{{$client->number}}" class="form-control">
                    </div>

                    <div class="form-group col-xl-2">
                        <label for="Complemento">Complemento</label>
                        <input type="text" name="complement"  value="{{$client->complement}}" class="form-control">
                    </div>

                    <div class="form-group col-xl-2">
                        <label for="Bairro">Bairro</label>
                        <input type="text" name="bairro"  value="{{$client->bairro}}" class="form-control">
                    </div>

                    <div class="form-group col-xl-3">
                        <label for="Cidade">Cidade</label>
                        <input type="text" name="city"  value="{{$client->city}}" class="form-control">
                    </div>

                    <div class="form-group col-xl-2">
                        <label for="Estado">Estado</label>
                        <input type="text" name="state"  value="{{$client->state}}" class="form-control">
                    </div>

                    <div class="form-group col-xl-2">
                        <label for="Pais">País</label>
                        <input type="text" name="country"  value="{{$client->country}}" class="form-control">
                    </div>

                    <div class="form-group col-xl-2">
                        <label for="Telefone">Telefone</label>
                        <input type="text" name="phone"  value="{{$client->phone}}" class="form-control">
                    </div>

                    <div class="form-group col-xl-3">
                        <label for="CNPJ">CNPJ</label>
                        <input type="text" name="cnpj"  value="{{$client->cnpj}}" class="form-control">
                    </div>

                    <div class="form-group col-xl-3">
                        <label for="Inscricao">Incrição Estadual</label>
                        <input type="text" name="insc"  value="{{$client->insc}}" class="form-control">
                    </div>

                    <div class="form-group col-xl-4">
                        <label for="E-mail">E-mail</label>
                        <input type="text" name="email"  value="{{$client->email}}" class="form-control">
                    </div>

                    <div class="form-group col-xl-12">
                        <label for="Frase">Anotações Extras</label>
                        <textarea id="elm1" name="description" value="{{$client->description}}">{{$client->description}}</textarea>
                        </textarea>
                    </div>

                    @if( isset($client) )
                    <div class="col-xl-4">
                        <img class="img-thumbnail shadow" src="{{ url('storage/'.$client->image) }}" alt="{{ $client->image }}" style="max-width: 640px;" data-holder-rendered="true">
                    </div>
                        @else
                    @endif

                    <div class="form-group col-xl-12">
                        <label>Logotipo da Empresa</label>
                        <input type="file" name="image" class="filestyle" data-buttonname="btn-secondary">
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

@stop

