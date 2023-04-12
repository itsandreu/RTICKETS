<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjunto extends Model
{
    use HasFactory;
    protected $table = 'adjuntos';
    protected $primaryKey ='id';
    protected $fillable = ['id_ticket','nombreoriginal','archivo'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id_ticket');
    }
}
