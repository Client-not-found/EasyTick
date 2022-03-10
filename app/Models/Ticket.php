<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'useId', 'depId', 'subject', 'status'];

    public function departement()
    {
        return $this->hasOne(Departement::class, 'Key', 'depId');
    }
}
