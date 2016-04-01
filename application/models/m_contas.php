<?php

class m_contas extends CI_Model {
    
    public function salvar($id){
        $this->load->database();
        $insert = array(
            'conNome' => $this->input->post('conNome'),
        );
        
        if($this->db->update('contas',$insert,array('conId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    public function gravar(){
        $this->load->database();
        $insert = array(
            'conNome' => $this->input->post('conNome'),
        );
        if($this->db->insert('contas',$insert)){
            return true;    
        }else{
            return false;    
        }
    }
    public function listar(){
        $this->load->database();
        $return =  $this->db->get('contas');
        return $return->result();
    }
    
    public function Buscar($id){
        $this->load->database();
        $return  = $this->db->get_where('contas',array('conId'=>$id));
        return $return->result();
    }
    
    public function excluir($id){
        $this->load->database();
        if($this->db->delete('contas',array('conId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    
}
?>