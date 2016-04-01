<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of c_instrutor
 *
 * @author Loki
 */
class c_instrutor extends CI_Controller{
    
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
        $this->load->view('instrutor/cadastraInstrutor');
        $this->load->view('footer/footer');        
    }
    public function editar($id){
        $this->load->model('m_instrutor');
        $data['instrutor'] = $this->m_instrutor->buscar($id);
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('instrutor/editaInstrutor',$data);
        $this->load->view('footer/footer');
    }
    public function listar()
    {
        $this->load->model('m_instrutor');
        $data['instrutores'] = $this->m_instrutor->listar();
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('instrutor/listaInstrutor',$data);
        $this->load->view('footer/footer');
    }
    
    //funcoes para gravar no banco de dados
    public function salvar($id){
        $this->load->model('m_instrutor');
        $this->m_instrutor->salvar($id);        
        $this->listar();
        
    }
    public function gravar(){
        $this->load->model('m_instrutor');
        if($this->m_instrutor->gravar()){        
            $this->listar();
        }else{
            $this->cadastrar();
        }
        
    }
    public function excluir($id){
        $this->load->model('m_instrutor');
        $this->m_instrutor->excluir($id);      
        $this->listar();
    }
    
}
