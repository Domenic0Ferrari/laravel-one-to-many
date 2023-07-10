<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    // un post può essere associato ad una sola categoria quindi category lo scriviamo al singolare...il nome quindi dipende dalla relazione che c'è (una a molti, molti a molti)
    public function category()
    {
        return $this->belongsTo(Category::class);
        // abbiamo diversi metodi, usiamo belongsTo perchè il post appartiene ad una categoria, che sta sempre dalla parte del molti in una relazione una a molti, nella tabella che contiene la chiave esterna
        // qui si usa sempre il belongsTo perchè è la tabella che contiene la chiave esterna
    }
}
