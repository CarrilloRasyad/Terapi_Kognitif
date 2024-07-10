<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller 
{

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])-> row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('fitur/myprofile',$data);
        $this->load->view('templates/footer');
    }
    public function update()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])-> row_array();

        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim');

        if($this->form_validation->run() == false) {
           $this->load->view('templates/header', $data);
           $this->load->view('fitur/myprofile',$data);
           $this->load->view('templates/footer');

        }else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('users');

            $this->session->set_flashdata('message', '<div class="allert alert-success" role="alert">Akun anda telah di ubah!</div>');
            redirect('profile');

        }
    }
}