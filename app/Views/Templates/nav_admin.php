<nav class="navbar navbar-dark bg-dark fixed-top mb-5">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">
            <!--Logo do Projeto-->
            <img src="<?php echo base_url('assets/images/bootstrap-logo.svg') ?>" alt="SysDelivery" width="30"
                height="24">
            SysDelivery
        </a>


        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
            aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> Menu
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
            aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu SysDelivery</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                    <!-- Link Home-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url('admin') ?>">
                            <i class="bi bi-house-fill"></i>
                            Home
                        </a>
                    </li>

                    <!-- Link usuários-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url('usuarios') ?>">
                            <i class="bi bi-person"></i>
                            Usuários
                        </a>
                    </li>

                    <!-- Link Categorias-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url('categorias') ?>">
                            <i class="bi bi-file-earmark-text"></i>
                            Categorias
                        </a>
                    </li>

                    <!-- Link Produtos-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url('produtos') ?>">
                            <i class="bi bi-basket"></i>
                            Produtos
                        </a>
                    </li>

                    <!-- Link IMG Produtos-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url('imgprodutos') ?>">
                            <i class="bi bi-images"></i>
                            IMG Produtos
                        </a>
                    </li>

                    <!-- Link Alterar Senha-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="<?php echo base_url('usuarios/edit_senha') ?>">
                            <i class="bi bi-key"></i>
                            Alterar Senha
                        </a>
                    </li>

                    <!-- Link Alterar Nível-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="<?php echo base_url('usuarios/edit_nivel') ?>">
                            <i class="bi bi-bar-chart-steps"></i>
                            Alterar Nível
                        </a>
                    </li>

                    <!-- ------------------------------------------------------------ -->

                    <!-- Link Alterar Nível-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url('cidades') ?>">
                            <i class="bi bi-bank"></i>
                            Cidades
                        </a>
                    </li>

                    <!-- Link Alterar Nível-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url('clientes') ?>">
                            <i class="bi bi-person-x"></i>
                            Clientes
                        </a>
                    </li>

                    <!-- Link Alterar Nível-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url('enderecos') ?>">
                            <i class="bi bi-house-add"></i>
                            Endereços
                        </a>
                    </li>

                    <!-- Link Alterar Nível-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url('estoques') ?>">
                            <i class="bi bi-archive"></i>
                            Estoques
                        </a>
                    </li>

                    <!-- Link Alterar Nível-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url('funcionarios') ?>">
                            <i class="bi bi-file-person"></i>
                            Funcionarios
                        </a>
                    </li>

                    <!-- Link Alterar Nível-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url('pedidos') ?>">
                            <i class="bi bi-table"></i>
                            Pedidos
                        </a>
                    </li>

                    <!-- Link Alterar Nível-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url('vendas') ?>">
                            <i class="bi bi-receipt-cutoff"></i>
                            Vendas
                        </a>
                    </li>

                    <!-- Link Alterar Nível-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url('entregas') ?>">
                            <i class="bi bi-truck"></i>
                            Entregas
                        </a>
                    </li>










                </ul>

            </div>
        </div>

        <div class="d-flex">
            <a class="btn btn-outline-primary me-2" href="<?php echo base_url('login/logout') ?>">
                <i class="bi bi-unlock"></i>
                sair
            </a>
        </div>
    </div>
</nav>