<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\models\Clients;

class ContactsClients extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'name',
        'cargo_id',
        'email',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
        
    }

    public function client()
    {
        return $this->belongsTo(Clients::class);
        
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
        
    }
}
