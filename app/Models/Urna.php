<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Urna extends Model
{
    use HasFactory;
    protected $table = 'urna';
    protected $fillable = ['urna_nome', 'urna_tipo', 'urna_material', 'urna_preco'];
    protected $primaryKey = 'id'; 

    public $timestamps = false;
}
