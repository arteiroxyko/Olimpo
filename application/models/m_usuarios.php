<?php

class m_usuarios extends CI_Model {
    
    public function salvar($id){
        $this->load->database();
        if(empty($this->input->post('usuSenha',true))){
            $insert = array(
                'usuNome' => $this->input->post('usuNome',true),
                'conId' => $this->input->post('conId',true),
                'perId' => $this->input->post('perId',true),
            );
        }else{
            $insert = array(
                'usuNome' => $this->input->post('usuNome',true),
                'usuSenha' => md5($this->input->post('usuSenha',true)),
                'conId' => $this->input->post('conId',true),
                'perId' => $this->input->post('perId',true),
            );
        }
        if($this->db->update('usuarios',$insert,array('usuId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    public function gravar(){
        $this->load->database();
        $insert = array(
            'usuNome' => $this->input->post('usuNome',true),
            'usuSenha' => md5($this->input->post('usuSenha',true)),
            'conId' => $this->input->post('conId',true),
            'perId' => $this->input->post('perId',true),
        );
        if($this->db->insert('usuarios',$insert)){
            return true;    
        }else{
            return false;    
        }
    }
    public function listar(){
        $this->load->database();
        $return =  $this->db->get('usuarios');
        return $return->result();
    }
    
    public function Buscar($id){
        $this->load->database();
        $return  = $this->db->get_where('usuarios',array('usuId'=>$id));
        return $return->result();
    }
    
    public function excluir($id){
        $this->load->database();
        if($this->db->delete('usuarios',array('usuId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    
}
?>