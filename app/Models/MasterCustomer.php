<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCustomer extends Model
{
    use HasFactory;

    protected $table = 'master_customer';

    protected $fillable = [
        'nomor_customer',
        'nama_customer',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_hp',
        'email',
        'alamat',
        'nik',
        'status',
    ];

    //carbon
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}
