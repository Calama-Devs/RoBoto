<?php

namespace App\Models;

use CodeIgniter\Model;

class ContatosModel extends Model
{
    protected $table = 'contatos';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['telefone', 'matricula'];

    //Dates
    protected $useTimestamps = false;

    //Validation
    protected $validationRules = [
        'telefone' => 'required|string|max_length[15]|is_unique[contatos.telefone,telefone,{id}]',
        'matricula' => 'string|max_length[15]|is_unique[contatos.matricula,matricula,{id}]',
    ];

    protected $validationMessages = [
        'telefone' => [
            'required'   => 'O telefone é obrigatório.',
            'string'     => 'O telefone deve ser string.',
            'max_length' => 'O telefone deve ter no máximo 15 caracteres',
            'is_unique'  => 'Este telefone já existe.',
        ],
        'matricula' => [
            'string'     => 'A matrícula deve ser uma string.',
            'max_length' => 'A matrícula deve ter no máximo 15 caracteres',
            'is_unique'  => 'Este aluno já existe.',
        ],
    ];

    public function create(string $contato) {
        $dados = [
            'telefone' => $contato,
            'matricula' => '12345656'
        ];

        return $this->insert($dados);
    }
}