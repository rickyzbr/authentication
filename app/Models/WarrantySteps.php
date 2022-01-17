<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarrantySteps extends Model
{
    use HasFactory;

    protected $fillable = ['warranty_id', 'type', 'description' ];


    public function type($type = null)
    {
        $types = [
            'L' => 'Esperando o Laudo de Análise Técnica',
            'R' => 'Recomendações',
            'C' => 'Conclusão',
            'O' => 'Observações'
        ];

        if (!$type)
            return $types;

        if ($this->description != null && $type =='L')
            return 'Laudo de Análise Técnica';

        return $types[$type];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function steps()
    {
        return $this->belongsTo(Warranty::class, 'warranty_id');
    }

    public function warranty()
    {
        return $this->belongsTo(Warranty::class);
    }
}
