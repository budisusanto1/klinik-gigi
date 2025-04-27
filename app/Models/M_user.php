<?php
namespace App\Models;

use CodeIgniter\Model;

class M_user extends Model
{
    protected $table = 'user'; // Pastikan tabel user benar
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['email', 'password', 'username', 'level'];

    // Fungsi untuk validasi login
    public function cek_login($email, $password)
    {
        return $this->where('email', $email)
                    ->where('password', md5($password)) // Pakai MD5 sesuai database
                    ->first(); // Ambil satu data user
    }
    public function getUserByRole($role)
{
    return $this->where('role', $role)->findAll();
}

}
