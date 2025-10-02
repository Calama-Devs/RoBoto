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
        return view('verifica-contato');
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
        $sheet  = $spreadsheet->getActiveSheet();
        $rows   = $sheet->toArray(null, true, true, true);

        if (empty($rows)) return [];

        $header = array_shift($rows);
        $map = $this->mapHeader($header);

        $idx = [];
        foreach ($rows as $r) {
            $nome      = trim((string)($r[$map['nome']] ?? ''));
            $matricula = trim((string)($r[$map['matricula']] ?? ''));
            $foneRaw   = trim((string)($r[$map['telefone']] ?? ''));

            if ($matricula === '' && $foneRaw === '') continue;

            $foneKey = $this->digitsOnly($foneRaw);
            if ($foneKey === '') continue;

            $idx[$foneKey] = [
                'nome'              => $nome,
                'matricula'         => $matricula,
                'telefone_original' => $foneRaw,
            ];
        }

        // dd($idx);
        return $idx;

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
        $headerClear = function ($s) {
            $s = mb_strtolower(trim((string)$s));
            $s = str_replace(['á','à','ã','â','é','ê','í','ó','ô','õ','ú','ç'], ['a','a','a','a','e','e','i','o','o','o','u','c'], $s);
            return preg_replace('/[^a-z0-9]/', '', $s);
        };

        $map = [];
        foreach ($header as $col => $label) {
            $key = $headerClear($label);
            if ($key === 'nome') $map['nome'] = $col;
            if (in_array($key, ['matricula','matrícula'])) $map['matricula'] = $col;
            if (in_array($key, ['telefone','fone','celular'])) $map['telefone'] = $col;
        }

        return $map;
    }

}
