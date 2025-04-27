<?php namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $allowedFields = ['id_booking', 'metode_pembayaran', 'total', 'status', 'tanggal_pembayaran'];

    // Mengambil pembayaran berdasarkan status
    public function getPembayaranByStatus($status)
    {
        return $this->where('status', $status)->findAll();
    }

    // Mengambil seluruh riwayat pembayaran
    public function getAllPembayaran()
    {
        return $this->findAll();
    }
}
