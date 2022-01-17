<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\ContactsClients;

class Clients extends Model
{
    use HasFactory;

    protected $fillable = ['active',
        'name',
        'address',
        'number',
        'complement',
        'cep',
        'state',
        'city',
        'bairro',
        'country',
        'cnpj',
        'insc',
        'phone', 'email', 'description', 'image',
    ];

    public function contactsClient()
    {
        return $this->hasMany(ContactsClients::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    


}
