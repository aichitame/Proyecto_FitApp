<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

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
        'version',
        'status',
        'published_at',
    ];

    protected $casts = [
        'version' => 'integer',
        'published_at' => 'datetime',
    ];

    /**
     * Relación: esta versión del plan pertenece a una solicitud concreta
     */

    public function clientRequest(): BelongsTo{

        return $this->belongsTo(ClientRequest::class, 'client_request_id');
    }

    /**
     * Usuario administrador que crea o edita esta versión.
     */

    public function user():BelongsTo{

        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope opcional para recuperar solo planes publicados.
    */

    public function scopePublished(Builder $query): Builder {
        return $query->where('status', 'published');
    }

    /**
     * Scope opcional para recuperar borradores.
     */

    public function scopeDraft(Builder $query): Builder {
        return $query->where('status', 'draft');
    }
}
