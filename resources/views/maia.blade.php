<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <title>Maia</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Styles -->
    <style>

        .m1{
            opacity: 1;
            animation-name: fadeInOpacity;
            animation-iteration-count: 1;
            animation-timing-function: ease-in;
            animation-duration: 3s;
        }

        .m2{
            opacity: 1;
            animation-name: fadeInOpacity;
            animation-iteration-count: 1;
            animation-timing-function: ease-in;
            animation-duration: 6s;
        }

        .m3{
            opacity: 1;
            animation-name: fadeInOpacity;
            animation-iteration-count: 1;
            animation-timing-function: ease-in;
            animation-duration: 9s;
        }

        @keyframes fadeInOpacity {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 42px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>


<div class="flex-center position-ref full-height">
        <div class="top-right links">
            @if(Auth::user()->tipo !== 3)
                <a href="{{ url('sistema') }}">Sistema</a>
                |
            @endif
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Desconectar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
        </div>


    <div class="content">
        <div class="title m-b-md">
                @if(Auth()->user ()->tipo === 1)
                <p class="m1">  Olá novamente Vinicius, espero que esteja bem! <br> Tudo certo por aqui. </p>
                @elseif(Auth()->user()->tipo === 2)
                    <p class="m1">Olá, {{ Auth()->user()->name }}.</p>
                    <p class="m2">Seu protocolo ainda não foi ativado.</p>
                @else
                    <p class="m1">Olá, {{ Auth()->user()->name }}.</p>
                    <p class="m2">Seu protocolo foi ativado.</p>
                    <p class="m3">Nome do protocolo: {{ $gravacoes[0]->nome }}</p>
                @endif
        </div>
        <i class="fa fa-angle-double-down m3" aria-hidden="true"></i>
    </div>
</div>

<div class="card-body">
@if($gravacoes->isEmpty())

    <div class="alert alert-primary" role="alert">
        Nada por aqui ainda...
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
                               href="{{ route ('assistir-usuario', ['id' => $g->gravacao_id]) }}">Assistir</a>
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

</body>
</html>
