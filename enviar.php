<?php
header('Content-Type: text/html; charset=utf-8');
ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação dos dados
    $nome = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $empresa = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
    $whatsapp = filter_input(INPUT_POST, 'whatsapp', FILTER_SANITIZE_STRING);
    $horario = filter_input(INPUT_POST, 'contact_time', FILTER_SANITIZE_STRING);
    
    // Verifica se todos os campos obrigatórios foram preenchidos
    if (empty($nome) || empty($empresa) || empty($whatsapp) || empty($horario)) {
        header("Location: erro.html");
        exit;
    }

    // Configurações do e-mail
    $to = "contato@solvenza.com.br";
    $subject = "Novo contato do site - " . $empresa;
    
    // Corpo do e-mail em HTML
    $message = "
    <html>
    <head>
        <title>Novo contato do site</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; }
            h3 { color: #333; }
            p { margin: 10px 0; }
            strong { color: #0066cc; }
        </style>
    </head>
    <body>
        <h3>Novo contato recebido:</h3>
        <p><strong>Nome:</strong> $nome</p>
        <p><strong>Empresa:</strong> $empresa</p>
        <p><strong>WhatsApp:</strong> $whatsapp</p>
        <p><strong>Horário preferido:</strong> $horario</p>
    </body>
    </html>
    ";
    
   // Cabeçalhos do e-mail
// Corrigir cabeçalhos
$headers = "From: Alessandra Solvenza <contato@solvenza.com.br>\r\n";
$headers .= "Reply-To: $nome <$email>\r\n"; // Adicione um campo email no formulário
$headers .= "Return-Path: contato@solvenza.com.br\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Envia o e-mail
    if (mail($to, $subject, $message, $headers)) {
        // Redireciona para página de agradecimento
        header("Location: obrigado.html");
        exit;
    } else {
        // Log do erro (em produção, você deveria registrar em um arquivo de log)
        error_log("Falha ao enviar e-mail para: $to");
        header("Location: erro.html");
        exit;
    }
} else {
    // Se alguém tentar acessar diretamente o arquivo sem enviar o formulário
    header("Location: index.html");
    exit;
}
?>