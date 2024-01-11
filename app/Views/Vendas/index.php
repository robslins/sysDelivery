<?php
    helper('functions');
    session();
    if(isset($_SESSION['login'])){
        $login = $_SESSION['login'];
        //print_r($login);
        if($login->usuarios_nivel == 1){
    
?>
<?= $this->extend('Templates_admin') ?>
<?= $this->section('content') ?>

<div class="container">

    <h2 class="border-bottom border-2 border-primary mt-3 mb-4 pt-5"> <?= $title ?> </h2>


    <?php if(isset($msg)){echo $msg;} ?>

    <form action="<?= base_url('vendas/search'); ?>" class="d-flex" role="search" method="post">
        <input class="form-control me-2" name="pesquisar" type="search" placeholder="Pesquisar" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Número da venda</th>
                <th scope="col">Pedido</th>
                <th scope="col">Produtos</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Data</th>
                <th scope="col">Forma de Pagamento</th>
                <th scope="col">Cliente</th>
                <th scope="col">Funcionário</th>

                <th scope="col">
                    <a class="btn btn-success" href="<?= base_url('vendas/new'); ?>">
                        Novo
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody class="table-group-divider">

            <?php // var_dump($enderecos); exit; ?>

            <!-- Aqui vai o laço de repetição -->
            <?php for($i=0; $i < count($vendas); $i++){ ?>
            <tr>
                <th scope="row"><?= $vendas[$i]->vendas_id; ?></th>
                <td><?= $vendas[$i]->pedidos_id; ?></td>
                <td><?= $vendas[$i]->produtos_id; ?></td>
                <td><?= $vendas[$i]->vendas_quantidade; ?></td>
                <td><?= $vendas[$i]->vendas_data; ?></td>
                <td><?= $vendas[$i]->forma_pagamentos_id; ?></td>
                <td><?= $vendas[$i]->clientes_id; ?></td>
                <td><?= $vendas[$i]->funcionarios_id; ?></td>

                <td>
                    <a class="btn btn-primary" href="<?= base_url('vendas/edit/'.$vendas[$i]->vendas_id); ?>">
                        Editar
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a class="btn btn-danger" href="<?= base_url('vendas/delete/'.$vendas[$i]->vendas_id); ?>">
                        Excluir
                        <i class="bi bi-x-circle"></i>
                    </a>
                </td>

            </tr>
            <?php } ?>

        </tbody>
    </table>

</div>
<?= $this->endSection() ?>

<?php 
        }else{

            $data['msg'] = msg("Sem permissão de acesso!","danger");
            echo view('login',$data);
        }
    }else{

        $data['msg'] = msg("O usuário não está logado!","danger");
        echo view('login',$data);
    }

?>