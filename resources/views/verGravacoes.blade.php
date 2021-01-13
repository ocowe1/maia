@include('layouts.app')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Gravações</div>

                <div class="card-body">
                    <div align="right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#upar">
                            Upload
                            Gravação
                        </button>

                    </div>

                    <hr>

                    @if(session('erro'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Atenção!</strong> {{ session('erro') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(session('sucesso'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Atenção!</strong> {{ session('sucesso') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($gravacoes->isEmpty())

                        <div class="alert alert-primary" role="alert">
                            Ainda não há gravações!
                        </div>

                    @else
                        <div class="container">
                            <div class="row">
                                @foreach($gravacoes as $g)
                                    <div class="col-md-4">
                                        <div class="card text-center">
                                            <div class="card-header">
                                                {{ $g->nome_exibir }}
                                            </div>
                                            <div class="card-body">
                                                <a class="btn btn-primary" target="_blank"
                                                   href="{{ route ('assistir', ['id' => $g->id]) }}">Assistir</a>
                                                <button data-toggle="modal" data-target="#assimilar"
                                                        class="btn btn-warning">Assimilar
                                                </button>
                                                <button data-toggle="modal" data-target="#deletar"
                                                        class="btn btn-danger">Deletar
                                                </button>
                                            </div>
                                            <div class="card-footer text-muted">
                                                {{ $g->created_at }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    @endif


                </div>
                <div class="container">
                    {{ $gravacoes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="upar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action=" {{ route('upload') }} " enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload de Gravação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Arquivo</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="gravacao" id="gravacao">
                                <label class="custom-file-label" for="inputGroupFile01">Selecionar Gravação</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome da Gravação</label>
                        <input type="text" class="form-control" name="nome" id="nome">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="submit" name="upload" value="Upload" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>



    <div class="modal fade" id="assimilar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @foreach($gravacoes as $g)
                <form method="post" action="{{ route('assimilar-gravacao', ['id' => $g->id]) }}">
                    @endforeach
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Assimilar Gravação</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="protocolos-assimilar">Protocolos</label>

                            <select multiple="multiple" class="protocolos form-control" name="protocolos-assimilar[]"
                                    id="protocolos-assimilar">

                                @foreach($protocolos as $p)
                                    <option value="{{ $p->id }}">{{ $p->nome }}</option>
                                @endforeach

                            </select>

                            <script>
                                $('option').mousedown(function(e) {
                                    e.preventDefault();
                                    $(this).prop('selected', !$(this).prop('selected'));
                                    return false;
                                });
                            </script>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <input type="submit" name="assimilar" value="Assimilar" class="btn btn-warning">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deletar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @foreach($gravacoes as $g)
                <form method="post" action=" {{ route('deletar-gravacao', ['id' => $g->id]) }} "
                      enctype="multipart/form-data">
                    @endforeach
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deletar Gravação</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja deletar este arquivo? Não pode ser desfeito!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <input type="submit" name="Deletar" value="Deletar" class="btn btn-danger">
                    </div>
                </form>
            </div>
        </div>
    </div>

