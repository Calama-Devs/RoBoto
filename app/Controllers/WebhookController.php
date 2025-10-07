<?php namespace App\Controllers;

class WebhookController extends BaseController {
    public function index() {
        //
    }

    public function response()
    {
        $dados = $this->request->getJSON(true);

        echo 'Webhook recebido: ' . json_encode($dados);

        //Teste
        log_message('error', 'Webhook recebido: ' . json_encode($dados));
    }
}