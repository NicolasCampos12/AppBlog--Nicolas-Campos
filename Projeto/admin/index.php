<?php
require_once '../_conn/conect.php';
$error = isset($_GET['error']) ? true : false;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - Login</title>

    <link rel="stylesheet" href="<?= $base_url; ?>public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body {background-color: #f8f9fa; height: 100vh;display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;}
        .login-card { width: 100%; max-width: 420px; border: none; border-radius: 12px; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1); background: #fff;}
        .input-group-text { background-color: #f8f9fa; border-right: none; color: #6c757d;}
        .form-control { border-left: none; padding: 12px; }
        .form-control:focus { box-shadow: none; border-color: #dee2e6;}
        .btn-primary { padding: 12px; font-weight: 600; border-radius: 8px; transition: all 0.3s;}
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);}
        .brand-icon {font-size: 3rem;color: #0d6efd;}
    </style>
</head>

<body>

    <div class="container p-3">
        <div class="card login-card mx-auto">
            <div class="card-body p-4 p-md-5">
                
                <div class="text-center mb-4">
                    <div class="brand-icon mb-2">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <h3 class="fw-bold">Painel Admin</h3>
                    <p class="text-muted small">Insira seus dados para entrar</p>
                </div>

                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>Usuário ou senha inválidos!
                    </div>

                <?php endif; ?>

                <?php if (isset($_GET['inserted'])): ?>
                    <div class="alert alert-success" role="alert">Usuário cadastrado com sucesso!</div>
                <?php endif; ?>

                <form action="logar.php" method="POST">

          
                    
                    <div class="mb-3">
                        <label for="username" class="form-label small fw-bold text-secondary">E-mail</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="username" name="email" placeholder="E-mail" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="pass" class="form-label small fw-bold text-secondary">Senha</label>
                        <div class="input-group">
                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                <i class="bi bi-eye"></i>
                            </span>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Senha " required>

                            <!-- <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Senha" required> -->
                        </div>
                    </div>



                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Entrar no Sistema
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="card-footer bg-light border-0 py-3 text-center">
                <small class="text-muted">Esqueceu o acesso? Contate o suporte.</small>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // toggle senha (corrige id para "pass")
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#pass');
            if (togglePassword && password) {
                const icon = togglePassword.querySelector('i');
                togglePassword.addEventListener('click', function () {
                    const isPassword = password.getAttribute('type') === 'password';
                    password.setAttribute('type', isPassword ? 'text' : 'password');
                    icon.classList.toggle('bi-eye');
                    icon.classList.toggle('bi-eye-slash');
                });
            }

            // // recuperação de senha via AJAX (recuperar_senha.php deve retornar JSON { success: bool, message: string })
            // const forgotForm = document.querySelector('#forgotForm');
            // const forgotAlert = document.querySelector('#forgotAlert');

            // if (forgotForm) {
            //     forgotForm.addEventListener('submit', async function (e) {
            //         e.preventDefault();
            //         forgotAlert.innerHTML = '';
            //         const submitBtn = forgotForm.querySelector('button[type="submit"]');
            //         const originalBtnText = submitBtn.innerHTML;
            //         submitBtn.disabled = true;
            //         submitBtn.innerHTML = 'Enviando...';

            //         const formData = new FormData(forgotForm);

            //         try {
            //             const resp = await fetch('recuperar_senha.php', {
            //                 method: 'POST',
            //                 body: formData,
            //             });

            //             if (!resp.ok) throw new Error('Erro na requisição');

            //             const data = await resp.json();
            //             const type = data.success ? 'success' : 'danger';
            //             forgotAlert.innerHTML = `<div class="alert alert-${type}" role="alert">${data.message}</div>`;

            //             if (data.success) {
            //                 forgotForm.reset();
            //                 // fecha modal após 1.5s
            //                 setTimeout(() => {
            //                     const modalEl = document.getElementById('forgotModal');
            //                     const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            //                     modal.hide();
            //                 }, 1500);
            //             }
            //         } catch (err) {
            //             forgotAlert.innerHTML = `<div class="alert alert-danger" role="alert">Erro ao enviar. Tente novamente.</div>`;
            //             console.error(err);
            //         } finally {
            //             submitBtn.disabled = false;
            //             submitBtn.innerHTML = originalBtnText;
            //         }
            //     });
            // }
        });
    </script>

    <script src="<?= $base_url; ?>public/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>