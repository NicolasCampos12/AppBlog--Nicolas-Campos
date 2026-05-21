<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: index.php?error=true');
    exit();
}
$raiz = dirname(__DIR__, 2);
include_once $raiz . '/_conn/conect.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Painel</title>
    <link rel="stylesheet" href="<?= $base_url ?>public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>public/admin/css/admin.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">MinhaLogo</a>
            <button class="btn btn-link text-white me-3" id="sidebarToggle"><i class="fas fa-bars"></i></button>
            <div class="ms-auto">
                <span class="text-white me-3">Olá, <?= $_SESSION['email'] ?></span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Sair</a>
            </div>
        </div>
    </nav>

    <div class="wrapper">
        <nav id="sidebar" class="bg-light border-end">
            <div class="p-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base_url ?>admin/home.php">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-between align-items-center"
                            data-bs-toggle="collapse"
                            href="#menuUsuarios"
                            role="button"
                            aria-expanded="false">
                            <span><i class="fas fa-users me-2"></i> Usuários</span>
                            <i class="fas fa-chevron-down small"></i>
                        </a>
                        <div class="collapse" id="menuUsuarios">
                            <ul class="nav flex-column ms-3 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link py-1" href="<?= $base_url ?>admin/usuarios/form.php">
                                        <i class="fas fa-user-plus me-2"></i> Novo Usuário
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-1" href="<?= $base_url ?>admin/usuarios/listar.php">
                                        <i class="fas fa-list me-2"></i> Listar Usuários
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-1" href="<?= $base_url ?>admin/usuarios/index.php">
                                        <i class="fas fa-list me-2"></i> Index
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-cog me-2"></i> Configurações</a>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="content-wrapper p-4">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>