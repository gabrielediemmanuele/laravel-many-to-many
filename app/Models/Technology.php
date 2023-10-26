<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    public function projects()
    {
        /* il belongsToMany definisce una relazione molti a molti  */
        return $this->belongsToMany(Project::class);
    }
}
