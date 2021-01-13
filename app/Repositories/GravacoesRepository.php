<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Entities\Gravacoes;


/**
 * Interface GravacoesRepository.
 *
 * @package namespace App\Repositories;
 */

class GravacoesRepository
{
    private $gravacoes;

    public function __construct(Gravacoes $gravacoes)
    {
        $this->entity = $gravacoes;
    }

    public function getGravacoes()
    {
        return $this->entity = DB::table('gravacoes')
            ->paginate(10);
    }


    public function upGravacao($nome, $local, $nome_exibir)
    {
        return $this->entity = DB::table ('gravacoes')
            ->insert ([
               'nome' => $nome,
               'local' => $local,
               'nome_exibir' => $nome_exibir
            ]);
    }

    public function deletarGravacao($id)
    {
        return $this->entity = DB::table ('gravacoes')
            ->where ('id', '=', $id)
            ->delete ();
    }

    public function getGravacaoInfo($id)
    {
        return $this->entity = DB::table('gravacoes')
            ->where('id', '=', $id)
            ->get();
    }

    public function assimilarProtocoloGravacao($id, $protocoloSelecionado)
    {
        return $this->entity = DB::table ('protocolo_gravacao')
            ->insert ([
               'protocolo_id' => $protocoloSelecionado,
               'gravacao_id' => $id
            ]);
    }

    public function getGravacoesProtocolo($id)
    {
        return $this->entity = DB::table ('protocolo_gravacao')
            ->select ('gravacao_id as id', 'gravacoes.nome_exibir', 'gravacoes.created_at')
            ->join ('gravacoes', 'gravacoes.id', '=', 'protocolo_gravacao.gravacao_id')
            ->where ('protocolo_id', '=', $id)
            ->paginate (10);
    }

    public function deletarAssimilacao($id)
    {
        return $this->entity = DB::table('protocolo_gravacao')
            ->where ('gravacao_id', '=', $id)
            ->delete ();
    }


}
