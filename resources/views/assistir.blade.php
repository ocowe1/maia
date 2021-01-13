@include('layouts.app')
<style>
    body
    {
        background-color: black;
        color: white;
    }

    .exibicao
    {
        background-color: #211f1f;
        color: white;
    }
</style>
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card exibicao">
                <div class="card-header">{{ $gravacao->nome_exibir }}</div>

                <div align="center">
                    <video controls width="70%">
                        <source src="{{ URL::asset('/videos/' . $gravacao->nome) }}" type="video/mp4">
                    </video>
                </div>

            </div>
        </div>
    </div>
</div>
