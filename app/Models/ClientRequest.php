<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ClientRequest extends Model
{
    //nombre de la tabla en inglés
    protected $table = 'client_requests';

    //campos que permitimos rellenar (mass assignment)
    protected $fillable = [
        'user_id',
        'age',
        'gender',
        'height',
        'weight',
        'goal',
        'activity_level',
        'training_days',
        'food_preference',
        'notes',
        'status',
    ];

    /**
     * Relación: Una solicitud pertenece a un usuario (cliente)
     */

    public function user(): BelongsTo{

        return $this->belongsTo(User::class);
    }

    /**
     * Relación: una solicitud puede tener un plan asociado.
     */

    public function plan(): HasOne{
        
        return $this->hasOne(Plan::class);
    }
}
