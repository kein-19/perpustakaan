<?php
class Member extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Model_member');
    }

    public function index()
    {
        // sementara memakai if dulu 
        if (!$this->session->userdata('email')) {
            redirect('member/login');
        }

        $data['title'] = 'Home';
        $data['tbl_member'] = $this->Model_member->getMember();

        $this->load->view('templates/_partials/header', $data);
        $this->load->view('templates/_partials/sidebar', $data);
        $this->load->view('templates/_partials/topbar', $data);
        $this->load->view('member/index', $data);
        $this->load->view('templates/_partials/footer');
    }

    public function registration()
    {

        if ($this->session->userdata('email')) {
            redirect('member');
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('rt', 'RT', 'required|trim|numeric|max_length[3]');
        $this->form_validation->set_rules('rw', 'RW', 'required|trim|numeric|max_length[3]');
        $this->form_validation->set_rules('kelurahan', 'Kelurahan / Desa', 'required|trim');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'required|trim|numeric|min_length[10]|max_length[13]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_member.email]', [
            'is_unique' => 'Email sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('pendidikan', 'Pendidikan Terakhir', 'required|trim');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|trim');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pendaftaran Member Baru' . date('Y') . ' / ' . date('Y', strtotime('+1 years'));

            $data['judul'] = 'Pendaftaran Member Baru';
            $data['navbar'] = 'PERPUSTAKAAN DESA CIWARU';
            // $data['tbl_member'] = $this->Model_member->getMember();
            $this->load->view('templates/header', $data);
            $this->load->view('member/registration', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->select('RIGHT(tbl_member.id_member,4) as kode', false);
            $this->db->order_by('id_member', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get('tbl_member'); // cek sudah ada atau belum kodenya
            if ($query->num_rows() <> 0) {
                //jika kodenya sudah ada.      
                $data = $query->row();
                $kode = intval($data->kode) + 1;
            } else {
                //jika kodenya belum ada      
                $kode = 1;
            }

            // siapkan kode
            $thn = substr(date('Y'), 2, 2) . substr(date('Y', strtotime('+1 years')), 2, 2);
            $bln = date('md');
            $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
            $idmember = $thn . $bln . $kodemax;

            $this->Model_member->tambahDataMember($idmember);

            $this->session->set_flashdata('message', $idmember);
            redirect('member/registration');
        }
    }

    public function login()
    {

        // if ($this->session->userdata('email')) {
        //     redirect('member');
        // }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        // $this->form_validation->set_rules('id_member', 'Id Member', 'trim|required');
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
            $this->Model_member->checkLogin();
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil logout! Terima kasih</div>');
        redirect('member/login');
    }

    public function profile()
    {
        // $data['tbl_member'] = $this->Model_member->getMember();
        // $this->Model_member->getAgama();
        // $this->db->get('tbl_agama')->row_array();
        // $this->db->get_where('tbl_member', ['id_member' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'My Profile';
        $data['tbl_member'] = $this->Model_member->getMember();

        $this->load->view('templates/_partials/header', $data);
        $this->load->view('templates/_partials/sidebar', $data);
        $this->load->view('templates/_partials/topbar', $data);
        $this->load->view('member/profile', $data);
        $this->load->view('templates/_partials/footer');
    }

    public function editProfile()
    {
        $data['title'] = 'Edit Profile';
        $data['tbl_member'] = $this->Model_member->getMember();
        // $data['tbl_member'] = $this->Model_member->getAgama();
        // $data['nama_agama'] = $this->db->get('tbl_agama')->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('rt', 'RT', 'required|trim|numeric|max_length[3]');
        $this->form_validation->set_rules('rw', 'RW', 'required|trim|numeric|max_length[3]');
        $this->form_validation->set_rules('kelurahan', 'Kelurahan / Desa', 'required|trim');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'required|trim|numeric|min_length[10]|max_length[13]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan Terakhir', 'required|trim');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/_partials/header', $data);
            $this->load->view('templates/_partials/sidebar', $data);
            $this->load->view('templates/_partials/topbar', $data);
            $this->load->view('member/editprofile', $data);
            $this->load->view('templates/_partials/footer');
        } else {
            // $name = $this->input->post('name');
            // $email = $this->input->post('email');

            // $upload_image = $_FILES['image']['nama'];

            $this->Model_member->editDataMember();

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil Anda berhasil diupdate</div>');
            redirect('member/profile');
        }
    }
}
