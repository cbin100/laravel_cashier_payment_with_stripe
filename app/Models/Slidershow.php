<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slidershow extends Model
{
    use HasFactory;
    protected $table = 'slidershows';
    protected $fillable = ['user_id', 'slider_title', 'slider_status', 'slider_caption', 'slider_description', 'post_id', 'post_image_id', 'slider_parent', 'slider_type', 'external_link'];
    protected $attributes = [
        'slider_status' => '',
        'slider_caption' => '',
        'slider_description' => '',
        'post_id' => 0,
        'slider_parent' => 0,
        'post_image_id' => 0,
        'slider_type' => '',
        'external_link' => ''

    ];

    /*
    public function user()
    {
        return $this->belongsTo(User::class, 'post_author');
    }
    public function postmeta()
    {
        return $this->hasMany(Postmeta::class, 'post_id');
    }
    */
}
