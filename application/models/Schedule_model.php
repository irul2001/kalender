<?php
class Schedule_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_schedules($month, $year) {
        $this->db->where('MONTH(date)', $month);
        $this->db->where('YEAR(date)', $year);
        $query = $this->db->get('schedules');
        return $query->result_array();
    }

    public function add_schedule($data) {
        return $this->db->insert('schedules', $data);
    }

    public function get_schedule($id) {
        $query = $this->db->get_where('schedules', array('id' => $id));
        return $query->row_array();
    }

    public function update_schedule($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('schedules', $data);
    }

    public function delete_schedule($id) {
        $this->db->where('id', $id);
        return $this->db->delete('schedules');
    }
}
