<?php namespace App\Controllers;

class WebhookController extends BaseController {
    public function index() {
        //
    }

    public function response()
    {
        $dados = $this->request->getJSON(true);

        echo "<pre>" . json_encode($dados) . "</pre>";

        //Teste
        log_message('debug', 'Webhook recebido: ' , ['dados' => json_encode($dados)]);
    }
}