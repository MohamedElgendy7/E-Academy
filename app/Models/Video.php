<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Video extends Model
{
    protected $table = 'videos';

    protected $fillable = [
        'link', 'cap', 'active', 'created_at', 'updated_at'
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function setLinkAttribute($value)
    {
        $this->attributes['link'] = Str::after(Str::limit($value, 43, ''), 'watch?v=');
    }

    public function getActive()
    {
        return    $this->active == 1 ? 'مفعل' : 'غير مفعل';
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
