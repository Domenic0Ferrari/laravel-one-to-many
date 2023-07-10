<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;

    // scriviamo posts perchè la categoria può essere associata a più post
    public function posts()
    {
        return $this->hasMany(Post::class);
        // qui usiamo hasMany perchè una categoria può essere assegnata a più post, quindi l'hasMany va nella tabella che contiene l'1, nella relazione una a molti
        // se la relazione fosse uno a uno si userebbe l'"hasOne" e si userebbero i nomi al singolare
    }
}
