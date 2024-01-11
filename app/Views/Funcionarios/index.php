<?php
    helper('functions');
    session();
    if(isset($_SESSION['login'])){
        $login = $_SESSION['login'];
        print_r($login);
        if($login->usuarios_nivel == 1){
    
?>
<?= $this->extend('Templates_admin') ?>
<?= $this->section('content') ?>

<div class="container">

    <h2 class="border-bottom border-2 border-primary mt-3 mb-4 pt-5"> <?= $title ?> </h2>

    <?php if(isset($msg)){echo $msg;} ?>

    <form action="<?= base_url('funcionarios/search'); ?>" class="d-flex" role="search" method="post">
        <input class="form-control me-2" name="pesquisar" type="search" placeholder="Pesquisar" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Data de Admissão</th>
                <th scope="col">Contrato</th>
                <th scope="col">Salário</th>
                <th scope="col">Cargo</th>
                <th scope="col">
                    <a class="btn btn-success" href="<?= base_url('funcionarios/new'); ?>">
                        Novo
                        <i class="bi bi-plus-circle"></i>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody class="table-group-divider">

            <!-- Aqui vai o laço de repetição -->
            <?php for($i=0; $i < count($funcionarios); $i++){ ?>
            <tr>
                <th scope="row"><?= $funcionarios[$i]->funcionarios_id; ?></th>
                <td><?= $funcionarios[$i]->usuarios_nome; ?></td>
                <td><?= $funcionarios[$i]->funcionarios_data_admissao; ?></td>
                <td><?= $funcionarios[$i]->funcionarios_contrato; ?></td>
                <td>R$ <?= moedaReal($funcionarios[$i]->funcionarios_salario); ?></td>
                <td><?= $funcionarios[$i]->funcionarios_cargo; ?></td>

                <td>
                    <a class="btn btn-primary"
                        href="<?= base_url('funcionarios/edit/'.$funcionarios[$i]->funcionarios_id); ?>">
                        Editar
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a class="btn btn-danger"
                        href="<?= base_url('funcionarios/delete/'.$funcionarios[$i]->funcionarios_id); ?>">
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