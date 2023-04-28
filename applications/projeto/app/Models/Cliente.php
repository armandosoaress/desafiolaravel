<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    // "Add [nome] to fillable property 

    protected $fillable = ['nome', 'email', 'imagem'];

    public function users()
    {

        return $this->belongsToMany(User::class);
    }
}
