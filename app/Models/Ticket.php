<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'tickets';
    protected $primaryKey ='id';
    protected $fillable =['id','id_user','asignado','titulo','descripcion','id_estado','id_prioridad','updated_by'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function asignadoA()
    {
        return $this->belongsTo(User::class, 'asignado');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }

    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class, 'id_prioridad');
    }

    public function adjuntos()
    {
        return $this->hasMany(Adjunto::class, 'id_ticket');
    }
    public function actualizado()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
