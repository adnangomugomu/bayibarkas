<?php

class Datatable extends CI_Model
{
    var $table = 'data_laundry a'; //nama tabel dari database
    var $column_order = array(null, 'a.id', 'a.id_estimasi', null, 'a.biaya', 'a.waktu', null, null,); //field yang ada di table user
    var $column_search = array('a.nama_pemilik', 'a.nama_barang', 'a.alamat', 'a.no_hp', 'a.kode', 'a.token'); //field yang diizin untuk pencarian
    var $order = array('a.id' => 'desc'); // default order
    var $menu;

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {

        $waktu_laundry = "(select f.waktu from laundry_has_status f where f.id_data_laundry = a.id and f.is_active = '1' order by f.id asc limit 1) as waktu";
        $status_laundry = "(select e.status from laundry_has_status d left join ref_status_laundry e on e.id = d.id_status where d.id_data_laundry = a.id and d.is_active = '1' order by d.id desc limit 1) as status_laundry";
        $this->db->select("a.*, b.jenis as estimasi, c.jenis as metode, $status_laundry, $waktu_laundry");
        $this->db->where('a.is_active', '1');
        $this->db->join('ref_estimasi_penanganan_laundry b', 'b.id = a.id_estimasi', 'left');
        $this->db->join('ref_metode_pembayaran c', 'c.id = a.id_metode_pembayaran', 'left');
        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) { // looping awal
            if ($_GET['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_GET['search']['value']);
                } else {
                    $this->db->or_like($item, $_GET['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_GET['order'])) {
            $this->db->order_by($this->column_order[$_GET['order']['0']['column']], $_GET['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_GET['length'] != -1)
            $this->db->limit($_GET['length'], $_GET['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }

    function generate_table()
    {
        $list = $this->get_datatables();
        $data = array();
        $no = $_GET['start'];

        foreach ($list as $field) {

            $no++;
            $row = array();

            $tombol_hapus = '             
                <button title="hapus" type="button" class="btn btn-danger btn-sm waves-effect waves-light tombol_hapus" data-id="' . $field->id . '">
                    <i class="bx bx-trash font-size-16 align-middle"></i>
                </button>                                        
            ';

            $tombol_ubah = '                  
                <button title="edit" type="button" class="btn btn-success btn-sm waves-effect waves-light tombol_ubah" data-id="' . sha1($field->id) . '">
                    <i class="bx bx-edit font-size-16 align-middle"></i>
                </button>
            ';

            $tombol_detail = '     
                <br>              
                <span class="text-success tombol_detail" data-id="' . $field->id . '">
                    <i class="fa fa-edit"></i> cek
                </span>
            ';

            $aksi = '
                <div style="width:120px;margin:0 auto;">'  . $tombol_ubah  . $tombol_hapus . '</div>
            ';

            $this->db->select('b.jenis');
            $this->db->where('a.id_data_laundry', $field->id);
            $this->db->where('a.is_active', '1');
            $this->db->join('ref_jenis_laundry b', 'b.id = a.id_jenis', 'left');
            $jenis = $this->db->get('laundry_has_jenis a')->result();

            $get_jenis = '';
            foreach ($jenis as $key) {
                $get_jenis .= '
                    <span class="d-block">- ' . $key->jenis . '</span>
                ';
            }

            $kode = '
                <span class="badge bg-primary kode" title="Token ' . $field->token . '">' . $field->kode . '</span>
            ';

            $nama_pemilik = '
                <span class="text-bold">' . $field->nama_pemilik . '</span>
                <br>
                <span>' . $field->alamat . '</span>
                <br>
                <span class="badge bg-primary">' . $field->no_hp . '</span>
            ';

            $biaya = '
                <span>' . number_format($field->biaya, 0, ',', '.') . '</span>
                <br>
                <span class="text-danger">' . $field->metode . '</span>
            ';

            $tombol_status = '                  
                <button title="status laundry" type="button" class="btn btn-outline-success btn-sm waves-effect waves-light tombol_status" data-kode="' . $field->kode . '" data-id="' . $field->id . '">
                    ' . $field->status_laundry . '
                </button>
            ';

            $row[] = $no;
            $row[] = $field->nama_barang . $tombol_detail;
            $row[] = $kode;
            $row[] = $get_jenis;
            $row[] = $field->estimasi;
            $row[] = $tombol_status;
            $row[] = $biaya;
            $row[] = date('d-M-Y', strtotime($field->waktu));
            $row[] = $nama_pemilik;
            $row[] = $aksi;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_GET['draw'],
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->count_filtered(),
            "data" => $data,
        );
        return json_encode($output);
    }
}
