<?php

namespace App\Http\Controllers;

use App\Repositories\SistemaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SistemaController extends Controller
{

    private $sistemaRepository;
    private $request;

    public function __construct(SistemaRepository $sistemaRepository, Request $request)
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipo === 3)
            {
                return redirect ()->route ('maia');
            }
            return $next($request);
        });
        $this->sistemaRepository = $sistemaRepository;
        $this->request = $request;
    }

    public function index()
    {

        if(Auth::user()->token == 0)
        {
            $this->sistemaRepository->gerarToken();
            $this->sistemaRepository->gerarLogLogin();
        }
       return view ('painel');
    }

    public function protocolosInfo()
    {
       $protocolosInfo = $this->sistemaRepository->getProtocolosInfo ();
       return view ('painel', compact (['protocolosInfo']));
    }

    public function gravacoesInfo()
    {
       $gravacoesInfo = $this->sistemaRepository->getGravacoesInfo() ;
       return view ('painel', compact ('gravacoesInfo'));
    }

    public function usuariosInfo()
    {
        $usuariosInfo = $this->sistemaRepository->getUsuariosInfo();
        return view ('painel', compact ('usuariosInfo'));
    }

    public function logInfo()
    {
        $logInfo = $this->sistemaRepository->getLogInfo();
        return view ('painel', compact ('logInfo'));
    }

    public function criarUsuario()
    {
        $validar = $this->request->validate ([
            'name' => 'required',
            'tipo' => 'required',
            'email' => 'required',
            'celular' => 'required',
            'password' => 'required'
        ]);

        if($validar)
        {
            $fields = [
                'name' => $validar['name'],
                'tipo' => $validar['tipo'],
                'celular' => $validar['celular'],
                'email' => $validar['email'],
                'password' => Hash::make ($validar['password'])
            ];

            $this->sistemaRepository->criarUsuario ($fields);
            return redirect ()->route ('usuarios-info');
        }
        return redirect ()->route ('usuarios-info');
    }

    public function alterarUsuario()
    {
        dd('hey');
    }


}
