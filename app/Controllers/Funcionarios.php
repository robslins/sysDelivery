<?php

namespace App\Controllers;
use App\Models\Funcionarios as Funcionarios_model;
use App\Models\Usuarios as Usuarios_model;

class Funcionarios extends BaseController
{
    private $funcionarios;
    private $usuarios;
    public function __construct(){
        $this->funcionarios = new Funcionarios_model();
        $this->usuarios = new Usuarios_model();
        $data['title'] = 'Funcionarios';
        helper('functions');
    }
    public function index(): string
    {
        $data['title'] = 'Funcionarios';
        $data['funcionarios'] = $this->funcionarios->join('usuarios', 'funcionarios_usuarios_id = usuarios_id')->find();
        //$data['produtos'] = $this->produtos->findAll();
        return view('Funcionarios/index',$data);
    }

    public function new(): string
    {
        $data['title'] = 'Funcionarios';
        $data['op'] = 'create';
        $data['form'] = 'cadastrar';
        $data['usuarios'] = $this->usuarios->findAll();
        $data['funcionarios'] = (object) [
            'funcionarios_data_admissao'=> '',
            'funcionarios_contrato'=> '',
            'funcionarios_salario'=> '0.00',
            'funcionarios_cargo'=> '',
            'funcionarios_usuarios_id'=> '',
            'funcionarios_id'=> ''
        ];
        return view('Funcionarios/form',$data);
    }


    public function create()
    {

        // Checks whether the submitted data passed the validation rules.
        if(!$this->validate([
            'funcionarios_salario' => 'required',
            'funcionarios_cargo' => 'required'
        ])) {
            
            // The validation fails, so returns the form.
            $data['funcionarios'] = (object) [
                'funcionarios_data_admissao' => $_REQUEST['funcionarios_data_admissao'],
                'funcionarios_contrato' => $_REQUEST['funcionarios_contrato'],
                'funcionarios_salario' => moedaDolar($_REQUEST['funcionarios_salario']),
                'funcionarios_cargo' => $_REQUEST['funcionarios_cargo'],
                'funcionarios_usuarios_id' => $_REQUEST['funcionarios_usuarios_id']
            ];
            
            $data['title'] = 'Funcionarios';
            $data['form'] = 'Cadastrar';
            $data['op'] = 'create';
            return view('Funcionarios/form',$data);
        }


        $this->funcionarios->save([
            'funcionarios_data_admissao' => $_REQUEST['funcionarios_data_admissao'],
            'funcionarios_contrato' => $_REQUEST['funcionarios_contrato'],
            'funcionarios_salario' => moedaDolar($_REQUEST['funcionarios_salario']),
            'funcionarios_cargo' => $_REQUEST['funcionarios_cargo'],
            'funcionarios_usuarios_id' => $_REQUEST['funcionarios_usuarios_id']
        ]);
        
        $data['msg'] = msg('Cadastrado com Sucesso!','success');
        $data['funcionarios'] = $this->funcionarios->join('usuarios', 'funcionarios_usuarios_id = usuarios_id')->find();
        $data['title'] = 'Funcionarios';
        return view('Funcionarios/index',$data);

    }





    public function delete($id)
    {
        $this->funcionarios->where('funcionarios_id', (int) $id)->delete();
        $data['msg'] = msg('Deletado com Sucesso!','success');
        $data['funcionarios'] = $this->funcionarios->join('usuarios', 'funcionarios_usuarios_id = usuarios_id')->find();
        $data['title'] = 'Funcionarios';
        return view('Funcionarios/index',$data);
    }

    public function edit($id)
    {
        $data['usuarios'] = $this->usuarios->findAll();
        $data['funcionarios'] = $this->funcionarios->find(['funcionarios_id' => (int) $id])[0];
        $data['title'] = 'Funcionarios';
        $data['form'] = 'Alterar';
        $data['op'] = 'update';
        return view('Funcionarios/form',$data);
    }

    public function update()
    {
        $dataForm = [
            'funcionarios_data_admissao' => $_REQUEST['funcionarios_data_admissao'],
            'funcionarios_contrato' => $_REQUEST['funcionarios_contrato'],
            'funcionarios_salario' => moedaDolar($_REQUEST['funcionarios_salario']),
            'funcionarios_cargo' => $_REQUEST['funcionarios_cargo'],
            'funcionarios_usuarios_id' => $_REQUEST['funcionarios_usuarios_id']
        ];

        $this->funcionarios->update($_REQUEST['funcionarios_id'], $dataForm);
        $data['msg'] = msg('Alterado com Sucesso!','success');
        $data['funcionarios'] = $this->funcionarios->join('usuarios', 'funcionarios_usuarios_id = usuarios_id')->find();
        $data['title'] = 'Funcionarios';
        return view('Funcionarios/index',$data);
    }

    public function search()
    {
        //$data['produtos'] = $this->produtos->like('produtos_nome', $_REQUEST['pesquisar'])->find();
        $data['funcionarios'] = $this->funcionarios->join('usuarios', 'funcionarios_usuarios_id = usuarios_id')->like('funcionarios_contrato', $_REQUEST['pesquisar'])->orlike('funcionarios_cargo', $_REQUEST['pesquisar'])->find();
        $total = count($data['funcionarios']);
        $data['msg'] = msg("Dados Encontrados: {$total}",'success');
        $data['title'] = 'Funcionarios';
        return view('Funcionarios/index',$data);

    }

}