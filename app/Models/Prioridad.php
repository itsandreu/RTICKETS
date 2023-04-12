<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prioridad extends Model
{
    use HasFactory;
    protected $table = 'prioridades';
    protected $primaryKey ='id';
    protected $fillable =['id','name'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'id_prioridad');
    }
}
