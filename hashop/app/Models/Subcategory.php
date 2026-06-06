<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    protected $fillable = ['category_id', 'name', 'slug', 'description', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($sub) {
            $sub->slug = Str::slug($sub->name);
        });
        static::updating(function ($sub) {
            $sub->slug = Str::slug($sub->name);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
