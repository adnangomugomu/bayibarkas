<?php

function ref_status_laundry()
{
    $ci = &get_instance();

    $ci->db->where('is_active', '1');
    $ci->db->order_by('urutan', 'asc');
    $data = $ci->db->get('ref_status_laundry')->result();
    return $data;
}

function ref_jenis_laundry()
{
    $ci = &get_instance();
    $ci->db->where('is_active', '1');
    $ci->db->order_by('urutan', 'asc');
    $data = $ci->db->get('ref_jenis_laundry')->result();
    return $data;
}

function ref_estimasi_penanganan_laundry()
{
    $ci = &get_instance();
    $ci->db->where('is_active', '1');
    $ci->db->order_by('urutan', 'asc');
    $data = $ci->db->get('ref_estimasi_penanganan_laundry')->result();
    return $data;
}

function ref_metode_pembayaran()
{
    $ci = &get_instance();
    $ci->db->where('is_active', '1');
    $ci->db->order_by('urutan', 'asc');
    $data = $ci->db->get('ref_metode_pembayaran')->result();
    return $data;
}

function ref_jenis_barang()
{
    $ci = &get_instance();
    $ci->db->where('is_active', '1');
    $ci->db->order_by('urutan', 'asc');
    $data = $ci->db->get('ref_jenis_barang')->result();
    return $data;
}

function ref_bulan()
{
    $ci = &get_instance();
    $ci->db->where('is_active', '1');
    $ci->db->order_by('urutan', 'asc');
    $data = $ci->db->get('ref_bulan')->result();
    return $data;
}

function ref_tahun()
{
    $ci = &get_instance();
    $ci->db->where('is_active', '1');
    $ci->db->order_by('urutan', 'asc');
    $data = $ci->db->get('ref_tahun')->result();
    return $data;
}