<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

        'eating_habits',
        'has_allergies',
        'allergies_description',

        'physical_activity_frequency',
        'physical_activity_type',
        'physical_limitations',

        'goal',
        'additional_observations',
        'orientative_service_acknowledged',

        'status',
        'rejection_reason',
        'status_changed_at',
    ];

    protected $casts = [
        'has_allergies' => 'boolean',
        'orientative_service_acknowledged' => 'boolean',
        'status_changed_at' => 'datetime',
        'physical_activity_type' => 'array',
    ];

    /**
     * Relación: Una solicitud pertenece a un usuario (cliente)
     */

    public function user(): BelongsTo{

        return $this->belongsTo(User::class);
    }

    /**
     * Versiones internas del plan orientativo asoaciado a la solicitud.
     */

    public function plans(): HasMany{
        
        return $this->hasMany(Plan::class, 'client_request_id')->orderBy('version');
    }

    public function notifications(): HasMany{
        return $this->hasMany(RequestNotification::class, 'client_request_id');
    }

    public function scopeActive($query){
        return $query->whereIn('status', ['pending', 'in_review']);
    }
}
