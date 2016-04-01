<?php

class m_turnos extends CI_Model {
    
    public function salvar($id){
        $this->load->database();
        $insert = array(
            'turNome' => $this->input->post('turNome'),
            'turIni' => $this->input->post('turIni'),
            'turFim' => $this->input->post('turFim'),
        );
        
        if($this->db->update('turnos',$insert,array('turId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    public function gravar(){
        $this->load->database();
        $insert = array(
            'turNome' => $this->input->post('turNome'),
            'turIni' => $this->input->post('turIni'),
            'turFim' => $this->input->post('turFim'),
        );
        if($this->db->insert('turnos',$insert)){
            return true;    
        }else{
            return false;    
        }
    }
    public function listar(){
        $this->load->database();
        $return =  $this->db->get('turnos');
        return $return->result();
    }
    
    public function Buscar($id){
        $this->load->database();
        $return  = $this->db->get_where('turnos',array('turId'=>$id));
        return $return->result();
    }
   
    public function excluir($id){
        $this->load->database();
        if($this->db->delete('turnos',array('turId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    
}
?>