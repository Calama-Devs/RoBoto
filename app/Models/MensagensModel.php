<?php

namespace App\Models;

use Cassandra\Date;

class MensagensModel extends Model
{
    protected $table = 'mensagens';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['contato_id', 'texto', 'remetente', 'score_filtro', 'sessao_id'];
    protected bool $allowEmptyInserts = true;

    //Dates
    protected $useTimestamps = true;

    //Validation
    protected $validationRules = [
      'contato_id'   => 'numeric|max_length[15]',
      'texto'        => 'required|string',
      'remetente'    => 'required|max_length(100)',
      'score_filtro' => 'numeric',
      'sessao_id'    => 'numeric|max_length(11)',
    ];

    protected $validationMessages = [
        'contato_id'   => [
            'numeric'    => 'O contato deve ser numérico.',
            'max_length' => 'O contato deve ter no máximo 15 caracteres',
        ],
        'texto'        => [
            'required' => 'O campo texto é obrigatório',
            'string'   => 'O campo texto deve ser texto',
        ],
        'remetente'    => [
            'required'   => 'O campo remetente é obrigatório',
            'max_length' => 'O remetente deve ter no máximo 100 caracteres',
        ],
        'score_filtro' => [
            'numeric' => 'O campo score_filtro deve ser numérico'
        ],
        'sessao_id'    => [
            'numeric' => 'O campo sessao_id deve ser numérico',
            'max_length' => 'O campo sessao_id deve ter no máximo 100 caracteres.'
        ],
    ];

    public function create(string $mensagem) {
        $dados = [
            'texto' => $mensagem,
            'remetente' => 'Ana Clara',
            'contato_id' => 1,
            'timestamp' => 2025-10-16,
        ];

        return $this->insert($dados);
    }
}