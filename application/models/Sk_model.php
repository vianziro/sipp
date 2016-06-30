<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* Suratk Model Class
 *
 * @package     SGCMS
 * @subpackage  Models
 * @category    Models
 * @author      Achyar Anshorie
 */

class Sk_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases 
    function get($params = array())
    {
        if(isset($params['id']))
        {
            $this->db->where('sk.sk_id', $params['id']);
        }

        if (isset($params['multiple_id'])) {
            $this->db->where_in('sk.sk_id', $params['multiple_id']);
        }

        if(isset($params['member_nip']))
        {
            $this->db->where('member.sk_member_nip', $params['member_nip']);
        }

        if(isset($params['sk_member_nip']))
        {
            $this->db->where('sk.sk_member_nip', $params['sk_member_nip']);
        }

        if(isset($params['sk_member_full_name']))
        {
            $this->db->where('member.sk_member_full_name', $params['sk_member_full_name']);
        }

        if(isset($params['member_division']))
        {
            $this->db->where('member.sk_member_division', $params['member_division']);
        }

        if(isset($params['member_score']))
        {
            $this->db->where('member.sk_member_score', $params['member_score']);
        }
        
        if (isset($params['date_start']) AND isset($params['date_end'])) {
            $this->db->where('sk_input_date >=', $params['date_start'] . ' 00:00:00');
            $this->db->where('sk_input_date <=', $params['date_end'] . ' 23:59:59');
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
            $this->db->order_by('sk_id', 'desc');
        }

        $this->db->select('sk.sk_id, sk_number, sk_member_nip, sk_member_full_name,  sk_member_division,            
            sk_member_score,   sk_member_entry_date, sk_member_end_date,
            sk_input_date, sk_last_update');
        $this->db->join('member', 'member.member_nip = sk_member_nip', 'left');              
        $res = $this->db->get('sk');

        if(isset($params['id']) OR (isset($params['limit']) AND $params['limit']==1))
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

       if(isset($data['sk_id'])) {
        $this->db->set('sk_id', $data['sk_id']);
    }

    if(isset($data['sk_number'])) {
        $this->db->set('sk_number', $data['sk_number']);
    }    

    if(isset($data['sk_member_nip'])) {
        $this->db->set('sk_member_nip', $data['sk_member_nip']);
    }

    if(isset($data['sk_member_full_name'])) {
        $this->db->set('sk_member_full_name', $data['sk_member_full_name']);
    }

    if(isset($data['sk_member_division'])) {
        $this->db->set('sk_member_division', $data['sk_member_division']);
    }

    if(isset($data['sk_member_score'])) {
        $this->db->set('sk_member_score', $data['sk_member_score']);
    }

    if(isset($data['sk_member_entry_date'])) {
        $this->db->set('sk_member_entry_date', $data['sk_member_entry_date']);
    }

    if(isset($data['sk_member_end_date'])) {
        $this->db->set('sk_member_end_date', $data['sk_member_end_date']);
    }

    if(isset($data['sk_input_date'])) {
        $this->db->set('sk_input_date', $data['sk_input_date']);
    }

    if(isset($data['sk_last_update'])) {
        $this->db->set('sk_last_update', $data['sk_last_update']);
    }   

    if (isset($data['sk_id'])) {
        $this->db->where('sk_id', $data['sk_id']);
        $this->db->update('sk');
        $id = $data['sk_id'];
    } else {
        $this->db->insert('sk');
        $id = $this->db->insert_id();
    }

    $status = $this->db->affected_rows();
    return ($status == 0) ? FALSE : $id;
}

    // Delete to database
function delete($id) {
    $this->db->where('sk_id', $id);
    $this->db->delete('sk');
}

}
