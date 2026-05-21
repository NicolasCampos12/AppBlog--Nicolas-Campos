
<?php
require_once '../../_conn/conect.php';

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Validação de Campos Obrigatórios
if (empty($post['name']) || empty($post['email']) || empty($post['pass']) || empty($post['pass_confirm'] || empty($post['telefone']))) {
    header('LOCATION: form.php?errornull=True'); 
    exit;
}

if ($post['pass'] !== $post['pass_confirm']) {
    header('LOCATION: form.php?errorhash=True'); 
    exit;
}
// Verificação se já existe o e-mail cadastrado no banco de dados
$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
$stmt->bindParam(':email', $post['email']);
$stmt->execute();
$emailCount = $stmt->fetchColumn();
if ($emailCount > 0) {
    header('LOCATION: form.php?erroremail=True'); 
    exit;
}

// Ternária, se existir o campo status, atribui 1, caso contrário, atribui 0
$post['status'] = isset($post['status']) ? 1 : 0;
// Remover o array de confirmação de senha para não ser inserido no banco
unset($post['pass_confirm']);


// Modo 2 - Insert Dinâmico 
$table = 'users';
$fields = [];
$placeholders = [];


$post['pass'] = md5($post['pass']);

foreach ($post as $key => $value) {
    $fields[] = $key;
    $placeholders[] = ':' . $key;
}

//Modificar o insert into para o novo campo telefone


$sql = "INSERT INTO " . $table. " (" . implode(", ", $fields) . ") VALUES (" . implode(", ", $placeholders) . ")";
$stmt = $pdo->prepare($sql);
foreach ($post as $key => $value) {
    $stmt->bindValue(':' . $key, $value);
}
$stmt->execute();
if ($stmt->rowCount()) {
    header('LOCATION: ../index.php?inserted=True'); 
    //header('LOCATION: form.php?inserted=True'); 
    exit;
} else {
    header('LOCATION: form.php?errorinsert=True'); 
    exit;
}


















	 