<?php

namespace App\Controllers;
use App\Models\Estoques as Estoques_model;
use App\Models\Produtos as Produtos_model;
use App\Models\Funcionarios as Funcionarios_model;


class Estoques extends BaseController
{
    private $estoques;
    private $produtos;
    private $funcionarios;
    public function __construct(){
        $this->estoques = new Estoques_model();
        $this->produtos = new Produtos_model();
        $this->funcionarios = new Funcionarios_model();
        $data['title'] = 'Estoques';
        helper('functions');
    }

    public function index(): string
    {
        $data['title'] = 'Estoques';
        $data['estoques'] = $this->estoques->getEstoquesComProdutosFuncionarios();
        return view('Estoques/index',$data);
    }
    public function new(): string
    {
        $data['title'] = 'Estoques';
        $data['op'] = 'create';
        $data['form'] = 'Cadastrar';
        $data['produtos'] = $this->produtos->findAll();
        $data['funcionarios'] = $this->funcionarios->findAll();
        $data['estoques'] = (object) [
            'estoques_id' => '',
            'estoques_quantidade' => '',
            'estoques_data_compra' => '',
            'estoques_data_validade' => '',
            'estoques_lote' => '',
            'estoques_produtos_id' => '',
            'estoques_funcionarios_id' => ''];
            return view('Estoques/form',$data);
    }

    public function create()
    {
        helper(["form", "url"]);
        $regrasValidacao = [
            'estoques_quantidade' => 'required|max_length[255]|min_length[1]'
        ];

            if($this->validate($regrasValidacao)){
                $this->estoques->save([
                    'estoques_quantidade' => $_REQUEST['estoques_quantidade'],
                    'estoques_data_compra' => $_REQUEST['estoques_data_compra'],
                    'estoques_data_validade' => $_REQUEST['estoques_data_validade'],
                    'estoques_lote' => $_REQUEST['estoques_lote'],
                    'estoques_produtos_id' => $_REQUEST['estoques_produtos_id'],
                    'estoques_funcionarios_id' => $_REQUEST['estoques_funcionarios_id'],
                ]);
                
                
                $data['msg'] = msg('Cadastrado com Sucesso!','success');
                $data['estoques'] = $this->estoques->getEstoquesComProdutosFuncionarios();
                $data['title'] = 'Estoques';
                return view('Estoques/index',$data);
            } 
            
            else {
                $data['estoques'] = (object) [
                    'estoques_quantidade' => $_REQUEST['estoques_quantidade'],
                    'estoques_data_compra' => $_REQUEST['estoques_data_compra'],
                    'estoques_data_validade' => $_REQUEST['estoques_data_validade'],
                    'estoques_lote' => $_REQUEST['estoques_lote'],
                    'estoques_produtos_id' => $_REQUEST['estoques_produtos_id'],
                    'estoques_funcionarios_id' => $_REQUEST['estoques_funcionarios_id'],
                    'estoques_id' => $_REQUEST['estoques_id']
                ];
                
                $data['produtos'] = $this->produtos->findAll();
                $data['funcionarios'] = $this->funcionarios->findAll();
                $data['title'] = 'Estoques';
                $data['form'] = 'Cadastrar';
                $data['op'] = 'create';
                $data['msg'] = msg($this->validator->listErrors(), "danger");
                return view('Estoques/form',$data);
            }

    }

    public function delete($id)
    {

        $this->estoques->where('estoques_id', (int) $id)->delete();
        $data['msg'] = msg('Deletado com Sucesso!','success');
        $data['estoques'] = $this->estoques->getEstoquesComProdutosFuncionarios();
        $data['title'] = 'Estoques';
        return view('Estoques/index',$data);
    }

    public function edit($id)
    {
        $data['produtos'] = $this->produtos->findAll();
        $data['funcionarios'] = $this->funcionarios->findAll();
        $data['estoques'] = $this->estoques->find(['estoques_id' => (int) $id])[0];
        $data['title'] = 'Estoques';
        $data['form'] = 'Alterar';
        $data['op'] = 'update';
        return view('Estoques/form',$data);
    }

    public function update()
    {
        $dataForm = [
            'estoques_quantidade' => $_REQUEST['estoques_quantidade'],
            'estoques_data_compra' => $_REQUEST['estoques_data_compra'],
            'estoques_data_validade' => $_REQUEST['estoques_data_validade'],
            'estoques_lote' => $_REQUEST['estoques_lote'],
            'estoques_produtos_id' => $_REQUEST['estoques_produtos_id'],
            'estoques_funcionarios_id' => $_REQUEST['estoques_funcionarios_id'],
        ];

        $this->estoques->update($_REQUEST['estoques_id'], $dataForm);
        $data['msg'] = msg('Alterado com Sucesso!','success');
        $data['estoques'] = $this->estoques->getEstoquesComProdutosFuncionarios();
        $data['title'] = 'Estoques';
        return view('Estoques/index',$data);
    }

    public function search()
    {

        $data['estoques'] = $this->estoques->join('produtos', 'estoques_produtos_id = produtos_id')->like('produtos_nome', $_REQUEST['pesquisar'])->join('funcionarios', 'estoques_funcionarios_id = funcionarios_id')->orlike('funcionarios_id', $_REQUEST['pesquisar'])->find();
        $total = count($data['estoques']);
        $data['msg'] = msg("Dados Encontrados: {$total}",'success');
        $data['title'] = 'Estoques';
        return view('Estoques/index',$data);

    }
}