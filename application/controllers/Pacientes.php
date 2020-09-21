<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pacientes extends CI_Controller
{
    public function __construct()
    {  
        parent::__construct();
        $this->load->helper('security');
        $this->load->library('form_validation');
        $this->load->model("pacientes_model");
    }

	public function index()
	{
        $data["pacientes"] = $this->pacientes_model->index();
        $data["title"] = "Pacientes - Listagem";
        $data["buttonnew"] = "Paciente";
        $this->load->view('templates/header',   $data);
        $this->load->view('pages/pacientes',    $data);
        $this->load->view('templates/footer',   $data);
    }
    
    public function new()
	{
        $data["title"] = "Pacientes - Cadastro";
        $this->viewForm($data);
    }

    public function edit($id)
	{
        $data["paciente"] = $this->pacientes_model->show($id);
        $data["title"] = "Pacientes - Edição";
        $data["action"] = "edit";
        $this->viewForm($data);
    }

    public function view($id)
	{
        $data["paciente"] = $this->pacientes_model->show($id);
        $data["title"] = "Pacientes - Visualização";
        $data["action"] = "view";
        $this->viewForm($data);
    }
    
    public function store()
	{
       $this->validations();

       if ($this->form_validation->run() == false) {
           $this->new();
	   } else {
            $paciente = $_POST;
            $paciente["foto"] = !empty($_FILES["foto"]["name"]) ? $_FILES['foto'] : "";
            if (!empty($paciente["foto"])) {
                $paciente["foto"] = $this->uploadPicture();
            }
            $this->pacientes_model->store($paciente);
            $this->session->set_flashdata('sucesso','Paciente <b>cadastrado</b> com sucesso.');
            redirect("pacientes");
       }
    }

    public function update($id)
	{
        $this->validations();

        if ($this->form_validation->run() == false) {
            $this->edit($id);
        } else {
            /*
                Se vier arquivo em FILE, este é prioridade, se não vier NENHUM arquivo em FILE, verifica se o POST de foto não está vazio
                pois se não estiver vazio quer dizer que já existe uma foto para esse registro no banco e no diretorio upload 
                e mantem a mesma para update
            */
            $paciente = $_POST;
            $paciente["foto"] = !empty($_FILES["foto"]["name"]) ? $_FILES['foto'] : ""; 
            if (!empty($paciente["foto"])) {
                $paciente["foto"] = $this->uploadPicture();
            } else {
                if(!empty($_POST['foto'])) {
                    $paciente["foto"] = $_POST['foto'];
                }
            }
            $this->pacientes_model->update($id, $paciente);
            $this->session->set_flashdata('sucesso','Paciente <b>alterado</b> com sucesso.');
            redirect('pacientes');
        }
    }
    
    public function delete($id)
	{
        $this->pacientes_model->delete($id);
        $this->session->set_flashdata('sucesso','Paciente <b>deletado</b> com sucesso.');
        redirect('pacientes');
    }

    public function consultaCEP()
	{
        $cep = $this->input->post('cep');
        $this->load->library('curl');
		echo $this->curl->consulta($cep);
    }

    private function uploadPicture()
    {
        $pathBd = "foto_".date('d_m_Y_H_i_s').".jpg";

        $configuracao = array(
            'upload_path'   => APPPATH . "uploads/pacientes/",
            'allowed_types' => "jpg",
            'file_name'     => $pathBd,
            'max_size'      => "500"
        );

        $this->load->library('upload',$configuracao);
        $this->upload->initialize($configuracao);
        
        if ($this->upload->do_upload('foto')) {
            return $pathBd;
        }
    }
          
    private function validations()
    {
        $this->form_validation->set_rules("nome_completo", "Nome Completo", "required", 
            array('required' => 'Preencha o campo %s.'));
        $this->form_validation->set_rules("nome_completo_mae", "Nome Completo da Mãe", "required", 
            array('required' => 'Preencha o campo %s.'));
        $this->form_validation->set_rules("data_nascimento", "Data de Nascimento", "required|valid_date", 
            array('required' => 'Preencha o campo %s.'));
        $this->form_validation->set_rules("cpf", "CPF", "required|valid_cpf", 
            array('required' => 'Preencha o campo %s.'));
        $this->form_validation->set_rules("cns", "CNS", "required|valid_cns", 
            array('required' => 'Preencha o campo %s.'));
        $this->form_validation->set_rules("cep", "CEP", "required|valid_cep", 
            array('required' => 'Preencha o campo %s.',
            'valid_cep' => 'O %s digitado é inválido'));
        $this->form_validation->set_rules("endereco", "Endereço", "required", 
            array('required' => 'Preencha o campo %s.'));
        $this->form_validation->set_rules("bairro", "Bairro", "required", 
            array('required' => 'Preencha o campo %s.'));
        $this->form_validation->set_rules("cidade", "Cidade", "required", 
            array('required' => 'Preencha o campo %s.'));
        $this->form_validation->set_rules("estado", "Estado", "required", 
            array('required' => 'Preencha o campo %s.'));
    }

    private function viewForm($data)
    {
        $this->load->view('templates/header',       $data);
        $this->load->view('pages/form-pacientes',   $data);
        $this->load->view('templates/footer',       $data);
    }
}