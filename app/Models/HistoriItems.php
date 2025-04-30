<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriItems extends Model
{
    use HasFactory;

    protected $table = 'histori_item';

    protected $fillable = [
        'item_id',
        'user_id',
        'type',
        'quantity',
        'previous_stock',
        'new_stock',
        'description'
    ];

    protected $casts = ['created_at' => 'datetime'];
}
