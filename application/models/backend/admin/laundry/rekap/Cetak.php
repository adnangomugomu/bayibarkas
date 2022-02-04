<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class Cetak extends CI_Model
{

    public function cetak_harian($bulan,$tahun)
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


        $spreadsheet->getActiveSheet(0)->getStyle('A5:L' . $awal)->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet(0)->getStyle('A5:L' . $awal)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $spreadsheet->getActiveSheet(0)->getStyle('A5:A' . $awal)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet(0)->getStyle('E5:E' . $awal)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

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
    }
}

/* End of file ModelName.php */
