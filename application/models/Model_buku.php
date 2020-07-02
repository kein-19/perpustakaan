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

    public function getBukuId($id_buku)
    {
        return $this->db->get_where('t_buku', ['id' => $id_buku])->row_array();
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


    public function addBuku()
    {

        $data = [
            'id_kelas'          => $this->input->post('kategori', TRUE),
            'id_jenis'          => $this->input->post('jenis', TRUE),
            'judul'             => htmlspecialchars($this->input->post('judul', TRUE)),
            'pengarang'         => htmlspecialchars($this->input->post('pengarang', TRUE)),
            'penerbit'          => htmlspecialchars($this->input->post('penerbit', TRUE)),
            'th_terbit'         => htmlspecialchars($this->input->post('th_terbit', TRUE)),
            'isbn'              => htmlspecialchars($this->input->post('isbn', TRUE)),
            'harga'             => htmlspecialchars($this->input->post('harga', TRUE)),
            'jml_hal'           => htmlspecialchars($this->input->post('jml_hal', TRUE)),
            'asal_perolehan'    => htmlspecialchars($this->input->post('asal_perolehan', TRUE)),
            'id_lokasi'         => $this->input->post('id_lokasi', TRUE),
            'stat'              => htmlspecialchars($this->input->post('stat', TRUE)),
            'deskripsi'         => htmlspecialchars($this->input->post('deskripsi', TRUE))

            // $data = [
            //     'id_member'             => ($idmember),
            //     'nama'                  => htmlspecialchars($nama),
            //     'tempat_lahir'          => htmlspecialchars($this->input->post('tempat_lahir', TRUE)),
            //     'tanggal_lahir'         => htmlspecialchars($this->input->post('tanggal_lahir', TRUE)),
            //     'jenis_kelamin'         => $this->input->post('jenis_kelamin', TRUE),
            //     'kd_agama'              => $this->input->post('agama', TRUE),
            //     'alamat'                => htmlspecialchars($this->input->post('alamat', TRUE)),
            //     'rt'                    => htmlspecialchars($this->input->post('rt', TRUE)),
            //     'rw'                    => htmlspecialchars($this->input->post('rw', TRUE)),
            //     'kelurahan'             => htmlspecialchars($this->input->post('kelurahan', TRUE)),
            //     'kecamatan'             => htmlspecialchars($this->input->post('kecamatan', TRUE)),
            //     'no_hp'                 => htmlspecialchars($this->input->post('no_hp', TRUE)),
            //     'pendidikan'            => htmlspecialchars($this->input->post('pendidikan', TRUE)),
            //     'pekerjaan'             => htmlspecialchars($this->input->post('pekerjaan', TRUE)),

            //     // 'name' => htmlspecialchars($this->input->post('name', true)),
            //     'email' => htmlspecialchars($email),
            //     'image' => 'default.png',
            //     'password' => password_hash($idmember, PASSWORD_DEFAULT),
            //     'role_id' => 2,
            //     'is_active' => 1,
            //     'date_created' => time()
        ];
        $this->db->insert(
            't_buku',
            $data
        );
    }

    public function editBuku()
    {

        $data = [
            'id_kelas'          => $this->input->post('kategori', TRUE),
            'id_jenis'          => $this->input->post('jenis', TRUE),
            'judul'             => htmlspecialchars($this->input->post('judul', TRUE)),
            'pengarang'         => htmlspecialchars($this->input->post('pengarang', TRUE)),
            'penerbit'          => htmlspecialchars($this->input->post('penerbit', TRUE)),
            'th_terbit'         => htmlspecialchars($this->input->post('th_terbit', TRUE)),
            'isbn'              => htmlspecialchars($this->input->post('isbn', TRUE)),
            'harga'             => htmlspecialchars($this->input->post('harga', TRUE)),
            'jml_hal'           => htmlspecialchars($this->input->post('jml_hal', TRUE)),
            'asal_perolehan'    => htmlspecialchars($this->input->post('asal_perolehan', TRUE)),
            'id_lokasi'         => $this->input->post('id_lokasi', TRUE),
            'stat'              => htmlspecialchars($this->input->post('stat', TRUE)),
            'deskripsi'         => htmlspecialchars($this->input->post('deskripsi', TRUE))

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
                $this->db->set(
                    'image',
                    $new_image
                );
                // $this->Model_member->editDataBuku($new_image);
            } else {
                echo $this->upload->dispay_errors();
            }
        }

        // $this->db->set('name', $data);

        // $this->db->set('image', $new_image);
        $this->db->where('id', $this->input->post('id'));
        $this->db->update(
            't_buku',
            $data
        );
    }

    public function deleteBuku($id_buku)
    {
        $this->db->delete(
            't_buku',
            ['id' => $id_buku]
        );
    }
}
