<?php namespace App\Controllers;

use App\Models\ContatosModel;
use App\Models\MensagensModel;

class WebhookController extends BaseController {
    public function index() {
        //
    }

    public function response()
    {
        $contatoModel = new ContatosModel();
        $mensagemModel = new MensagensModel();

        $dados = $this->request->getJSON(true);

        if($dados['event'] === 'messages.upsert')
        {
            $contato = explode('@', $dados['data']['key']['remoteJid'])[0]; //Número do contato
            $mensagem = $dados['data']['message']['conversation']; //Mensagem recebida

            echo "Contato: " . $contato;
            echo "Mensagem: " . $mensagem;

            if ($contatoModel->create($contato) && $mensagemModel->create($mensagem)) {
                echo 'Contato salvo com sucesso!';
            } else {
                echo 'Erro ao salvar contato';
            }
        }
    }
}

