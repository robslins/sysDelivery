<?php

namespace App\Controllers;
use App\Models\Entregas as Entregas_model;
use App\Models\Vendas as Vendas_model;
use App\Models\Funcionarios as Funcionarios_model;



class Entregas extends BaseController
{
    private $entregas;
    private $vendas;
    private $funcionarios;
    
    public function __construct(){
        $this->entregas = new Entregas_model();
        $this->vendas = new Vendas_model();
        $this->funcionarios = new Funcionarios_model();
        $data['title'] = 'Entregas';
        helper('functions');
    }

    public function index(): string
    {
        $data['title'] = 'Entregas';
        $data['entregas'] = $this->entregas->getEntregas();
        return view('Entregas/index',$data);
    }
    public function new(): string
    {
        $data['title'] = 'Entregas';
        $data['op'] = 'create';
        $data['form'] = 'Cadastrar';
        $data['vendas'] = $this->vendas->findAll();
        $data['funcionarios'] = $this->funcionarios->findAll();
        $data['entregas'] = (object) [
            'entregas_id' => '',
            'entregas_data_saida' => '',
            'entregas_data_entrega' => '',
            'entregas_status' => '',
            'entregas_observacao' => '',
            'entregas_vendas_id' => '',
            'entregas_funcionarios_id' => ''
        ];
            return view('Entregas/form',$data);
    }

    public function create()
    {
        helper(["form", "url"]);
        $regrasValidacao = [
            'entregas_status' => 'required'
        ];

            if($this->validate($regrasValidacao)){
                $this->entregas->save([
                    'entregas_data_saida' => $_REQUEST['entregas_data_saida'],
                    'entregas_data_entrega' => $_REQUEST['entregas_data_entrega'],
                    'entregas_status' => $_REQUEST['entregas_status'],
                    'entregas_observacao' => $_REQUEST['entregas_observacao'],
                    'entregas_vendas_id' => $_REQUEST['entregas_vendas_id'],
                    'entregas_funcionarios_id' => $_REQUEST['entregas_funcionarios_id']
                ]);
                
                
                $data['msg'] = msg('Cadastrado com Sucesso!','success');
                $data['entregas'] = $this->entregas->getEntregas();
                $data['title'] = 'Entregas';
                return view('Entregas/index',$data);
            } 
            
            else {
                $data['entregas'] = (object) [
                    'entregas_data_saida' => $_REQUEST['entregas_data_saida'],
                    'entregas_data_entrega' => $_REQUEST['entregas_data_entrega'],
                    'entregas_status' => $_REQUEST['entregas_status'],
                    'entregas_observacao' => $_REQUEST['entregas_observacao'],
                    'entregas_vendas_id' => $_REQUEST['entregas_vendas_id'],
                    'entregas_funcionarios_id' => $_REQUEST['entregas_funcionarios_id'],
                    'entregas_id' => $_REQUEST['entregas_id']
                ];
                
               
                $data['funcionarios'] = $this->funcionarios->findAll();
                $data['vendas'] = $this->vendas->findAll();
                $data['title'] = 'Entregas';
                $data['form'] = 'Cadastrar';
                $data['op'] = 'create';
                $data['msg'] = msg($this->validator->listErrors(), "danger");
                return view('Entregas/form',$data);
            }

    }

    public function delete($id)
    {

        $this->entregas->where('entregas_id', (int) $id)->delete();
        $data['msg'] = msg('Deletado com Sucesso!','success');
        $data['entregas'] = $this->entregas->getEntregas();
        $data['title'] = 'Entregas';
        return view('Entregas/index',$data);
    }

    public function edit($id)
    {
        $data['vendas'] = $this->vendas->findAll();
        $data['funcionarios'] = $this->funcionarios->findAll();
        $data['entregas'] = $this->entregas->find(['entregas_id' => (int) $id])[0];
        $data['title'] = 'Entregas';
        $data['form'] = 'Alterar';
        $data['op'] = 'update';
        return view('Entregas/form',$data);
    }

    public function update()
    {
        $dataForm = [
            'entregas_data_saida' => $_REQUEST['entregas_data_saida'],
            'entregas_data_entrega' => $_REQUEST['entregas_data_entrega'],
            'entregas_status' => $_REQUEST['entregas_status'],
            'entregas_observacao' => $_REQUEST['entregas_observacao'],
            'entregas_vendas_id' => $_REQUEST['entregas_vendas_id'],
            'entregas_funcionarios_id' => $_REQUEST['entregas_funcionarios_id']
        ];

        $this->entregas->update($_REQUEST['entregas_id'], $dataForm);
        $data['msg'] = msg('Alterado com Sucesso!','success');
        $data['entregas'] = $this->entregas->getEntregas();
        $data['title'] = 'Entregas';
        return view('Entregas/index',$data);
    }

    public function search()
    {

        $data['entregas'] = $this->entregas->join('funcionarios', 'entregas_funcionarios_id = funcionarios_id')->like('funcionarios_nome', $_REQUEST['pesquisar'])->find();
        $total = count($data['entregas']);
        $data['msg'] = msg("Dados Encontrados: {$total}",'success');
        $data['title'] = 'Entregas';
        return view('Entregas/index',$data);

    }
}