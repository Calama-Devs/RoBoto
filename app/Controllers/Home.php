<?php

namespace App\Controllers;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use CodeIgniter\Exceptions\ReferenciaException;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Home extends BaseController
{
    public function index(): string
    {
        return view('dashboard');
    }

    public function viewVerificaContato(): string
    {
        return view('verify-phone');
    }

    public function verifyPhone()
    {   
        $phoneSent = (string)$this->request->getPost('contato');
            \Kint\Kint::$mode_default = \Kint\Kint::MODE_PLAIN;

            // return view('verifica-contato');
        //1- pegar o número
        //2- renderizar a planilha do excel
        //3- buscar na coluna telefone um número q bata com o contato
        //4- buscar esse a matrícula vinculada a esse número

        $spreadsheetStudents = WRITEPATH.'data/alunos_teste.xlsx';

        // $row = $this->findByPhone($phoneSent);

        $spreadsheet = IOFactory::load($spreadsheetStudents);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        if (empty($rows)) return [];

        $header = array_shift($rows);
        
        $map = $this->mapHeader($header);
        // dd($map);

        $lookupKey = $this->digitsOnly($phoneSent);
        $matches = [];

        foreach ($rows as $r) {
            $name = trim((string)($r[$map['name']] ?? ''));
            $studentIdNumber = trim((string)($r[$map['student_id_number']] ?? ''));
            $foneRaw = trim((string)($r[$map['phone']] ?? ''));
            $situation = trim((string)($r[$map['situation']] ?? ''));

            if ($studentIdNumber === '' && $foneRaw === '') continue;

            $foneKey = $this->digitsOnly($foneRaw);
            if ($foneKey !== '' && $foneKey === $lookupKey) {
                $matches[] = [
                    'name' => $name,
                    'student_id_number' => $studentIdNumber,
                    'phone' => $foneRaw,
                    'situation' => $situation,
                ];
            }
        }

        $studentId = [];
        foreach($matches as $m) {
            if($m['situation'] == 1) $studentId = $m['student_id_number']; 
        }

        dd($studentId);
    }

    public function findByPhone($phoneClear) {
        $phone = $this->digitsOnly($phoneClear);

        if($phone == '') {
            return null;
        }

        return $phone;
    }

    public function digitsOnly(string $phoneStripped): string {
        $clearPhone = preg_replace('/\D+/', '', $phoneStripped) ?? '';

         if (strlen($clearPhone) >= 12 && substr($clearPhone, 0, 2) === '55') {
            $clearPhone = substr($clearPhone, 2);
         } 
        
        return $clearPhone;
    }

    public function mapHeader($header) {

        $headerClear = function ($nameCol) {
            $nameCol = mb_strtolower(trim((string)$nameCol));
            $nameCol = str_replace(['á','à','ã','â','é','ê','í','ó','ô','õ','ú','ç'], ['a','a','a','a','e','e','i','o','o','o','u','c'], $nameCol);
            return preg_replace('/[^a-z0-9]/', '', $nameCol);
        };

        $map = [];

        foreach ($header as $col => $label) {
            $key = $headerClear($label);

            if ($key === 'nome') $map['name'] = $col;
            if (in_array($key, ['matricula'])) $map['student_id_number'] = $col;
            if (in_array($key, ['telefone','fone','celular'])) $map['phone'] = $col;
            if (in_array($key, ['situação','situacao','situacão'])) $map['situation'] = $col;
        }

        return $map;
    }

}
