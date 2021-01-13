@if($protocolos->isEmpty())

    <div class="alert alert-primary" role="alert">
        Ainda não há protocolos!
    </div>

@else
    <div class="container">
        <div class="row">
            @foreach($protocolos as $protocolo)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $protocolo->nome}}
                                <span class="badge badge-dark">
                            {{ $repository->getQuantidadeGravacao($protocolo->id) }}
                        </span>
                            </h5>
                            <p class="card-text">Status: <span style="color:
                                @if($protocolo->status == true) green @else red @endif"> @if($protocolo->status == true)
                                        Habilitado. @else Desabilitado. @endif</span>

                                <br>
                                <span style="color: @if($protocolo->ativo == true) green @else red @endif">@if($protocolo->ativo == true)
                                        Protocolo ativado. @else Aguardando ativação. @endif</span>

                            </p>

                            @auth
                                @if(Auth()->user()->tipo === 1)
                                    <a href="{{ route('ver-protocolo', ['id' => $protocolo->id]) }}"
                                       class="btn btn-primary">Acessar</a>
                                    <button data-toggle="modal" data-target="#assimilar" class="btn btn-warning">
                                        Assimilar
                                    </button>
                                @endif
                            @endauth

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endif
@auth
    @if(Auth()->user()->tipo === 1)
        <div class="modal fade" id="assimilar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    @foreach($protocolos as $protocolo)
                        <form method="post" action="{{ route('assimilar-protocolo', ['id' => $protocolo->id]) }}">
                    @endforeach
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

                                <select multiple="multiple" class="protocolos form-control"
                                        name="protocolos-assimilar[]"
                                        id="protocolos-assimilar">

                                    @foreach($usuarios as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endforeach

                                </select>

                                <script>
                                    $('option').mousedown(function (e) {
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
    @endif
@endauth
