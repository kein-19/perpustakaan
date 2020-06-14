<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member_baru extends CI_Controller
{

    // public function __construct()
    // {
    //     parent::__construct();
    //     if (!$this->session->userdata('email')) {
    //         redirect('index');
    //     }
    // }


    public function __construct()
    {
        parent::__construct();
        // sementara memakai if dulu 
        if (!$this->session->userdata('email')) {
            redirect('member/login');
        }

        // is_logged_in();

        //chekAksesModule();
        $this->load->library('form_validation');
        // $this->load->library('ssp');
        $this->load->model('Model_member');
    }


    public function index()
    {
        $data['title'] = 'Home';
        $data['tbl_member'] = $this->Model_member->getMember();

        $this->load->view('templates/_partials/header', $data);
        $this->load->view('templates/_partials/sidebar', $data);
        $this->load->view('templates/_partials/topbar', $data);
        $this->load->view('member/index', $data);
        $this->load->view('templates/_partials/footer');
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

        // $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
        //     'is_unique' => 'This email has already registered!'
        // ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        // $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
        //     'matches' => 'Password dont match!',
        //     'min_length' => 'Password too short!'
        // ]);
        // $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        // Data Orang Tua Member
        $this->form_validation->set_rules('nama', 'Nama Orang Tua/Wali', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat Orang Tua/Wali', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'required|trim|numeric|min_length[10]|max_length[13]');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan Terakhir', 'required|trim');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|trim');
        $this->form_validation->set_rules('penghasilan', 'Penghasilan', 'required|trim|numeric');

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

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil logout! Terima kasih</div>');
        redirect('member/login');
    }

    // function data()
    // {

    //     // nama tabel
    //     $table = 'tbl_siswa';
    //     // nama PK
    //     $primaryKey = 'nim';
    //     // list field
    //     $columns = array(
    //         array(
    //             'db' => 'foto',
    //             'dt' => 'foto',
    //             'formatter' => function ($d) {
    //                 if (empty($d)) {
    //                     return "<img width='30px' src='" .  base_url() . "/uploads/user-siluet.jpg'>";
    //                 } else {
    //                     return "<img width='20px' src='" .  base_url() . "/uploads/" . $d . "'>";
    //                 }
    //             }
    //         ),
    //         array('db' => 'nim', 'dt' => 'nim'),
    //         array('db' => 'nama', 'dt' => 'nama'),
    //         array('db' => 'tempat_lahir', 'dt' => 'tempat_lahir'),
    //         array('db' => 'tanggal_lahir', 'dt' => 'tanggal_lahir'),
    //         array(
    //             'db' => 'nim',
    //             'dt' => 'aksi',
    //             'formatter' => function ($d) {
    //                 //return "<a href='edit.php?id=$d'>EDIT</a>";
    //                 return anchor('siswa/edit/' . $d, '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"') . ' 
    //                     ' . anchor('siswa/delete/' . $d, '<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger tooltips" data-placement="top" data-original-title="Delete"');
    //             }
    //         )
    //     );

    //     $sql_details = array(
    //         'tbl_member' => $this->db->username,
    //         'pass' => $this->db->password,
    //         'db' => $this->db->database,
    //         'host' => $this->db->hostname
    //     );

    //     echo json_encode(
    //         SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
    //     );
    // }

    // function index()
    // {
    //     $this->template->load('template', 'siswa/list');
    // }

    // function add()
    // {
    //     if (isset($_POST['submit'])) {
    //         $uploadFoto = $this->upload_foto_siswa();
    //         $this->Model_siswa->save($uploadFoto);
    //         redirect('siswa');
    //     } else {
    //         $this->template->load('template', 'siswa/add');
    //     }
    // }

    // function edit()
    // {
    //     if (isset($_POST['submit'])) {
    //         $uploadFoto = $this->upload_foto_siswa();
    //         $this->Model_siswa->update($uploadFoto);
    //         redirect('siswa');
    //     } else {
    //         $nim           = $this->uri->segment(3);
    //         $data['siswa'] = $this->db->get_where('tbl_siswa', array('nim' => $nim))->row_array();
    //         $this->template->load('template', 'siswa/edit', $data);
    //     }
    // }

    // function delete()
    // {
    //     $nim = $this->uri->segment(3);
    //     if (!empty($nim)) {
    //         // proses delete data
    //         $this->db->where('nim', $nim);
    //         $this->db->delete('tbl_siswa');
    //     }
    //     redirect('siswa');
    // }

    // function upload_foto_siswa()
    // {
    //     $config['upload_path']          = './uploads/';
    //     $config['allowed_types']        = 'jpg|png';
    //     $config['max_size']             = 1024; // imb
    //     $this->load->library('upload', $config);
    //     // proses upload
    //     $this->upload->do_upload('userfile');
    //     $upload = $this->upload->data();
    //     return $upload['file_name'];
    // }


    // function siswa_aktif()
    // {
    //     $this->template->load('template', 'siswa/siswa_aktif');
    // }

    // function load_data_siswa_by_rombel()
    // {
    //     $rombel = $_GET['rombel'];

    //     echo "<table class='table table-bordered'>
    //         <tr><th width='90'>NIM</th><th>NAMA</th></tr>";
    //     $this->db->where('id_rombel', $rombel);
    //     $siswa = $this->db->get('tbl_siswa');
    //     foreach ($siswa->result() as $row) {
    //         echo "<tr><td>$row->nim</td><td>$row->nama</td></tr>";
    //     }
    //     echo "</table>";
    // }

    // function data_by_rombel_excel()
    // {
    //     $this->load->library('CPHP_excel');
    //     $objPHPExcel = new PHPExcel();
    //     $objPHPExcel->getActiveSheet()->setCellValue('A1', 'NIM');
    //     $objPHPExcel->getActiveSheet()->setCellValue('B1', 'SISWA');

    //     $rombel = $_POST['rombel'];
    //     $this->db->where('id_rombel', $rombel);
    //     $siswa = $this->db->get('tbl_siswa');
    //     $no = 2;
    //     foreach ($siswa->result() as $row) {
    //         $objPHPExcel->getActiveSheet()->setCellValue('A' . $no, $row->nim);
    //         $objPHPExcel->getActiveSheet()->setCellValue('B' . $no, $row->nama);
    //         $no++;
    //     }

    //     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    //     $objWriter->save("data-siswa.xlsx");
    //     $this->load->helper('download');
    //     force_download('data-siswa.xlsx', NULL);
    // }
}
