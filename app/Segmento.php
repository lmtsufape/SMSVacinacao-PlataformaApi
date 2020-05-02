<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Segmento extends Model
{
    //

    protected $table = "segmentos";

    protected $fillable = [
        'id', 'idade_id', 'periodo_id',
    ];

    public function idade()
    {
        return $this->belongsTo('App\Idade');
    }

    public function periodo()
    {
        return $this->belongsTo('App\Periodo');
    }
}
