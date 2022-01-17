<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>   

    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{url('assets/images/favicon.ico')}}">

    <!-- Plugins css -->
    <link href="{{url('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}"  rel="stylesheet">

    <link href="{{url('../plugins/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css">


    <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/style.css')}}" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div id="wrapper">
        @include ('includes.top')
        @include ('includes.navigation')
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        @yield('content_header')
                        @yield('content')
                    </div>
                </div>
        @include ('includes.footer')
            </div>
        </div>
            

        <!-- jQuery  -->
        <script src="{{url('assets/js/jquery.min.js')}}"></script>
        <script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{url('assets/js/metisMenu.min.js')}}"></script>
        <script src="{{url('assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{url('assets/js/waves.min.js')}}"></script>

        <script src="{{url('../plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

        <script src="{{url('../plugins/tinymce/tinymce.min.js')}}"></script>

        <!-- Plugins js -->
        <script src="{{url('../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>

         <!-- Plugins Init js -->
         <script src="{{url('assets/pages/form-advanced.js')}}"></script>

        <script src="{{url('../plugins/select2/js/select2.min.js')}}"></script>
        <script src="{{url('../plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
        <script src="{{url('../plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}"></script>
        <script src="{{url('../plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>

      
       >

        <!-- App js -->
        <script src="{{url('assets/js/app.js')}}"></script>

        <script>
            $(document).ready(function () {
                if($("#elm1").length > 0){
                    tinymce.init({
                        selector: "textarea#elm1",
                        theme: "modern",
                        height:300,
                        plugins: [
                            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                            "save table contextmenu directionality emoticons template paste textcolor"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                        style_formats: [
                            {title: 'Bold text', inline: 'b'},
                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                            {title: 'Example 1', inline: 'span', classes: 'example1'},
                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                            {title: 'Table styles'},
                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                        ]
                    });
                }
            });
        </script>

        <script type="text/javascript" >

$(document).ready(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#adress").val("");
        $("#bairro").val("");
        $("#city").val("");
        $("#state").val("");
        $("#ibge").val("");
    }
    
    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#address").val("...");
                $("#bairro").val("...");
                $("#city").val("...");
                $("#state").val("...");
                $("#ibge").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#address").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#city").val(dados.localidade);
                        $("#state").val(dados.uf);
                        $("#ibge").val(dados.ibge);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});

</script>


@yield('scripts')
    </body>

</html>