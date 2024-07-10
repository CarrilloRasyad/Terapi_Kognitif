<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','trim|required');

        if($this->form_validation->run() == false){
            $this->load->view('templates/auth_header');
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //validasinya lolos
            $this->_login();
        }
    }


    private function _login()
    { 
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $users = $this->db->get_where('users', ['email'=> $email])-> row_array();

        // jika usernya ada
        if($users) {
            //jika usernya aktif
            if($users['is_active'] == 1) {
                // cek passwordnya
                if(password_verify($password, $users['password'])) {
                    $data = [
                        'email' => $users['email']
                    ];
                    $this->session->set_userdata($data);
                    redirect('user');
                }else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email atau Password salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum di aktivasi</div>');
                redirect('auth');
            }
        }else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('name','Name','required|trim');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[users.email]', 
        ['is_unique'=> 'Email ini telah digunakan!']);
        $this->form_validation->set_rules('password1','Password','required|trim|min_length[6]|matches[password2]',
        ['matches' => 'Password tidak sesuai!', 'min_length'=> 'Password terlalu pendek!']);
        $this->form_validation->set_rules('password2','Password','required|trim|matches[password1]');
        


        if( $this->form_validation->run() == false){
            $this->load->view('templates/auth_header');
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');

        }else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)), 
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT), 
                'is_active' => 0,
                'date_created'=> time()
            ];

            // siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('users', $data);
            $this->db->insert('user_token', $user_token);
            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">Selamat akun anda berhasil terdaftar!. Silahkan aktivasi akun anda</div>');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    { 
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'teluterapikognitif@gmail.com',
            'smtp_pass' => 'ltqqrxeuvbscmjdi',
            'smtp_port' =>  465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"

        ];

        $this->load->library('email',$config); 
        $this->email->initialize($config);
        $this->email->from('teluterapikognitif@gmail.com', 'Terapi Kognitif Universitas Telkom');
        $this->email->to($this->input->post('email'));

        if($type == 'verify') {
            $this->email->subject('Verifikasi Akun');
            $this->email->message('Klik link ini untuk mengaktivasi akun anda : <a href="'. base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        } else if($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Klik link ini untuk reset password anda : <a href="'. base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        
        if($user) { 
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            
            if($user_token) {
                if(time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('users');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="allert alert-success" role="alert">' . $email . ' telah aktif! Silahkan masuk.</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('users', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="allert alert-danger" role="alert">Gagal aktivasi akun! Token sudah expired</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="allert alert-danger" role="alert">Gagal aktivasi akun! Token salah</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="allert alert-danger" role="alert">Gagal aktivasi akun! Email salah</div>');
            redirect('auth');

        }
    }


    public function logout()
    {
        /** unset/destroy semua session */
        $this->session->sess_destroy();
        redirect('auth');
    }


    public function forgotPassword() 
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header');
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('users', ['email' => $email, 'is_active' => 1])->row_array();

            if($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                 'email' => $email,
                 'token' => $token,
                 'date_created' => time()   
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="allert alert-success" role="alert">Silahkan cek email anda untuk reset password anda!</div>');
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="allert alert-danger" role="alert">Email tidak terdaftar atau belum aktif!</div>');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="allert alert-danger" role="alert">Reset password gagal! Token salah</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="allert alert-danger" role="alert">Reset password gagal! Email salah</div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        if(!$this->session->userdata('reset_email')) {
            redirect('auth');
        }
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'trim|required|min_length[6]|matches[password1]');
        if($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header');
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('users');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="allert alert-success" role="alert">Password berhasil di ganti! Silahkan Masuk Kembali</div>');
            redirect('auth');
        }
    }

}