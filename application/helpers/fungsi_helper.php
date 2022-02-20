<?php

function dd($arr)
{
    echo json_encode($arr);
    die;
}

function json($arr)
{
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arr);
    die;
}

function cek_post()
{
    if (!$_POST) {
        json([
            'status' => 'failed',
            'msg' => 'method tidak diizinkan',
        ]);
    }
}

function cek_aktif($aktif = null, $keyword = null, $return = 'mm-active')
{
    if (strtolower($aktif) == strtolower($keyword)) return $return;
}

function generateRandomString($length = 5)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function remove_titik($data)
{
    return str_replace('.', '', $data);
}

function rupiah($data)
{
    return number_format($data, 0, ',', '.');
}
