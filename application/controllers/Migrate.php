<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller
{
    public function index()
    {
        if (ENVIRONMENT === 'development') {
            if ($this->input->is_cli_request()) {

                $this->load->library('migration');

                if ($this->migration->current() === FALSE) {
                    show_error($this->migration->error_string());
                }
                else {
                    echo 'Migration(s) done'.PHP_EOL;
                }
            }
            else {
                header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
                die();
            }
        }
        else {
            echo 'Can not do migrate in current environment'.PHP_EOL;
        }
    }
}
