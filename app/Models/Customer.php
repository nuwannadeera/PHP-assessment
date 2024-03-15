<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'address', 'email', 'contact_no', 'description', 'user_id'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    use HasFactory;
}
