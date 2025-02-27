<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_admin extends CI_Model
{

    public function getAdmin()
    {
        // return $this->db->get_where('tbl_member', ['id_member' => $this->session->userdata('email')])->row_array();
        return $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
    }


    public function checkLogin()
    {
        // $this->db->where('username', $username);
        // $this->db->where('password',  md5($password));
        // $user = $this->db->get('tbl_admin')->row_array();
        // return $user;

        $email = htmlspecialchars($this->input->post('email', TRUE));
        $password = htmlspecialchars($this->input->post('password', TRUE));

        $user = $this->db->get_where('tbl_admin', ['email' => $email])->row_array();

        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Anda Salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Mohon maaf akun anda belum diaktivasi!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar</div>');
            redirect('auth');
        }
    }

    public function tambahUser()
    {

        $email = $this->input->post('email', true);
        $data = [
            'nama_lengkap' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($email),
            'foto' => 'default.png',
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'role_id' => 1,
            'is_active' => 1,
            // 'is_active' => 1,
            'date_created' => time()
        ];

        // // siapkan token
        // $token = base64_encode(random_bytes(32));
        // $user_token = [
        //     'email' => $email,
        //     'token' => $token,
        //     'date_created' => time()
        // ];
        // var_dump($data);

        $this->db->insert('tbl_admin', $data);
        // $this->db->insert('user_token', $user_token);

        // $this->_sendEmail($token, 'verify');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat Anda sudah mendaftar sebagai Admin! Silahkan Login</div>');
        redirect('auth');
    }

    public function getRoleId($id)
    {
        return $this->db->get_where('t_user_role', ['id' => $id])->row_array();
    }

    public function deleteRole($id)
    {
        $this->db->delete('t_user_role', ['id' => $id]);
    }


    public function getMemberId($id_member)
    {
        return $this->db->get_where('tbl_member', ['id_member' => $id_member])->row_array();
    }

    public function addMember($idmember)
    {

        $nama = $this->input->post('nama', TRUE);
        $email = $this->input->post('email', true);

        $data = [
            'id_member'             => ($idmember),
            'nama'                  => htmlspecialchars($nama),
            'tempat_lahir'          => htmlspecialchars($this->input->post('tempat_lahir', TRUE)),
            'tanggal_lahir'         => htmlspecialchars($this->input->post('tanggal_lahir', TRUE)),
            'jenis_kelamin'         => $this->input->post('jenis_kelamin', TRUE),
            'kd_agama'              => $this->input->post('agama', TRUE),
            'alamat'                => htmlspecialchars($this->input->post('alamat', TRUE)),
            'rt'                    => htmlspecialchars($this->input->post('rt', TRUE)),
            'rw'                    => htmlspecialchars($this->input->post('rw', TRUE)),
            'kelurahan'             => htmlspecialchars($this->input->post('kelurahan', TRUE)),
            'kecamatan'             => htmlspecialchars($this->input->post('kecamatan', TRUE)),
            'no_hp'                 => htmlspecialchars($this->input->post('no_hp', TRUE)),
            'pendidikan'            => htmlspecialchars($this->input->post('pendidikan', TRUE)),
            'pekerjaan'             => htmlspecialchars($this->input->post('pekerjaan', TRUE)),

            // 'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($email),
            'image' => 'default.png',
            'password' => password_hash($idmember, PASSWORD_DEFAULT),
            'role_id' => 2,
            'is_active' => 1,
            'date_created' => time()
        ];
        $this->db->insert('tbl_member', $data);
    }

    public function editMember()
    {

        $nama = $this->input->post('nama', TRUE);
        $email = $this->input->post('email', true);
        // $idmember = $this->input->post('id_member');

        $is_active = $this->input->post('is_active', TRUE);
        // if ($is_active == 1) {
        //     $validasi = 'Aktif';
        // } elseif ($is_active == 0) {
        //     $validasi = 'Tidak Aktif';
        // }

        $data = [
            // 'id_member'      => ($idmember),
            'nama'                  => htmlspecialchars($nama),
            'tempat_lahir'          => htmlspecialchars($this->input->post('tempat_lahir', TRUE)),
            'tanggal_lahir'         => htmlspecialchars($this->input->post('tanggal_lahir', TRUE)),
            'jenis_kelamin'         => $this->input->post('jenis_kelamin', TRUE),
            'kd_agama'              => $this->input->post('agama', TRUE),
            'alamat'                => htmlspecialchars($this->input->post('alamat', TRUE)),
            'rt'                    => htmlspecialchars($this->input->post('rt', TRUE)),
            'rw'                    => htmlspecialchars($this->input->post('rw', TRUE)),
            'kelurahan'             => htmlspecialchars($this->input->post('kelurahan', TRUE)),
            'kecamatan'             => htmlspecialchars($this->input->post('kecamatan', TRUE)),
            'no_hp'                 => htmlspecialchars($this->input->post('no_hp', TRUE)),
            'pendidikan'            => htmlspecialchars($this->input->post('pendidikan', TRUE)),
            'pekerjaan'             => htmlspecialchars($this->input->post('pekerjaan', TRUE)),

            // 'name' => htmlspecialchars($this->input->post('name', true)),
            'email'                 => htmlspecialchars($email),
            'password'              => password_hash($this->input->post('tanggal_lahir'), PASSWORD_DEFAULT),
            'role_id'               => 2,
            'is_active'             => $is_active,
            // 'validasi'              => $validasi
            // 'validasi'              => $this->input->post('validasi', TRUE),
        ];

        // cek jika ada gambar yang akan diupload
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size']      = '2048';
            $config['upload_path'] = './assets/img/profile/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $old_image = $data['tbl_member']['image'];
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }
                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
                // $this->Model_member->editDataMember($new_image);
            } else {
                echo $this->upload->dispay_errors();
            }
        }

        // $this->db->set('name', $data);

        // $this->db->set('image', $new_image);
        $this->db->where('id_member', $this->input->post('id_member'));
        $this->db->update('tbl_member', $data);
    }

    public function deleteMember($id_member)
    {
        $this->db->delete('tbl_member', ['id_member' => $id_member]);
    }
}
