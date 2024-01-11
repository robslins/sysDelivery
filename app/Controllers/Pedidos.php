<?php

namespace App\Controllers;
use App\Models\Pedidos as Pedidos_model;
use App\Models\Produtos as Produtos_model;
use App\Models\Funcionarios as Funcionarios_model;
use App\Models\Clientes as Clientes_model;


class Pedidos extends BaseController
{
    private $pedidos;
    private $produtos;
    private $funcionarios;
    private $clientes;
    public function __construct(){
        $this->pedidos = new Pedidos_model();
        $this->produtos = new Produtos_model();
        $this->funcionarios = new Funcionarios_model();
        $this->clientes = new Clientes_model();
        $data['title'] = 'Pedidos';
        helper('functions');
    }

    public function index(): string
    {
        $data['title'] = 'Pedidos';
        $data['pedidos'] = $this->pedidos->getPedidosProdutosFuncClientes();
        return view('Pedidos/index',$data);
    }
    public function new(): string
    {
        $data['title'] = 'Pedidos';
        $data['op'] = 'create';
        $data['form'] = 'Cadastrar';
        $data['produtos'] = $this->produtos->findAll();
        $data['funcionarios'] = $this->funcionarios->findAll();
        $data['clientes'] = $this->clientes->findAll();
        $data['pedidos'] = (object) [
            'pedidos_id' => '',
            'pedidos_data' => '',
            'pedidos_produtos_id' => '',
            'pedidos_funcionarios_id' => '',
            'pedidos_clientes_id' => ''];
            return view('Pedidos/form',$data);
    }

    public function create()
    {
        helper(["form", "url"]);
        $regrasValidacao = [
            'pedidos_data' => 'required'
        ];

            if($this->validate($regrasValidacao)){
                $this->pedidos->save([
                    'pedidos_data' => $_REQUEST['pedidos_data'],
                    'pedidos_produtos_id' => $_REQUEST['pedidos_produtos_id'],
                    'pedidos_funcionarios_id' => $_REQUEST['pedidos_funcionarios_id'],
                    'pedidos_clientes_id' => $_REQUEST['pedidos_clientes_id']
                ]);
                
                
                $data['msg'] = msg('Cadastrado com Sucesso!','success');
                $data['pedidos'] = $this->pedidos->getPedidosProdutosFuncClientes();
                $data['title'] = 'Pedidos';
                return view('Pedidos/index',$data);
            } 
            
            else {
                $data['pedidos'] = (object) [
                    'pedidos_data' => $_REQUEST['pedidos_data'],
                    'pedidos_produtos_id' => $_REQUEST['pedidos_produtos_id'],
                    'pedidos_funcionarios_id' => $_REQUEST['pedidos_funcionarios_id'],
                    'pedidos_clientes_id' => $_REQUEST['pedidos_clientes_id'],
                    'pedidos_id' => $_REQUEST['pedidos_id']
                ];
                
                $data['produtos'] = $this->produtos->findAll();
                $data['funcionarios'] = $this->funcionarios->findAll();
                $data['clientes'] = $this->clientes->findAll();
                $data['title'] = 'Pedidos';
                $data['form'] = 'Cadastrar';
                $data['op'] = 'create';
                $data['msg'] = msg($this->validator->listErrors(), "danger");
                return view('Pedidos/form',$data);
            }

    }

    public function delete($id)
    {

        $this->pedidos->where('pedidos_id', (int) $id)->delete();
        $data['msg'] = msg('Deletado com Sucesso!','success');
        $data['pedidos'] = $this->pedidos->getPedidosProdutosFuncClientes();
        $data['title'] = 'Pedidos';
        return view('Pedidos/index',$data);
    }

    public function edit($id)
    {
        $data['produtos'] = $this->produtos->findAll();
        $data['funcionarios'] = $this->funcionarios->findAll();
        $data['clientes'] = $this->clientes->findAll();
        $data['pedidos'] = $this->pedidos->find(['pedidos_id' => (int) $id])[0];
        $data['title'] = 'Pedidos';
        $data['form'] = 'Alterar';
        $data['op'] = 'update';
        return view('Pedidos/form',$data);
    }

    public function update()
    {
        $dataForm = [
            'pedidos_data' => $_REQUEST['pedidos_data'],
            'pedidos_produtos_id' => $_REQUEST['pedidos_produtos_id'],
            'pedidos_funcionarios_id' => $_REQUEST['pedidos_funcionarios_id'],
            'pedidos_clientes_id' => $_REQUEST['pedidos_clientes_id']
        ];

        $this->pedidos->update($_REQUEST['pedidos_id'], $dataForm);
        $data['msg'] = msg('Alterado com Sucesso!','success');
        $data['pedidos'] = $this->pedidos->getPedidosProdutosFuncClientes();
        $data['title'] = 'Pedidos';
        return view('Pedidos/index',$data);
    }

    public function search()
    {

        $data['pedidos'] = $this->pedidos->join('produtos', 'pedidos_produtos_id = produtos_id')->like('produtos_nome', $_REQUEST['pesquisar'])->join('funcionarios', 'pedidos_funcionarios_id = funcionarios_id')->orlike('funcionarios_id', $_REQUEST['pesquisar'])->join('clientes', 'pedidos_clientes_id = clientes_id')->orlike('clientes_id', $_REQUEST['pesquisar'])->find();
        $total = count($data['pedidos']);
        $data['msg'] = msg("Dados Encontrados: {$total}",'success');
        $data['title'] = 'Pedidos';
        return view('Pedidos/index',$data);

    }
}