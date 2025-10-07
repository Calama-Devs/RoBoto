<?php namespace App\Controllers;

class WebhookController extends BaseController {
    public function index() {
        //
    }

    public function response()
    {
        $dados = $this->request->getJSON(true);

        if($dados['event'] === 'messages.upsert')
        {
            $contato = explode('@', $dados['data']['key']['remoteJid'])[0]; //Número do contato
            $mensagem = $dados['data']['message']['conversation']; //Mensagem recebida

            echo "Contato: " . $contato . "\n";
            echo "Mensagem: " . $mensagem . "\n";        
        }

        //Teste
        //log_message('error', 'Webhook recebido: ' . json_encode($dados));
    }
}