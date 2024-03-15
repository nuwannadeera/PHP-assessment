<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Medication extends Model {
    protected $table = 'medications';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'quantity', 'user_id'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    use HasFactory, softDeletes;
}
