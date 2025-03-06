<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Model{

    function consultar_carrusel()
    {
        $sql="exec pa_consultar_carrusel";
        $query=$this->db->query($sql);
        if($query!=false){
            if($query->num_rows()>0){
                return $query->result();
            }
        }else{
            return false;
        }
    }

    function consultar_secciones()
    {
        $sql="exec pa_consultar_secciones";
        $query=$this->db->query($sql);
        if($query!=false){
            if($query->num_rows()>0){
                return $query->result();
            }
        }else{
            return false;
        }
    }
}
