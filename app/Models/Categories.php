<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Categories extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'position', 'image' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sub_categories()
    {
        return $this->hasMany(SubCategories::class, 'category_id')->orderBy('position', 'asc');
    }

    
    
}
