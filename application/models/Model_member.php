<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_member extends CI_Model
{
    // get data seluruh siswa baru
    public function getAllMember()
    {
        return $this->db->get('tbl_member')->result_array();
    }

    public function getMember()
    {
        return $this->db->get_where('tbl_member', ['email' => $this->session->userdata('email')])->row_array();
    }

    // fitur untuk pagination
    public function getMemberLimit($limit, $start, $keyword = null)
    // public function getMemberLimit($limit, $start)
    {
        // untuk pencarian
        if ($keyword) {
            $this->db->like('id_member', $keyword);
            $this->db->or_like('nama', $keyword);
            $this->db->or_like('email', $keyword);
            $this->db->or_like('kelurahan', $keyword);
            $this->db->or_like('pendidikan', $keyword);
            $this->db->or_like('pekerjaan', $keyword);
        }
        // elseif ( $keyword == '1' ) {
        //     $this->db->like('is_active', $keyword);
        // }

        return $this->db->get('tbl_member', $limit, $start)->result_array();
    }

    public function countAllMember()
    {
        return $this->db->get('tbl_member')->num_rows();
    }



    public function checkLogin()
    {
        $email = htmlspecialchars($this->input->post('email', TRUE));
        $password = htmlspecialchars($this->input->post('password', TRUE));

        $member = $this->db->get_where('tbl_member', ['email' => $email])->row_array();

        // var_dump($password);

        // jika usernya ada
        if ($member) {
            // jika usernya aktif
            // if ($member['is_active'] == 0) {
            // cek password
            if ($password == $member['id_member']) {
                $data = [
                    'email' => $member['email'],
                    'role_id' => $member['role_id']
                ];

                $this->session->set_userdata($data);
                // if ($member['role_id'] == 1) {
                //     redirect('member');
                // } else {
                redirect('member');
                // }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Anda Salah!</div>');
                redirect('member/login');
            }
            // } else {
            //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Mohon maaf akun anda belum diaktivasi!</div>');
            //     redirect('member/login');
            // }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar</div>');
            redirect('member/login');
        }
    }

    public function tambahDataMember($idmember)
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

    public function editDataMember()
    {

        $nama = $this->input->post('nama', TRUE);
        $email = $this->input->post('email', true);
        $idmember = $this->input->post('id_member', true);

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
            // 'password' => password_hash($this->input->post('id_member', true), PASSWORD_DEFAULT),
            'password' => password_hash($idmember, PASSWORD_DEFAULT),
            'role_id' => 2,
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
        // $this->db->where('email', $email);
        $this->db->where('id_member', $idmember);
        $this->db->update('tbl_member', $data);
    }
}
