document.addEventListener('DOMContentLoaded', function () {
    console.log("✅ EasyBudget.js carregado!");

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // --------- CONTROLE DE MODAIS ---------
    const loginBtn = document.getElementById('loginBtn');
    const registerBtn = document.getElementById('registerBtn');
    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal');
    const closeButtons = document.querySelectorAll('.close');
    const showRegister = document.getElementById('showRegister');
    const showLogin = document.getElementById('showLogin');

    function showModal(modal) { if (modal) modal.style.display = 'block'; }
    function closeModal(modal) { if (modal) modal.style.display = 'none'; }

    if (loginBtn) loginBtn.addEventListener('click', () => showModal(loginModal));
    if (registerBtn) registerBtn.addEventListener('click', () => showModal(registerModal));

    closeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = btn.closest('.modal');
            closeModal(modal);
        });
    });

    if (showRegister) {
        showRegister.addEventListener('click', e => {
            e.preventDefault();
            closeModal(loginModal);
            showModal(registerModal);
        });
    }

    if (showLogin) {
        showLogin.addEventListener('click', e => {
            e.preventDefault();
            closeModal(registerModal);
            showModal(loginModal);
        });
    }

    window.addEventListener('click', e => {
        if (e.target === loginModal) closeModal(loginModal);
        if (e.target === registerModal) closeModal(registerModal);
    });

    // --------- FUNÇÕES AUXILIARES ---------
    function toFormData(data) {
        return new URLSearchParams(data).toString();
    }

    // --------- CADASTRO ---------
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const name = document.getElementById('registerName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const password_confirmation = document.getElementById('registerConfirmPassword').value;

            try {
                const response = await fetch('/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: toFormData({ name, email, password, password_confirmation })
                });

                if (response.ok) {
                    alert('✅ Cadastro realizado com sucesso!');
                    window.location.href = '/dashboard';
                } else {
                    const errorData = await response.json();
                    alert('❌ Erro no cadastro: ' + (errorData.message || JSON.stringify(errorData.errors)));
                }
            } catch (error) {
                console.error(error);
                alert("❌ Erro inesperado no cadastro!");
            }
        });
    }

    // --------- LOGIN ---------
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;

            try {
                const response = await fetch('/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: toFormData({ email, password })
                });

                if (response.ok) {
                    alert('✅ Login realizado com sucesso!');
                    window.location.href = '/dashboard';
                } else {
                    const errorData = await response.json();
                    alert('❌ Erro no login: ' + (errorData.message || "Credenciais inválidas"));
                }
            } catch (error) {
                console.error(error);
                alert("❌ Erro inesperado no login!");
            }
        });
    }

    // --------- LOGOUT ---------
    async function doLogout() {
        try {
            const response = await fetch('/logout', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                alert("🚪 Logout realizado com sucesso!");
                window.location.href = '/';
            } else {
                alert("❌ Erro ao sair!");
            }
        } catch (error) {
            console.error(error);
            alert("❌ Erro inesperado no logout!");
        }
    }

    function updateAuthUI() {
        const authArea = document.getElementById('authArea');
        if (authArea) {
            authArea.innerHTML = `<button id="logoutBtn" class="btn btn-danger">Sair</button>`;
            document.getElementById('logoutBtn').addEventListener('click', doLogout);
        }
    }
});
