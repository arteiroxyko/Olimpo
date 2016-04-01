<?php

class m_categorias extends CI_Model {
    
    public function salvar($id){
        $this->load->database();
        $insert = array(
            'rcNome' => $this->input->post('rcNome'),
            'rcSaida' => $this->input->post('rcSaida'),
        );
        
        if($this->db->update('registrocategorias',$insert,array('rcId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    public function gravar(){
        $this->load->database();
        $insert = array(
            'rcNome' => $this->input->post('rcNome'),
            'rcSaida' => $this->input->post('rcSaida'),
        );
        if($this->db->insert('registrocategorias',$insert)){
            return true;    
        }else{
            return false;    
        }
    }
    public function listar(){
        $this->load->database();
        $return =  $this->db->get('registrocategorias');
        return $return->result();
    }
    
    public function Buscar($id){
        $this->load->database();
        $return  = $this->db->get_where('registrocategorias',array('rcId'=>$id));
        return $return->result();
    }
    public function buscaEntradas()
    {
        $this->load->database();
        $return =  $this->db->get_where('registrocategorias', array('rcSaida' => 0));
        return $return->result();
    }
    public function buscaSaidas()
    {
        $this->load->database();
        $return =  $this->db->get_where('registrocategorias', array('rcSaida' => 1));
        return $return->result();
    }
    public function excluir($id){
        $this->load->database();
        if($this->db->delete('registrocategorias',array('rcId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    
}
?>