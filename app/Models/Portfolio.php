<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolio';

    protected $fillable = [
        'title',
        'image',
        'category',
        'description',
        'link',
        'status',
    ];

    public function cat_name(){
        return $this->hasOne(Category::class,'id','category');
    }
}
