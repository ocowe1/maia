<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Protocolo.
 *
 * @package namespace App\Entities;
 */
class Protocolos extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $nome;
    public $local;

    protected $fillable = ['nome, local'];

}
