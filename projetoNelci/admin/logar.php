<?php
session_start();
// Essa validação é quando acessa a url diretamente: localhost/app-login/logar.php
if (empty($_POST)) {
    echo "Acesso Restrito";
    die();
}
include_once '../_conn/conect.php';
$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
// echo '<pre>';
// var_dump($post);
// echo '</pre>';

// echo $post['email'] . '<br>';
// echo $post['pass'] . '<br>';

if (isset($post['email']) && isset($post['pass'])) { // isset -> Verifica se a variável existe
    // Tratamento do login e senha trim (remove espaços ante e depois), strtolower(converte para minúsculo)
    $post['email'] = trim(strtolower($post['email']));
    
      $post['pass'] = md5($post['pass']);


    if (empty($post['email']) || empty($post['pass'])) { // empty -> Verifica se a variável está vazia
        echo 'Preencha todos os campos!';
    } else {
        try {
            // Verificação com o Banco de Dados
            $sth = $pdo->prepare('SELECT * FROM users WHERE email = :email AND pass = :pass');
            $sth->bindParam(':email', $post['email']);
            $sth->bindParam(':pass', $post['pass']);
            $sth->execute();
            if ($sth->rowCount() > 0) {
                $_SESSION['email'] = $post['email'];
                header('Location: home.php');
            } else {
                if (isset($_SESSION['email'])) {
                    unset($_SESSION['email']);
                }
                echo "Usuário ou senha inválidos!";
            }
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }
}
