<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarrantyStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color_id', 'description' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function colors()
    {
        return $this->belongsTo(ColorStatus::class, 'color_id');
    }


}
