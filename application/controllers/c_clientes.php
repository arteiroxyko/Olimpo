<?php

/**
 * Description of c_clientes
 *
 * @author Loki
 */
class c_clientes extends CI_Controller{
    //put your code here
    function __construct() {
        parent::__construct();
        if (!isset($this->session->userdata['Ativo'])) {
            header('location: '.site_url());
        }
    }
    
    public function cadastrar(){
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('clientes/cadastraclientes');
        $this->load->view('footer/footer');        
    }
    public function editar($id){
        $this->load->model('m_clientes');
        $data['clientes'] = $this->m_clientes->buscar($id);
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('clientes/editaclientes',$data);
        $this->load->view('footer/footer');
    }
    public function listar()
    {
        $this->load->model('m_clientes');
        $data['clientes'] = $this->m_clientes->listar();
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('clientes/listaclientes',$data);
        $this->load->view('footer/footer');
    }
    
    //funcoes para gravar no banco de dados
    public function salvar($id){
        $this->load->model('m_clientes');
        $this->m_clientes->salvar($id);        
        $this->listar();
    }
    public function gravar(){
        $this->load->model('m_clientes');
        if($this->m_clientes->gravar()){        
            header("location: listar");
        }else{
            header("location: cadastrar");
        }
        
    }
    public function excluir($id){
        $this->load->model('m_clientes');
        $this->m_clientes->excluir($id);      
        $this->listar();
    }
    
}
