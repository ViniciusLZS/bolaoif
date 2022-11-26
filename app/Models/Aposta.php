<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aposta extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get the post that owns the comment.
     */
    public function jogo()
    {
        return $this->belongsTo(Jogo::class);
    }
}
