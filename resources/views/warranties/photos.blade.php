@section('title', 'Garantia | Cadastro de Imagens')

@extends ('layouts.app')

@section('content_header')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">@if($warranty->client_id)
                                                {{$warranty->client->name}} @endif</h4>
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
                @if($warranty->product_id)
                    @if ($warranty->product->image != null)
                    <div class="col-xl-1">
                        <img class="img-thumbnail shadow" src="{{ url('storage/products/'.$warranty->product->image) }}" alt="{{ $warranty->product->image }}" style="max-width: 170px;" data-holder-rendered="true">
                    </div>
                        @else
                    <div class="col-xl-1">
                        <img class="img-thumbnail shadow" src="{{ url('assets/images/default_img.png') }}" alt="Sem Imagem" style="max-width: 170px;" data-holder-rendered="true">
                    </div>
                    @endif
                @endif
            </div>
        </div>
    </div>    
    <div class="col-xl-9 col-md-">                                
        <div class="card m-b-30">
            <div class="card-body">                
                <h4 class="mt-0 header-title">Açoes</h4>
                    <div class="button-items float-right"> 
                    <a href="{{ route('warranties.index') }}" class="btn btn-success waves-effect waves-light"><i class="fas fa-chevron-circle-left"></i> Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.alerts')

<div class="row">
@if($images = $warranty->imagesWarranty)
    @foreach($images as $image) 
    <div class="col-md-6 col-lg-6 col-xl-3">            
        <!-- Simple card -->
        <div class="card m-b-30">
            <img class="card-img-top img-fluid" alt="400x400" width="248" src="{{ url('storage/'.$image->filename) }}">
            <div class="card-body ">
                <form action="{{ route('warrantyimages.destroy', $image->id) }}" method="post">
                {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit"  class="btn btn-info btn-rounded btn-block waves-effect waves-light"> Remover </button>
                </form>
            </div>
        </div>            
    </div>
    @endforeach
@endif
    </div>
            


                            <div class="row">
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body"> 
            <h4 class="mt-0 header-title">Inserir Imagens ao Laudo</h4>
                <p class="text-muted m-b-30">Clique ou arraste os arquivos que deseja no quadro salvar as imagens ao Laudo!
                </p>
                <div class="m-b-30">
                <form method="post" action="{{ route('warrantyimages.store', $warranty->id) }}" enctype="multipart/form-data" 
                  class="dropzone" id="dropzone">
                    @csrf
                    <div class="fallback">
                        <input name="filename" type="file" multiple />
                    </div>
                    <div class="dz-message">
                        Insira as Imagens clicando Aqui !<br>
                    </div>  
                </form>   
                </div> 
            </div>
        </div>
    </div> <!-- end col -->       
@stop

@section('scripts')
@parent
<!-- Dropzone js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

<script type="text/javascript">
        Dropzone.options.dropzone =
         {
            maxFilesize: 6,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
            success: function(file, response) 
            {
                console.log(response);
            },
            error: function(file, response)
            {
               return false;
            }
};
</script>
@endsection
