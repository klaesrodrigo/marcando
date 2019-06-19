<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marcacoe extends Model
{
    protected $fillable = ['usuario_id', 'data_hora', 'valor', 'quadra_tipo_id'];
}
