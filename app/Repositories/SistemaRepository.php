<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Entities\Gravacoes;
use App\Entities\Protocolos;
use App\User;


/**
 * Interface GravacoesRepository.
 *
 * @package namespace App\Repositories;
 */

class SistemaRepository
{
    private $gravacoes;

    public
    function __construct ( Gravacoes $gravacoes )
    {
        $this->entity = $gravacoes;
    }


    public function getGravacoesInfo()
    {
        return $this->entity = DB::table('gravacoes')
            ->get ();
    }

    public function getProtocolosInfo()
    {
        return $this->entity = DB::table('protocolos')
            ->get ();
    }

    public function getUsuariosInfo()
    {
        return $this->entity = DB::table('users')
            ->get ();
    }

    public function criarUsuario($fields)
    {
        return $this->entity = DB::table ('users')
            ->insert ($fields);
    }

    public function getGravacaoProtocolo($id)
    {
        return $this->entity = DB::table ('protocolo_gravacao')
            ->where ('gravacao_id', '=', $id)
            ->get (['nome_exibir', 'nome']);
    }

    public function getUsuarioProtocolo($id)
    {
        return $this->entity = DB::table ('user_protocolo')
            ->where ('user_id', '=', $id)
            ->get('protocolo_id');
    }

    public function getGravacoesUsuario($id)
    {
        return $this->entity = DB::table ('user_protocolo')
            ->select (['protocolo_gravacao.gravacao_id', 'protocolos.nome', 'gravacoes.nome_exibir', 'gravacoes.created_at'])
            ->join ('protocolo_gravacao', 'protocolo_gravacao.protocolo_id', '=', 'user_protocolo.protocolo_id')
            ->join ('gravacoes', 'gravacoes.id', '=', 'protocolo_gravacao.gravacao_id')
            ->join ('protocolos', 'protocolos.id', '=', 'user_protocolo.protocolo_id')
            ->where ('user_protocolo.user_id', '=', $id)
//            ->get ([
//                'protocolo_gravacao.gravacao_id', 'protocolos.nome', 'gravacoes.nome_exibir', 'gravacoes.created_at'
//            ])
            ->paginate(10);
    }

    public function getGravacaoUsuario($id, $gravacao_id)
    {
        return $this->entity = DB::table ('user_protocolo')
//            ->select ('protocolo_gravacao.gravacao_id')
            ->join ('protocolo_gravacao', 'protocolo_gravacao.protocolo_id', '=', 'user_protocolo.protocolo_id')
            ->join ('gravacoes', 'gravacoes.id', '=', 'protocolo_gravacao.gravacao_id')
            ->join ('protocolos', 'protocolos.id', '=', 'user_protocolo.protocolo_id')
            ->where ('user_protocolo.user_id', '=', $id)
            ->where ('protocolo_gravacao.gravacao_id', '=', $gravacao_id)
            ->get ([
                'gravacoes.nome_exibir', 'gravacoes.id', 'gravacoes.nome'
            ]);
    }

    public function gerarToken()
    {
        return $this->entity = DB::table ('users')
            ->where('id', '=', Auth::user()->id)
            ->update ([
                'token' => uniqid (),
            ]);
    }

    public function gerarLogLogin()
    {
        return $this->entity = DB::table('log')
            ->insert([
                'descricao' => 'Usuário realizou primeiro login.',
                'user_id' => Auth::user()->id
            ]);
    }

    public function getLogInfo()
    {
        return $this->entity = DB::table('log')
            ->join('users', 'users.id', '=', 'log.user_id')
            ->get(['log.id', 'users.name as user_name', 'users.id as user_id','log.descricao', 'log.created_at']);
    }
}
