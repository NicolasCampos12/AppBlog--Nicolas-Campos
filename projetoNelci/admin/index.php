<?php
require_once '../_conn/conect.php';
// Verifica se há erro na URL para exibir o alerta
$erro = isset($_GET['erro']) ? true : false;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso ao Sistema</title>
    <link rel="stylesheet" href="<?= $base_url ?>public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background: #f4f6f9; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card-login { width: 100%; max-width: 420px; border: none; border-radius: 12px; }
        .btn-login { padding: 12px; font-weight: 600; border-radius: 8px; }
        .form-floating > .form-control:focus ~ label { color: #007bff; }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center">
        <div class="card card-login shadow-lg">
            <div class="card-body p-5">
                
                <div class="text-center mb-4">
                    <i class="bi bi-shield-lock-fill text-secondary" style="font-size: 2rem;"></i>
                    <h2 class="fw-bold mt-2">Painel Admin</h2>
                    <p class="text-muted small">Insira suas credenciais abaixo</p>
                </div>

                <?php if ($erro): ?>
                <div class="alert alert-danger border-0 d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <div>Acesso negado. Tente novamente.</div>
                </div>
                <?php endif; ?>

                <form action="logar.php" method="POST">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" required>
                        <label for="email"><i class="bi bi-envelope me-2"></i>E-mail</label>
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

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label small text-muted" for="remember">Lembrar-me</label>
                        </div>
                        <a href="recuperar.php" class="text-decoration-none small fw-medium">Esqueceu a senha?</a>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-login shadow-sm">
                        Acessar Sistema <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </form>

            </div>
            <div class="card-footer bg-white border-0 text-center pb-4">
                <span class="text-muted small">&copy; <?= date('Y') ?> Sua Empresa</span>
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

</body>
</html>


