<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    use HasFactory;
    //protected $fillable = ['numero_porte ','user_id','category_id','disponibilite_id'];
    protected $guarded = ['user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function disponibilite(){
        return $this->belongsTo(Disponibilite::class);
    }

    public function reservation(){
        return $this->hasOne(Reservation::class);
    }
}
