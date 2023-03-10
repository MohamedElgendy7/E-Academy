<?php

namespace App\Models;

use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class mainCategory extends Model
{
    protected $table = 'main_categories';

    protected $fillable = [
        'name',  'active', 'super_id', 'created_at', 'updated_at'
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];

    //observer link
    protected static function boot()
    {
        parent::boot();
        mainCategory::observe(MainCategoryObserver::class);
    }






    //end of relations

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeUser($query)
    {
        return $query->where('super_id', Auth::user()->super_id);
    }


    public function scopeSelection($query)
    {
        return $query->select('id', 'name', 'active')->where('super_id', Auth::user()->super_id);
    }

    //model method 

    public function getActive()
    {
        return    $this->active == 1 ? 'مفعل' : 'غير مفعل';
    }

    //Accessors 
    public function getPhotoAttribute($val)
    {
        return ($val !== NUll)  ? asset('assets/' . $val) : '';
    }


    //relations 


    public function grades()
    {
        return $this->hasMany(Grade::class, 'main_category_id', 'id');
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'main_category_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'main_category_id', 'id');
    }
}
