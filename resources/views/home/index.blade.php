                @extends ('layouts.app')
                        @section('content_header')
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Dashboard</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active">Welcome to Agroxa Dashboard</li>
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
                                                    <h6 class="text-uppercase mt-0 text-white-50">Clientes</h6>
                                                    <h3 class="mb-3 mt-0">30</h3>
                                                    <div class="">
                                                        <span class="badge badge-light text-info"> +11% </span> <span class="ml-2">From previous period</span>
                                                    </div>
                                                </div>
                                                <div class="mini-stat-icon">
                                                    <i class="mdi mdi-cube-outline display-2"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-primary mini-stat position-relative">
                                        <div class="card-body">
                                            <div class="mini-stat-desc">
                                                <h6 class="text-uppercase verti-label text-white-50">Produtos</h6>
                                                <div class="text-white">
                                                    <h6 class="text-uppercase mt-0 text-white-50">Produtos</h6>
                                                    <h3 class="mb-3 mt-0">458</h3>
                                                    <div class="">
                                                        <span class="badge badge-light text-danger"> -29% </span> <span class="ml-2">From previous period</span>
                                                    </div>
                                                </div>
                                                <div class="mini-stat-icon">
                                                    <i class="mdi mdi-buffer display-2"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-primary mini-stat position-relative">
                                        <div class="card-body">
                                            <div class="mini-stat-desc">
                                                <h6 class="text-uppercase verti-label text-white-50">Notícias</h6>
                                                <div class="text-white">
                                                    <h6 class="text-uppercase mt-0 text-white-50">Noticias</h6>
                                                    <h3 class="mb-3 mt-0">15.9</h3>
                                                    <div class="">
                                                        <span class="badge badge-light text-primary"> 0% </span> <span class="ml-2">From previous period</span>
                                                    </div>
                                                </div>
                                                <div class="mini-stat-icon">
                                                    <i class="mdi mdi-tag-text-outline display-2"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-primary mini-stat position-relative">
                                        <div class="card-body">
                                            <div class="mini-stat-desc">
                                                <h6 class="text-uppercase verti-label text-white-50">lançamentos</h6>
                                                <div class="text-white">
                                                    <h6 class="text-uppercase mt-0 text-white-50">Lanç..</h6>
                                                    <h3 class="mb-3 mt-0">R$ 1500,00</h3>
                                                    <div class="">
                                                        <span class="badge badge-light text-info"> +89% </span> <span class="ml-2">From previous period</span>
                                                    </div>
                                                </div>
                                                <div class="mini-stat-icon">
                                                    <i class="mdi mdi-briefcase-check display-2"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div> <!-- container-fluid -->

                </div> <!-- content -->
                @stop
