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

    <h2 class="border-bottom border-2 border-primary mt-5 pt-3"> <?= $title ?> </h2>


    <?php if(isset($msg)){echo $msg;} ?>

    <form action="<?= base_url('entregas/search'); ?>" class="d-flex" role="search" method="post">
        <input class="form-control me-2" name="pesquisar" type="search" placeholder="Pesquisar" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Número da entrega</th>
                <th scope="col">Data saída</th>
                <th scope="col">Data entrega</th>
                <th scope="col">Status</th>
                <th scope="col">Observação</th>
                <th scope="col">Venda</th>
                <th scope="col">Funcionário</th>

                <th scope="col">
                    <a class="btn btn-success" href="<?= base_url('entregas/new'); ?>">
                        Novo
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody class="table-group-divider">

            <?php // var_dump($enderecos); exit; ?>

            <!-- Aqui vai o laço de repetição -->
            <?php for($i=0; $i < count($entregas); $i++){ ?>
            <tr>
                <th scope="row"><?= $entregas[$i]->entregas_id; ?></th>
                <td><?= $entregas[$i]->entregas_data_saida; ?></td>
                <td><?= $entregas[$i]->entregas_data_entrega; ?></td>
                <td><?= $entregas[$i]->entregas_status; ?></td>
                <td><?= $entregas[$i]->entregas_observacao; ?></td>
                <td><?= $entregas[$i]->vendas_id; ?></td>
                <td><?= $entregas[$i]->funcionarios_id; ?></td>

                <td>
                    <a class="btn btn-primary" href="<?= base_url('entregas/edit/'.$entregas[$i]->entregas_id); ?>">
                        Editar
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a class="btn btn-danger" href="<?= base_url('entregas/delete/'.$entregas[$i]->entregas_id); ?>">
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