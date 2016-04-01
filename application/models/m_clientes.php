<?php

class m_clientes extends CI_Model {
    

    public function salvar($id){
        $this->load->database();
        $insert = array(
            'cliNome' => $this->input->post('nome'),
            'cliMatricula' => $this->input->post('matricula'),
            'cliNascimento' => implode("-", array_reverse(explode("-", str_replace("/","-",$this->input->post('nascimento'))))),
            'cliTelefone1' => $this->input->post('telefone1'),
            'cliTelefone2' => $this->input->post('telefone2'),
        );
        
        if($this->db->update('clientes',$insert,array('cliid'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    public function gravar(){
        $this->load->database();
        $insert = array(
            'cliNome' => $this->input->post('nome'),
            'cliMatricula' => $this->input->post('matricula'),
            'cliNascimento' => implode("-", array_reverse(explode("-", str_replace("/","-",$this->input->post('nascimento'))))),
            'cliTelefone1' => $this->input->post('telefone1'),
            'cliTelefone2' => $this->input->post('telefone2'),
        );
        if($this->db->insert('clientes',$insert)){
            return true;    
        }else{
            return false;    
        }
    }
    public function listar(){
        $this->load->database();
        $return =  $this->db->get('clientes');
        return $return->result();
    }
    
    public function Buscar($id){
        $this->load->database();
        $return  = $this->db->get_where('clientes',array('cliid'=>$id));
        return $return->result();
    }

    public function buscaAniversariantes(){
        $this->load->database();
        $sql = "SELECT * FROM clientes WHERE date_format(cliNascimento,'%c') = date_format(now(),'%c')";
        $return = $this->db->query($sql);
        return $return->result();
    }
    
    public function excluir($id){
        $this->load->database();
        if($this->db->delete('clientes',array('cliid'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    
}
?>