<?php

class m_fornecedores extends CI_Model {
    
    public function salvar($id){
        $this->load->database();
        $insert = array(
            'forNome' => $this->input->post('nome'),
            'forTelefone1' => $this->input->post('telefone1'),
            'forTelefone2' => $this->input->post('telefone2'),
        );
        
        if($this->db->update('fornecedores',$insert,array('forid'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    public function gravar(){
        $this->load->database();
        $insert = array(
            'forNome' => $this->input->post('nome'),
            'forTelefone1' => $this->input->post('telefone1'),
            'forTelefone2' => $this->input->post('telefone2'),
        );
        if($this->db->insert('fornecedores',$insert)){
            return true;    
        }else{
            return false;    
        }
    }
    public function listar(){
        $this->load->database();
        $return =  $this->db->get('fornecedores');
        return $return->result();
    }
    
    public function Buscar($id){
        $this->load->database();
        $return  = $this->db->get_where('fornecedores',array('forid'=>$id));
        return $return->result();
    }
    
    public function excluir($id){
        $this->load->database();
        if($this->db->delete('fornecedores',array('forid'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    
}
?>