<?php

namespace App\Libraries;

use OpenAI;

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $this->client = OpenAI::client(getenv('OPENAI_API_KEY'));
    }

    /**
     * Gera embedding real a partir de um texto
     */
    public function gerarEmbedding(string $texto): array
    {
        $response = $this->client->embeddings()->create([
            'model' => 'text-embedding-3-large',
            'input' => $texto
        ]);

        return $response['data'][0]['embedding'];
    }
}
