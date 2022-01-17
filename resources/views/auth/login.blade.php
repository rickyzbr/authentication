    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Criare - Sistema para Laudo de Garantia de Produto</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{url('assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{url('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{url('assets/css/style.css')}}" rel="stylesheet" type="text/css">
    </head>

    <body>

        <!-- Background -->
        <div class="account-pages"></div>
        <!-- Begin page -->
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <h3 class="text-center m-0">
                        <a href="index.html" class="logo logo-admin"><img src="assets/images/logo.png" height="30" alt="logo"></a>
                    </h3>

                    <div class="p-3">
                        <h4 class="text-muted font-18 m-b-5 text-center">Olá Seja Bem Vindo !</h4>
                        <p class="text-muted text-center">Insira seu email e senha para usar o Sistema.</p>

                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            <form method="POST" action="{{ route('login') }}">  
                            @csrf
                            <div class="form-group">
                                <label for="username">Usuário :</label>
                                <input type="text" class="form-control" id="email" type="email" name="email" :value="old('email')" required autofocus />
                            </div>

                            <div class="form-group">
                                <label for="userpassword">Senha :</label>
                                <input type="password" class="form-control" id="password" name="password"
                                required autocomplete="current-password" placeholder="Enter password">
                            </div>

                            <div class="form-group row m-t-20">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                                        <label class="custom-control-label" for="customControlInline">Lembrar Senha</label>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Entrar</button>
                                </div>
                            </div>

                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-12 m-t-20">
                                    <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center">
                <p class="text-white-50">Ainda nao tem uma Conta ? <a href="pages-register.html" class="text-white"> Cadastra-se! </a> </p>
                <p class="text-muted">© 2021 Criare <span class="d-none d-sm-inline-block">- Todos Direitos Reservados <i class="mdi mdi-heart text-danger"></i> by Ricardo Oliveira.</span></p>
            </div>

        </div>

        <!-- END wrapper -->
            

        <!-- jQuery  -->

        <script src="{{url('assets/js/jquery.min.js')}}"></script>
        <script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{url('assets/js/metisMenu.min.js')}}"></script>
        <script src="{{url('assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{url('assets/js/waves.min.js')}}"></script>

        <script src="{{url('../plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

        <!-- App js -->
        <script src="{{url('assets/js/app.js')}}"></script>

    </body>

</html>