<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_buku extends CI_Model
{
    // get data seluruh siswa baru
    public function getAllBuku()
    {
        return $this->db->get('t_buku')->result_array();
    }

    public function getBuku()
    {
        return $this->db->get_where('t_buku', ['email' => $this->session->userdata('email')])->row_array();
    }

    // fitur untuk pagination
    public function getBukuLimit($limit, $start, $keyword = null)
    // public function getBukuLimit($limit, $start)
    {
        // untuk pencarian
        if ($keyword) {
            $this->db->like('isbn', $keyword);
            $this->db->or_like('judul', $keyword);
            $this->db->or_like('pengarang', $keyword);
            $this->db->or_like('penerbit', $keyword);
            $this->db->or_like('th_terbit', $keyword);
            $this->db->or_like('jml_hal', $keyword);
            $this->db->or_like('id_lokasi', $keyword);
        }
        // elseif ( $keyword == '1' ) {
        //     $this->db->like('is_active', $keyword);
        // }

        return $this->db->get('t_buku', $limit, $start)->result_array();
    }

    public function countAllBuku()
    {
        return $this->db->get('t_buku')->num_rows();
    }


    public function tambahDataBuku($idbuku)
    {

        $nama = $this->input->post('nama', TRUE);
        $email = $this->input->post('email', true);

        $data = [
            'id_buku'             => ($idbuku),
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
            'password' => password_hash($idbuku, PASSWORD_DEFAULT),
            'role_id' => 2,
            'is_active' => 1,
            'date_created' => time()
        ];
        $this->db->insert('t_buku', $data);
    }

    public function editDataBuku()
    {

        $nama = $this->input->post('nama', TRUE);
        $email = $this->input->post('email', true);
        $idbuku = $this->input->post('id_buku', true);

        $data = [
            'id_buku'             => ($idbuku),
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
            // 'password' => password_hash($this->input->post('id_buku', true), PASSWORD_DEFAULT),
            'password' => password_hash($idbuku, PASSWORD_DEFAULT),
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
                $old_image = $data['t_buku']['image'];
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }
                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
                // $this->Model_buku->editDataBuku($new_image);
            } else {
                echo $this->upload->dispay_errors();
            }
        }

        // $this->db->set('name', $data);

        // $this->db->set('image', $new_image);
        // $this->db->where('email', $email);
        $this->db->where('id_buku', $idbuku);
        $this->db->update('t_buku', $data);
    }
}
