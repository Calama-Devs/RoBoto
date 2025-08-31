<?php

namespace App\Libraries;

class EvolutionAPI
{
    public $WPP_DEVICE_TOKEN = 'D41AE93B116A-4292-A9E5-90B1A474F3E5';
    public $API_KEY = 'HASHZINHOCOMPALAVRAALEATORIA';

    public $client;

    public function __construct()
    {
        $this->client = \Config\Services::curlrequest();        
    }

    public function sendMessage($number,$message)
    {
        if(strlen($number) > 9) //validar melhor os números
        {
            try 
            {
                $this->client->request('POST', 'http://103.14.27.53:8090/message/sendText/ChatBotIF', [
                    'headers' => [
                        'Content-Type'  => 'application/json',
                        'apikey'	=> $this->API_KEY
                    ],
                    'json' => [
                        'number'	=> "55" . $number, //ajustar para poder aceitar numeros internacionais também
                        'text' => $message
                    ]
                ]); 
            }
            catch(\Exception  $e) {
                //trabalhar observabilidade aqui
            }                   
        }
    }   

    public function findMessages($where)
    {        
        try 
        {
            $response = $this->client->request('POST', 'http://103.14.27.53:8090/chat/findChats/ChatBotIF', [
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'apikey'	=> $this->API_KEY
                ]
            ]);

            echo "<pre>";
            print_r(json_decode($response->getBody(),JSON_PRETTY_PRINT));
            echo "</pre>";
        }
        catch(\Exception  $e) {
            exit($e->getMessage());
        }        
    }
}
