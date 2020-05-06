<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampanhaIdadePublico extends Model
{
    //

    protected $table = "campanhas_idades_publicos";

    protected $fillable = [
        'id', 'campanha_id','idade_id', 'publico_id', 'data_ini', 'data_end',
    ];

    public function campanha()
    {
        return $this->belongsTo('App\Campanha');
    }

    public function idade()
    {
        return $this->belongsTo('App\Idade');
    }

    public function publico()
    {
        return $this->belongsTo('App\Publico');
    }
}
