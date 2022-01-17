<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function clients()
    {
        return $this->hasMany(Clients::class);
    }

    public function cargo()
    {
        return $this->hasMany(Cargo::class);
    }


    public function contactsClients()
    {
        return $this->hasMany(ContactsClients::class);
    }

    public function categories()
    {
        return $this->hasMany(Categories::class);
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategories::class);
    }

    public function warrantystatus()
    {
        return $this->hasMany(WarrantyStatus::class);
    }

    public function warranty()
    {
        return $this->hasMany(Warranty::class);
    }

    public function imageWarranty()
    {
        return $this->hasMany(ImagesWarranty::class);
    }

    public function warrantysteps()
    {
        return $this->hasMany(WarrantySteps::class);
    }

    
}
