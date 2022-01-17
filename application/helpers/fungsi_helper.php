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
