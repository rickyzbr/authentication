<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class SubCategories extends Model 
{
    use HasFactory;

    public $table = 'sub_categories';

    protected $fillable = ['category_id', 'name', 'position', 'image' ];

    

}


