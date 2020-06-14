<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        is_logged_in();

        $this->load->library('form_validation');
        $this->load->model('Model_user');
        $this->load->model('Model_member');
    }


    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['tbl_user'] = $this->Model_user->getAdmin();
        $data['tbl_member'] = $this->Model_member->getAllMember();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/admin/footer');
    }

    public function add()
    {
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

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_member.email]', [
            'is_unique' => 'Email sudah terdaftar!'
        ]);

        // Data Orang Tua Member
        $this->form_validation->set_rules('nama', 'Nama Orang Tua/Wali', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat Orang Tua/Wali', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'required|trim|numeric|min_length[10]|max_length[13]');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan Terakhir', 'required|trim');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|trim');
        $this->form_validation->set_rules('penghasilan', 'Penghasilan', 'required|trim|numeric');


        if ($this->form_validation->run() == false) {
            $data['tbl_user'] = $this->Model_user->getAdmin();
            $data['title'] = 'Tambah Data Member Baru';

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/add', $data);
            $this->load->view('templates/admin/footer');
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

            $this->Model_user->addMember($idmember);

            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('admin');
        }
    }

    public function detail($id_member)
    {

        $data['tbl_user'] = $this->Model_user->getAdmin();
        $data['title'] = 'Detail Data Member Baru';
        $data['tbl_member'] = $this->Model_user->getMemberId($id_member);

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/detail', $data);
        $this->load->view('templates/admin/footer');
    }


    public function edit($id_member)
    {

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

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        // Data Orang Tua Member
        $this->form_validation->set_rules('nama', 'Nama Orang Tua/Wali', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat Orang Tua/Wali', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'required|trim|numeric|min_length[10]|max_length[13]');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan Terakhir', 'required|trim');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|trim');
        $this->form_validation->set_rules('penghasilan', 'Penghasilan', 'required|trim|numeric');

        if ($this->form_validation->run() == false) {
            $data['tbl_user'] = $this->Model_user->getAdmin();
            $data['title'] = 'Edit Data Member Baru';
            $data['tbl_member'] = $this->Model_user->getMemberId($id_member);

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/edit', $data);
            $this->load->view('templates/admin/footer');
        } else {
            $this->Model_user->editMember();
            $this->session->set_flashdata('flash', 'diupdate');
            redirect('admin');
        }
    }

    public function delete($id_member)
    {
        $this->Model_user->deleteMember($id_member);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('admin');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['tbl_user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('t_user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/admin/footer');
        } else {
            $this->db->insert('t_user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('flash', 'ditambahkan');

            redirect('admin/role');
        }
    }

    public function geteditrole()
    {
        $id = $this->input->post('id');
        echo json_encode($this->Model_user->getRoleId($id));
    }


    public function editrole()
    {
        $data['title'] = 'Role';
        $data['tbl_user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('t_user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $data['tbl_user'] = $this->Model_user->getAdmin();

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/admin/footer');
        } else {
            $data = [
                'role' => $this->input->post('role')
            ];
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('t_user_role', $data);
            $this->session->set_flashdata('flash', 'diubah');

            redirect('admin/role');
        }
    }

    public function deleterole($id)
    {
        $this->Model_user->deleteRole($id);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('admin/role');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['tbl_user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('t_user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('t_user_menu')->result_array();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/admin/footer');
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('t_user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('t_user_access_menu', $data);
        } else {
            $this->db->delete('t_user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }


    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['tbl_user'] = $this->Model_user->getAdmin();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/changepassword', $data);
            $this->load->view('templates/admin/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['tbl_user']['password'])) {
                $this->session->set_flashdata('flash', 'salah');
                // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('admin/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('flash', 'sama');
                    // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('admin/changepassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('tbl_user');

                    $this->session->set_flashdata('flash', 'diubah');
                    // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('admin/changepassword');
                }
            }
        }
    }
}
