<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrNasabah extends CI_Controller {

	public function __construct()
	{ 
		parent::__construct();
		$this->load->model('nasabah');
	}
 
	public function index()
	{
		$data['nasabah'] = $this->nasabah->get_file();
		$this->load->view('TabelAnggota', $data);
	}

	public function tambah()
	{
		$data = array();
		// $data['jk']=$this->db->anggota('anggota','jk_anggota');
		// $data['nasabah'] = $this->nasabah->get_all_nasabah(); 

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'nama', 'required', array('required' => 'Isi %s terlebih dahulu , '));
		$this->form_validation->set_rules('alamat', 'alamat', 'required', array('required' => 'Isi %s terlebih dahulu, '));
		$this->form_validation->set_rules('tempat', 'tempat tanggal lahir', 'required', array('required' => 'Isi %s terlebih dahulu, '));
		$this->form_validation->set_rules('tanggal', 'tanggal lahir', 'required', array('required' => 'Isi %s terlebih dahulu, '));
		$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'required', array('required' => 'Isi %s terlebih dahulu, '));

		if ($this->form_validation->run()==FALSE){
			$this->load->view('tambah_nasabah', $data);
		}
		else
		{
			if ($this->input->post('simpan')) {
			$upload = $this->nasabah->upload();

			if ($upload['result'] == 'success') {
				$this->nasabah->insert($upload);
				redirect('CtrNasabah');
			}else{
				$data['message'] = $upload['error'];
			}

		}

		$this->load->view('TabelAnggota', $data);
			
		}
	}

	public function delete($id){
		$this->nasabah->delete($id);
		redirect('CtrNasabah');
	}

	public function edit($id){
		$data['single'] = $this->nasabah->get_single($id);

		if($this->input->post('edit')){
			$upload=$this->nasabah->upload();
			$this->nasabah->update($upload,$id);
			redirect('CtrNasabah');
		}
		

		$this->load->view('edit_nasabah',$data);
	}
}
