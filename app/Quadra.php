<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quadra extends Model
{
    protected $fillable = ['nome', 'endereco', 'telefone', 'proprietario_id', 'descricao', 'imagem'];

    public function setTelefoneAttribute($value) {
        $novo1 = str_replace(' ', '', $value);    // retira o ponto
        $novo2 = str_replace('-', '', $novo1);   // substitui a , por .
        $this->attributes['telefone'] = $novo2;
    }
}
