<?php namespace App\Controllers;

use App\Models\ContatosModel;

class WebhookController extends BaseController {
    public function index() {
        //
    }

    public function response()
    {
        $contatoModel = new ContatosModel();

        $dados = $this->request->getJSON(true);

        if($dados['event'] === 'messages.upsert')
        {
            $contato = explode('@', $dados['data']['key']['remoteJid'])[0]; //Número do contato
            $mensagem = $dados['data']['message']['conversation']; //Mensagem recebida

            echo "Contato: " . $contato;
            echo "Mensagem: " . $mensagem;

            $dadosSalvar = ['telefone' => $contato];

            if ($contatoModel->insert($dadosSalvar)) {
                log_message('info', 'Contato salvo: ' . $contato);
                echo 'Contato salvo com sucesso!';
            } else {
                echo 'Erro ao salvar contato';
            }
        }

        //Teste
        //log_message('error', 'Webhook recebido: ' . json_encode($dados));
    }
}

