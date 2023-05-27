<nav class="navbar">
    <a class="navbar-brand text-dark" href="/">
        <span class="logo">CarReservExpress</span>
    </a>
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
        </li>
    </ul>
    <ul class="nav justify-content-end fw-bold text-dark">
        <li class="nav-item">
            <a class="nav-link text-danger " href="#">Minhas Reservas</a>
        </li>
        <?php if (isLogged()) : ?>
            <li class="nav-item">
                <a class="nav-link text-danger-emphasis" href="/logout">Sair</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link text-danger-emphasis" href="/login">Entrar</a>
            </li>
        <?php endif; ?>
    </ul>


</nav>