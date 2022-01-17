@if ($errors->any())
<div class="callout callout-danger"> 
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
        @foreach ($errors->all() as $error)
        <h4><i class="icon fa fa-ban"></i> ERRO !</h4>
        <p>{{ $error }}</p>
        @endforeach
    </div> 
@endif

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Sucesso !</strong> {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Erro !</strong> {{ session('error') }}
    </div>
@endif