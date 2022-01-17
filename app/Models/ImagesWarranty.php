<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesWarranty extends Model
{
    use HasFactory;

    protected $fillable = ['warranty_id', 'filename' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
