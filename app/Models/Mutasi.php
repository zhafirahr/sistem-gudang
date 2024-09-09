<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function barang() {
        return $this->belongsTo(Barang::class);
    }
}
