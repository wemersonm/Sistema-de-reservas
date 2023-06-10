<nav class="navbar">
    <a class="navbar-brand text-dark" href="/">
        <span class="logo">PAINEL ADM</span>
    </a>
    <ul class="nav justify-content-center fw-bold ">
        <li class="nav-item">
            <a class="nav-link text-danger" href="#">ALGUMA COISA</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger" href="#">OUTRA COISA</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger" href="#">QUALQUER COISA</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
        </li>
    </ul>
    <ul class="nav justify-content-end fw-bold text-dark">
        <li class="nav-item">
            <a class="nav-link text-danger " href="#">OLÁ FULANO</a>
        </li>
        <?php if (isAdmLogged()) : ?>
            <li class="nav-item">
                <a class="nav-link text-danger-emphasis" href="/admin/logout">Sair</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link text-danger-emphasis" href="/admin/login">Entrar</a>
            </li>
        <?php endif; ?>
    </ul>


</nav>