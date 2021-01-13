@include('layouts.app')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="{{ route('home') }}" class="btn"><i
                            class="fa fa-arrow-circle-left"></i></a> Protocolos / {{ $info->nome }}
                    @if($info->status == false)
                        <p>Status: Desabilitado</p>
                    @else
                        <p>Status: Habilitado</p>
                    @endif
                </div>

                <div class="card-body">
                        <div align="right">

                            <button type="button"
                                    class="btn @if($info->status == false) btn-success @else btn-danger @endif"
                                    data-toggle="modal"
                                    @if($info->status == false)
                                    data-target="#habilitar-protocolo"
                                    @else
                                    data-target="#desabilitar-protocolo"
                                @endif
                            >
                                @if($info->status == false)
                                    Habilitar Protocolo
                                @else
                                    Desabilitar Protocolo
                                @endif
                            </button>

                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#deletar-protocolo">Deletar Protocolo
                            </button>

                            <button data-toggle="modal" data-target="#assimilar"  class="btn btn-warning">Assimilar Protocolo</button>
                    </div>

                    <hr>


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
                                                <button data-toggle="modal" data-target="#remover"
                                                        class="btn btn-danger">Remover
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
            </div>
            <div class="container">
                {{ $gravacoes->links() }}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="habilitar-protocolo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action=" {{ route('habilitar-protocolo', [ 'id' => $info->id ]) }} ">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Habilitar Protocolo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    Deseja mesmo habilitar este protocolo?

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="submit" name="habilitar" value="Habilitar" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="assimilar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('assimilar-protocolo', ['id' => $info->id]) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assimilar Protocolo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="protocolos-assimilar">Usuários</label>

                        <select multiple="multiple" class="protocolos form-control" name="protocolos-assimilar[]"
                                id="protocolos-assimilar">

                            @foreach($usuarios as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
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


<div class="modal fade" id="desabilitar-protocolo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action=" {{ route('desabilitar-protocolo', [ 'id' => $info->id ]) }} ">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Desabilitar Protocolo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    Deseja mesmo desabilitar este protocolo?

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="submit" name="desabilitar" value="Desabilitar" class="btn btn-danger">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deletar-protocolo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('deletar-protocolo', [ 'id' => $info->id ]) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deletar Protocolo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    Deseja mesmo deletar este protocolo? Não há volta depois de executar está operação.

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="submit" name="deletar" value="Deletar" class="btn btn-danger">
                </div>
            </form>
        </div>
    </div>
</div>

@if(!empty($g))
    <div class="modal fade" id="remover" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post"
                      action=" {{ route('remover-gravacao', ['id_gravacao' => $g->id, 'id_protocolo' => $info->id]) }} "
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deletar Gravação</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja remover a assimilação desta gravação com este protocolo?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <input type="submit" name="remover" value="Remover" class="btn btn-danger">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
