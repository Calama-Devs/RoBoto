<?php namespace App\Controllers;

class WebhookController extends BaseController {
    public function index() {
        //
    }

    public function response()
    {
        $dados = $this->request->getJSON(true);

        //Teste
        log_message('debug', 'Webhook recebido: ' . json_encode($dados));
    }
}