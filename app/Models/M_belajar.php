<?php
namespace App\Models;
use CodeIgniter\Model;

class M_belajar extends Model
{ //protected $table = 'user'; // ✅ Tambahkan tabel utama (ubah sesuai kebutuhan)
    //protected $primaryKey = 'id_user'; // ✅ Sesuaikan dengan primary key tabel user
    //protected $allowedFields = ['email', 'password']; // ✅ Sesuaikan field yang bisa di-update
         protected $table = 'log_activity';
    protected $primaryKey = 'id';
    protected $allowedFields = ['waktu', 'date', 'username', 'activity', 'ip_address'];
public function tampil($table, $by)
    {
        return $this->db
            ->table($table)
            ->orderby($by, 'desc')
            ->get()
            ->getResult();
    } 
     public function getRekamMedisByPasien($id_pasien)
    {
        return $this->select('rekam_medis.*, user.nama as nama_dokter')
            ->join('user', 'rekam_medis.id_dokter = user.id_user')
            ->where('rekam_medis.id_pasien', $id_pasien)
            ->orderBy('tanggal_periksa', 'DESC')
            ->findAll();
    }
    // Fungsi untuk mengambil semua log
 public function getLogs()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    // Fungsi untuk menyimpan log aktivitas
    public function log_activity($id, $username, $activity)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            'id_user'    => $id,
            'username'   => $username,
            'activity'   => $activity,
            'created_at' => date('Y-m-d H:i:s'),
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN'
        ];
        return $this->insert($data);
    }
public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
    public function hapus($table, $where)
    {
        return $this->db->table($table)->delete($where);
    }

    public function getWhere($table, $where)
    {
        return $this->db->table($table)->getWhere($where)->getRow();
    }

    public function updateData($table, $where, $data)
    {
        return $this->db->table($table)->where($where)->update($data);
    }

    public function edit($table, $data, $where)
    {
        return $this->db->table($table)->update($data, $where);
    }
    public function simpan_data($table, $data)
{
    return $this->db->table($table)->insert($data);
}


    public function getAllMenu()
    {
        return $this->db->table('menu')
            ->select('menu.*, restoran.nama_restoran, restoran.status_restoran') // Ambil nama & status restoran
            ->join('restoran', 'restoran.id_restoran = menu.id_restoran') // JOIN dengan tabel restoran
            ->get()
            ->getResult();
    }

    public function getAllUsers()
    {
        return $this->db->table('user')->get()->getResult();
    }
    public function getAll()
    {
        return $this->db->table('layanan')->get()->getResult();
    }
    public function getAllKaryawan()
    {
        return $this->db->table('karyawan')->get()->getResult();
    }
      public function getAllPasien()
    {
        return $this->db->table('pasien')->get()->getResult();
    }
public function getDokterById($id_dokter)
{
    return $this->db->table('dokter')
        ->join('user', 'dokter.id_user = user.id_user')
        ->where('dokter.id_dokter', $id_dokter)
        ->get()
        ->getRow();
}
// Di dalam M_belajar.php
public function getAllDokter()
{
    return $this->db->table('dokter')->get()->getResult();
}
public function getData($table)
{
    return $this->db->table($table)->get()->getResult();
}

    public function input($table, $data)
    {
        return $this->db->table($table)->insert($data);
    }
public function join2($tabel1, $tabel2, $on, $where = null)
{
    $builder = $this->db->table($tabel1);
    $builder->join($tabel2, $on);

    if ($where !== null) {
        $builder->where($where);
    }

    return $builder->get();
}
public function getPasienList()
{
    return $this->db
        ->table('pasien')
        ->select('id_pasien, nama') // Ganti 'nama_pasien' jadi 'nama'
        ->get()
        ->getResult();
}



  public function join5($table, $table2, $table3, $table4,$table5,$on,$on1,$on2,$on3)
{
    return $this->db
        ->table($table) 
        ->join($table2, $on) 
        ->join($table3, $on1) 
        ->join($table4, $on2) 
        ->join($table5, $on3)
        ->get() 
        ->getResult();
}
    public function join($table, $table2, $on, $by)
    {
        return $this->db
            ->table($table)
            ->join($table2, $on)
            ->orderby($by, 'desc')
            ->get()
            ->getResult();
    }
    public function join3($table, $table2, $table3, $table4, $on, $on1, $on2, $by)
{
    return $this->db
        ->table($table) // Start with the base table ('orderdetail')
        ->join($table2, $on) // Join the 'menu' table using the condition in $on
        ->join($table3, $on1) // Join the 'orders' table using the condition in $on1
        ->join($table4, $on2) // Join the 'customer' table using the condition in $on2
        ->orderby($by, 'desc') // Order the results by the specified field ($by)
        ->get() // Execute the query
        ->getResult(); // Return the results as an array of objects
}
public function join4($table1, $table2, $id2, $table3, $id3, $table4, $id4, $where = [])
{
    return $this->db->table($table1)
        ->join($table2, "$table1.$id2 = $table2.$id2")
        ->join($table3, "$table1.$id3 = $table3.$id3")
        ->join($table4, "$table1.$id4 = $table4.$id4")
        ->where($where)
        ->get()->getResult();
}

    public function joinRPL12($tabel, $tabel2, $on)
    {
        return $this->db->table($tabel)
            ->join($tabel2, $on, 'left')
            ->get()
            ->getResult();
    }

public function filter($table, $table2, $on, $filter1, $filter2, $awal, $akhir)
{
    return $this->db
        ->table($table)
        ->join($table2, $on)
        ->where($filter1 . ' >=', $awal)
        ->where($filter2 . ' <=', $akhir)
        ->where('pembayaran.status_pembayaran', 'Sukses') // Hanya pembayaran sukses
        ->select('pembayaran.tanggal_pembayaran, pembayaran.metode_pembayaran, 
                  SUM(orders.total_harga) AS total_pendapatan, 
                  COUNT(orders.id_order) AS jumlah_transaksi')
        ->groupBy('pembayaran.tanggal_pembayaran, pembayaran.metode_pembayaran')
        ->get()
        ->getResult();
}

public function filter3($awal, $akhir)
{
    if (empty($awal) || empty($akhir)) {
        die("Tanggal awal atau akhir tidak boleh kosong!");
    }

    $query = $this->db
        ->table('pembayaran')
        ->join('orders', 'pembayaran.id_order = orders.id_order')
        ->where('tanggal_pembayaran >=', $awal . ' 00:00:00')
        ->where('tanggal_pembayaran <=', $akhir . ' 23:59:59')
        ->get();

    return $query->getResult(); 
}



    public function filter2($filter1, $filter2, $awal, $akhir)
    {
        return $this->db
            ->table('pesanan')
            ->join('barang', 'pesanan.id_barang=barang.id_barang')
            ->join('nota', 'pesanan.id_nota=nota.id_nota')
            ->join('user', 'pesanan.id_user=user.id_user')
            ->where($filter1, $awal)
            ->where($filter2, $akhir)
            ->get()
            ->getResult();
    }

    public function joinw($table, $table2, $on, $w)
    {
        return $this->db->table($table)
            ->join($table2, $on)
            ->where($w)
            ->get()
            ->getRow();
    }

    // ✅ Tambahkan fungsi getById untuk mengatasi error
    public function getById($table, $column, $id)
    {
        return $this->db->table($table)->where($column, $id)->get()->getRow();
    }
public function getUserDokterBelumTerdaftar()
{
    $query = $this->db->table('user')
        ->join('dokter', 'dokter.id_user = user.id_user', 'left')
        ->where('user.role', 'dokter')
        ->where('user.deleted_at', null)
        ->where('dokter.id_user', null)
        ->get();

    if ($query === false) {
        // Jika query gagal, log error dan tampilkan pesan kesalahan
        log_message('error', 'Query gagal: ' . $this->db->getLastQuery());
        log_message('error', 'Database Error: ' . $this->db->error()['message']);
        return []; // Kembalikan array kosong jika gagal
    }

    return $query->getResult();
}



   public function soft_delete($table, $column, $id)
{
    return $this->db->table($table)
        ->where($column, $id)
        ->update(['status' => 0]); 
}


    // Restore soft-deleted records (set status back to NULL)
    public function restore($table, $column, $id)
    {
        return $this->db->table($table)
            ->where($column, $id)
            ->update(['status' => NULL]);
    }

 public function tampil_active_no_sort($table, $column, $where = [])
{
    $builder = $this->db->table($table);
    $builder->where('status IS NULL', null, false); // Hanya data aktif
    $builder->orderBy($column, 'DESC'); 

    if (!empty($where)) {
        $builder->where($where);
    }

    $query = $builder->get();

    return $query->getResult(); // Harus mengembalikan array
}

    public function get_deleted_items_no_sort($table, $column, $order = 'DESC')
    {
        return $this->db->table($table)
            ->where('status', 0) // Soft deleted records
            ->orderBy($column, $order) // FIXED: Now orders by correct column
            ->get()
            ->getResult();
    }

    public function hard_delete($table, $column, $id)
    {
        return $this->db->table($table)
            ->where($column, $id)
            ->update(['status' => 1]); // Mark as permanently deleted
    }
public function getDokter()
{
    return $this->db->table('user')
        ->where('role', 'dokter')
        ->get()->getResultArray();
}

public function getPasien()
{
    return $this->db->table('user')
        ->where('role', 'pasien')
        ->get()->getResultArray();
}

public function getLayanan()
{
    return $this->db->table('layanan')
        ->get()->getResult();
}

public function getRekamMedisByDokter($id_dokter)
{
    return $this->db->table('rekam_medis')
        ->where('id_dokter', $id_dokter)
        ->get()->getResult();
}

// public function getLaporanKeuangan()
// {
//     return $this->db->table('pembayaran')
//         ->select('pembayaran.tanggal_pembayaran, pembayaran.metode_pembayaran, 
//                   SUM(orders.total_harga) AS total_pendapatan, 
//                   COUNT(orders.id_order) AS jumlah_transaksi')
//         ->join('orders', 'orders.id_order = pembayaran.id_order')
//         ->where('pembayaran.status_pembayaran', 'Sukses')
//         ->groupBy(['pembayaran.tanggal_pembayaran', 'pembayaran.metode_pembayaran'])
//         ->orderBy('pembayaran.tanggal_pembayaran', 'DESC')
//         ->get()->getResultArray();
// }

}
