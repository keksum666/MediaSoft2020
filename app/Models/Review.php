<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = ['Film_id','Review','Rating','UserName'];

    public function films(){
        return $this->belongsTo(Film::class);
    }
}
