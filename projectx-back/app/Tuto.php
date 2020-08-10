<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tuto extends Model
{
    protected $fillable = [
        'title', 'author_id', 'difficulty','summary','content', 'langage', 'state', 'pathImg', 'ratings', 'nb_ratings','files'
    ];
}
