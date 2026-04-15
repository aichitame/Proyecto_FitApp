<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestNotification extends Model
{
    protected $fillable = [
        'client_request_id',
        'type',
        'status',
        'notified_at',
        'error_message',
        'attempts',
        'sent_by_user_id',
    ];

    protected $casts = [
        'notified_at' => 'datetime',
    ];

    /**
     * La notificación pertenece a una solicitud.
     */

    public function clientRequest(): BelongsTo{
        return $this->belongsTo(ClientRequest::class, 'client_request_id');
    }


/**
 * Usuario administrador que lanzó el envío manual, si aplica
 */

public function sentByUser(): BelongsTo{
    return $this->belongsTo(User::class, 'sent_by_user_id');
}

}