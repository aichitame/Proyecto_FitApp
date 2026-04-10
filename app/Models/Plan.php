<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plan extends Model
{
    //Laravel ya asume que la tabla es 'plans', pero por seguridad la definimos
    protected $table = 'plans';

    protected $fillable = [
        'admin_id',
        'client_request_id',
        'title',
        'diet_tips',
        'training_tips',
        'final_observations',
    ];

    /**
     * Relación: el plan pertenece a una solicitud específica
     */

    public function clientRequest(): BelongsTo{

        return $this->belongsTo(ClientRequest::class, 'client_request_id');
    }

    /**
     * Relación: el plan es creado por un administrador.
     */

    public function admin():BelongsTo{

        return $this->belongsTo(User::class, 'admin_id');
    }
}
