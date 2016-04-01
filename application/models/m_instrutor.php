<?php

class m_instrutor extends CI_Model {
    
    public function salvar($id){
        $this->load->database();
        $insert = array('insNome' => $this->input->post('nome'));
        
        if($this->db->update('instrutores',$insert,array('insId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    public function excluir($id){
        $this->load->database();
        if($this->db->delete('instrutores',array('insId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    public function gravar(){
        $this->load->database();
        $insert = array('insNome' => $this->input->post('nome'));
        if($this->db->insert('instrutores',$insert)){
            return true;    
        }else{
            return false;    
        }
    }
    
    public function listar(){
        $this->load->database();
        $return = $this->db->get('instrutores');
        return $return->result();
    }
    
    public function buscar($id){
        $this->load->database();
        $return  = $this->db->get_where('instrutores',array('insId'=>$id));
        return $return->result();
    }
  
}
?>