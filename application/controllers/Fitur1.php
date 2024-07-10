<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fitur1 extends CI_Controller 
{

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])-> row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('fitur/sontak',$data);
        $this->load->view('templates/footer');
    }
}