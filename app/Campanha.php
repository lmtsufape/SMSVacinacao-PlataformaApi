<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campanha extends Model
{
    //

    protected $table = "campanhas";

    protected $fillable = [
        'id', 'termo_id', 'nome', 'desc', 'atend_domic', 'data_ini', 'data_end',
    ];

    public function termo()
    {
        return $this->belongsTo('App\Termo');
    }

    public function publicos(){
        return $this->hasMany('App\CampanhaIdadePublico');
    }

    public function idadePublico(){
        return $this->belongsToMany('\App\Publico', 'campanhas_idades_publicos', 'campanha_id', 'publico_id')
        ->withPivot('idade_id','data_ini', 'data_end');
    }

}
