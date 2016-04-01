<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of c_curso
 *
 * @author Loki
 */
class c_curso extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        if (!isset($this->session->userdata['Ativo'])) {
            header('location: '.site_url());
        }
    }
    //put your code here
    public function cadastrar(){
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('curso/cadastraCurso');
        $this->load->view('footer/footer');        
    }
    public function editar($id){
        $this->load->model('m_curso');
        $data['curso'] = $this->m_curso->buscar($id);
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('curso/editaCurso',$data);
        $this->load->view('footer/footer');
    }
    public function listar()
    {
        $this->load->model('m_curso');
        $data['cursos'] = $this->m_curso->listar();
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('curso/listaCurso',$data);
        $this->load->view('footer/footer');
    }
    
    //funcoes para gravar no banco de dados
    public function salvar($id){
        $this->load->model('m_curso');
        $this->m_curso->salvar($id);        
        $this->listar();
    }
    public function gravar(){
        $this->load->model('m_curso');
        if($this->m_curso->gravar()){        
            $this->listar();
        }else{
            $this->cadastrar();
        }
        
    }
    public function excluir($id){
        $this->load->model('m_curso');
        $this->m_curso->excluir($id);      
        $this->listar();
    }
    
}
