<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_paciente extends CI_Migration 
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nome_completo' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
            ),
            'nome_completo_mae' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'data_nascimento' => array(
                    'type' => 'DATE',
                    'null' => TRUE,
            ),
            'cpf' => array(
                'type' => 'VARCHAR',
                'constraint' => '14',
            ),
            'cns' => array(
                'type' => 'VARCHAR',
                'constraint' => '15',
            ),
            'cep' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'endereco' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'bairro' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'cidade' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'estado' => array(
                'type' => 'CHAR',
                'constraint' => '2',
            ),
            'numero' => array(
                'type' => 'INTEGER'
            ),
            'complemento' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'foto' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('paciente');
    }

    public function down()
    {
        $this->dbforge->drop_table('paciente');
    }
}