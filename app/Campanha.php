<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campanha extends Model
{
    //

    protected $table = "campanhas";

    protected $fillable = [
        'id', 'vacina_id', 'publico_id', 'segmento_id',
    ];

    public function vacina()
    {
        return $this->belongsTo('App\Vacina');
    }

    public function publico()
    {
        return $this->belongsTo('App\Publico');
    }

    public function segmento()
    {
        return $this->belongsTo('App\Segmento');
    }
}
