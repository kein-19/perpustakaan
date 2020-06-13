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
        $data['title'] = 'PERPUSTAKAAN DESA CIWARU';
        $data['navbar'] = 'PERPUSTAKAAN DESA CIWARU';

        // load library
        $this->load->library('pagination');

        // ambil data keyword
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            // $data['keyword'] = null;
            $data['keyword'] = $this->session->userdata('keyword');
        }

        // if ( $data['keyword'] == "sudah" ) {
        //     $this->db->where('is_active', '1');
        // }

        // config
        $this->db->like('kode_pendaftaran', $data['keyword']);
        $this->db->or_like('nama', $data['keyword']);
        $this->db->or_like('asal_sekolah', $data['keyword']);
        $this->db->or_like('alamat', $data['keyword']);
        // $this->db->or_like('is_active', $data['keyword']);
        $this->db->from('tbl_siswa_baru');
        $config['total_rows'] = $this->db->count_all_results();
        // $config['total_rows'] = $this->Model_siswa_baru->countAllSiswaBaru();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;

        // initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);

        $data['tbl_siswa_baru'] = $this->Model_siswa_baru->getSiswaBaruLimit($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
