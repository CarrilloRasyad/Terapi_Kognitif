<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terapi extends CI_Controller 
{

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])-> row_array();

        $this->load->view('templates/header',$data);
        $this->load->view('fitur/terapi');
        $this->load->view('templates/footer');
    }
}