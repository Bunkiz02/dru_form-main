<?php
// Include the PHPSpreadsheet classes
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create a new Excel spreadsheet
$spreadsheet = new Spreadsheet();

// Create a worksheet
$sheet = $spreadsheet->getActiveSheet();

// Add data to the worksheet
$sheet->setCellValue('A1', 'Name');
$sheet->setCellValue('B1', 'Age');
$sheet->setCellValue('A2', 'John');
$sheet->setCellValue('B2', 30);
$sheet->setCellValue('A3', 'Alice');
$sheet->setCellValue('B3', 25);

// Set the header for Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="example.xlsx"');
header('Cache-Control: max-age=0');

// Create an Xlsx writer and output the file to the browser
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
