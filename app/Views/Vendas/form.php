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

    <form action="<?= base_url('vendas/'.$op); ?>" method="post">

        <div class="mb-3">
            <label for="vendas_pedidos_id" class="form-label"> Pedido </label>
            <select class="form-control" name="vendas_pedidos_id" id="vendas_pedidos_id">

                <?php 
                    for($i=0; $i < count($pedidos);$i++){ 
                        $selected = '';
                        if($pedidos[$i]->pedidos_id == $vendas->vendas_pedidos_id){
                            $selected = 'selected'; 
                        }
                    ?>

                <option <?= $selected; ?> value="<?= $pedidos[$i]->pedidos_id; ?>">
                    <?= $pedidos[$i]->pedidos_id; ?>
                </option>
                <?php } ?>

            </select>
        </div>

        <div class="mb-3">
            <label for="vendas_produtos_id" class="form-label"> Produto </label>
            <select class="form-control" name="vendas_produtos_id" id="vendas_produtos_id">

                <?php 
                    for($i=0; $i < count($produtos);$i++){ 
                        $selected = '';
                        if($produtos[$i]->produtos_id == $vendas->vendas_produtos_id){
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
            <label for="vendas_clientes_id" class="form-label"> Cliente </label>
            <select class="form-control" name="vendas_clientes_id" id="vendas_clientes_id">

                <?php 
                    for($i=0; $i < count($clientes);$i++){ 
                        $selected = '';
                        if($clientes[$i]->clientes_id == $vendas->vendas_clientes_id){
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
            <label for="vendas_data" class="form-label"> Data </label>
            <input type="text" class="form-control" name="vendas_data" value="<?= $vendas->vendas_data; ?>"
                id="vendas_data">
        </div>


        <div class="mb-3">
            <label for="vendas_forma_pagamentos_id" class="form-label"> Forma de Pagamento </label>
            <select class="form-control" name="vendas_forma_pagamentos_id" id="vendas_forma_pagamentos_id">

                <?php 
                    for($i=0; $i < count($formaPagamentos);$i++){ 
                        $selected = '';
                        if($formaPagamentos[$i]->forma_pagamentos_id == $vendas->vendas_forma_pagamentos_id){
                            $selected = 'selected'; 
                        }
                    ?>

                <option <?= $selected; ?> value="<?= $formaPagamentos[$i]->forma_pagamentos_id; ?>">
                    <?= $formaPagamentos[$i]->forma_pagamentos_descricao; ?>
                </option>
                <?php } ?>

            </select>
        </div>



        <div class="mb-3">
            <label for="vendas_quantidade" class="form-label"> Quantidade </label>
            <input type="text" class="form-control" name="vendas_quantidade" value="<?= $vendas->vendas_quantidade; ?>"
                id="vendas_quantidade">
        </div>



        <div class="mb-3">
            <label for="vendas_funcionarios_id" class="form-label"> Funcionario que cadastrou </label>
            <select class="form-control" name="vendas_funcionarios_id" id="vendas_funcionarios_id">

                <?php 
                    for($i=0; $i < count($funcionarios);$i++){ 
                        $selected = '';
                        if($funcionarios[$i]->funcionarios_id == $vendas->vendas_funcionarios_id){
                            $selected = 'selected'; 
                        }
                    ?>

                <option <?= $selected; ?> value="<?= $funcionarios[$i]->funcionarios_id; ?>">
                    <?= $funcionarios[$i]->funcionarios_id; ?>
                </option>
                <?php } ?>

            </select>
        </div>


        <input type="hidden" name="vendas_id" value="<?= $vendas->vendas_id; ?>">

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