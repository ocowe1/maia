<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Entities\Protocolos;

/**
 * Interface ProtocoloRepository.
 *
 * @package namespace App\Repositories;
 */
class ProtocolosRepository
{
    private $protocolo;

    public function __construct(Protocolos $protocolo)
    {
        $this->entity = $protocolo;
    }

    public function getProtocolos()
    {
        return $this->entity = DB::table('protocolos')
                                ->paginate(10);
    }


    public function getProtocoloNome()
    {
        return $this->entity = DB::table ('protocolos')
            ->select ('id', 'nome')
            ->get ();
    }

    public function getQuantidadeGravacao($id)
    {
        return $this->entity = DB::table('protocolo_gravacao')
                                ->where('protocolo_id', '=', $id)
                                ->count();
    }

    public function criarProtocolo($nome)
    {
        return $this->entity = DB::table('protocolos')
                                ->insert([
                                    'nome' => $nome,
                                    'status' => 0,
                                    'ativo' => 0
                                ]);

    }

    public function getProtocoloInfo($id)
    {
        return $this->entity = DB::table('protocolos')
                                ->where('id', '=', $id)
                                ->get();
    }

    public function ativarProtocolo($id)
    {
        return $this->entity = DB::table('protocolos')
                                ->where('id', '=', $id)
                                ->update(
                                    [
                                        'status' => 1
                                    ]
                                );

    }
    public function desativarProtocolo($id)
    {
        return $this->entity = DB::table('protocolos')
                                ->where('id', '=', $id)
                                ->update(
                                    [
                                        'status' => 0
                                    ]
                                );

    }

    public function deletarProtocolo($id)
    {
        return $this->entity = DB::table('protocolos')
            ->where('id', '=', $id)
            ->delete();

    }

    public function removerAssimilcao($id_gravacao, $id_protocolo)
    {
        return $this->entity = DB::table('protocolo_gravacao')
            ->where ('protocolo_id', '=', $id_protocolo)
            ->where('gravacao_id', '=', $id_gravacao)
            ->delete ();
    }

    public function getUsuarios()
    {
        return $this->entity = DB::table ('users')
            ->get ([
                'id', 'name'
            ]);
    }

    public function assimilarProtocoloUsuario($id_protocolo, $usuario_id)
    {
        return $this->entity = DB::table ('user_protocolo')
            ->insert ([
               'protocolo_id' => $id_protocolo,
               'user_id' => $usuario_id
            ]);
    }

    public function verificaAssimilado()
    {
        return $this->entity = DB::table ('user_protocolo')
            ->get ('user_id');
    }
}
