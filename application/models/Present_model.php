<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Present Model Class
 *
 * @package     SYSCMS
 * @subpackage  Models
 * @category    Models
 * @author      Achyar Anshorie
 */
class Present_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array()) {
        if (isset($params['id'])) {
            $this->db->where('present.present_id', $params['id']);
        }

        if (isset($params['year'])) {
            $this->db->where('present_year', $params['year']);
        }

        if (isset($params['month'])) {
            $this->db->where('present_month', $params['month']);
        }

        if (isset($params['date'])) {
            $this->db->where('present_date', $params['date']);
        }

        if (isset($params['desc'])) {
            $this->db->where('present_desc', $params['desc']);
        }

        if (isset($params['member_id'])) {
            $this->db->where('member_member_id', $params['member_id']);
        }

        if (isset($params['member_nip'])) {
            $this->db->where('member_member_nip', $params['member_nip']);
        }

        if (isset($params['date_start']) AND isset($params['date_end'])) {
            $this->db->where('present_date >=', $params['date_start'] . ' 00:00:00');
            $this->db->where('present_date <=', $params['date_end'] . ' 23:59:59');
        }

        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'desc');
        } else {
            $this->db->order_by('present_date', 'desc');
        }

        $this->db->select('present.present_id, present_year, present_month, present_date,
            present_entry_time, present_out_time, present_desc, present_is_late, present_is_before, 
            member_member_id, member_member_nip, member.member_full_name, member_image, member_input_date');
        $this->db->join('member', 'member.member_id = present.member_member_id', 'left');
        $res = $this->db->get('present');

        if (isset($params['id']) OR (isset($params['limit']) AND $params['limit'] == 1) OR (isset($params['date']) AND isset($params['member_nip']))) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    // Add and update to database
    function add($data = array()) {

        if (isset($data['present_id'])) {
            $this->db->set('present_id', $data['present_id']);
        }

        if (isset($data['present_year'])) {
            $this->db->set('present_year', $data['present_year']);
        }

        if (isset($data['present_month'])) {
            $this->db->set('present_month', $data['present_month']);
        }

        if (isset($data['present_date'])) {
            $this->db->set('present_date', $data['present_date']);
        }

        if (isset($data['present_entry_time'])) {
            $this->db->set('present_entry_time', $data['present_entry_time']);
        }

        if (isset($data['present_out_time'])) {
            $this->db->set('present_out_time', $data['present_out_time']);
        }

        if (isset($data['present_desc'])) {
            $this->db->set('present_desc', $data['present_desc']);
        }

        if (isset($data['present_is_late'])) {
            $this->db->set('present_is_late', $data['present_is_late']);
        }

        if (isset($data['present_is_before'])) {
            $this->db->set('present_is_before', $data['present_is_before']);
        }

        if (isset($data['member_member_id'])) {
            $this->db->set('member_member_id', $data['member_member_id']);
        }

        if (isset($data['member_member_nip'])) {
            $this->db->set('member_member_nip', $data['member_member_nip']);
        }

        if (isset($data['present_id'])) {
            $this->db->where('present_id', $data['present_id']);
            $this->db->update('present');
            $id = $data['present_id'];
        } else {
            $this->db->insert('present');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    // Delete to database
    function delete($id) {
        $this->db->where('present_id', $id);
        $this->db->delete('present');
    }

}
