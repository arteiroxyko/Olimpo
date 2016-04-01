<?php

class m_login extends CI_Model {
    
    public function buscaUser(){
        $this->load->database();

        $query = "select * from usuarios where usuNome = '".$this->input->post('user',true)."' and usuSenha = '".md5($this->input->post('pass',true))."'";

        $user = $this->db->query($query);

        return $user->result();
    }    
}
?>
