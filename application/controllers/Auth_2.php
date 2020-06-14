<?php

class Auth_2 extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Model_admin');
    }

    public function index()
    {
        // if ($this->session->userdata('email')) {
        //     redirect('admin');
        // }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {

            $data['title'] = 'Login - Sistem Informasi Perpustakaan';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
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
        redirect('auth');
    }

    // public function chek_login()
    // {
    //     if (isset($_POST['submit'])) {
    //         // proses login disini

    //         $username = $this->input->post('username');
    //         $password = $this->input->post('password');
    //         $loginUser = $this->Model_admin->chekLogin($username, $password);
    //         $loginGuru = $this->Model_guru->chekLogin($username, $password);
    //         if (!empty($loginUser)) {
    //             // sukses login user
    //             $this->session->set_userdata($loginUser);
    //             redirect('siswa');
    //         } elseif (!empty($loginGuru)) {
    //             // login guru
    //             $session = array(
    //                 'nama_lengkap'  =>  $loginGuru['nama_guru'],
    //                 'id_level_user' =>  3,
    //                 'id_guru'       =>  $loginGuru['id_guru']
    //             );
    //             $this->session->set_userdata($session);
    //             redirect('jadwal');
    //         } else {
    //             // gagal login
    //             redirect('auth');
    //         }
    //     } else {
    //         redirect('auth');
    //     }
    // }




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
            $this->load->view('auth/registration');
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
        $this->load->view('auth/blocked');
    }


    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
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


    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
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
            redirect('auth');
        }
    }
}
