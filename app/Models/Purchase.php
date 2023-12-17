<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['motor_id', 'buyer_name', 'contact_number'];

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }
}
