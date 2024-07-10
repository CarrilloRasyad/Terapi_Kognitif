<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kuis_model extends CI_Model {
    public function get_random_questions($limit) {
        $this->db->order_by('RAND()'); // Mengurutkan acak
        $this->db->limit($limit); // Ambil sejumlah pertanyaan acak sesuai limit
        return $this->db->get('pertanyaan')->result_array();
    }

    public function get_image($pertanyaan_id) {
        return $this->db->get_where('pertanyaan', ['id' => $pertanyaan_id])->row('image');
    }

    public function get_correct_answer($pertanyaan_id) {
        return $this->db->get_where('pertanyaan', ['id' => $pertanyaan_id])->row('correct_answer');
    }
}