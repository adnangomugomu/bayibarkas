<?php

class Datatable extends CI_Model
{
    var $table = 'ref_jenis_barang a'; //nama tabel dari database
    var $column_order = array(null, 'a.nama', null); //field yang ada di table user
    var $column_search = array('a.nama'); //field yang diizin untuk pencarian
    var $order = array('a.urutan' => 'asc'); // default order

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {

        $this->db->where('a.is_active', '1');
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

            $tombol_setting = '             
                <button data-name="' . $field->nama . '" title="hapus" type="button" class="btn btn-success btn-sm tombol_setting" data-id="' . $field->id . '">
                    <i class="bx bx-cog font-size-16 align-middle"></i> Setting
                </button>                                        
            ';

            $aksi = '
                <div style="width:120px;margin:0 auto;">'  . $tombol_setting . '</div>
            ';
            $row[] = $no;
            $row[] = $field->nama;

            foreach (ref_estimasi_penanganan_laundry() as $key) {
                $this->db->where('id_jenis_barang', $field->id);
                $this->db->where('id_estimasi', $key->id);
                $this->db->where('is_active', '1');
                $harga = @$this->db->get('jenis_barang_has_estimasi_penanganan')->row()->biaya;
                $harga = $harga ? $harga : 0;
                $row[] = rupiah($harga);
            }

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
