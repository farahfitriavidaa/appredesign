<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_tb_user extends CI_Migration
{
    public function up()
    {
        $this->dbforge->modify_column('tb_user', array(
            'Password' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '60'
            )
        ));
    }

    public function down()
    {
        $this->dbforge->modify_column('tb_user', array(
            'Password' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '50'
            )
        ));
    }
}