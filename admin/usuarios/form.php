
<?php include_once '../_inc/_header.php'; ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Novo Usuário</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb small mb-0">
                    <li class="breadcrumb-item"><a href="../home.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php">Usuários</a></li>
                    <li class="breadcrumb-item active">Cadastro</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <a href="index.php" class="btn btn-outline-secondary px-3">
                <i class="fas fa-times me-2"></i>Cancelar
            </a>
            <button type="submit" form="formCadastro" class="btn btn-primary px-4">
                <i class="fas fa-check me-2"></i>Salvar Registro
            </button>
        </div>
    </div>



    <div class="card card-full">
        <div class="card-header bg-white py-3">
            <h6 class="fw-bold mb-0 text-dark">Cadastro</h6>
        </div>
        <div class="card-body p-4">
            <form action="insert.php" method="POST" id="formCadastro">

                <div class="row g-4 mb-4">

                <?php if (isset($_GET['errornull'])): ?>
                    <div class="alert alert-danger" role="alert">Preencha todos os campos obrigatórios!</div>
                <?php endif; ?>

                <?php if (isset($_GET['erroremail'])): ?>
                    <div class="alert alert-danger" role="alert">O e-mail informado já está cadastrado!</div>
                <?php endif; ?>

                

                

                <?php if (isset($_GET['errorpass'])): ?>
                    <div class="alert alert-danger" role="alert">As senhas não coincidem!</div>
                <?php endif; ?>

  


                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Nome Completo</label>
                        <input type="text" name="name" class="form-control form-control-flat" placeholder="Digite o nome" >
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">E-mail Principal</label>
                        <input type="email" name="email" class="form-control form-control-flat" placeholder="exemplo@blog.com" >
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Telefone</label>
                        <input type="tel" name="telefone" class="form-control form-control-flat" placeholder="+xx(xx)xxxx-xxxx"  pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" >
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Nível de Permissão</label>

                        <select name="id_level_users" class="form-select form-control-flat">
                            <?php
                            // Select de dados da tabela level_users
                            $stmt = $pdo->prepare("Select *from level_users");
                            $stmt->execute();
                            foreach($stmt as $row) {
                                echo '<option value="'.$row['id'].'">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>

                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Senha de Acesso</label>
                        <input type="password" name="pass" class="form-control form-control-flat" placeholder="••••••••" >
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Confirmar Senha</label>
                        <input type="password" name="pass_confirm" class="form-control form-control-flat" placeholder="••••••••" >
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Status da Conta</label>
                        <div class="d-flex align-items-center h-100 mt-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="statusSwitch" name="status" checked>
                                <label class="form-check-label ms-2" for="statusSwitch">Usuário Ativo</label>
                            </div>
                        </div>
                    </div>
                </div>               

            </form>
        </div>
        <div class="card-footer bg-light py-3 d-flex justify-content-end gap-2">
            <span class="text-muted small align-self-center me-auto ms-2">Campos marcados com * são obrigatórios</span>
            <button type="submit" form="formCadastro" class="btn btn-primary px-5 shadow-sm">
                Salvar Novo Usuário
            </button>
        </div>
    </div>
</div>

<?php include_once '../_inc/_footer.php'; ?>
