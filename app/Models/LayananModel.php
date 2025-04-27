<?php
namespace App\Models;
use CodeIgniter\Model;
class LayananModel extends Model
{
    protected $table = 'layanan'; // Nama tabel layanan
    protected $primaryKey = 'id_layanan'; // Primary key
    protected $allowedFields = ['id_layanan', 'nama_layanan', 'deskripsi', 'harga', 'foto']; // Kolom yang diizinkan
}
