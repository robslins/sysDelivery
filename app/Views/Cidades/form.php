<?= $this->extend('Templates') ?>
<?= $this->section('content') ?>


<div class="container pt-4 pb-5 bg-light">
    <h2 class="border-bottom border-2 border-primary">
        <?= ucfirst($form).' '.$title ?>
    </h2>

    <form action="<?= base_url('cidades/'.$op); ?>" method="post">
        <div class="mb-3">
            <label for="cidades_nome" class="form-label"> Nome </label>
            <input type="text" class="form-control" name="cidades_nome" value="<?= $cidades->cidades_nome; ?>"
                id="cidades_nome">
        </div>

        <div class="mb-3">
            <label for="cidades_estados_id" class="form-label"> Estado </label>
            <select class="form-control" name="cidades_estados_id" id="cidades_estados_id">

                <?php 
                    for($i=0; $i < count($estados);$i++){ 
                        $selected = '';
                        if($estados[$i]->estados_id == $cidades->cidades_estados_id){
                            $selected = 'selected'; 
                        }
                    ?>

                <option <?= $selected; ?> value="<?= $estados[$i]->estados_id; ?>">
                    <?= $estados[$i]->estados_nome; ?>
                </option>
                <?php } ?>

            </select>
        </div>

        <input type="hidden" name="cidades_id" value="<?= $cidades->cidades_id; ?>">

        <div class="mb-3">
            <button class="btn btn-success" type="submit"> <?= ucfirst($form)  ?> <i class="bi bi-floppy"></i></button>
        </div>

    </form>

</div>

<?= $this->endSection() ?>