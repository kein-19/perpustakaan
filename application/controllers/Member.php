<?php
class Member extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Model_siswa_baru');
    }

    public function index()
    {

        if ($this->session->userdata('kode_pendaftaran')) {
            redirect('siswa_baru');
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');

        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
        $this->form_validation->set_rules('warganegara', 'Kewarganegaraan', 'required');
        $this->form_validation->set_rules('statussiswa', 'Status Member', 'required');
        $this->form_validation->set_rules('anak_ke', 'Anak ke', 'required|trim|numeric|max_length[3]');
        $this->form_validation->set_rules('dari__bersaudara', 'dari bersaudara', 'required|trim|numeric|max_length[3]');
        $this->form_validation->set_rules('jumlah_saudara', 'Jumlah Saudara', 'required|trim|numeric|max_length[3]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('rt', 'RT', 'required|trim|numeric|max_length[3]');
        $this->form_validation->set_rules('rw', 'RW', 'required|trim|numeric|max_length[3]');
        $this->form_validation->set_rules('kelurahan', 'Kelurahan / Desa', 'required|trim');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'required|trim|numeric|min_length[10]|max_length[13]');
        $this->form_validation->set_rules('tinggalbersama', 'Tinggal Bersama dengan', 'required');
        $this->form_validation->set_rules('jarak', 'Jarak Rumah ke Sekolah', 'required|trim|numeric');
        $this->form_validation->set_rules('transport', 'Ke Sekolah dengan', 'required');
        $this->form_validation->set_rules('jurusan', 'Kompetensi Keahlian', 'required');
        $this->form_validation->set_rules('asal_sekolah', 'Asal Sekolah', 'required|trim');
        $this->form_validation->set_rules('nisn', 'Nomor Induk Member Nasional (NISN)', 'required|trim|numeric|exact_length[10]');
        $this->form_validation->set_rules('no_sttb', 'Tanggal/Tahun/No.STTB', 'required|trim');

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_siswa_baru.email]', [
            'is_unique' => 'Email sudah terdaftar!'
        ]);
        // $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
        //     'is_unique' => 'This email has already registered!'
        // ]);
        // $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        // $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
        //     'matches' => 'Password dont match!',
        //     'min_length' => 'Password too short!'
        // ]);
        // $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        // Data Orang Tua Member
        $this->form_validation->set_rules('nama_ot', 'Nama Orang Tua/Wali', 'required|trim');
        $this->form_validation->set_rules('alamat_ot', 'Alamat Orang Tua/Wali', 'required|trim');
        $this->form_validation->set_rules('no_hp_ot', 'No. HP', 'required|trim|numeric|min_length[10]|max_length[13]');
        $this->form_validation->set_rules('pendidikan_ot', 'Pendidikan Terakhir', 'required|trim');
        $this->form_validation->set_rules('pekerjaan_ot', 'Pekerjaan', 'required|trim');
        $this->form_validation->set_rules('penghasilan_ot', 'Penghasilan', 'required|trim|numeric');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pendaftaran Member Baru' . date('Y') . ' / ' . date('Y', strtotime('+1 years'));

            $data['judul'] = 'Pendaftaran Member Baru';
            $data['navbar'] = 'PERPUSTAKAAN DESA CIWARU';
            // $data['tbl_siswa_baru'] = $this->Model_siswa_baru->getMemberBaru();
            $this->load->view('templates/header', $data);
            $this->load->view('member/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->select('RIGHT(tbl_siswa_baru.kode_pendaftaran,4) as kode', false);
            $this->db->order_by('kode_pendaftaran', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get('tbl_siswa_baru'); // cek sudah ada atau belum kodenya
            if ($query->num_rows() <> 0) {
                //jika kodenya sudah ada.      
                $data = $query->row();
                $kode = intval($data->kode) + 1;
            } else {
                //jika kodenya belum ada      
                $kode = 1;
            }

            // siapkan kode
            $thn = substr(date('Y'), 2, 2) . "-" . substr(date('Y', strtotime('+1 years')), 2, 2);
            $bln = date('md');
            $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
            $fixkode = $thn . "-PSB-" . $bln . $kodemax;

            $this->Model_siswa_baru->tambahDataMemberBaru($fixkode);

            $this->session->set_flashdata('message', $fixkode);
            redirect('psb');
        }
    }

    public function login()
    {

        // if ($this->session->userdata('email')) {
        //     redirect('siswa_baru');
        // }
        $this->form_validation->set_rules('kode_pendaftaran', 'Nomor Formulir', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login - Member';

            // $data['judul'] = 'Login - Member Baru';
            $data['navbar'] = 'PERPUSTAKAAN DESA CIWARU';
            $this->load->view('templates/header', $data);
            $this->load->view('member/login', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // validasinya success
            $this->Model_siswa_baru->checkLogin();
        }
    }
}
