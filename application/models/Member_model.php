<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* Posts Model Class
 *
 * @package     SYSCMS
 * @subpackage  Models
 * @category    Models
 * @author      Achyar Anshorie
 */

class Member_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array())
    {
        if(isset($params['id']))
        {
            $this->db->where('member.member_id', $params['id']);
        }
        if(isset($params['member_nip']))
        {
            $this->db->where('member_nip', $params['member_nip']);
        }
        if(isset($params['username']))
        {
            $this->db->where('username', $params['username']);
        }
        if(isset($params['password']))
        {
            $this->db->where('password', $params['password']);
        }
        if(isset($params['member_full_name']))
        {
            $this->db->where('member_full_name', $params['member_full_name']);
        }
        if(isset($params['status']))
        {
            $this->db->where('member_status', $params['status']);
        }
        if(isset($params['date_start']) AND isset($params['date_end']))
        {
            $this->db->where('member_published_date >=', $params['date_start'] . ' 00:00:00');
            $this->db->where('member_published_date <=', $params['date_end'] . ' 23:59:59');
        }

        if(isset($params['limit']))
        {
            if(!isset($params['offset']))
            {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if(isset($params['order_by']))
        {
            $this->db->order_by($params['order_by'], 'desc');
        }
        else
        {
            $this->db->order_by('member_nip', 'desc');
        }

        $this->db->select('member.member_id, member_nip, username, password, member_full_name,
            member_sex, member_birth_place, member_birth_date, member_school, member_phone, member_address, 
            member_image, member_mentor, member_division, member_status, member_entry_date, member_end_date,
            member_score, member_input_date, member_last_update');
        $res = $this->db->get('member');
 
        if(isset($params['id']) OR (isset($params['limit']) AND $params['limit'] == 1) OR (isset($params['member_nip'])))
        {
            return $res->row_array();
        }
        else
        {
            return $res->result_array();
        }
    }

    // Add and update to database
    function add($data = array()) {
        
         if(isset($data['member_id'])) {
            $this->db->set('member_id', $data['member_id']);
        }
        
         if(isset($data['member_nip'])) {
            $this->db->set('member_nip', $data['member_nip']);
        }
        
         if(isset($data['username'])) {
            $this->db->set('username', $data['username']);
        }
        
         if(isset($data['password'])) {
            $this->db->set('password', $data['password']);
        }
        
         if(isset($data['member_full_name'])) {
            $this->db->set('member_full_name', $data['member_full_name']);
        }
        
         if(isset($data['member_sex'])) {
            $this->db->set('member_sex', $data['member_sex']);
        }
        
         if(isset($data['member_birth_place'])) {
            $this->db->set('member_birth_place', $data['member_birth_place']);
        }
        
         if(isset($data['member_birth_date'])) {
            $this->db->set('member_birth_date', $data['member_birth_date']);
        }
        
         if(isset($data['member_school'])) {
            $this->db->set('member_school', $data['member_school']);
        }
        
         if(isset($data['member_phone'])) {
            $this->db->set('member_phone', $data['member_phone']);
        }
        
         if(isset($data['member_address'])) {
            $this->db->set('member_address', $data['member_address']);
        }
        
         if(isset($data['member_image'])) {
            $this->db->set('member_image', $data['member_image']);
        }
        
         if(isset($data['member_mentor'])) {
            $this->db->set('member_mentor', $data['member_mentor']);
        }
        
         if(isset($data['member_division'])) {
            $this->db->set('member_division', $data['member_division']);
        }
        
         if(isset($data['member_status'])) {
            $this->db->set('member_status', $data['member_status']);
        }

        if(isset($data['member_entry_date'])) {
            $this->db->set('member_entry_date', $data['member_entry_date']);
        }

        if(isset($data['member_input_date'])) {
            $this->db->set('member_input_date', $data['member_input_date']);
        }
        
         if(isset($data['member_end_date'])) {
            $this->db->set('member_end_date', $data['member_end_date']);
        }
       
         if(isset($data['member_last_update'])) {
            $this->db->set('member_last_update', $data['member_last_update']);
        }
        
        if(isset($data['member_score'])) {
            $this->db->set('member_score', $data['member_score']);
        }

        if (isset($data['member_id'])) {
            $this->db->where('member_id', $data['member_id']);
            $this->db->update('member');
            $id = $data['member_id'];
        } else {
            $this->db->insert('member');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }
    
    // Delete to database
    function delete($id) {
        $this->db->where('member_id', $id);
        $this->db->delete('member');
    }
    
    function change_password($id, $params) {
        $this->db->where('member_id', $id);
        $this->db->update('member', $params);
    }
    
    
}
