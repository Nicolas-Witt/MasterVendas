<?php
header("Content-Type: application/json");

$orderId = $_POST['orderId'];
$buyerName = $_POST['buyerName'];
$buyerEmail = $_POST['buyerEmail'];
$notes = $_POST['notes'];
$cart = json_decode($_POST['cart'], true);

// salvar arquivo
if (isset($_FILES['receipt'])) {
    $uploadDir = __DIR__ . "/uploads/";
    if (!is_dir($uploadDir)) mkdir($uploadDir);

    $fileName = basename($_FILES["receipt"]["name"]);
    $targetPath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES["receipt"]["tmp_name"], $targetPath)) {
        echo json_encode([
            "success" => true,
            "message" => "Comprovante recebido!",
            "pedido" => $orderId
        ]);
        exit;
    }
}

http_response_code(400);
echo json_encode(["success" => false, "message" => "Falha no upload"]);
