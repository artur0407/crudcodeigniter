<?php

class Pacientes_model extends CI_Model
{
    public function index()
    {   
        $this->db->order_by("id", "desc");
        $pacientes = $this->db->get("paciente")->result_array();
        for($i=0; $i<count($pacientes); $i++) {
            $replace_date = str_replace('-', '/', $pacientes[$i]['data_nascimento']);
            $pacientes[$i]['data_nascimento'] = date("d/m/Y", strtotime($replace_date)); 
        }
        return $pacientes;
    }

    public function show($id)
    {   
        $result = $this->db->get_where("paciente", array("id" => $id ))->row_array();
        $replace_date = str_replace('-', '/', $result['data_nascimento']);
        $result['data_nascimento'] = date("d/m/Y", strtotime($replace_date)); 
        return $result;
    }

    public function store($paciente)
    {   
        $replace_date = str_replace('/', '-', $paciente['data_nascimento']);
        $paciente['data_nascimento'] = date("Y-m-d", strtotime($replace_date)); 
        $this->db->insert("paciente", $paciente);
    }

    public function update($id, $paciente)
    {   
        $this->db->where("id", $id);
        $replace_date = str_replace('/', '-', $paciente['data_nascimento']);
        $paciente['data_nascimento'] = date("Y-m-d", strtotime($replace_date)); 
        return $this->db->update("paciente", $paciente);
    }

    public function delete($id)
    {   
        $this->db->where("id", $id);
        return $this->db->delete("paciente");
    }
}