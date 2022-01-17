<?php

function cek_admin()
{
    if (!$_SESSION['id_admin']) {
        $ci = &get_instance();
        $ci->session->set_flashdata('notice', 'silahkan login terlebih dahulu !');
        redirect('login');
    }
}

function data_sistem($get = 'nama')
{
    $data = [
        'nama' => 'BayiBarkas Pusat Perlengkapan Bayi Terpercaya',
        'deskripsi' => 'Bayi Barkas - www.bayibarkas.com - Jual Beli, Tukar Tambah, Barang Ex Kadoan, Sewa mainan Anak, dan Laundry + Antiseptik serta Service khusus Perlengkapan Bayi. BEKAS BERKUALITAS.',
    ];

    return $data[$get];
}
