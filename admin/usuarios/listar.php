<?php 
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}
require_once '../../_conn/conect.php';


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Lista de Usuários</title>

    <link rel="stylesheet" href="<?= $base_url; ?>public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Roboto, sans-serif; }

        /* Sidebar (Mantendo seu padrão) */
        #sidebar {
            width: 260px; height: 100vh; position: fixed; background: #fff;
            border-right: 1px solid rgba(0,0,0,0.05); transition: all 0.3s; z-index: 1000;
        }
        .sidebar-header { padding: 30px; text-align: center; }
        .nav-link {
            color: #6c757d; padding: 12px 25px; margin: 5px 15px; border-radius: 10px;
            display: flex; align-items: center; font-weight: 500; transition: 0.3s; text-decoration: none;
        }
        .nav-link:hover, .nav-link.active {
            background-color: #0d6efd; color: #fff !important; box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
        }
        .nav-link i { margin-right: 12px; font-size: 1.1rem; }
        
        .submenu-list { list-style: none; padding-left: 20px; margin-bottom: 10px; }
        .submenu-link {
            color: #6c757d; text-decoration: none; display: flex; align-items: center;
            padding: 8px 25px; font-size: 0.9rem; transition: 0.3s;
        }
        .submenu-link:hover { color: #0d6efd; }

        /* Área de Conteúdo */
        #main-content { margin-left: 260px; padding: 30px; }
        
        .top-nav {
            background: #fff; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            margin-bottom: 30px; padding: 15px 25px;
        }

        /* Estilização da Tabela seguindo o padrão Dashboard */
        .card-table {
            border: none; border-radius: 15px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            background: #fff; overflow: hidden;
        }
        .table thead { background-color: #f8f9fa; }
        .table thead th { 
            border: none; padding: 18px; font-size: 0.85rem; 
            text-transform: uppercase; color: #6c757d; letter-spacing: 0.5px;
        }
        .table tbody td { padding: 18px; border-color: #f4f7f6; }
        
        .user-avatar {
            width: 38px; height: 38px; background: #e9ecef;
            color: #0d6efd; display: flex; align-items: center;
            justify-content: center; border-radius: 10px; font-weight: bold;
        }

        .status-badge {
            padding: 6px 12px; border-radius: 8px; font-size: 0.75rem; font-weight: 600;
        }

        .btn-action {
            padding: 5px 10px; border-radius: 8px; transition: 0.2s;
        }

        @media (max-width: 768px) {
            #sidebar { margin-left: -260px; }
            #main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h4 class="fw-bold text-primary"><i class="bi bi-shield-lock-fill"></i> Admin</h4>
        </div>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="../home2.php" class="nav-link">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>
            

            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="collapse" href="#userSubmenu" role="button" aria-expanded="true">
                    <i class="bi bi-people-fill"></i> 
                    <span>Usuários</span>
                    <i class="bi bi-chevron-down ms-auto small"></i>
                </a>
                <div class="collapse show" id="userSubmenu">
                    <ul class="submenu-list">
                        <li><a href="form.php" class="submenu-link"><i class="bi bi-person-plus me-2"></i> Novo Usuário</a></li>
                        <li><a href="listar.php" class="submenu-link fw-bold text-primary"><i class="bi bi-list-ul me-2"></i> Lista de Usuários</a></li>
                        <li><a href="index.php" class="submenu-link"><i class="bi bi-list-ul me-2"></i> Index</a></li>

                    </ul>
                </div>
            </li>
                                      

            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-bag-check-fill"></i> Vendas</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-gear-fill"></i> Ajustes</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main id="main-content">
        
        <!-- Navbar Superior -->
        <div class="top-nav d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 fw-bold text-secondary">Gerenciar Usuários</h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb small mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Usuários</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3 small text-muted d-none d-md-block">Olá, <strong><?= $_SESSION['email']; ?></strong></span>
                <a href="logout.php" class="btn btn-outline-danger btn-sm px-3 border-0 fw-bold">
                    <i class="bi bi-power me-1"></i> Sair
                </a>
            </div>
        </div>

        <!-- Tabela de Usuários -->
        <div class="card card-table">
            <div class="p-4 d-flex justify-content-between align-items-center border-bottom">
                <h6 class="fw-bold mb-0">Todos os Usuários</h6>
                <a href="form.php" class="btn btn-primary btn-sm px-3 rounded-pill">
                    <i class="bi bi-plus-lg"></i> Adicionar
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                      <?php

                   $stmt = $pdo->query("SELECT id, name, email, status, image FROM users ORDER BY id ASC");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td> <img src='" .$row['image'] . "' alt='avatar'/></td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . ($row['status'] ? 'Ativo' : 'Inativo') . "</td>";
                        echo "<td><a href='form.php?id=" . $row['id'] . "' class='btn btn-sm btn-outline-primary'>Editar</a></td>";
                        echo "<td><a href='delete.php?id=" . $row['id'] . "' class='btn btn-sm btn-outline-danger'>Excluir</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="p-3 px-4 d-flex align-items-center justify-content-between bg-light border-top" style="border-radius: 0 0 15px 15px;">
    <div class="d-flex align-items-center">
        <!-- Um pequeno círculo indicador -->
        <div class="rounded-circle bg-primary me-2" style="width: 8px; height: 8px;"></div>
        <span class="text-muted fw-medium" style="font-size: 1rem; letter-spacing: 0.3px;">
            Total de registros: 
            <span class="text-dark fw-bold ms-1"><?= $stmt->rowCount(); ?></span>
        </span>
        </div>
    </div>
            
     
        </div>

    </main>

    <script src="<?= $base_url; ?>public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>