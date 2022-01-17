<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Warranty extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['client_id', 'status_id', 'product_id', 'email', 'serial', 'description', 'file', 'date' ];

    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }

    public function status()
    {
        return $this->belongsTo(WarrantyStatus::class, 'status_id');
    }

    public function imagesWarranty()
    {
        return $this->hasMany(ImagesWarranty::class, 'warranty_id');
    }

    public function stepsWarranty()
    {
        return $this->hasMany(WarrantySteps::class, 'warranty_id');
    }

    public function search(Array $data, $totalPage)
    {
        return  $this->where(function ($query) use($data) {
            if (isset($data['busca']))
                $query->where('id','LIKE','%'.$data['busca'].'%')
                      ->orWhere('serial','LIKE','%'.$data['busca'].'%'); 
                      
            if (isset($data['client_id']))
                $query->where('client_id', $data['client_id']);
          
            if (isset($data['product_id']))
                $query->where('product_id', $data['product_id']);
                
            if (isset($data['status_id']))
                $query->where('status_id', $data['status_id']);
        })   
        ->paginate($totalPage);

        return $products;
    }
}
