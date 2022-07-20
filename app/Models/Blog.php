<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    use HasFactory;
    public $fillable = [
        'name','description','category_id',
    ];
    
    public function Category(){
        return $this->hasMany(Category::class, 'id'); 
    }

    public function setCategoryAttribute($value)
    {
        $this->attributes['category_id'] = json_encode($value);
    }

    public function getCategoryAttribute($value)
    {
        return $this->attributes['category_id'] = json_decode($value);
    }
}
