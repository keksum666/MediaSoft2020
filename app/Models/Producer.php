<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    use HasFactory;
    protected $table = 'producers';
    protected $fillable = ['Name','Photo','Age','Description'];

    public function films(){
        return $this->belongsToMany(Film::class);
    }
}
