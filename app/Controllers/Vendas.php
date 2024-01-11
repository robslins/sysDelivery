<?php

namespace App\Controllers;
use App\Models\Vendas as Vendas_model;
use App\Models\FormaPagamentos as FormaPagamentos_model;
use App\Models\Funcionarios as Funcionarios_model;
use App\Models\Clientes as Clientes_model;
use App\Models\Produtos as Produtos_model;
use App\Models\Pedidos as Pedidos_model;


class Vendas extends BaseController
{
    private $vendas;
    private $formaPagamentos;
    private $funcionarios;
    private $clientes;
    private $produtos;
    private $pedidos;
    
    public function __construct(){
        $this->vendas = new Vendas_model();
        $this->formaPagamentos = new FormaPagamentos_model();
        $this->funcionarios = new Funcionarios_model();
        $this->clientes = new Clientes_model();
        $this->produtos = new Produtos_model();
        $this->pedidos = new Pedidos_model();
        $data['title'] = 'Vendas';
        helper('functions');
    }

    public function index(): string
    {
        $data['title'] = 'Vendas';
        $data['vendas'] = $this->vendas->getVendas();
        return view('Vendas/index',$data);
    }
    public function new(): string
    {
        $data['title'] = 'Vendas';
        $data['op'] = 'create';
        $data['form'] = 'Cadastrar';
        $data['produtos'] = $this->produtos->findAll();
        $data['funcionarios'] = $this->funcionarios->findAll();
        $data['clientes'] = $this->clientes->findAll();
        $data['formaPagamentos'] = $this->formaPagamentos->findAll();
        $data['pedidos'] = $this->pedidos->findAll();
        $data['vendas'] = (object) [
            'vendas_id' => '',
            'vendas_quantidade' => '',
            'vendas_data' => '',
            'vendas_forma_pagamentos_id' => '',
            'vendas_funcionarios_id' => '',
            'vendas_clientes_id' => '',
            'vendas_produtos_id' => '',
            'vendas_pedidos_id' => '',
        ];
            return view('Vendas/form',$data);
    }

    public function create()
    {
        helper(["form", "url"]);
        $regrasValidacao = [
            'vendas_data' => 'required'
        ];

            if($this->validate($regrasValidacao)){
                $this->vendas->save([
                    'vendas_quantidade' => $_REQUEST['vendas_quantidade'],
                    'vendas_data' => $_REQUEST['vendas_data'],
                    'vendas_forma_pagamentos_id' => $_REQUEST['vendas_forma_pagamentos_id'],
                    'vendas_funcionarios_id' => $_REQUEST['vendas_funcionarios_id'],
                    'vendas_clientes_id' => $_REQUEST['vendas_clientes_id'],
                    'vendas_produtos_id' => $_REQUEST['vendas_produtos_id'],
                    'vendas_pedidos_id' => $_REQUEST['vendas_pedidos_id']
                ]);
                
                
                $data['msg'] = msg('Cadastrado com Sucesso!','success');
                $data['vendas'] = $this->vendas->getVendas();
                $data['title'] = 'Vendas';
                return view('Vendas/index',$data);
            } 
            
            else {
                $data['vendas'] = (object) [
                    'vendas_quantidade' => $_REQUEST['vendas_quantidade'],
                    'vendas_data' => $_REQUEST['vendas_data'],
                    'vendas_forma_pagamentos_id' => $_REQUEST['vendas_forma_pagamentos_id'],
                    'vendas_funcionarios_id' => $_REQUEST['vendas_funcionarios_id'],
                    'vendas_clientes_id' => $_REQUEST['vendas_clientes_id'],
                    'vendas_produtos_id' => $_REQUEST['vendas_produtos_id'],
                    'vendas_pedidos_id' => $_REQUEST['vendas_pedidos_id'],
                    'vendas_id' => $_REQUEST['vendas_id']
                ];
                
                $data['produtos'] = $this->produtos->findAll();
                $data['funcionarios'] = $this->funcionarios->findAll();
                $data['clientes'] = $this->clientes->findAll();
                $data['pedidos'] = $this->pedidos->findAll();
                $data['formaPagamentos'] = $this->formaPagamentos->findAll();
                $data['title'] = 'Vendas';
                $data['form'] = 'Cadastrar';
                $data['op'] = 'create';
                $data['msg'] = msg($this->validator->listErrors(), "danger");
                return view('Vendas/form',$data);
            }

    }

    public function delete($id)
    {

        $this->pedidos->where('vendas_id', (int) $id)->delete();
        $data['msg'] = msg('Deletado com Sucesso!','success');
        $data['vendas'] = $this->vendas->getVendas();
        $data['title'] = 'Vendas';
        return view('Vendas/index',$data);
    }

    public function edit($id)
    {
        $data['produtos'] = $this->produtos->findAll();
        $data['funcionarios'] = $this->funcionarios->findAll();
        $data['clientes'] = $this->clientes->findAll();
        $data['pedidos'] = $this->pedidos->findAll();
        $data['formaPagamentos'] = $this->formaPagamentos->findAll();
        $data['vendas'] = $this->vendas->find(['vendas_id' => (int) $id])[0];
        $data['title'] = 'Vendas';
        $data['form'] = 'Alterar';
        $data['op'] = 'update';
        return view('Vendas/form',$data);
    }

    public function update()
    {
        $dataForm = [
            'vendas_quantidade' => $_REQUEST['vendas_quantidade'],
            'vendas_data' => $_REQUEST['vendas_data'],
            'vendas_forma_pagamentos_id' => $_REQUEST['vendas_forma_pagamentos_id'],
            'vendas_funcionarios_id' => $_REQUEST['vendas_funcionarios_id'],
            'vendas_clientes_id' => $_REQUEST['vendas_clientes_id'],
            'vendas_produtos_id' => $_REQUEST['vendas_produtos_id'],
            'vendas_pedidos_id' => $_REQUEST['vendas_pedidos_id']
        ];

        $this->pedidos->update($_REQUEST['vendas_id'], $dataForm);
        $data['msg'] = msg('Alterado com Sucesso!','success');
        $data['vendas'] = $this->vendas->getVendas();
        $data['title'] = 'Vendas';
        return view('Vendas/index',$data);
    }

    public function search()
    {

        $data['vendas'] = $this->vendas->join('produtos', 'pedidos_produtos_id = produtos_id')->like('produtos_nome', $_REQUEST['pesquisar'])->join('funcionarios', 'pedidos_funcionarios_id = funcionarios_id')->orlike('funcionarios_id', $_REQUEST['pesquisar'])->join('clientes', 'pedidos_clientes_id = clientes_id')->orlike('clientes_id', $_REQUEST['pesquisar'])->find();
        $total = count($data['pedidos']);
        $data['msg'] = msg("Dados Encontrados: {$total}",'success');
        $data['title'] = 'Vendas';
        return view('Vendas/index',$data);

    }
}