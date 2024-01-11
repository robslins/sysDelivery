<?php

namespace App\Controllers;
use App\Models\Cidades as Cidades_model;
use App\Models\Estados as Estados_model;


class Cidades extends BaseController
{
    private $cidades;
    private $estados;
    public function __construct(){
        $this->cidades = new Cidades_model();
        $this->estados = new Estados_model();
        $data['title'] = 'Cidades';
        helper('functions');
    }

    public function index()
    {
        $data['title'] = 'Cidades';
        $data['cidades'] = $this->cidades->join('estados', 'cidades_estados_id = estados_id')->find();
        return view('Cidades/index',$data);
    }
    public function new(): string
    {
        $data['title'] = 'Cidades';
        $data['op'] = 'create';
        $data['form'] = 'Cadastrar';
        $data['estados'] = $this->estados->findAll();
        $data['cidades'] = (object) [
            'cidades_id' => '',
            'cidades_nome' => '',
            'cidades_estados_id' => '',];
            return view('Cidades/form',$data);
    }

    public function create()
    {

        // Checks whether the submitted data passed the validation rules.
        if(!$this->validate([
            'cidades_nome' => 'required|max_length[255]|min_length[3]',
        ])) {
            
            // The validation fails, so returns the form.
            $data['cidades'] = (object) [
                'cidades_nome' => $_REQUEST['cidades_nome'],
                'cidades_estados_id' => $_REQUEST['cidades_estados_id']];
            
            $data['title'] = 'Cidades';
            $data['form'] = 'Cadastrar';
            $data['op'] = 'create';
            return view('Cidades/form',$data);
        }


        $this->cidades->save([
            'cidades_nome' => $_REQUEST['cidades_nome'],
            'cidades_estados_id' => $_REQUEST['cidades_estados_id']
        ]);
        
        $data['msg'] = msg('Cadastrado com Sucesso!','success');
        $data['cidades'] = $this->cidades->join('estados', 'cidades_estados_id = estados_id')->find();
        $data['title'] = 'Cidades';
        return view('Cidades/index',$data);

    }

    public function delete($id)
    {

        $this->cidades->where('cidades_id', (int) $id)->delete();
        $data['msg'] = msg('Deletado com Sucesso!','success');
        $data['cidades'] = $this->cidades->join('estados', 'cidades_estados_id = estados_id')->find();
        $data['title'] = 'Cidades';
        return view('Cidades/form',$data);
    }

    public function edit($id)
    {
        $data['estados'] = $this->estados->findAll();
        $data['cidades'] = $this->cidades->find(['cidades_id' => (int) $id])[0];
        $data['title'] = 'Cidades';
        $data['form'] = 'Alterar';
        $data['op'] = 'update';
        return view('Cidades/form',$data);
    }

    public function update()
    {
        $dataForm = [
            'cidades_nome' => $_REQUEST['cidades_nome'],
            'cidades_estados_id' => $_REQUEST['cidades_estados_id']
        ];

        $this->cidades->update($_REQUEST['cidades_id'], $dataForm);
        $data['msg'] = msg('Alterado com Sucesso!','success');
        $data['cidades'] = $this->cidades->join('estados', 'cidades_estados_id = estados_id')->find();
        $data['title'] = 'Cidades';
        return view('Cidades/index',$data);
    }

    public function search()
    {

        $data['cidades'] = $this->cidades->join('estados', 'cidades_estados_id = estados_id')->like('cidades_nome', $_REQUEST['pesquisar'])->orlike('estados_nome', $_REQUEST['pesquisar'])->find();
        
        $total = count($data['cidades']);
        $data['msg'] = msg("Dados Encontrados: {$total}",'success');
        $data['title'] = 'Cidades';
        return view('Cidades/index',$data);

    }
}