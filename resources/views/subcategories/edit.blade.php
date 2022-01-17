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
                                                    <a href="{{ route('categories.index') }}" class="btn btn-success waves-effect waves-light"><i class="fas fa-chevron-circle-left"></i> Voltar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-12">
                                    <div class="card m-b-20">
                                        <div class="card-body">            
                                            <h4 class="mt-0 header-title">Atualizar Categoria</h4>
                                            <p class="text-muted m-b-30">`Você está atualizando os dados do {{$category->name}} !</p>            
                                            <div class="color-picker-inputs">
                                            @include('includes.alerts')
                                            <form method="POST" enctype="multipart/form-data" action="{{ route('category.update', $category->id) }}">
   
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <div class="form-group col-xl-12">
                        <label for="Nome">Nome</label>
                        <input type="text" name="name"  value="{{ $category->name }}" class="form-control">
                    </div>
                    
                    @if( isset($category) )
                    <div class="col-xl-4">
                        <img class="img-thumbnail shadow" src="{{ url('storage/'.$category->image) }}" alt="{{ $category->image }}" style="max-width: 640px;" data-holder-rendered="true">
                    </div>
                        @else
                    @endif

                    <div class="form-group col-xl-12">
                        <label>Imagem da Categoria</label>
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

