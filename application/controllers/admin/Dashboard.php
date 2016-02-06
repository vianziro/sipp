<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Dashboard controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
    }

    // Dashboard View
    public function index() {
        $this->load->model('Present_model');
        $this->load->model('Member_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('member_nip', 'Nip', 'trim|required|xss_clean');
        $this->form_validation->set_rules('present_date', 'Tanggal', 'trim|required|xss_clean');
        $this->form_validation->set_rules('present_desc', 'Kehadiran', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        if ($_POST AND $this->form_validation->run() == TRUE) {
            $nip = $this->input->post('member_nip');
            $date = $this->input->post('present_date');
            $member = $this->Member_model->get(array('member_nip' => $nip));
            $check = $this->Present_model->get(array('date' => $date, 'member_nip' => $nip));
            if (empty($member)) {
                $this->session->set_flashdata('failed', 'Maaf, nip yang anda masukkan salah.');
                redirect('admin');
            } else {
                if (!empty($check)) {

                    $this->session->set_flashdata('failed', 'Maaf, nip tersebut sudah menginput kehadiran');
                    redirect('admin');
                } else {
                    $params['present_year'] = pretty_date($date, 'Y', FALSE);
                    $params['present_month'] = pretty_date($date, 'm', FALSE);
                    $params['present_date'] = $date;
                    $params['present_desc'] = $this->input->post('present_desc');
                    $params['member_member_id'] = $member['member_id'];
                    $params['member_member_nip'] = $nip;
                    $this->Present_model->add($params);

                    $this->session->set_flashdata('success', 'Tambah kehadiran berhasil');
                    redirect('admin');
                }
            }
        } else {
            $data['present'] = $this->Present_model->get(array('date' => date('Y-m-d')));

            $data['title'] = 'Dashboard';
            $data['main'] = 'admin/dashboard/dashboard';
            $this->load->view('admin/layout', $data);
        }
    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
