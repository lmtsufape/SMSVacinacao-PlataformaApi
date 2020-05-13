<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campanha extends Model
{
    //

    protected $table = "campanhas";

    protected $fillable = [
        'id', 'termo_id', 'nome', 'desc', 'atend_domic',
    ];

    public function termo()
    {
        return $this->belongsTo('App\Termo');
    }

    /* public function publicos()
    {
        return $this->hasMany('App\CampanhaIdadePublico');
    } */

    public function publicos()
    {
        return $this->belongsToMany('\App\Publico', 'campanhas_idades_publicos', 'campanha_id', 'publico_id')
            ->distinct();
    }
}
