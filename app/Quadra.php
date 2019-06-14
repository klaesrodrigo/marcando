<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quadra extends Model
{
    protected $fillable = ['nome', 'endereco', 'telefone', 'proprietario_id', 'descricao', 'imagem'];
}
