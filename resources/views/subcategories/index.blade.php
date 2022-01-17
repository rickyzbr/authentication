@section('title', 'Admin | Lista de Clientes')

@extends ('layouts.app')
                        @section('content_header')
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Cadasto de Categorias</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active">Gerenciamento das Categorias dos seus Produtos Aqui !</li>
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
                                                <h6 class="text-uppercase verti-label text-white-50">Sub-Categorias</h6>
                                                <div class="text-white">
                                                    <h6 class="text-uppercase mt-0 text-white-50">Total Sub-Categorias</h6>
                                                    <h3 class="mb-3 mt-0">{{$totalSubCategories}}</h3>                                                    
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
                                                    <a href="{{ route('subcategory.create') }}" class="btn btn-success waves-effect waves-light"><i class="far fa-plus-square"></i>  Add Sub-Categoria</a>
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
                                            <h4 class="mt-0 header-title mb-4">Lista de Categorias Cadastradas</h4>
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                      <tr>
                                                        <th style="width: 20px">(#) Id</th>
                                                        <th style="width: 100px">Imagem</th>
                                                        <th style="width: 500px">Nome</th>
                                                        <th scope="col">Autor</th>
                                                        <th scope="col">Position</th>
                                                        <th scope="col">Açoes</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($categories as $category)
                    <tbody data-id="{{ $category->id }}" class="sortable">
                        <tr>
                            <td colspan="8" style="background-color:#ddd;">{{ $category->name }}</td>
                        </tr>
                        @foreach($category->sub_categories as $subcategory)
                            <tr data-id="{{ $subcategory->id }}" class="subcategory">
                                <td>
                                    {{ $subcategory->id ?? '' }}
                                </td>
                                <td>
                                @if ($subcategory->image != null)                  
                                    <img img class="img-thumbnail shadow" src="{{ url('storage/sub_categories/' .$subcategory->image) }}" alt="{{ $subcategory->name }}" style="max-width: 80px;">
                                    @else
                                    <img img class="img-thumbnail shadow" src="{{ url('assets/images/default_imgproduct.png') }}" alt="{{ $subcategory->name }}" style="max-width: 80px;">
                                @endif
                                </td>
                                <td>
                                    {{ $subcategory->name ?? '' }}
                                </td>
                               
                                <td>
                                @if($category->user_id)
                                        {{$category->user->name}}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td class="position">
                                    {{ $subcategory->position ?? '' }}
                                </td>
                                <td>
                                    <div>
                                        <a href="{{route('subcategory.edit', $category->id)}}" class="btn btn-warning waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
                                        <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal"  data-placement="top" title="Apagar"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="empty-message" @if($category->sub_categories->count()) style="display:none;"@endif>
                            <td colspan="8" class="text-center">
                                Sem Cadastro para essa Categoria!
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
                                    
                            </div>
                        </div>
                    </div>
                </div>                                
            </div>
    </div> <!-- container-fluid -->
</div> <!-- content -->

               
@stop

@section('scripts')
@parent
<script>
    function sendReorderSubcategoriesRequest($category) {
        var items = $category.sortable('toArray', {attribute: 'data-id'});
        var ids = $.grep(items, (item) => item !== "");

        if ($category.find('tr.subcategory').length) {
            $category.find('.empty-message').hide();
        }
        $category.find('.category-name').text($category.find('tr:first td').text());

        $.post('{{ route('subcategories.reorder') }}', {
                _token,
                ids,
                category_id: $category.data('id')
            })
            .done(function (response) {
                $category.children('tr.subcategory').each(function (index, sub_categories) {
                    $(sub_categories).children('.position').text(response.positions[$(sub_categories).data('id')])
                });
            })
            .fail(function (response) {
                alert('Error occured while sending reorder request');
                location.reload();
            });
    }

    $(document).ready(function () {
        var $categories = $('table');
        var $sub_categories = $('.sortable');

        $categories.sortable({
            cancel: 'thead',
            stop: () => {
                var items = $categories.sortable('toArray', {attribute: 'data-id'});
                var ids = $.grep(items, (item) => item !== "");
                $.post('{{ route('categories.reorder') }}', {
                        _token,
                        ids
                    })
                    .fail(function (response) {
                        alert('Error occured while sending reorder request');
                        location.reload();
                    });
            }
        });

        $sub_categories.sortable({
            connectWith: '.sortable',
            items: 'tr.subcategory',
            stop: (event, ui) => {
                sendReorderSubcategoriesRequest($(ui.item).parent());

                if ($(event.target).data('id') != $(ui.item).parent().data('id')) {
                    if ($(event.target).find('tr.subcategory').length) {
                        sendReorderSubcategoriesRequest($(event.target));
                    } else {
                        $(event.target).find('.empty-message').show();
                    }
                }
            }
        });
        $('table, .sortable').disableSelection();
    });
</script>
@endsection