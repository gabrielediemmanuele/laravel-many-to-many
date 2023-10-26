<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'slug',
        'date',
        'link',
        'type_id',
        'tec_name',
        'description'
    ];

    /* 
    ! rapporto tra project e type uno a molti.  
    */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /* 
    ! rapporto tra projects e technologies molti a molti.  
    */
    public function technologies()
    {
        /* il belongsToMany definisce una relazione molti a molti  */
        return $this->belongsToMany(Technology::class);
    }

}
