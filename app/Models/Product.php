<?php

namespace App\Models;

use App\Models\User;
use App\Models\Categories;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Product extends Model
{
   
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'price',
        'size',
        'image',
        'qty',
        'listingtype',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function setImageAttribute($value)
    {
        if(is_file($value)){
            $this->attributes['image'] = $value->store('products_images','public');
        }else {
            $this->attributes['image'] = $value;
        }
    }
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
