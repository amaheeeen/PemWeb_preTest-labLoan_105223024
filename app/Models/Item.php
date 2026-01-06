<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
    protected $guarded = ['id']; // Shortcut biar semua bisa diisi

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
