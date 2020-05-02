<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacina extends Model
{
    //

    protected $fillable = [
        'id', 'termo_id', 'nome', 'desc', 'atend_domic',
    ];

    protected $primaryKey = 'id';

    public function termo()
    {
        return $this->belongsTo('App\Termo');
    }

    public function unidades()
    {
        return $this->belongsToMany('App\Unidade', 'vacinas_unidades')->withTimestamps();
    }

    public function publicos()
    {
        return $this->belongsToMany('App\Publico', 'campanhas');
    }

    public function segmentos()
    {
        return $this->belongsToMany('App\Segmento', 'campanhas');
    }

    public function campanhas(){
        return $this->hasMany('App\Campanha');
    }

}
