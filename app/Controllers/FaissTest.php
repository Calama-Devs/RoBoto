<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use App\Libraries\OpenAIService;

class FaissMetaTest extends Controller
{
    protected $client;
    protected $baseUrl = 'http://localhost:8000'; // altere se rodar remoto
    protected $openai;

    public function __construct()
    {
        $this->client = Services::curlrequest();
        $this->openai = new OpenAIService();
    }

    // -------------------------
    // Adicionar com metadados customizados
    // -------------------------
    public function add()
    {
        $texto = "As inscrições do curso de Engenharia começam em 05/03/2025 e vão até 15/03/2025.";
        $metadata = [
            "tipo_doc" => "edital",
            "ano" => 2025,
            "semestre" => "2025/1",
            "curso" => "Engenharia",
            "responsavel" => "Coordenação de Graduação"
        ];

        // gerar embedding real
        $embedding = $this->openai->gerarEmbedding($texto);

        // enviar para API FAISS
        $response = $this->client->post($this->baseUrl . '/add', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'embedding' => $embedding,
                'texto' => $texto,
                'metadata' => $metadata
            ]
        ]);

        return $this->response->setJSON(json_decode($response->getBody(), true));
    }

    // -------------------------
    // Consultar filtrando por metadata
    // -------------------------
    public function query()
    {
        $pergunta = "Quais são as datas de inscrição?";
        $embedding = $this->openai->gerarEmbedding($pergunta);

        $response = $this->client->post($this->baseUrl . '/query', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'embedding' => $embedding,
                'top_k' => 5,
                'filters' => [
                    "tipo_doc" => "edital",
                    "curso" => "Engenharia"  // filtro aplicado
                ]
            ]
        ]);

        return $this->response->setJSON(json_decode($response->getBody(), true));
    }
}
