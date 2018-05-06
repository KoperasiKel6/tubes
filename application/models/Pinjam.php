<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjam extends CI_Model {

	public function get_pinjaman(){
		$query = $this->db->get('pinjaman');
		return $query->result_array();
	}
	public function get_single_pinjaman($id)
	{
		$query = $this->db->query('SELECT * from pinjaman WHERE id_pinjaman='.$id);
		return $query->result();
	}

	

	public function insert()
	{
		$data = array(
			'id_pinjaman' => '',
			'besar_pinjaman' => $this->input->post('besar_pinjaman'),
			'tanggal_pinjaman' => $this->input->post('tanggal_pinjaman'),
			'id_anggota' => $this->input->post('id_anggota'),
			'id_angsuran' => $this->input->post('id_angsuran'),
			'tanggal_pelunasan' => $this->input->post('tanggal_pelunasan')
		);

		$this->db->insert('pinjaman', $data);
	}

	public function update($id){
			$data = array(
				'besar_pinjaman' => $this->input->post('besar_pinjaman'),
				'tanggal_pinjaman' => $this->input->post('tanggal_pinjaman'),
				'id_anggota' => $this->input->post('id_anggota'),
				'tangga_pelunasan' => $this->input->post('tanggal_pelunasan'),
			);

		$this->db->where('id_pinjaman',$id);
		$this->db->update('pinjaman', $data);
	}


	public function delete($id){
		$query = $this->db->query('DELETE from anggota WHERE id_anggota= '.$id);
	}
}