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

    <form action="<?= base_url('entregas/'.$op); ?>" method="post">

        <div class="mb-3">
            <label for="entregas_data_saida" class="form-label"> Data Saída </label>
            <input type="text" class="form-control" name="entregas_data_saida"
                value="<?= $entregas->entregas_data_saida; ?>" id="entregas_data_saida">
        </div>

        <div class="mb-3">
            <label for="entregas_data_entrega" class="form-label"> Data Entrega </label>
            <input type="text" class="form-control" name="entregas_data_entrega"
                value="<?= $entregas->entregas_data_entrega; ?>" id="entregas_data_entrega">
        </div>

        <div class="mb-3">
            <label for="entregas_status" class="form-label"> Status </label>
            <input type="text" class="form-control" name="entregas_status" value="<?= $entregas->entregas_status; ?>"
                id="entregas_status">
        </div>

        <div class="mb-3">
            <label for="entregas_observacao" class="form-label"> Observação </label>
            <input type="text" class="form-control" name="entregas_observacao"
                value="<?= $entregas->entregas_observacao; ?>" id="entregas_observacao">
        </div>



        <div class="mb-3">
            <label for="entregas_vendas_id" class="form-label"> Venda </label>
            <select class="form-control" name="entregas_vendas_id" id="entregas_vendas_id">

                <?php 
                    for($i=0; $i < count($vendas);$i++){ 
                        $selected = '';
                        if($vendas[$i]->vendas_id == $entregas->entregas_vendas_id){
                            $selected = 'selected'; 
                        }
                    ?>

                <option <?= $selected; ?> value="<?= $vendas[$i]->vendas_id; ?>">
                    <?= $vendas[$i]->vendas_id; ?>
                </option>
                <?php } ?>

            </select>
        </div>



        <div class="mb-3">
            <label for="entregas_funcionarios_id" class="form-label"> Funcionario </label>
            <select class="form-control" name="entregas_funcionarios_id" id="entregas_funcionarios_id">

                <?php 
                    for($i=0; $i < count($funcionarios);$i++){ 
                        $selected = '';
                        if($funcionarios[$i]->funcionarios_id == $entregas->entregas_funcionarios_id){
                            $selected = 'selected'; 
                        }
                    ?>

                <option <?= $selected; ?> value="<?= $funcionarios[$i]->funcionarios_id; ?>">
                    <?= $funcionarios[$i]->funcionarios_id; ?>
                </option>
                <?php } ?>

            </select>
        </div>


        <input type="hidden" name="entregas_id" value="<?= $entregas->entregas_id; ?>">

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