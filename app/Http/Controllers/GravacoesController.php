<?php

namespace App\Http\Controllers;

use App\Repositories\GravacoesRepository;
use App\Repositories\ProtocolosRepository;
//use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class GravacoesController extends Controller
{

    private $protocolosRepository;
    private $gravacoesRepository;
    private $request;

    public function __construct(ProtocolosRepository $protocolosRepository, Request $request, gravacoesRepository $gravacoesRepository)
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

    public function exibirGravacoes()
    {
        $gravacoes = $this->gravacoesRepository->getGravacoes ();
        $protocolos = $this->protocolosRepository->getProtocoloNome ();
        return view ('verGravacoes', compact (['gravacoes', 'protocolos', 'gravacaoDados']));
    }

    public function upload()
    {
        $validar = $this->request->validate([
            'gravacao' => 'required',
            'nome' => 'required'
        ]);

        if ($this->request->hasFile('gravacao') && $this->request->file('gravacao')->isValid()) {
            $file = $this->request->file ('gravacao');

            if($file->getClientOriginalExtension () !== 'mp4')
            {
                return redirect ( 'gravacoes')->with ('erro', 'A extensão deve ser MP4, favor upar o arquivo correto.');
            }

            $file->getClientOriginalName ();
            $nameFile = uniqid(date('HisYmd')) . "." .  $file->getClientOriginalExtension () ;
            $file->getRealPath ();
            $file->getSize ();
            $file->getMimeType ();
            $destinationPath = public_path ('videos');
            if($file->move ($destinationPath, $nameFile))
            {
                $this->gravacoesRepository->upGravacao ($nameFile, $destinationPath, $validar['nome']);
                return redirect ('gravacoes')->with ('sucesso', 'Upload concluído.');
            }else{
                return redirect ('gravacoes')->with ('erro', 'Houve um problema ao realizar upload.');
            }
        }
        return redirect ('gravacoes')->with ('erro', 'Houve um problema ao realizar upload.');
    }

    public function deletarGravacao($id)
    {
        $gravacaoInfo = $this->gravacoesRepository->getGravacaoInfo ($id);
        File::delete ($gravacaoInfo[0]->local . '/' . $gravacaoInfo[0]->nome);
        $this->gravacoesRepository->deletarAssimilacao($id);
        $this->gravacoesRepository->deletarGravacao($id);
        return redirect ('gravacoes');
    }

    public function assimilarGravacao($id)
    {

        $protocoloSelecionado = $_POST['protocolos-assimilar'];
//        for ($i = 0; $i < count($protocoloSelecionado); $i++)
//        {
//            $this->gravacoesRepository->assimilarProtocoloGravacao($id, $protocoloSelecionado[$i]);
//        }


        /**
         * by: Sartori
         *
         */

        foreach ($protocoloSelecionado as $protocolo)
        {
            dd($this->gravacoesRepository->assimilarProtocoloGravacao($id, $protocolo));
        }

        return redirect ('gravacoes')->with ('sucesso', 'Gravacao Assimildada Com Sucesso');
    }

    public function assistirGravacao($id)
    {
        $gravacao = $this->gravacoesRepository->getGravacaoInfo ($id)[0];
        return view ('assistir', compact ('gravacao'));
    }

}
