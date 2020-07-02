<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // if (!$this->session->userdata('email')) {
        //     redirect('admin');
        // }

        $this->load->library('form_validation');
        $this->load->model('Model_admin');
        $this->load->model('Model_member');
    }


    public function index()
    {
        // is_logged_in();

        if (!$this->session->userdata('email')) {
            redirect('admin/login');
        }

        $data['title'] = 'Dashboard';
        $data['tbl_admin'] = $this->Model_admin->getAdmin();

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

        // config
        $this->db->like('id_member', $data['keyword']);
        $this->db->or_like('nama', $data['keyword']);
        $this->db->or_like('email', $data['keyword']);
        $this->db->or_like('kelurahan', $data['keyword']);
        $this->db->or_like('pendidikan', $data['keyword']);
        $this->db->or_like('pekerjaan', $data['keyword']);
        $this->db->from('tbl_member');
        $config['total_rows'] = $this->db->count_all_results();
        // $config['total_rows'] = $this->Model_siswa_baru->countAllSiswa();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;

        $root = "http://" . $_SERVER['HTTP_HOST'] . '/';
        $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
        $root .= 'admin/index';
        $config['base_url']    = "$root";
        // initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);

        // $data['tbl_siswa_baru'] = $this->Model_siswa_baru->getSiswaLimit($config['per_page'], $data['start'], $data['keyword']);

        $data['tbl_member'] = $this->Model_member->getMemberLimit($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/admin/footer');
    }

    public function login()
    {
        if ($this->session->userdata('email')) {
            redirect('admin');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {

            $data['title'] = 'Login - Sistem Informasi Perpustakaan';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('admin/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validasinya success
            // var_dump($data);
            $this->Model_admin->checkLogin();
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil logout! Terima kasih</div>');
        redirect('admin/login');
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('admin');
        }

        $this->form_validation->set_rules('name', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_admin.email]', [
            'is_unique' => 'Email sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak sesuai!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Daftar Sebagai Admin';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('admin/registration');
            $this->load->view('templates/auth_footer');
        } else {

            $this->Model_admin->tambahUser();
        }
    }

    // private function _sendEmail($token, $type)
    // {
    //     $config = [
    //         'protocol'  => 'smtp',
    //         'smtp_host' => 'ssl://smtp.googlemail.com',
    //         'smtp_user' => 'wpunpas@gmail.com',
    //         'smtp_pass' => '1234567890',
    //         'smtp_port' => 465,
    //         'mailtype'  => 'html',
    //         'charset'   => 'utf-8',
    //         'newline'   => "\r\n"
    //     ];

    //     $this->email->initialize($config);

    //     $this->email->from('wpunpas@gmail.com', 'Web Programming UNPAS');
    //     $this->email->to($this->input->post('email'));

    //     if ($type == 'verify') {
    //         $this->email->subject('Account Verification');
    //         $this->email->message('Click this link to verify you account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
    //     } else if ($type == 'forgot') {
    //         $this->email->subject('Reset Password');
    //         $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
    //     }

    //     if ($this->email->send()) {
    //         return true;
    //     } else {
    //         echo $this->email->print_debugger();
    //         die;
    //     }
    // }


    public function verify()
    {
        $email = $this->input->get('email');
        // $token = $this->input->get('token');

        $user = $this->db->get_where('tbl_admin', ['email' => $email])->row_array();

        // if ($user) {
        //     $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

        //     if ($user_token) {
        //         if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
        //             $this->db->set('is_active', 1);
        //             $this->db->where('email', $email);
        //             $this->db->update('user');

        //             $this->db->delete('user_token', ['email' => $email]);

        //             $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login.</div>');
        //             redirect('auth');
        //         } else {
        //             $this->db->delete('user', ['email' => $email]);
        //             $this->db->delete('user_token', ['email' => $email]);

        //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
        //             redirect('auth');
        //         }
        //     } else {
        //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong token.</div>');
        //         redirect('auth');
        //     }
        // } else {
        //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email.</div>');
        //     redirect('auth');
        // }
    }

    public function blocked()
    {
        $this->load->view('admin/blocked');
    }


    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('admin/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            // $email = $this->input->post('email');
            // $user = $this->db->get_where('tbl_admin', ['email' => $email, 'is_active' => 1])->row_array();

            // if ($user) {
            //     $token = base64_encode(random_bytes(32));
            //     $user_token = [
            //         'email' => $email,
            //         'token' => $token,
            //         'date_created' => time()
            //     ];

            //     $this->db->insert('user_token', $user_token);
            //     $this->_sendEmail($token, 'forgot');

            //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
            //     redirect('auth/forgotpassword');
            // } else {
            //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');
            //     redirect('auth/forgotpassword');
            // }
        }
    }


    public function resetPassword()
    {
        $email = $this->input->get('email');
        // $token = $this->input->get('token');

        $user = $this->db->get_where('tbl_admin', ['email' => $email])->row_array();

        // if ($user) {
        //     $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

        //     if ($user_token) {
        //         $this->session->set_userdata('reset_email', $email);
        //         $this->changePassword();
        //     } else {
        //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
        //         redirect('auth');
        //     }
        // } else {
        //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
        //     redirect('auth');
        // }
    }


    public function changePassword2()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('admin/login');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('admin/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('tbl_admin');

            $this->session->unset_userdata('reset_email');

            // $this->db->delete('user_token', ['email' => $email]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
            redirect('admin/login');
        }
    }

    public function add()
    {
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
            $data['tbl_admin'] = $this->Model_admin->getAdmin();
            $data['title'] = 'Tambah Data Member ';

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
            $bln = date('m');
            $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
            $idmember = $thn . $bln . $kodemax;

            $this->Model_admin->addMember($idmember);

            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('admin');
        }
    }

    public function detail($id_member)
    {

        $data['tbl_admin'] = $this->Model_admin->getAdmin();
        $data['title'] = 'Detail Data Member ';
        $data['tbl_member'] = $this->Model_admin->getMemberId($id_member);

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
            $data['tbl_admin'] = $this->Model_admin->getAdmin();
            $data['title'] = 'Edit Data Member';
            $data['tbl_member'] = $this->Model_admin->getMemberId($id_member);

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/edit', $data);
            $this->load->view('templates/admin/footer');
        } else {
            $this->Model_admin->editMember();
            $this->session->set_flashdata('flash', 'diupdate');
            redirect('admin');
        }
    }

    public function delete($id_member)
    {
        $this->Model_admin->deleteMember($id_member);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('admin');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();

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
        echo json_encode($this->Model_admin->getRoleId($id));
    }


    public function editrole()
    {
        $data['title'] = 'Role';
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('t_user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $data['tbl_admin'] = $this->Model_admin->getAdmin();

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
        $this->Model_admin->deleteRole($id);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('admin/role');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();

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
        $data['tbl_admin'] = $this->Model_admin->getAdmin();

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
            if (!password_verify($current_password, $data['tbl_admin']['password'])) {
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
                    $this->db->update('tbl_admin');

                    $this->session->set_flashdata('flash', 'diubah');
                    // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('admin/changepassword');
                }
            }
        }
    }
}
