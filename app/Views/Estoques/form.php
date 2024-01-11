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

    <form action="<?= base_url('estoques/'.$op); ?>" method="post">

        <div class="mb-3">
            <label for="estoques_produtos_id" class="form-label"> Produto </label>
            <select class="form-control" name="estoques_produtos_id" id="estoques_produtos_id">

                <?php 
                    for($i=0; $i < count($produtos);$i++){ 
                        $selected = '';
                        if($produtos[$i]->produtos_id == $estoques->estoques_produtos_id){
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
            <label for="estoques_quantidade" class="form-label"> Quantidade </label>
            <input type="text" class="form-control" name="estoques_quantidade"
                value="<?= $estoques->estoques_quantidade; ?>" id="estoques_quantidade">
        </div>

        <div class="mb-3">
            <label for="estoques_data_compra" class="form-label"> Data da Compra </label>
            <input type="text" class="form-control" name="estoques_data_compra"
                value="<?= $estoques->estoques_data_compra; ?>" id="estoques_data_compra">
        </div>

        <div class="mb-3">
            <label for="estoques_data_validade" class="form-label"> Data de Validade </label>
            <input type="text" class="form-control" name="estoques_data_validade"
                value="<?= $estoques->estoques_data_validade; ?>" id="estoques_data_validade">
        </div>

        <div class="mb-3">
            <label for="estoques_lote" class="form-label"> Lote </label>
            <input type="text" class="form-control" name="estoques_lote" value="<?= $estoques->estoques_lote; ?>"
                id="estoques_lote">
        </div>

        <div class="mb-3">
            <label for="estoques_funcionarios_id" class="form-label"> Funcionario que cadastrou </label>
            <select class="form-control" name="estoques_funcionarios_id" id="estoques_funcionarios_id">

                <?php 
                    for($i=0; $i < count($funcionarios);$i++){ 
                        $selected = '';
                        if($funcionarios[$i]->funcionarios_id == $estoques->estoques_funcionarios_id){
                            $selected = 'selected'; 
                        }
                    ?>

                <option <?= $selected; ?> value="<?= $funcionarios[$i]->funcionarios_id; ?>">
                    <?= $funcionarios[$i]->funcionarios_id; ?>
                </option>
                <?php } ?>

            </select>
        </div>


        <input type="hidden" name="estoques_id" value="<?= $estoques->estoques_id; ?>">

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