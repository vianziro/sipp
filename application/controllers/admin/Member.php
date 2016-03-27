<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Member controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Achyar Anshorie
 */
class Member extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Member_model', 'Activity_log_model'));
        $this->load->library('upload');
    }

    // Member view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');
        // Apply Filter
        // Get $_GET variable
        $f = $this->input->get(NULL, TRUE);

        $data['f'] = $f;

        $params = array();
        // Nip
        if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
            $params['member_full_name'] = $f['n'];
        }

        $paramsPage = $params;
        $params['limit'] = 10;
        $params['offset'] = $offset;
        $data['member'] = $this->Member_model->get($params);

        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('admin/member/index');
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['total_rows'] = count($this->Member_model->get($paramsPage));
        $this->pagination->initialize($config);

        $data['title'] = 'Peserta';
        $data['main'] = 'admin/member/member_list';
        $this->load->view('admin/layout', $data);
    }

    function detail($id = NULL) {
        if ($this->Member_model->get(array('id' => $id)) == NULL) {
            redirect('admin/member');
        }
        $data['member'] = $this->Member_model->get(array('id' => $id));
        $data['title'] = 'Detail peserta';
        $data['main'] = 'admin/member/member_detail';
        $this->load->view('admin/layout', $data);
    }

    // Add Member and Update
    public function add($id = NULL) {
        $this->load->library('form_validation');
        if (!$this->input->post('member_id')) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|xss_clean');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|min_length[6]|matches[password]');
        }
        $this->form_validation->set_rules('member_full_name', 'Nama Lengkap', 'trim|required|xss_clean');
        $this->form_validation->set_rules('member_phone', 'No. Tlp/HP', 'trim|required|xss_clean');
        $this->form_validation->set_rules('member_sex', 'Jenis Kelamin', 'trim|required|xss_clean');
        $this->form_validation->set_rules('member_school', 'Asal Sekolah', 'trim|required|xss_clean');
        $this->form_validation->set_rules('member_mentor', 'Nama Pembimbing', 'trim|required|xss_clean');
        $this->form_validation->set_rules('member_status', 'Status', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            if ($this->input->post('member_id')) {
                $params['member_id'] = $this->input->post('member_id');
                $nip = $this->input->post('member_nip');
            } else {
                $params['username'] = $this->input->post('username');
                $params['password'] = sha1($this->input->post('password'));
                $params['member_input_date'] = date('Y-m-d H:i:s');

                $lastmember = $this->Member_model->get(array('order_by' => 'member_id', 'limit' => 1));
                if (empty($lastmember)) {
                    $nip = $params['member_nip'] = date('Ym') . sprintf('%02d', 01);
                } else {
                    $num = substr($lastmember['member_nip'], 6, 2);
                    $nip = $params['member_nip'] = date('Ym') . sprintf('%02d', $num + 01);
                }
            }

            $params['member_status'] = $this->input->post('member_status');
            $params['member_last_update'] = date('Y-m-d H:i:s');
            $params['member_full_name'] = stripslashes($this->input->post('member_full_name'));
            $params['member_sex'] = $this->input->post('member_sex');
            $params['member_birth_place'] = $this->input->post('member_birth_place');
            $params['member_birth_date'] = $this->input->post('member_birth_date');
            $params['member_school'] = $this->input->post('member_school');
            $params['member_phone'] = $this->input->post('member_phone');
            $params['member_address'] = $this->input->post('member_address');
            $params['member_mentor'] = $this->input->post('member_mentor');
            $params['member_division'] = $this->input->post('member_division');
            $params['member_entry_date'] = $this->input->post('member_entry_date');
            $params['member_end_date'] = $this->input->post('member_end_date');
            $params['member_score'] = $this->input->post('member_score');
            $status = $this->Member_model->add($params);

            if (!empty($_FILES['member_image']['name'])) {
                if ($this->input->post('member_id')) {
                    $createdate = $this->input->post('member_input_date');
                } else {
                    $createdate = date('Y-m-d H:i');
                }
                $paramsupdate['member_image'] = $this->do_upload($name = 'member_image', $createdate, $nip);
            }
            $paramsupdate['member_id'] = $status;
            $this->Member_model->add($paramsupdate);


            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Peserta',
                        'log_action' => $data['operation'],
                        'log_info' => 'ID:' . $status . ';Title:' . $params['member_full_name']
                    )
            );

            $this->session->set_flashdata('success', $data['operation'] . ' posting berhasil');
            redirect('admin/member');
        } else {

            // Edit mode
            if (!is_null($id)) {
                $data['member'] = $this->Member_model->get(array('id' => $id));
            }
            $data['title'] = $data['operation'] . ' Peserta';
            $data['main'] = 'admin/member/member_add';
            $this->load->view('admin/layout', $data);
        }
    }

    // Setting Upload File Requied
    function do_upload($name, $createdate, $nip) {
        $config['upload_path'] = FCPATH . 'uploads/';

        $paramsupload = array('date' => $createdate);
        list($date, $time) = explode(' ', $paramsupload['date']);
        list($year, $month, $day) = explode('-', $date);
        $config['upload_path'] = FCPATH . 'uploads/member_photo/' . $year . '/' . $month . '/' . $day . '/';

        /* create directory if not exist */
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '32000';
        $config['file_name'] = $nip;
                $this->upload->initialize($config);

        if (!$this->upload->do_upload($name)) {
            echo $config['upload_path'];
            $this->session->set_flashdata('success', $this->upload->display_errors(''));
            redirect(uri_string());
        }

        $upload_data = $this->upload->data();

        return $upload_data['file_name'];
    }

    function rpw($id = NULL) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('member_password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|min_length[6]|matches[member_password]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        if ($_POST AND $this->form_validation->run() == TRUE) {
            $id = $this->input->post('member_id');
            $params['password'] = sha1($this->input->post('member_password'));
            $status = $this->Member_model->change_password($id, $params);

            $this->session->set_flashdata('success', 'Reset password berhasil');
            redirect('admin/member');
        } else {
            if ($this->Member_model->get(array('id' => $id)) == NULL) {
                redirect('admin/member');
            }
            $data['member'] = $this->Member_model->get(array('id' => $id));
            $data['title'] = $this->lang->line('reset_pass_member');
            $data['main'] = 'admin/member/change_pass';
            $this->load->view('admin/layout', $data);
        }
    }

    // Delete Member
    public function delete($id = NULL) {
        if ($_POST) {
            $this->Member_model->delete($this->input->post('del_id'));
            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Peserta',
                        'log_action' => 'Hapus',
                        'log_info' => 'ID:' . $this->input->post('del_id') . ';Title:' . $this->input->post('del_name')
                    )
            );
            $this->session->set_flashdata('success', 'Hapus posting berhasil');
            redirect('admin/member');
        } elseif (!$_POST) {
            $this->session->set_flashdata('delete', 'Delete');
            redirect('admin/member/edit/' . $id);
        }
    }


function report($id = NULL) {
        $this->load->helper(array('dompdf'));
        if ($id == NULL)
            redirect('admin/member');

        $data['member'] = $this->Member_model->get(array('id' => $id));

        $html = $this->load->view('admin/member/member_pdf', $data, true);
        $data = pdf_create($html, '', TRUE);
    }

public function export() {
        $this->load->helper('csv');
        $params = array();
        $data['member'] = $this->Member_model->get($params);
        $csv = array(
            0 => array(
                'No.', 'NIPM', 'Nama', 'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir',
                'Asal Sekolah', 'Pembimbing', 'No Telp', 'Alamat', 'Departement', 'Status', 'Mulai Prakerin'
            )
        );
        $i = 1;
        foreach ($data['member'] as $row) {
            $csv[] = array( $i,
                $row['member_nip'], $row['member_full_name'], $row['member_sex'] == 'MALE' ? 'Laki-laki' : 'Perempuan', $row['member_birth_place'], $row['member_birth_date'],
                $row['member_school'], $row['member_mentor'], $row['member_phone'], $row['member_address'], $row['member_division'], $row['member_status'] == 0 ? 'Non-Aktif' : 'Aktif',
                pretty_date($row['member_entry_date'], 'm/d/Y', FALSE)
            );
            $i++;
        }

       // echo "<pre>";
        // echo print_r($csv);
        // echo "</pre>";
        // die();

        array_to_csv($csv, 'Data_Peserta_Prakerin.csv');
    }
   
}

/* End of file member.php */
/* Location: ./application/controllers/admin/member.php */
