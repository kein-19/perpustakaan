<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PrintDoc extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // sementara memakai if dulu 
        // $this->session->userdata('email');
        // elseif (is_logged_in()) {
        //     redirect('psb/login');
        // }

        // is_logged_in();

        //chekAksesModule();
        $this->load->library('form_validation');
        $this->load->library('ssp');
        $this->load->model('Model_siswa_baru');
        $this->load->model('Model_user');
    }

    public function index()
    {
        // $data = $this->load->view('mpdf_v');
        if (!$this->session->userdata('kode_pendaftaran')) {
            redirect('psb/login');
        }

        $data['title'] = 'My Profile';
        $data['tbl_siswa_baru'] = $this->Model_siswa_baru->getSiswaBaru();
        $this->load->view('siswa_baru/print', $data);
    }

    public function data($kode_pendaftaran)
    {
        // $data = $this->load->view('mpdf_v');
        // is_logged_in();

        $data['title'] = 'Detail Data Siswa Baru';
        $data['tbl_siswa_baru'] = $this->Model_user->getSiswaBaruId($kode_pendaftaran);
        // $data['tbl_siswa_baru'] = $this->Model_siswa_baru->getSiswaBaru();
        $this->load->view('admin/print', $data);
    }

    // public function printPDF()
    // {
    // $stylesheet = file_get_contents('assets/vendor/fontawesome-free/css/all.min.css');
    // $stylesheet = file_get_contents('assets/css/sb-admin-2.min.css');
    // $stylesheet = file_get_contents('assets/css/print.css');
    // $stylesheet = file_get_contents('style.css');

    //     $data = [
    //         'title' => 'My Profile',
    //         'tbl_siswa_baru' => $this->Model_siswa_baru->getSiswaBaru()
    //     ];
    //     $html = $this->load->view('siswa_baru/print', $data, TRUE);

    //     $mpdf = new \Mpdf\Mpdf();
    //     // $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    //     // $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
    //     $mpdf->WriteHTML($html);
    //     $mpdf->Output();
    // }

    // public function print()
    // {
    //     $mpdf = new \Mpdf\Mpdf();
    //     $html = $this->load->view('html_to_pdf', [], true);
    //     $mpdf->WriteHTML($html);
    //     $mpdf->Output();

    //     $data['title'] = 'My Profile';
    //     $data['tbl_siswa_baru'] = $this->Model_siswa_baru->getSiswaBaru();

    //     $this->load->view('templates/_partials/header', $data);
    //     $this->load->view('templates/_partials/topbar', $data);
    //     $this->load->view('siswa_baru/profile', $data);
    // }

}
