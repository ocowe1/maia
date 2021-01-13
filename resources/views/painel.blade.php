@include('layouts.app')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Olá, eu sou a Maia e este é meu painel principal.
                </div>
                <div class="card-body">

                    <h4>Sistema</h4>
                    <hr>
                    <div class="container">
                        <div class="row">

                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body" align="center">
                                        <h5 class="card-title">Protocolos</h5>
                                        <a href="{{ route ('protocolos-info') }}" class="btn btn-primary">Detalhes</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body" align="center">
                                        <h5 class="card-title">Gravações</h5>
                                        <a href="{{ route ('gravacoes-info') }}" class="btn btn-info">Detalhes</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body" align="center">
                                        <h5 class="card-title">Banco de Usuários</h5>
                                        <a href="{{ route ('usuarios-info') }}" class="btn btn-warning">Detalhes</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body" align="center">
                                        <h5 class="card-title">Log do Sistema</h5>
                                        <a href="{{ route ('log-info') }}" class="btn btn-danger">Detalhes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@if(isset($protocolosInfo) and !empty($protocolosInfo))

    <div class="container">
        <hr>
        <table class="table table-striped table-bordered">

            Status se refere a habilitado para disparo ou não (1 ou 0)
            <br>
            Ativo se refere a disparado ou não (1 ou 0)
            <hr>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Status</th>
                <th>Ativo</th>
                <th>Data de Criação</th>
            </tr>
            @foreach($protocolosInfo as $p)
                <tr>
                    <td> {{ $p->id }} </td>
                    <td> {{ $p->nome }} </td>
                    <td> {{ $p->status }} </td>
                    <td> {{ $p->ativo }} </td>
                    <td> {{ $p->created_at }} </td>
                </tr>
            @endforeach
        </table>
    </div>
@elseif(isset($gravacoesInfo) and !empty($gravacoesInfo))
    <div class="container">
        <hr>
        <table class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Nome ID</th>
                <th>Data de Criação</th>
            </tr>
            @foreach($gravacoesInfo as $g)
                <tr>
                    <td> {{ $g->id }} </td>
                    <td> {{ $g->nome }} </td>
                    <td> {{ $g->created_at }} </td>
                </tr>
            @endforeach
        </table>
    </div>
@elseif(isset($usuariosInfo) and !empty($usuariosInfo))
    <div class="container">
        <hr>
        <table class="table table-striped table-bordered">

            @auth
                @if(Auth()->user()->tipo === 3)
                    <div align="right">
                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#create-user">
                            Adicionar Usuário
                        </button>
                    </div>
                    <hr>
                @endif
            @endauth
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Email</th>
                <th>Celular</th>
                <th>Data de Criação</th>
                <th>Funções</th>
            </tr>
            @foreach($usuariosInfo as $u)
                <tr>
                    <td> {{ $u->id }} </td>
                    <td> {{ $u->name }} </td>
                    <td> {{ $u->tipo }} </td>
                    <td> {{ $u->email }} </td>
                    <td> {{ $u->celular }} </td>
                    <td> {{ $u->created_at }} </td>
                    <td><button class="btn btn-sm btn-info" data-target="#alter-user" data-toggle="modal">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </button> </td>
                    <td hidden><input type="hidden" name="user" value="{{$u->id}}"></td>
                </tr>
            @endforeach
        </table>
    </div>

    <style>
        input[type='number'] {
            -moz-appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }
    </style>

    <div class="modal fade" id="create-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action=" {{ route('criar-usuario') }} ">
                    @csrf
                    <div class="modal-header">
                        Subir Novo Usuário
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" name="name" aria-describedby="name"
                                   placeholder="Digite o Nome do Usuário">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Digite o Email">
                            <small id="email" class="form-text text-muted">Digite o email do usuário para qual devo
                                enviar o acesso ao protocolo</small>
                        </div>

                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <input type="number" class="form-control" name="tipo" placeholder="Digite o tipo">
                        </div>

                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input type="number" class="form-control" name="celular" placeholder="Digite o celular">
                        </div>

                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" name="password" placeholder="Digite a Senha">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <input type="submit" name="criar" value="Criar" class="btn btn-info">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="alter-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action=" {{ route('alterar-usuario') }} ">
                    @csrf
                    <div class="modal-header">
                        Alterar Usuário
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Digite o Email">
                            <small id="email" class="form-text text-muted">Digite o email do usuário para qual devo
                                enviar o acesso ao protocolo</small>
                        </div>

                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input type="number" class="form-control" name="celular" placeholder="Digite o celular">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <input type="submit" name="alterar" value="Alterar" class="btn btn-info">
                    </div>
                </form>
            </div>
        </div>
    </div>

@elseif(isset($logInfo) and !empty($logInfo))
    <div class="container">
        <hr>
        <table class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Usuário ID</th>
                <th>Usuário Nome</th>
                <th>Data de Criação</th>
            </tr>
            @foreach($logInfo as $l)
                <tr>
                    <td> {{ $l->id }} </td>
                    <td> {{ $l->descricao }} </td>
                    <td> {{ $l->user_id }} </td>
                    <td> {{ $l->user_name }} </td>
                    <td> {{ $l->created_at }} </td>
                </tr>
            @endforeach
        </table>
    </div>
@endif

