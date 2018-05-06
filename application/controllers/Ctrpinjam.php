<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrpinjam extends CI_Controller {

	public function __construct()
	{ 
		parent::__construct();
		$this->load->model('Pinjam');
	}
 
	public function index()
	{
		$data['Pinjam'] = $this->Pinjam->get_pinjaman();
		$this->load->view('TabelPinjaman', $data);
	}

	public function tambah()
	{
		$data = array(); 

		$this->load->library('form_validation');
		$this->form_validation->set_rules('besar_pinjaman', 'besar_pinjaman', 'required', array('required' => 'Isi %s terlebih dahulu , '));
		$this->form_validation->set_rules('tanggal_pinjaman', 'tanggal_pinjaman', 'required', array('required' => 'Isi %s terlebih dahulu, '));
		$this->form_validation->set_rules('tempat', 'tempat tanggal lahir', 'reuired', array('required' => 'Isi %s terlebih dahulu, '));
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

		$this->load->view('tambah_pinjam', $data);
			
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