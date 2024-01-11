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


<div class="container pt-4 pb-5 bg-light">
    <h2 class="border-bottom border-2 border-primary">
        <?= ucfirst($form).' '.$title ?>
    </h2>

    <form action="<?= base_url('funcionarios/'.$op); ?>" method="post">

        <div class="mb-3">
            <label for="funcionarios_usuarios_id" class="form-label"> Nome </label>
            <select class="form-control" name="funcionarios_usuarios_id" id="funcionarios_usuarios_id">

                <?php 
                    for($i=0; $i < count($usuarios);$i++){ 
                        $selected = '';
                        if($usuarios[$i]->usuarios_id == $funcionarios->funcionarios_usuarios_id){
                            $selected = 'selected'; 
                        }
                    ?>

                <option <?= $selected; ?> value="<?= $usuarios[$i]->usuarios_id; ?>">
                    <?= $usuarios[$i]->usuarios_nome; ?>
                </option>
                <?php } ?>

            </select>
        </div>

        <div class="mb-3">
            <label for="funcionarios_data_admissao" class="form-label"> Data de Admissão </label>
            <input type="text" class="form-control" name="funcionarios_data_admissao"
                value="<?= $funcionarios->funcionarios_data_admissao; ?>" id="funcionarios_data_admissao">
        </div>

        <div class="mb-3">
            <label for="funcionarios_contrato" class="form-label"> Contrato </label>
            <input type="text" class="form-control" name="funcionarios_contrato"
                value="<?= $funcionarios->funcionarios_contrato; ?>" id="funcionarios_contrato">
        </div>

        <div class="mb-3">
            <label for="funcionarios_salario" class="form-label"> Salário </label>
            <input type="text" class="form-control" name="funcionarios_salario"
                value="<?= moedaReal($funcionarios->funcionarios_salario); ?>" id="funcionarios_salario">
        </div>

        <div class="mb-3">
            <label for="funcionarios_cargo" class="form-label"> Cargo </label>
            <input type="text" class="form-control" name="funcionarios_cargo"
                value="<?= $funcionarios->funcionarios_cargo; ?>" id="funcionarios_cargo">
        </div>



        <input type="hidden" name="funcionarios_id" value="<?= $funcionarios->funcionarios_id; ?>">

        <div class="mb-3">
            <button class="btn btn-success" type="submit"> <?= ucfirst($form)  ?> <i class="bi bi-floppy"></i></button>
        </div>

    </form>

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