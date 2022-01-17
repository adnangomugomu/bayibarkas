<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Main_data extends MY_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->path = 'backend/admin/main_data/';
    }

    public function profil()
    {
        $data = [
            'title' => 'Perbarui Profil',
            'li_active' => '',
            'uri_segment' => $this->path,
            'content' => $this->path . 'profil/index',
            'script' => $this->path . 'profil/index_js',
            'breadcrumb' => [
                'Data',
                'Profil',
                'Index',
            ],
        ];

        $this->db->where('is_active', '1');
        $this->db->where('id', $_SESSION['id_akun']);
        $data['data'] = $this->db->get('dev_user')->row();

        $this->templates->load($data);
    }

    public function update_profil()
    {
        cek_post();

        $password = $this->input->post('password_data', true);
        $username = $this->input->post('username_data', true);
        $nama = $this->input->post('nama', true);

        $this->db->where('username', $username);
        $this->db->where('is_active', '1');
        $cek = $this->db->get('dev_user')->row();

        if ($cek && $_SESSION['username'] != $cek->username) {
            echo json_encode([
                'status' => 'failed',
                'msg' => 'Username sudah digunakan',
            ]);
            die;
        }

        $this->db->where('id', $_SESSION['id_akun']);

        if ($password) $this->db->set('password', sha1($password));

        if ($_FILES['foto']['name']) {
            $config['upload_path'] = 'uploads/users';
            $config['allowed_types'] = 'jpg|png|jpeg|gif|svg';
            $config['max_size'] = 0; // 0 = no limit || default max 2048 kb
            $config['overwrite'] = false;
            $config['remove_space'] = true;
            $config['encrypt_name'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $run = $this->upload->do_upload('foto'); // name inputnya

            if (!$run) {
                echo json_encode([
                    'status' => 'failed',
                    'msg' => $this->upload->display_errors()
                ]);
                die;
            }

            $zdata = ['upload_data' => $this->upload->data()]; // get data
            $zfile = $zdata['upload_data']['full_path']; // get file path
            chmod($zfile, 0777); // linux wajib
            $gambar = $zdata['upload_data']['file_name']; // nama file
            $this->db->set('foto', $gambar);

            $this->session->set_userdata([
                'foto' => $gambar,
            ]);
        }

        $this->db->update('dev_user', [
            'nama' => $nama,
            'username' => $username,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $this->session->set_userdata([
            'nama' => $nama,
            'username' => $username,
        ]);

        json([
            'status' => 'success',
            'msg' => 'data berhasil diperbarui'
        ]);
    }
}

/* End of file Main_data.php */
