<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Contract controllers class 
 *
 * @package     HRA CMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Achyar Anshorie
 */ 
class Sk extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Sk_model', 'Activity_log_model', 'Member_model'));
        $this->load->helper('string');
    }

    // Surat Keterangan view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');

        // Apply Filter
        // Get $_GET variable
        $q = $this->input->get(NULL, TRUE);

        $data['q'] = $q;
        $params = array(); 

        // Member NIP
        if (isset($q['n']) && !empty($q['n']) && $q['n'] != '') {
            $params['sk_member_nip'] = $q['n'];
        }

        // Date start
        if (isset($q['ds']) && !empty($q['ds']) && $q['ds'] != '') {
            $params['date_start'] = $q['ds'];
        }

        // Date end
        if (isset($q['de']) && !empty($q['de']) && $q['de'] != '') {
            $params['date_end'] = $q['de'];
        }
        
        $paramsPage = $params;
        $params['limit'] = 10;
        $params['offset'] = $offset;


        $data['sk'] = $this->Sk_model->get($params);        
        $config['base_url'] = site_url('admin/sk/index');
        $config['total_rows'] = count($this->Sk_model->get($paramsPage));
        $this->pagination->initialize($config);

        $data['title'] = 'Surat Keterangan Prakerin';
        $data['main'] = 'admin/sk/sk_list';
        $this->load->view('admin/layout', $data);
    }

    function detail($id = NULL) {
        if ($this->Sk_model->get(array('id' => $id)) == NULL) {
            redirect('admin/sk');
        }
        $data['sk'] = $this->Sk_model->get(array('id' => $id));
        $data['title'] = 'Surat Keterangan Prakerin';
        $data['main'] = 'admin/sk/sk_view';
        $this->load->view('admin/layout', $data);
    }

    // Add Surat and Update
    public function add($id = NULL) {
        $this->load->library('form_validation');   
        $this->form_validation->set_rules('sk_input_date', 'Tanggal', 'trim|required|xss_clean');          
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            if ($this->input->post('sk_id')) {
                $params['sk_id'] = $this->input->post('sk_id');
            } else {
                $lastnumber = $this->Sk_model->get(array('limit' => 1, 'order_by' => 'sk_id'));
                $num = $lastnumber['sk_number'];
                $params['sk_number'] = sprintf('%04d', $num + 01);
                $params['sk_input_date'] = date('Y-m-d H:i:s');
                
            }    
            $params['sk_member_nip'] = $this->input->post('member_nip');
            $params['sk_member_full_name'] = $this->input->post('member_full_name');
            $params['sk_member_division'] = $this->input->post('member_division');
            $params['sk_member_score'] = $this->input->post('member_score');
            $params['sk_member_entry_date'] = $this->input->post('member_entry_date');
            $params['sk_member_end_date'] = $this->input->post('member_end_date');
            $params['sk_last_update'] = date('Y-m-d H:i:s');
            $status = $this->Sk_model->add($params);


            // activity log
            $this->Activity_log_model->add(
                array(
                    'log_date' => date('Y-m-d H:i:s'),
                    'user_id' => $this->session->userdata('user_id'),
                    'log_module' => 'Surat Keterangan Prakerin',
                    'log_action' => $data['operation'],
                    'log_info' => 'ID:'.$status.';Title:NULL' 
                    )
                );

            $this->session->set_flashdata('success', $data['operation'] . ' Surat berhasil');
            redirect('admin/sk');
        } else {
            if ($this->input->post('sk_id')) {
                redirect('admin/sk/edit/' . $this->input->post('sk_id'));
            }

            // Edit mode
            if (!is_null($id)) {
                $data['sk'] = $this->Sk_model->get(array('id' => $id));
            }
            $data['member'] = $this->Member_model->get();
            $data['title'] = $data['operation'] . ' Surat Keterangan Prakerin';
            $data['main'] = 'admin/sk/sk_add';
            $this->load->view('admin/layout', $data);
        }
    }

    // Delete Surat Keterangan
    public function delete($id = NULL) {
        if ($_POST) {
            $this->Sk_model->delete($this->input->post('del_id'));
            // activity log
            $this->Activity_log_model->add(
                array(
                    'log_date' => date('Y-m-d H:i:s'),
                    'user_id' => $this->session->userdata('user_id'),
                    'log_module' => 'Surat Keterangan Prakerin',
                    'log_action' => 'Hapus',
                    'log_info' => 'ID:' . $this->input->post('del_id') . ';Title:' . $this->input->post('del_name')
                    )
                );
            $this->session->set_flashdata('success', 'Hapus Surat Keterangan berhasil');
            redirect('admin/sk');
        } elseif (!$_POST) {
            $this->session->set_flashdata('delete', 'Delete');
            redirect('admin/sk/edit/' . $id);
        }
    }

    function printPdf($id = NULL) {
        $this->load->helper(array('dompdf'));
        $this->load->helper(array('tanggal'));
        if ($id == NULL)
            redirect('admin/sk');
        $data['sk'] = $this->Sk_model->get(array('id' => $id));
        $html = $this->load->view('admin/sk/sk_pdf', $data, true);
        $data = pdf_create($html, '', TRUE, 'A4', TRUE);
    }


    function multiple() {
        $action = $this->input->post('action');
        if ($action == "delete") {
            $delete = $this->input->post('msg');
            for ($i = 0; $i < count($delete); $i++) {
                $this->Sk_model->delete($delete[$i]);
            }
        } elseif ($action == "printPdf") {
            $this->load->helper(array('dompdf'));
            $this->load->helper(array('tanggal'));
            $memo = $this->input->post('msg');
            for ($i = 0; $i < count($memo); $i++) {
                $print[] = $memo[$i];
            }
            $data['sk'] = $this->Sk_model->get(array('multiple_id' => $print));

            $html = $this->load->view('admin/sk/sk_multiple_pdf', $data, true);
            $data = pdf_create($html, 'A4', TRUE);
        }
        elseif ($action == "printEnvl") {
            $this->load->helper(array('dompdf'));
            $this->load->helper(array('tanggal'));
            $memo = $this->input->post('msg');
            for ($i = 0; $i < count($memo); $i++) {
                $print[] = $memo[$i];
            }
            $data['sk'] = $this->Sk_model->get(array('multiple_id' => $print));

            $html = $this->load->view('admin/sk/sk_multiple_envelope', $data, true);
            $data = pdf_create($html, 'A4', TRUE);
        }
        redirect('admin/sk');
    }

}



/* End of file Sk.php */
/* Location: ./application/controllers/admin/sk.php */
