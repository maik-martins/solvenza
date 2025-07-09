<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST['name']);
    $empresa = htmlspecialchars($_POST['company']);
    $whatsapp = htmlspecialchars($_POST['whatsapp']);
    $horario = htmlspecialchars($_POST['contact_time']);

    $to = "Alessandra@solvenzabpofinanceiro.com.br";
    $subject = "Novo contato do site - " . $empresa;
    $message = "
        <h3>Novo contato recebido:</h3>
        <p><strong>Nome:</strong> $nome</p>
        <p><strong>Empresa:</strong> $empresa</p>
        <p><strong>WhatsApp:</strong> $whatsapp</p>
        <p><strong>Horário preferido:</strong> $horario</p>
    ";
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: $nome <contato@solvenzabpofinanceiro.com.br>\r\n";

    if (mail($to, $subject, $message, $headers)) {
        header("Location: obrigado.html"); // Página de agradecimento
    } else {
        echo "<script>alert('Erro ao enviar. Tente novamente.'); history.back();</script>";
    }
}
?>