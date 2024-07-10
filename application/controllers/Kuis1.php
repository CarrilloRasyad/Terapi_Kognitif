<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuis1 extends CI_Controller 
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Kuis_model'); // Memuat model Kuiz_model
        $this->load->library('session'); // Memuat library session
        /** redirect2login jika tidak ada session auth */
        if (!$this->session->userdata('email'))
            redirect('auth'); 
    }

    public function index() {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])-> row_array();

        /** menampung skor */
        if (!$this->session->userdata('score'))
            $this->session->set_userdata('score', 0);
        /** tampungan index dari quiz */
        if (!$this->session->userdata('quiz_index')) //kan data quesions itu bentuknya array, ada (misal) 10 data, index arraynya 0 - 9
                                                    //quiz_indez itu untuk menentukan question mana yang akan tampil dihalaman jawab soal
            $this->session->set_userdata('quiz_index', 0);
        /** tampungan kunci jawaban */
        if (!$this->session->userdata('user_answered'))
            $this->session->set_userdata('user_answered', array());
        
        /** get data berdasarkan limit, set di konstanta constant.php */
        $random_questions = $this->Kuis_model->get_random_questions(QUIZ_LIMIT);

        if (!$this->session->userdata('random_questions')) {
            $this->session->set_userdata('random_questions', $random_questions);
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('kuis/menjawab');
        $this->load->view('templates/footer');
    }

    public function answer() {
        $user_answer = $this->input->post('user_answer');

        $pertanyaan_id = $this->input->post('pertanyaan_id');
        $image = $this->Kuis_model->get_image($pertanyaan_id);
        $correct_answer = $this->Kuis_model->get_correct_answer($pertanyaan_id);

        /** periksa jawaban benar, parsing menjadi huruf kecil semua, menghindari case-insensitif
         * misal aPel = Apel (false positive)
         */
        if (strtolower($user_answer) === strtolower($correct_answer)) {
            $this->session->set_userdata('score', $this->session->userdata('score') + 1);
        }

        /** get data kunci jawaban, bentuknya himpunan/array */
        $user_answered = $this->session->userdata('user_answered');
        /** gabungkan kunci jawaban yang ada dengan kunci jawaban baru */
        array_push($user_answered, [
            'pertanyaan_id' => $pertanyaan_id,
            'user_answer' => $user_answer,
            'correct_answer' => $correct_answer,
            'image' => $image
        ]);
        $this->session->set_userdata('user_answered', $user_answered);
        $this->session->set_userdata('quiz_index', $this->session->userdata('quiz_index') + 1);

        $submit_type = $this->input->post('submit');
        if ($submit_type === "next") {
            redirect('kuis1');
        } else {
            redirect('kuis1/result');
        }
    }

    public function result() {
        $data = [
            'users' => $this->db->get_where('users', ['email' => $this->session->userdata('email')])-> row_array(),
            'score' => $this->session->userdata('score'),
            'user_answered' => $this->session->userdata('user_answered'),
            'wrong_answer' => QUIZ_LIMIT - $this->session->userdata('score'),
        ];
        
        $this->load->view('templates/header',$data);
        $this->load->view('kuis/hasil', $data);
        $this->load->view('templates/footer');
    }

    public function restart() {
        $this->reset_session();
        redirect('kuis1');
    }

    private function reset_session() {
        /** unset session tertentu */
        $this->session->unset_userdata('score');
        $this->session->unset_userdata('quiz_index');
        $this->session->unset_userdata('user_answered');
        $this->session->unset_userdata('random_questions');
    }
}