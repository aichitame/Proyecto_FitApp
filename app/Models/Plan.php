<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{

    use HasFactory;
    //Laravel ya asume que la tabla es 'plans', pero por seguridad la definimos
    protected $table = 'plans';

    protected $fillable = [
        'user_id',
        'client_request_id',
        'name',
        'description',
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

    public function user():BelongsTo{

        return $this->belongsTo(User::class, 'user_id');
    }
}
