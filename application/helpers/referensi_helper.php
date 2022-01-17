<?php

function ref_status_laundry()
{
    $ci = &get_instance();

    $ci->db->where('is_active', '1');
    $ci->db->order_by('urutan', 'asc');
    $data = $ci->db->get('ref_status_laundry')->result();
    return $data;
}
