<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Dashboard controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Achyar Anshorie
 */
class Present extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model('Present_model');
        $this->load->model('Member_model');
    }

    // Dashboard View
    public function index($offset = NULL) {
        $this->load->library('pagination');
        // Apply Filter
        // Get $_GET variable
        $q = $this->input->get(NULL, TRUE);

        $data['q'] = $q;

        $params = array();
        // Nip
        if (isset($q['n']) && !empty($q['n']) && $q['n'] != '') {
            $params['member_nip'] = $q['n'];
        }

        // Date start
        if (isset($q['ds']) && !empty($q['ds']) && $q['ds'] != '') {
            $params['date_start'] = $q['ds'];
        }

        // Date end
        if (isset($q['de']) && !empty($q['de']) && $q['de'] != '') {
            $params['date_end'] = $q['de'];
        }
        
        $params_total = $params;
        $params['limit'] = 10;
        $params['offset'] = $offset;
        $data['present'] = $this->Present_model->get($params);

        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('admin/present/index');
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['total_rows'] = count($this->Present_model->get($params_total));
        $this->pagination->initialize($config);

        $data['title'] = 'Kehadiran';
        $data['main'] = 'admin/present/present_list';
        $this->load->view('admin/layout', $data);
    }

    public function export() {
        $this->load->helper('csv');
        // Apply Filter
        // Get $_GET variable
        $q = $this->input->get(NULL, TRUE);

        $data['q'] = $q;

        $params = array();
        // Nip
        if (isset($q['n']) && !empty($q['n']) && $q['n'] != '') {
            $params['member_nip'] = $q['n'];
        }

        // Date start
        if (isset($q['ds']) && !empty($q['ds']) && $q['ds'] != '') {
            $params['date_start'] = $q['ds'];
        }

        // Date end
        if (isset($q['de']) && !empty($q['de']) && $q['de'] != '') {
            $params['date_end'] = $q['de'];
        }
        
//        if($nip != 'all'){
//            $params['member_nip'] = $nip;
//        }
        $data['present'] = $this->Present_model->get($params);
        $csv = array(
            0 => array(
                'No.', 'NIP', 'Nama', 'Tanggal', 'Jam masuk', 'Jam keluar',
                'Kehadiran', 'Keterangan'
            )
        );
        $i = 1;
        foreach ($data['present'] as $row) {
            $csv[] = array( $i,
                $row['member_member_nip'], $row['member_full_name'], pretty_date($row['present_date'], 'm/d/Y', FALSE),
                $row['present_entry_time'], $row['present_out_time'], strip_tags($row['present_desc'], ($row['present_is_late'] == 1) ? 'Telat' : '-')
            );
            $i++;
        }
        array_to_csv($csv, 'Report_presensi.csv');
    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
