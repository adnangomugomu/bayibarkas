<?php

class Datatable extends CI_Model
{
    var $table = 'data_laundry a'; //nama tabel dari database
    var $column_order = array(null, 'a.nama_pemilik', 'a.kode', 'a.total', 'a.id_status', 'a.created_at', null, null,); //field yang ada di table user
    var $column_search = array('a.nama_pemilik', 'a.alamat', 'a.no_hp', 'a.kode', 'a.token'); //field yang diizin untuk pencarian
    var $order = array('a.id' => 'desc'); // default order
    var $menu;

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {

        $this->db->select("a.*, b.jenis as metode, c.status");
        $this->db->where('a.is_active', '1');
        $this->db->join('ref_metode_pembayaran b', 'b.id = a.id_metode_pembayaran', 'left');
        $this->db->join('ref_status_laundry c', 'c.id = a.id_status', 'left');

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

            $aksi = '
                <div style="width:120px;margin:0 auto;">'  . $tombol_ubah  . $tombol_hapus . '</div>
            ';

            $kode = '
                <span class="badge bg-primary kode" title="Token ' . $field->token . '">' . $field->kode . '</span>
                <span class="badge bg-danger"> <i class="bx bx-money"></i>' . $field->metode . '</span>
            ';

            $informasi_pelanggan = '                           
                <div style="width:150px;">
                    <span>' . $field->alamat . '</span>
                    <br>
                    <span class="badge badge-soft-primary"> <i class="bx bx-phone-call"></i> ' . $field->no_hp . '</span>
                </div>
            ';

            $biaya = '
                <div style="width:100px;">
                    <span>' . rupiah($field->total) . '</span>                                         
                </div>
            ';

            $tombol_status = '                  
                <button style="width:120px;" title="status laundry" type="button" class="btn btn-soft-success btn-rounded btn-sm tombol_status" data-kode="' . $field->kode . '" data-id="' . $field->id . '">
                    ' . $field->status . '
                </button>
            ';

            $tombol_detail = '     
                <span style="width:100px;" class="btn btn-soft-dark btn-rounded btn-sm tombol_detail" data-id="' . $field->id . '">
                    info barang
                </span>
            ';

            $nama_pemilik = '
                <div style="width:200px;">' . $field->nama_pemilik . '</div>
            ';

            $waktu_penerimaan = '
                <div style="width:150px;">' . date('d-M-Y H:i', strtotime($field->created_at)) . '</div>
            ';

            $row[] = $no;
            $row[] = $nama_pemilik;
            $row[] = $kode;
            $row[] = $biaya;
            $row[] = $informasi_pelanggan;
            $row[] = $tombol_detail;
            $row[] = $tombol_status;
            $row[] = $waktu_penerimaan;
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
