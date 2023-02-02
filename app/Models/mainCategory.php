<?php

namespace App\Models;

use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Model;

class mainCategory extends Model
{
    protected $table = 'main_categories';

    protected $fillable = [
        'name',  'active', 'created_at', 'updated_at'
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


    //relations 

    //get all translation
    public function categories()
    {
        return  $this->hasMany(self::class, 'translation_of', 'id');
    }



    //end of relations

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }


    public function scopeSelection($query)
    {
        return $query->select('id', 'name', 'active');
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
