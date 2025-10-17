<?php

namespace App\Models;

use CodeIgniter\Model;

class MensagensModel extends Model
{
    protected $table = 'mensagens';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['texto', 'timestamp'];
    protected bool $allowEmptyInserts = false;

    //Dates
    protected $useTimestamps = false;

    //Validation
//    protected $validationRules = [
//      'contato_id'   => 'numeric|max_length[15]',
//      'texto'        => 'required|string',
//      'remetente'    => 'max_length[100]',
//      'score_filtro' => 'numeric',
//      'sessao_id'    => 'numeric|max_length[11]',
//    ];
//
//    protected $validationMessages = [
//        'contato_id'   => [
//            'numeric'    => 'O contato deve ser numérico.',
//            'max_length' => 'O contato deve ter no máximo 15 caracteres',
//        ],
//        'texto'        => [
//            'required' => 'O campo texto é obrigatório',
//            'string'   => 'O campo texto deve ser texto',
//        ],
//        'remetente'    => [
//            'max_length' => 'O remetente deve ter no máximo 100 caracteres',
//        ],
//        'score_filtro' => [
//            'numeric' => 'O campo score_filtro deve ser numérico'
//        ],
//        'sessao_id'    => [
//            'numeric'    => 'O campo sessao_id deve ser numérico',
//            'max_length' => 'O campo sessao_id deve ter no máximo 11 caracteres.'
//        ],
//    ];

    public function create(string $mensagem, string $timestamp) {
        $dados = [
            'texto' => $mensagem,
            'contato_id' => 1,
            'timestamp' => date('Y-m-d H:i:s', $timestamp),
        ];

        return $this->insert($dados);
    }
}