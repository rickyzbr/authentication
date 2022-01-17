

<div class="page-content-wrapper">
         <div class="col-xl-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="invoice-title">
                                <h3 class="mt-0"> Identificação do Laudo # {{ $warranty->id }} </h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <address>
                                    @if($warranty->client_id)
                                        <strong>Endereço :</strong> {{ $warranty->client->address }}, {{ $warranty->client->number }} <strong>CEP :</strong> {{ $warranty->client->cep }}<br>
                                        <strong>E-mail :</strong> {{ $warranty->client->email }}<br>
                                        <strong>Telefone :</strong> {{ $warranty->client->phone }}<br>
                                        <strong>CNPJ :</strong> {{ $warranty->client->cnpj }} <strong>Inscrição Estadual :</strong> {{ $warranty->client->insc }}<br>
                                        <strong>{{ $warranty->client->country }} - {{ $warranty->client->city }} - {{ $warranty->client->state }}</strong>
                                    @endif
                                    </address>
                                </div>
                                <div class="col-6 text-right">
                                    <address>
                                        <strong>Cadastrado Por :</strong><br>
                                        @if($warranty->user_id)
                                                {{$warranty->user->name}} @endif<br>
                                        Técnico - KGM<br>
                                        Apt. 4B<br>
                                        Springfield, ST 54321
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 m-t-30">
                                    <address>
                                        <strong>Relato do Cliente :</strong><br>
                                        {!! $warranty->description !!}
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div>
                                <div class="p-2">
                                    <h3 class="font-16"><strong>Produto</strong></h3>
                                </div>
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <td><strong>Nome</strong></td>
                                                <td><strong>Cod. KGM</strong></td>
                                                <td><strong>Cod. Original</strong></td>
                                                <td><strong>Serial</strong></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($warranty->product_id)
                                        <tr>
                                        <th scope="row">{{$warranty->product->name}}</th>
                                        <td>{{$warranty->product->cod_kgm}}</td>
                                        <td>{{$warranty->product->cod_original}}</td>
                                        <td>{{$warranty->serial}}</td>
                                        </tr>
                                        @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            @if($images = $warranty->imagesWarranty)
                                @foreach($images as $image) 
                                <img class="img-thumbnail shadow " alt="400x400" width="248" src="{{ url('storage/'.$image->filename) }}" data-holder-rendered="true">
                                @endforeach
                            @endif
                        </div>
                    </div> <!-- end row -->
<br>
<br>
                    @if($steps = $warranty->stepsWarranty)
                                @foreach($steps as $step) 
                                <div class="row">
                        <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-header">
                                        <strong>{{ $step->type($step->type) }}</strong>
                                        </div>
                                        <div class="card-body">
                                            <blockquote class="card-blockquote mb-0">
                                            {!! $step->description !!}
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
</div>
                                @endforeach
                            @endif
                </div>
            </div>
        </div> 