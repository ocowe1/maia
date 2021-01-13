@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Protocolos</div>

                    <div class="card-body">
                        @auth
                            @if(Auth()->user()->tipo === 1)
                                <div align="right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#criar-protocolo">
                                        Criar Protocolo
                                    </button>
                                </div>
                            @endif
                        @endauth
                        <hr>
                        @include('protocolos')
                    </div>
                    @if($protocolos->isNotEmpty())
                        <div class="container">
                            {{ $protocolos->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @auth
        @if(Auth()->user()->tipo === 1)
            <div class="modal fade" id="criar-protocolo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="{{ route('novo-protocolo') }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Criar Protocolo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Nome do Protocolo</label>
                                    <input type="text"
                                           class="form-control @error('nome-protocolo') is-invalid @enderror"
                                           id="nome-protocolo" name="nome-protocolo">

                                    @error('nome-protocolo')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <input type="submit" name="criar" value="Criar" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endauth

@endsection
