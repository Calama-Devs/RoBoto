<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use App\Libraries\OpenAIService;

class FaissLoader extends Controller
{
    protected $client;
    protected $baseUrl = 'http://localhost:8000'; // endereço do seu FAISS API
    protected $openai;

    public function __construct()
    {
        $this->client = Services::curlrequest();
        $this->openai = new OpenAIService();
    }

    // -------------------------
    // Gerar embedding e adicionar ao FAISS
    // -------------------------
    public function addDoc()
    {
        $texto = "As inscrições para o semestre 2025/1 deverão ser realizadas no portal acadêmico até 15/03/2025.";
        $metadata = [
            "tipo_doc" => "edital",
            "ano" => 2025,
            "semestre" => "2025/1"
        ];

        // 1. gerar embedding real
        $embedding = $this->openai->gerarEmbedding($texto);

        // 2. enviar ao FAISS
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
    // Gerar embedding e consultar no FAISS
    // -------------------------
    public function queryDoc()
    {
        $pergunta = "Quais documentos preciso para me inscrever?";

        // 1. gerar embedding da pergunta
        $embedding = $this->openai->gerarEmbedding($pergunta);

        // 2. consultar FAISS
        $response = $this->client->post($this->baseUrl . '/query', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'embedding' => $embedding,
                'top_k' => 3
            ]
        ]);

        return $this->response->setJSON(json_decode($response->getBody(), true));
    }
}
