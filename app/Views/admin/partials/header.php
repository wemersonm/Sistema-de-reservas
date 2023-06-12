<nav class="navbar">
    <a class="navbar-brand text-dark" href="/admin">
        <span class="logo">PAINEL ADM</span>
    </a>
    <ul class="nav justify-content-center fw-bold ">
        <li class="nav-item">
            <a class="nav-link text-danger" href="/admin/cars">Veiculos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger" href="/admin/reserves">Reservas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger" href="/admin/employees">Funcionarios</a>
        </li>
       
    </ul>
    <ul class="nav justify-content-end fw-bold text-dark">
        <li class="nav-item">
            <a class="nav-link text-danger " href="#">Olá <?php echo $_SESSION[ADM_LOGGED]['nameUser']?></a>
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