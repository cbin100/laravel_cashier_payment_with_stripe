<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;

    //protected $table = 'categories';
    //public $timestamps = true;

    protected $fillable = ['title', 'content', 'user_id', 'slug'];
    //protected $fillable = ['title', 'content', 'slug'];


//I also want to link to posts using a unique 'slug' rather than the default ID. Add this as well and we are done with this file:
    public function getRouteKeyName()
    {
        return 'slug';
    }
    /*
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    */
}
