<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BeasiswaModel');
        $this->load->model('JenisBeasiswaModel');
        // $this->load->model(array('BeasiswaModel','JenisBeasiswaModel'));
    }

    public function index()
    {
        $data['title'] = 'Data Beasiswa';
        $data['beasiswa'] = $this->BeasiswaModel->get_beasiswa();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('beasiswa/beasiswa_read', $data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {
        if ($this->input->post('create')) {
            $this->BeasiswaModel->insert_beasiswa();
            redirect('beasiswa');
        } else {
            $data['title'] = 'Tambah Data Beasiswa';
            $data['jenis_beasiswa'] = $this->JenisBeasiswaModel->get_jenis();
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('beasiswa/beasiswa_create', $data);
            $this->load->view('template/footer');
        }
    }

    public function ubah($id)
    {
        if ($this->input->post('update')) {
            $this->BeasiswaModel->update_beasiswa($id);
            redirect('beasiswa');
        } else {
            $data['title'] = 'Ubah Data Beasiswa';
            $data['beasiswa'] = $this->BeasiswaModel->get_beasiswa_by_id($id);
            $data['jenis_beasiswa'] = $this->JenisBeasiswaModel->get_jenis();
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('beasiswa/beasiswa_update', $data);
            $this->load->view('template/footer');
        }
    }

    public function hapus($id)
    {
        $this->BeasiswaModel->delete_beasiswa($id);
        redirect('beasiswa');
    }
}
