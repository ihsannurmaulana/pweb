<?php 
defined('BASEPATH') OR exit ('No direct script acces allowed');

class M_pweb extends CI_Model
{
	function read(){
		$this->db->order_by('nama_mahasiswa', 'Asc'); //untuk mengurutkan nama secara ascending
		return $this->db->get('tbl_nilai')->result_array();
	}

	function create(){
		$nilai1 = $this->input->post('n_pert1');
		$nilai2 = $this->input->post('n_pert2');
		$nilai3 = $this->input->post('n_pert3');
		$nilai4 = $this->input->post('n_pert4');
		$rata = ($nilai1 + $nilai2 + $nilai3 + $nilai4) / 4;

		if ($rata <= 75) {
			$keterangan = "Tidak Lulus";
		} elseif ($rata >= 75) {
			$keterangan = "Lulus";
		} else {
			$keterangan = "Nilai Tidak Valid";
		}

		$data = [
			'nama_mahasiswa' => $this->input->post('nama_mhs'),
			'nilai1' => $nilai1,
			'nilai2' => $nilai2,
			'nilai3' => $nilai3,
			'nilai4' => $nilai4,
			'rata' => $rata,
			'keterangan' => $keterangan
		];

		$this->db->insert('tbl_nilai', $data);
		if ($this->db->affected_rows() > 0){
			$this->session->set_flashdata('pesan', 'Ditambah');
			redirect('pweb', 'refresh');
		}
	}
    
}

 ?>