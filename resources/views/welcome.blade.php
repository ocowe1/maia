<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <title>Maia</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>


        .bem-vindo {
            opacity: 1;
            animation-name: fadeInOpacity;
            animation-iteration-count: 1;
            animation-timing-function: ease-in;
            animation-duration: 3s;
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

</head>
<body>

{{--<audio src="{{ URL::asset('teste.wav') }}" autoplay id="audioFundo">--}}
{{--    bla bla bla--}}
{{--</audio>--}}

{{--<script>--}}
{{--    var audio = document.getElementById("audioFundo");--}}
{{--    audio.volume = 0.1 ;--}}
{{--</script>--}}

<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('sistema') }}">Sistema</a>
                |

                @auth
                    @if(Auth()->user()->tipo === 1)
                        <a href="{{ url('gravacoes') }}">Gravações</a>
                        |
                    @endif
                @endauth

                <a href="{{ url('protocolos') }}">Protocolos</a>
                |
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Desconectar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}">Autenticar</a>
            @endauth
        </div>
    @endif


    <div class="content bem-vindo">
        <div class="title m-b-md">
            @if(Auth()->check())
                @if(Auth()->user ()->tipo === 1)
                    Olá novamente Vinicius, espero que esteja bem!
                @else
                    Olá, {{ Auth()->user()->name }}.
                @endif
            @else
                Olá, meu nome é Maia! <br> Precisarei de sua autenticação.
            @endif
        </div>

        <div class="links">

            <script type="text/javascript">
                // código criado por : Leandro Lyria
                // por favor não copiar os códigos scripts
                // eu conheço meus códigos

                function setcountdown(theyear, themonth, theday) {
                    yr = theyear;
                    mo = themonth;
                    da = theday
                }

                setcountdown(2021, 12, 31)


                var occasion = "ativar PROTOCOLO/COMO_SE_FOSSE_A_PRIMEIRA_VEZ"
                var message_on_occasion = "Protocolo/COMO_SE_FOSSE_A_PRIMEIRA_VEZ foi ativado."



                var countdownwidth = '1210px'
                var countdownheight = '90px'
                // var countdownbgcolor = '#e1e1e1'
                var opentags = '<font face="Verdana" size="3" color="#000000">'
                var closetags = '</font>'


                var montharray = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec")
                var crosscount = ''

                function start_countdown() {
                    if (document.layers)
                        document.countdownnsmain.visibility = "show"
                    else if (document.all || document.getElementById)
                        crosscount = document.getElementById && !document.all ? document.getElementById("countdownie") : countdownie
                    countdown()
                }

                if (document.all || document.getElementById)
                    document.write('<span id="countdownie" style="width:' + countdownwidth + '"></span>')

                window.onload = start_countdown


                function countdown() {
                    var today = new Date()
                    var todayy = today.getYear()
                    if (todayy < 1000)
                        todayy += 1900
                    var todaym = today.getMonth()
                    var todayd = today.getDate()
                    var todayh = today.getHours()
                    var todaymin = today.getMinutes()
                    var todaysec = today.getSeconds()
                    var todaystring = montharray[todaym] + " " + todayd + ", " + todayy + " " + todayh + ":" + todaymin + ":" + todaysec
                    futurestring = montharray[mo - 1] + " " + da + ", " + yr
                    dd = Date.parse(futurestring) - Date.parse(todaystring)
                    dday = Math.floor(dd / (60 * 60 * 1000 * 24) * 1)
                    dhour = Math.floor((dd % (60 * 60 * 1000 * 24)) / (60 * 60 * 1000) * 1)
                    dmin = Math.floor(((dd % (60 * 60 * 1000 * 24)) % (60 * 60 * 1000)) / (60 * 1000) * 1)
                    dsec = Math.floor((((dd % (60 * 60 * 1000 * 24)) % (60 * 60 * 1000)) % (60 * 1000)) / 1000 * 1)
                    //if on day of occasion
                    if (dday <= 0 && dhour <= 0 && dmin <= 0 && dsec <= 1 && todayd == da) {
                        if (document.layers) {
                            document.countdownnsmain.document.countdownnssub.document.write(opentags + message_on_occasion + closetags)
                            document.countdownnsmain.document.countdownnssub.document.close()
                        } else if (document.all || document.getElementById)
                            crosscount.innerHTML = opentags + message_on_occasion + closetags
                        return
                    }
                    //if passed day of occasion
                    else if (dday <= -1) {
                        if (document.layers) {
                            document.countdownnsmain.document.countdownnssub.document.write(opentags + "Protocolo foi ativado! " + closetags)
                            document.countdownnsmain.document.countdownnssub.document.close()
                        } else if (document.all || document.getElementById)
                            crosscount.innerHTML = opentags + "Protocolo foi ativado! " + closetags
                        return
                    }
                    //else, if not yet
                    else {
                        if (document.layers) {
                            document.countdownnsmain.document.countdownnssub.document.write(opentags + dday + " dias, " + dhour + " horas, " + dmin + " minutos, e " + dsec + " " + occasion + closetags)
                            document.countdownnsmain.document.countdownnssub.document.close()
                        } else if (document.all || document.getElementById)
                            crosscount.innerHTML = opentags + dday + " dias, " + dhour + " horas, " + dmin + " minutos, e " + dsec + " segundos para <b>" + occasion + closetags
                    }
                    setTimeout("countdown()", 1000)
                }


            </script>
            <ilayer id="countdownnsmain" width=&{countdownwidth}; height=&{countdownheight};
                    bgColor=&{countdownbgcolor}; visibility=hide>
                <layer id="countdownnssub" width=&{countdownwidth}; height=&{countdownheight}; left=0 top=0></layer>
            </ilayer>

        </div>
    </div>
</div>

</body>
</html>
