<?php

namespace App\Controllers;

class Faiss extends BaseController
{
    public function add(): string
    {
        $client = \Config\Services::curlrequest();

        $response = $client->post('http://localhost:8000/add', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'embedding' => [0.12, -0.34, 0.56, 0.78], // exemplo
                'texto' => 'As aulas do semestre 2025/1 começam em 03/03/2025.',
                'metadata' => [
                    'tipo_doc' => 'edital',
                    'ano' => 2025,
                    'semestre' => '2025/1'
                ]
            ]
        ]);

        return $response->getBody();
    }

    public function query(): string
    {
        $client = \Config\Services::curlrequest();

        $response = $client->post('http://localhost:8000/query', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'embedding' => [0.12, -0.34, 0.56, 0.78], // mesma dimensão
                'top_k' => 3,
                'filters' => [
                    'tipo_doc' => 'edital'
                ]
            ]
        ]);

        return $response->getBody();
    }

    public function list($filter): string
    {
        $client = \Config\Services::curlrequest();
        $response = $client->get('http://localhost:8000/list');
        return $response->getBody();
    }

    public function delete($id): string
    {
        $client = \Config\Services::curlrequest();

        $response = $client->delete('http://localhost:8000/delete/$id');
        return $response->getBody();
    }

    







}
