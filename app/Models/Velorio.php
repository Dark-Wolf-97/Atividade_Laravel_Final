<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Velorio extends Model
{
    protected $fillable = ['velorio_data', 'finado_id', 'usuario_id', 'urna_id'];
    protected $primaryKey = 'id'; 

    public $timestamps = false;

    public function finado()
    {
        return $this->belongsTo(Finado::class);
    }

    public function urna()
    {
        return $this->belongsTo(Urna::class);
    }

}
