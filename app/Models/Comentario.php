<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $table = 'comentarios';
    protected $primaryKey ='id';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable =['id','titulo','comentario','id_ticket','creado_por'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class,'id_ticket');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class,'creado_por');
    }
}
