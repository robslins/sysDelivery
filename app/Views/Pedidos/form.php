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

    <?php if(isset($msg)){echo $msg;} ?>

    <form action="<?= base_url('pedidos/'.$op); ?>" method="post">

        <div class="mb-3">
            <label for="pedidos_data" class="form-label"> Data </label>
            <input type="text" class="form-control" name="pedidos_data" value="<?= $pedidos->pedidos_data; ?>"
                id="pedidos_data">
        </div>

        <div class="mb-3">
            <label for="pedidos_produtos_id" class="form-label"> Produto </label>
            <select class="form-control" name="pedidos_produtos_id" id="pedidos_produtos_id">

                <?php 
                    for($i=0; $i < count($produtos);$i++){ 
                        $selected = '';
                        if($produtos[$i]->produtos_id == $pedidos->pedidos_produtos_id){
                            $selected = 'selected'; 
                        }
                    ?>

                <option <?= $selected; ?> value="<?= $produtos[$i]->produtos_id; ?>">
                    <?= $produtos[$i]->produtos_nome; ?>
                </option>
                <?php } ?>

            </select>
        </div>

        <div class="mb-3">
            <label for="pedidos_clientes_id" class="form-label"> Cliente </label>
            <select class="form-control" name="pedidos_clientes_id" id="pedidos_clientes_id">

                <?php 
                    for($i=0; $i < count($clientes);$i++){ 
                        $selected = '';
                        if($clientes[$i]->clientes_id == $pedidos->pedidos_clientes_id){
                            $selected = 'selected'; 
                        }
                    ?>

                <option <?= $selected; ?> value="<?= $clientes[$i]->clientes_id; ?>">
                    <?= $clientes[$i]->clientes_id; ?>
                </option>
                <?php } ?>

            </select>
        </div>





        <div class="mb-3">
            <label for="pedidos_funcionarios_id" class="form-label"> Funcionario que cadastrou </label>
            <select class="form-control" name="pedidos_funcionarios_id" id="pedidos_funcionarios_id">

                <?php 
                    for($i=0; $i < count($funcionarios);$i++){ 
                        $selected = '';
                        if($funcionarios[$i]->funcionarios_id == $pedidos->pedidos_funcionarios_id){
                            $selected = 'selected'; 
                        }
                    ?>

                <option <?= $selected; ?> value="<?= $funcionarios[$i]->funcionarios_id; ?>">
                    <?= $funcionarios[$i]->funcionarios_id; ?>
                </option>
                <?php } ?>

            </select>
        </div>


        <input type="hidden" name="pedidos_id" value="<?= $pedidos->pedidos_id; ?>">

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