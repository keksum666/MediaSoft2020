<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    protected $table = 'films';
    protected $fillable = ['Title','Duration','Poster','Description'];

    public function genres(){
        return $this->belongsToMany(Genre::class);
    }

    public function actors(){
        return $this->belongsToMany(Actor::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function producers(){
        return $this->belongsToMany(Producer::class);
    }
}
