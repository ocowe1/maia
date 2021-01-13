<?php

namespace App\Http\Controllers;

use App\Repositories\ProtocolosRepository;
use App\Repositories\GravacoesRepository;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProtocolosController extends Controller
{

    private $protocolosRepository;
    private $gravacoesRepository;
    private $request;

    public function __construct(ProtocolosRepository $protocolosRepository, Request $request, GravacoesRepository $gravacoesRepository)
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipo === 3)
            {
                return redirect ()->route ('maia');
            }
            return $next($request);
        });
        $this->protocolosRepository = $protocolosRepository;
        $this->gravacoesRepository = $gravacoesRepository;
        $this->request = $request;
    }

    public function exibirProtocolos()
    {
        $usuarios = $this->protocolosRepository->getUsuarios();
        $protocolos = $this->protocolosRepository->getProtocolos();
        $repository = $this->protocolosRepository;
        return view('home', compact(['protocolos', 'repository', 'usuarios']));
    }

    public function novoProtocolo()
    {
        if(Auth()->user()->tipo !== 1)
        {
            return redirect()->route('/');
        }

        $validar = $this->request->validate([
                'nome-protocolo' => 'required'
            ]);

        $nome = strtoupper(str_replace(' ', '_', $validar['nome-protocolo']));
        $this->protocolosRepository->criarProtocolo($nome);
        return redirect()->route('home');
    }

    public function verProtocolo($id)
    {
        if(Auth()->user()->tipo !== 1)
        {
            return redirect()->route('/');
        }

        $usuarios = $this->protocolosRepository->getUsuarios();
        $info = $this->protocolosRepository->getProtocoloInfo($id)[0];
        $gravacoes = $this->gravacoesRepository->getGravacoesProtocolo ($id);
        return view('verProtocolo', compact(['info', 'gravacoes', 'usuarios']));
    }

    public function habilitarProtocolo($id)
    {
        if(Auth()->user()->tipo !== 1)
        {
            return redirect()->route('/');
        }

        $this->protocolosRepository->ativarProtocolo($id);
        return redirect()->route('ver-protocolo', ['id' => $id]);
    }

    public function desabilitarProtocolo($id)
    {
        if(Auth()->user()->tipo !== 1)
        {
            return redirect()->route('/');
        }

        $this->protocolosRepository->desativarProtocolo($id);
        return redirect()->route('ver-protocolo', ['id' => $id]);
    }

    public function deletarProtocolo($id)
    {

        if(Auth()->user()->tipo !== 1)
        {
            return redirect()->route('/');
        }

        $this->protocolosRepository->deletarProtocolo($id);
        return redirect()->route('home');
    }

    public function removerGravacao($id_protocolo, $id_gravacao)
    {

        if(Auth()->user()->tipo !== 1)
        {
            return redirect()->route('/');
        }

        $this->protocolosRepository->removerAssimilcao ($id_gravacao, $id_protocolo);
        return redirect()->route ('ver-protocolo', ['id' => $id_protocolo]);
    }

    public function assimilarProtocolo($id)
    {
        if(Auth()->user()->tipo !== 1)
        {
            return redirect()->route('/');
        }

        $usuario = $_POST['protocolos-assimilar'];

        foreach ($usuario as $u)
        {
            $this->protocolosRepository->assimilarProtocoloUsuario($id, $u);
        }

        return redirect ()->route ('ver-protocolo', ['id' => $id]);
    }
}
