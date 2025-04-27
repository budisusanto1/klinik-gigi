<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';  // Nama tabel
    protected $primaryKey = 'id'; // Primary key tabel

    // Kolom yang dapat diubah (fillable)
    protected $allowedFields = ['email', 'password', 'reset_token', 'token_created_at'];

    // Mengatur apakah password perlu di-hash atau tidak
    protected $useTimestamps = true;  // Jika ingin menggunakan timestamp otomatis
}
