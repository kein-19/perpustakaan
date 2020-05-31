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

        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
