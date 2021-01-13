<?php

namespace App\Http\Controllers;

use App\Repositories\ProtocolosRepository;
use App\Repositories\GravacoesRepository;
use App\Repositories\SistemaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MaiaController extends Controller
{

    private $request;
    private $protocolosRepository;
    private $sistemaRepository;
    private $gravacoesRepository;

    public function __construct(ProtocolosRepository $protocolosRepository, Request $request, GravacoesRepository $gravacoesRepository, SistemaRepository $sistemaRepository)
    {
        $this->middleware('auth');
        $this->protocolosRepository = $protocolosRepository;
        $this->gravacoesRepository = $gravacoesRepository;
        $this->sistemaRepository = $sistemaRepository;
        $this->request = $request;
    }

    public function inicio()
    {
        if(Auth::user()->token == 0)
        {
            $this->sistemaRepository->gerarToken();
            $this->sistemaRepository->gerarLogLogin();
        }

        $id = Auth::user ()->id;
        $gravacoes = $this->sistemaRepository->getGravacoesUsuario ($id);
//        dd ($gravacoes);
        return view ('maia', compact (['gravacoes']));
    }

    public function assistirGravacao($id)
    {
        $gravacao = $this->sistemaRepository->getGravacaoUsuario (Auth::user ()->id, $id)[0];
        return view ('assistir', compact ('gravacao'));
    }

}
