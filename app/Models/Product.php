<?php

namespace App\Models;

use App\Models\User;
use App\Models\Categories;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Searchable;

class Product extends Model
{
   //typesense searchable trait from laravel scout
    use Searchable;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'price',
        'approval_status',
        'size',
        'image',
        'qty',
        'status',
        'segment_id' 
    ];

    protected $casts = [
        'price' => 'float',
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

    public function segment()
    {
        return $this->belongsTo(Segment::class, 'segment_id');
    }
        /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray() : array
    {
        return array_merge($this->toArray(),[
            'id' => (string) $this->id,
            'created_at' => $this->created_at->timestamp,
            'updated_at' => $this->updated_at->timestamp,        
        ]);
    }

}
