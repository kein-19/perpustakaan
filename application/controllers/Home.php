<?php

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_siswa_baru');
    }

    public function index()
    {
        $data['title'] = 'SMK MERAH PUTIH';
        $data['sekolah'] = 'SMK MERAH PUTIH';
        $data['tbl_siswa_baru'] = $this->Model_siswa_baru->getAllSiswaBaru();

        // $this->load->model('Model_siswa_baru', 'peoples');

        // $data['peoples'] = $this->peoples->getAllPeoples();

        // load library
        $this->load->library('pagination');

        // ambil data keyword
        // if( $this->input->post('submit') ) {
        //     $data['keyword'] = $this->input->post('keyword');
        //     $this->session->set_userdata('keyword', $data['keyword']);
        // } else {
        //     $data['keyword'] = $this->session->userdata('keyword');
        //     ;
        // }

        // config
        // $this->db->like('name', $data['keyword']);
        // $this->db->or_like('email', $data['keyword']);
        // $this->db->from('peoples');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;

        // initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        // $data['tbl_siswa_baru'] = $this->tbl_siswa_baru->getPeoples($config['per_page'], $data['start'], $data['keyword']);
        // $this->load->view('templates/header', $data);
        // $this->load->view('peoples/index', $data);
        // $this->load->view('templates/footer');


        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
