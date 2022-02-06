<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class Cetak extends CI_Model
{

    public function cetak_harian($bulan, $tahun)
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle('rekap harian');
        $spreadsheet->getProperties()->setCreator('bayibarkas')
            ->setLastModifiedBy('bayibarkas')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php');

        $spreadsheet
            ->getActiveSheet()
            ->getStyle('A5:L5')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('FFFA65');

        $spreadsheet->getActiveSheet(0)->setCellValue('A2', 'Data laundry harian - bayibarkas');

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A5', 'NO')->getStyle('A5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B5', 'NAMA PRODUK')->getStyle('B5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C5', 'KODE')->getStyle('C5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('D5', 'JENIS LAUNDRY')->getStyle('D5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('E5', 'ESTIMASI PENANGANAN')->getStyle('E5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('F5', 'STATUS')->getStyle('F5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('G5', 'BIAYA')->getStyle('G5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('H5', 'METODE PEMBAYARAN')->getStyle('H5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('I5', 'WAKTU PENERIMAAN')->getStyle('I5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('J5', 'NAMA PELANGGAN')->getStyle('J5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('K5', 'ALAMAT')->getStyle('K5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('L5', 'NOMER HP')->getStyle('L5')->getFont()->setBold(true);

        $spreadsheet->getActiveSheet(0)->getStyle('A5:L5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet(0)->getRowDimension('5')->setRowHeight(35);

        $spreadsheet->getActiveSheet(0)->getColumnDimension('A')->setWidth(10);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('B')->setWidth(35);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('C')->setWidth(25);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('D')->setWidth(25);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('E')->setWidth(20);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('F')->setWidth(20);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('G')->setWidth(20);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('H')->setWidth(20);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('I')->setWidth(20);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('J')->setWidth(20);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('K')->setWidth(20);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('L')->setWidth(30);

        $kolom = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];

        for ($i = 0; $i < count($kolom); $i++) {
            $row = $kolom[$i] . 5;

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
        }

        $no = 1;
        $awal = 6;

        $waktu_laundry = "(select f.waktu from laundry_has_status f where f.id_data_laundry = a.id and f.is_active = '1' order by f.id asc limit 1)";
        $status_laundry = "(select e.status from laundry_has_status d left join ref_status_laundry e on e.id = d.id_status where d.id_data_laundry = a.id and d.is_active = '1' order by d.id desc limit 1) as status_laundry";
        $this->db->select("a.*, b.jenis as estimasi, c.jenis as metode, $status_laundry, $waktu_laundry as waktu");

        $this->db->where('a.is_active', '1');
        $this->db->where("YEAR($waktu_laundry) = $tahun", NULL, FALSE);
        if ($bulan != 'all') $this->db->where("MONTH($waktu_laundry) = $bulan", NULL, FALSE);

        $this->db->join('ref_estimasi_penanganan_laundry b', 'b.id = a.id_estimasi', 'left');
        $this->db->join('ref_metode_pembayaran c', 'c.id = a.id_metode_pembayaran', 'left');
        $this->db->order_by($waktu_laundry, 'asc');
        $this->db->order_by('a.id', 'asc');
        $data = $this->db->get('data_laundry a')->result();

        foreach ($data as $field) {

            $this->db->select('b.jenis');
            $this->db->where('a.id_data_laundry', $field->id);
            $this->db->where('a.is_active', '1');
            $this->db->join('ref_jenis_laundry b', 'b.id = a.id_jenis', 'left');
            $jenis = $this->db->get('laundry_has_jenis a')->result();

            $total_row = count($jenis) == 0 ? 0 : count($jenis) - 1;

            $start = $awal;
            for ($i = 0; $i < count($jenis); $i++) {
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('D' . $start, $jenis[$i]->jenis);

                for ($ix = 0; $ix < count($kolom); $ix++) {
                    $row_merge = $kolom[$ix] . $start;
                    $spreadsheet
                        ->getActiveSheet()
                        ->getStyle($row_merge)
                        ->getBorders()
                        ->getOutline()
                        ->setBorderStyle(Border::BORDER_THIN)
                        ->setColor(new Color('000000'));
                }

                $start++;
            }

            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A' . $awal, $no);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B' . $awal, $field->nama_barang);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('C' . $awal, $field->kode);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('E' . $awal, $field->estimasi);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('F' . $awal, $field->status_laundry);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('G' . $awal, $field->biaya);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('H' . $awal, $field->metode);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('I' . $awal, $field->waktu);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('J' . $awal, $field->nama_pemilik);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('K' . $awal, $field->alamat);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('L' . $awal, $field->no_hp);

            $spreadsheet->getActiveSheet()->mergeCells('A' . $awal . ':A' . ($awal + $total_row));
            $spreadsheet->getActiveSheet()->mergeCells('B' . $awal . ':B' . ($awal + $total_row));
            $spreadsheet->getActiveSheet()->mergeCells('C' . $awal . ':C' . ($awal + $total_row));
            $spreadsheet->getActiveSheet()->mergeCells('E' . $awal . ':E' . ($awal + $total_row));
            $spreadsheet->getActiveSheet()->mergeCells('F' . $awal . ':F' . ($awal + $total_row));
            $spreadsheet->getActiveSheet()->mergeCells('G' . $awal . ':G' . ($awal + $total_row));
            $spreadsheet->getActiveSheet()->mergeCells('H' . $awal . ':H' . ($awal + $total_row));
            $spreadsheet->getActiveSheet()->mergeCells('I' . $awal . ':I' . ($awal + $total_row));
            $spreadsheet->getActiveSheet()->mergeCells('J' . $awal . ':J' . ($awal + $total_row));
            $spreadsheet->getActiveSheet()->mergeCells('K' . $awal . ':K' . ($awal + $total_row));
            $spreadsheet->getActiveSheet()->mergeCells('L' . $awal . ':L' . ($awal + $total_row));

            for ($i = 0; $i < count($kolom); $i++) {
                $row = $kolom[$i] . $awal;

                $spreadsheet
                    ->getActiveSheet()
                    ->getStyle($row)
                    ->getBorders()
                    ->getOutline()
                    ->setBorderStyle(Border::BORDER_THIN)
                    ->setColor(new Color('000000'));
            }

            $awal = $awal + ($total_row == 0 ? 1 : ($total_row + 1));
            $no++;
        }

        $spreadsheet->getActiveSheet(0)->getStyle('A5:L' . $awal)->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet(0)->getStyle('A5:L' . $awal)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet(0)->getStyle('A5:A' . $awal)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet(0)->getStyle('A1');

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data_laundry_rekap_harian_' . date('dMY') . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit();
    }

    public function cetak_bulanan($tahun)
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle('rekap bulanan');
        $spreadsheet->getProperties()->setCreator('bayibarkas')
            ->setLastModifiedBy('bayibarkas')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php');

        $spreadsheet
            ->getActiveSheet()
            ->getStyle('A5:D5')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('FFFA65');

        $spreadsheet->getActiveSheet(0)->setCellValue('A2', 'Data laundry bulanan - bayibarkas');

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A5', 'NO')->getStyle('A5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B5', 'BULAN')->getStyle('B5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C5', 'TOTAL TRANSAKSI')->getStyle('C5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('D5', 'TOTAL OMSET')->getStyle('D5')->getFont()->setBold(true);

        $spreadsheet->getActiveSheet(0)->getStyle('A5:D5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet(0)->getRowDimension('5')->setRowHeight(35);

        $spreadsheet->getActiveSheet(0)->getColumnDimension('A')->setWidth(10);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('B')->setWidth(35);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('C')->setWidth(25);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('D')->setWidth(25);

        $kolom = ['A', 'B', 'C', 'D'];

        for ($i = 0; $i < count($kolom); $i++) {
            $row = $kolom[$i] . 5;

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
        }

        $no = 1;
        $awal = 6;

        $waktu_laundry = "(select f.waktu from laundry_has_status f where f.id_data_laundry = a.id and f.is_active = '1' order by f.id asc limit 1)";
        $this->db->select("sum(a.biaya) total_omset, count(id) total_transaksi, DATE_FORMAT($waktu_laundry,'%M %Y') waktu");
        $this->db->where('a.is_active', '1');
        $this->db->where("YEAR($waktu_laundry) = $tahun", NULL, FALSE);
        $this->db->group_by("MONTH($waktu_laundry)");
        $this->db->order_by($waktu_laundry, 'asc');
        $data = $this->db->get('data_laundry a')->result();

        foreach ($data as $field) {

            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A' . $awal, $no);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B' . $awal, $field->waktu);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('C' . $awal, $field->total_transaksi);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('D' . $awal, $field->total_omset);

            for ($i = 0; $i < count($kolom); $i++) {
                $row = $kolom[$i] . $awal;

                $spreadsheet
                    ->getActiveSheet()
                    ->getStyle($row)
                    ->getBorders()
                    ->getOutline()
                    ->setBorderStyle(Border::BORDER_THIN)
                    ->setColor(new Color('000000'));
            }

            $no++;
            $awal++;
        }

        $spreadsheet->getActiveSheet(0)->getStyle('A5:L' . $awal)->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet(0)->getStyle('A5:L' . $awal)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet(0)->getStyle('A5:A' . $awal)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet(0)->getStyle('A1');

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data_laundry_rekap_bulanan_' . date('dMY') . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit();
    }

    public function cetak_tahunan()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle('rekap tahunan');
        $spreadsheet->getProperties()->setCreator('bayibarkas')
            ->setLastModifiedBy('bayibarkas')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php');

        $spreadsheet
            ->getActiveSheet()
            ->getStyle('A5:D5')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('FFFA65');

        $spreadsheet->getActiveSheet(0)->setCellValue('A2', 'Data laundry tahunan - bayibarkas');

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A5', 'NO')->getStyle('A5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B5', 'TAHUN')->getStyle('B5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C5', 'TOTAL TRANSAKSI')->getStyle('C5')->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('D5', 'TOTAL OMSET')->getStyle('D5')->getFont()->setBold(true);

        $spreadsheet->getActiveSheet(0)->getStyle('A5:D5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet(0)->getRowDimension('5')->setRowHeight(35);

        $spreadsheet->getActiveSheet(0)->getColumnDimension('A')->setWidth(10);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('B')->setWidth(35);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('C')->setWidth(25);
        $spreadsheet->getActiveSheet(0)->getColumnDimension('D')->setWidth(25);

        $kolom = ['A', 'B', 'C', 'D'];

        for ($i = 0; $i < count($kolom); $i++) {
            $row = $kolom[$i] . 5;

            $spreadsheet
                ->getActiveSheet()
                ->getStyle($row)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
        }

        $no = 1;
        $awal = 6;

        $waktu_laundry = "(select f.waktu from laundry_has_status f where f.id_data_laundry = a.id and f.is_active = '1' order by f.id asc limit 1)";
        $this->db->select("sum(a.biaya) total_omset, count(id) total_transaksi, DATE_FORMAT($waktu_laundry,'%Y') waktu");
        $this->db->where('a.is_active', '1');
        $this->db->group_by("YEAR($waktu_laundry)");
        $this->db->order_by($waktu_laundry, 'asc');
        $data = $this->db->get('data_laundry a')->result();

        foreach ($data as $field) {

            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A' . $awal, $no);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B' . $awal, $field->waktu);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('C' . $awal, $field->total_transaksi);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('D' . $awal, $field->total_omset);

            for ($i = 0; $i < count($kolom); $i++) {
                $row = $kolom[$i] . $awal;

                $spreadsheet
                    ->getActiveSheet()
                    ->getStyle($row)
                    ->getBorders()
                    ->getOutline()
                    ->setBorderStyle(Border::BORDER_THIN)
                    ->setColor(new Color('000000'));
            }

            $no++;
            $awal++;
        }

        $spreadsheet->getActiveSheet(0)->getStyle('A5:L' . $awal)->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet(0)->getStyle('A5:L' . $awal)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet(0)->getStyle('A5:A' . $awal)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet(0)->getStyle('A1');

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data_laundry_rekap_tahun_' . date('dMY') . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit();
    }
}

/* End of file ModelName.php */
