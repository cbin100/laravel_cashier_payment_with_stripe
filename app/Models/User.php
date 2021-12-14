<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// Use this for Cashier. Before using Cashier, add Billable trait to your billable model definition
//use Laravel\Cashier\Billable;
class User extends Authenticatable
{
    use HasFactory, Notifiable;
// Use Billable trait to the billable model definition
    //use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $attributes = [
        'name' => 'Cashier Customer',
        'email' => 'your email address',
        'password' => 'your password',
        'admin' => 0,
        'role' => 'customer',
        'permission' => 0,
    ];




    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post()
    {
        //foreign_key = post_author
        //return $this->hasMany(Post::class);
        return $this->hasMany(Post::class, 'user_id', 'id');
        //return $this->hasOne(Post::class, 'post_author');
        //return $this->hasManyThrough(Post::class, Postmeta::class);
        //return $this->hasManyThrough(Postmeta::class, Post::class);
    }

    public function userProductCategory()
    {
        return $this->hasMany(\App\Models\ProductCategory::class, 'user_id');
    }

}
