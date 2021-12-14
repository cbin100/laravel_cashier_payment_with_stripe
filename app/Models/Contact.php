<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    protected $fillable = [
        'name',
        'email',
        'message',
        'subject',
        'is_read',
        'folder'
    ];
    protected $attributes = [
        'name' => '',
        'message' => '',
        'subject' => '',
        'is_read' => 0,
        'folder' => 'inbox'
    ];
}
