<?php

class m_curso extends CI_Model {
    
    public function salvar($id){
        $this->load->database();
        $insert = array(
            'curNome' => $this->input->post('nome'),
            'curCursos' => $this->input->post('curso'),
            'curConteudo' => $this->input->post('conteudo'),
            'curCargHora' => $this->input->post('cargaHoraria'),
        );
        
        if($this->db->update('cursos',$insert,array('curId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    public function gravar(){
        $this->load->database();
        $insert = array(
            'curNome' => $this->input->post('nome'),
            'curCursos' => $this->input->post('curso'),
            'curConteudo' => $this->input->post('conteudo'),
            'curCargHora' => $this->input->post('cargaHoraria'),
        );
        if($this->db->insert('cursos',$insert)){
            return true;    
        }else{
            return false;    
        }
    }
    
    public function listar(){
        $this->load->database();
        $return =  $this->db->get('cursos');
        return $return->result();
    }
    
    public function Buscar($id){
        $this->load->database();
        $return  = $this->db->get_where('cursos',array('curId'=>$id));
        return $return->result();
    }
    public function excluir($id){
        $this->load->database();
        if($this->db->delete('cursos',array('curId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    
}
?>