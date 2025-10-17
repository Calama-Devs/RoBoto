<?php namespace App\Controllers;

use App\Models\ContatosModel;
use App\Models\MensagensModel;
use CodeIgniter\I18n\Time;

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
            $mensagem = $dados['data']['message']['conversation']; //Mensagem
            $timestamp = $dados['data']['messageTimestamp']; //TimeStamp

            echo "Contato: " . $contato;
            echo "Mensagem: " . $mensagem;


            if (!$contatoModel->create($contato)) {
                echo 'Erro ao salvar o contato.';
            } else {
                if (!$mensagemModel->create($mensagem, $timestamp)) {
                    echo 'O contato foi salvo, mas a mensagem falhou';
                } else {
                    echo 'Contato e mensagem salvos com sucesso!';
                }
            }
        }
    }
}

