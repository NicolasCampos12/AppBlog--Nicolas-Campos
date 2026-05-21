<?php 
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

require_once '../_conn/conect.php';
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>

    <link rel="stylesheet" href="<?= $base_url; ?>public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Segoe UI', Roboto, sans-serif;
        }

        /* Sidebar */
        #sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: #fff;
            border-right: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 30px;
            text-align: center;
        }

        .nav-link {
            color: #6c757d;
            padding: 12px 25px;
            margin: 5px 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            font-weight: 500;
            transition: 0.3s;
            cursor: pointer;
        }

        .nav-link:hover, .nav-link.active {
            background-color: #0d6efd;
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
        }

        .nav-link i {
            margin-right: 12px;
            font-size: 1.1rem;
        }

        /* Ajustes do Dropdown (Submenu) */
        .submenu-list {
            list-style: none;
            padding-left: 20px;
            margin-bottom: 10px;
        }

        .submenu-link {
            color: #6c757d;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 8px 25px;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .submenu-link:hover {
            color: #0d6efd;
        }

        .rotate-icon {
            transition: 0.3s;
        }

        .nav-link[aria-expanded="true"] .rotate-icon {
            transform: rotate(180deg);
        }

        /* Área de Conteúdo */
        #main-content {
            margin-left: 260px;
            padding: 30px;
        }

        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            background: #fff;
            transition: transform 0.3s;
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }

        .top-nav {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            margin-bottom: 30px;
            padding: 15px 25px;
        }

        .btn-logout {
            border-radius: 8px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            #sidebar { margin-left: -260px; }
            #main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

    <nav id="sidebar">
        <div class="sidebar-header">
            <h4 class="fw-bold text-primary"><i class="bi bi-shield-lock-fill"></i> Admin</h4>
        </div>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="home.php" class="nav-link active">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#userSubmenu" role="button" aria-expanded="false">
                    <i class="bi bi-people-fill"></i> 
                    <span>Usuários</span>
                    <i class="bi bi-chevron-down ms-auto small rotate-icon"></i>
                </a>
                <div class="collapse" id="userSubmenu">
                    <ul class="submenu-list">
                        <li>
                            <a href="./usuarios/form.php" class="submenu-link">
                                <i class="bi bi-person-plus me-2"></i> Novo Usuário
                            </a>
                        </li>
                        <li>
                            <a href="./usuarios/listar.php" class="submenu-link">
                                <i class="bi bi-list-ul me-2"></i> Lista de Usuários
                            </a>
                        </li>
                        <li>
                            <a href="./usuarios/index.php" class="submenu-link">
                                <i class="bi bi-list-ul me-2"></i> Index
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-bag-check-fill"></i> Vendas
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-gear-fill"></i> Ajustes
                </a>
            </li>
        </ul>
    </nav>

    <main id="main-content">
        
        <div class="top-nav d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-secondary">Visão Geral</h5>
            <div class="d-flex align-items-center">
                <span class="me-3 small text-muted">Olá, <strong><?= $_SESSION['email']; ?></strong></span>
                <a href="index.php" class="btn btn-outline-danger btn-sm btn-logout">
                    <i class="bi bi-power"></i> Sair
                </a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card card-custom p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-muted small fw-bold mb-1">TOTAL VENDAS</p>
                            <h3 class="fw-bold mb-0">R$ 12.450</h3>
                        </div>
                        <div class="text-primary fs-1">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-muted small fw-bold mb-1">NOVOS CLIENTES</p>
                            <h3 class="fw-bold mb-0">48</h3>
                        </div>
                        <div class="text-success fs-1">
                            <i class="bi bi-person-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-muted small fw-bold mb-1">MENSAGENS</p>
                            <h3 class="fw-bold mb-0">12</h3>
                        </div>
                        <div class="text-warning fs-1">
                            <i class="bi bi-envelope-paper"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-custom mt-5">
            <div class="card-body p-0">
                <div class="p-4 border-bottom">
                    <h6 class="fw-bold mb-0">Atividades Recentes</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 border-0">Cliente</th>
                                <th class="border-0">Serviço</th>
                                <th class="border-0">Status</th>
                                <th class="text-end pe-4 border-0">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary rounded-circle text-white d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                            <i class="bi bi-person small"></i>
                                        </div>
                                        <span>Marcos Oliveira</span>
                                    </div>
                                </td>
                                <td>Assinatura Premium</td>
                                <td><span class="badge rounded-pill bg-success-subtle text-success border border-success">Concluído</span></td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-light border"><i class="bi bi-eye"></i></button>
                                </td>
                            </tr>
                        </tbody>









                    </table>
                </div>
            </div>
        </div>

    </main>



    <script src="<?= $base_url; ?>public/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>