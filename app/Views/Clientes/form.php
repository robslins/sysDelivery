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

    <form action="<?= base_url('clientes/'.$op); ?>" method="post">

        <div class="mb-3">
            <label for="clientes_usuarios_id" class="form-label"> Nome </label>
            <select class="form-control" name="clientes_usuarios_id" id="clientes_usuarios_id">

                <?php 
                    for($i=0; $i < count($usuarios);$i++){ 
                        $selected = '';
                        if($usuarios[$i]->usuarios_id == $clientes->clientes_usuarios_id){
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
            <label for="clientes_data_cadastro" class="form-label"> Data do Cadastro </label>
            <input type="text" class="form-control" name="clientes_data_cadastro"
                value="<?= $clientes->clientes_data_cadastro; ?>" id="clientes_data_cadastro">
        </div>


        <input type="hidden" name="funcionarios_id" value="<?= $clientes->clientes_id; ?>">

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