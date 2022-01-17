<div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Menu</li>
                            <li>
                                <a href="/dashboard" class="waves-effect">
                                    <i class="mdi mdi-home"></i><span class="badge badge-primary float-right"></span> <span> Dashboard </span>
                                </a>
                            </li>

                            <li>
                                <a href="/calendario" class="waves-effect"><i class="mdi mdi-calendar-check"></i><span> Blog </span></a>
                            </li>

                            <li>
                                <a href="/clientes" class="waves-effect"><i class="mdi mdi-calendar-check"></i><span> Clientes </span></a>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-buffer"></i> <span> Produtos <span class="float-right menu-arrow"><i class="mdi mdi-plus"></i></span> </span> </a>
                                <ul class="submenu">
                                    <li><a href="/categorias">Categorias</a></li>
                                    <li><a href="/subcategorias">Sub Categorias</a></li>
                                    <li><a href="/especificacoes">Especificações</a></li>
                                    <li><a href="/variacoes">Variações</a></li>
                                    <li><a href="/produtos">Produtos</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-buffer"></i> <span> Garantia Produtos <span class="float-right menu-arrow"><i class="mdi mdi-plus"></i></span> </span> </a>
                                <ul class="submenu">
                                    <li><a href="/garantias">Garantias</a></li>
                                    <li><a href="/garantias/status">Status</a></li>
                                </ul>
                            </li>      
                            <li>
                                <a href="calendar.html" class="waves-effect"><i class="mdi mdi-calendar-check"></i><span> Calendário </span></a>
                            </li>


                            <li class="menu-title">Extras</li>

                            <li>
                                <a href="{{ route('logout') }}"  class="waves-effect" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="mdi mdi-power text-danger"></i> <span> Logout </span></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>

                            
                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>