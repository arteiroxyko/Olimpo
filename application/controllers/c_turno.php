<?php

/**
 * Description of c_turnos
 *
 * @author Loki
 */
class c_turno extends CI_Controller{
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
        $this->load->view('turnos/cadastraturnos');
        $this->load->view('footer/footer');        
    }
    public function editar($id){
        $this->load->model('m_turnos');
        $data['turnos'] = $this->m_turnos->buscar($id);
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('turnos/editaturnos',$data);
        $this->load->view('footer/footer');
    }
    public function listar()
    {
        $this->load->model('m_turnos');
        $data['turnos'] = $this->m_turnos->listar();
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('turnos/listaturnos',$data);
        $this->load->view('footer/footer');
    }
    
    //funcoes para gravar no banco de dados
    public function salvar($id){
        $this->load->model('m_turnos');
        $this->m_turnos->salvar($id);        
        header("location: ".site_url('c_turno/listar'));
    }
    public function gravar(){
        $this->load->model('m_turnos');
        if($this->m_turnos->gravar()){        
            header("location: listar");
        }else{
            header("location: cadastrar");
        }
        
    }
    public function excluir($id){
        $this->load->model('m_turnos');
        $this->m_turnos->excluir($id);      
        $this->listar();
    }
    
}
