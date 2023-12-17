<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Motor extends Model
{
    use HasFactory;

    protected $fillable = ['brand', 'model', 'year', 'power', 'image_path',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
