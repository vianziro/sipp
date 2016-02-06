<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* Dashboard controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Achyar Anshorie
 */

class Present extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_member') == NULL) {
            header("Location:" . site_url('member/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
    }

    // Dashboard View
    public function index($ket = 'all', $offset = NULL)
    {
        if($ket != 'all'){
            $params['desc'] = $ket;
        }
        $this->load->library('pagination');
        $this->load->model('Present_model');
        $params['limit'] = 10;
		$params['offset'] = $offset;
        $id = $params['member_id'] = $this->session->userdata('member_id');
        $params['member_id'] = $this->session->userdata('member_id');
        $data['present'] = $this->Present_model->get($params);
		$data['hadir'] = count($this->Present_model->get(array('member_id' => $id, 'desc' => 'Hadir')));
        $data['sakit'] = count($this->Present_model->get(array('member_id' => $id, 'desc' => 'Sakit')));
        $data['izin'] = count($this->Present_model->get(array('member_id' => $id, 'desc' => 'Izin')));
        $data['alfa'] = count($this->Present_model->get(array('member_id' => $id, 'desc' => 'Alfa')));
        $data['semua'] = count($this->Present_model->get(array('member_id' => $id)));
        $config['base_url'] = site_url('member/present/index/all');
        $config['total_rows'] = count($this->Present_model->get());
        $this->pagination->initialize($config);
        
        $data['title'] = 'Kehadiran';
        $data['main'] = 'member/present/present';
        $this->load->view('member/layout', $data);
    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
