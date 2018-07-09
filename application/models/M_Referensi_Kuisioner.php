<?php 

class M_Referensi_Kuisioner extends CI_Model {
    function get_data() {
        $this->db->select('referensi_kuisioner.*, kategori_kuisioner.nama as kategori');
        $this->db->from('referensi_kuisioner');
        $this->db->join('kategori_kuisioner', 'kategori_kuisioner.id = referensi_kuisioner.id_kategori');
        return $this->db->get();
    }

    function tambah_field($column) {
        $this->load->dbforge();
        $field =array(
            'ref'.$column.'' => array(
                'type' => 'VARCHAR',
                'constraint' => '200'
            )
        );
        $this->dbforge->add_column('kuisioner', $field);
    }

    function hapus_field($column) {
        $this->load->dbforge();
        $this->dbforge->drop_column('kuisioner', 'ref'.$column.'');
    }

    function input_data($data, $table){
        $this->db->insert($table, $data);
	}

	function edit_data($where, $table){		
        return $this->db->get_where($table, $where);
    }

    function update_data($where, $data, $table){
		$this->db->where($where);
		$this->db->update($table, $data);
    }
    
    function hapus_data($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }
}