<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_member') == NULL) {
            header("Location:" . site_url('member/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model('Member_model');
        $this->load->model('Activity_log_model');
        $this->load->helper(array('form', 'url'));
    }

    // User_customer view in list
    public function index($offset = NULL) {
        $id = $this->session->userdata('member_id');
        if ($this->Member_model->get(array('id' => $id)) == NULL) {
            redirect('member/user');
        }
        $data['member'] = $this->Member_model->get(array('id' => $id));
        $data['title'] = 'Detail Profil';
        $data['main'] = 'member/profile/profile_detail';
        $this->load->view('member/layout', $data);
    }

    // Add User_customer and Update
    public function edit($id = NULL) {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('member_full_name', 'Nama Lengkap', 'trim|required|xss_clean');
        $this->form_validation->set_rules('member_phone', 'No. Tlp/HP', 'trim|required|xss_clean');
        $this->form_validation->set_rules('member_sex', 'Jenis Kelamin', 'trim|required|xss_clean');
        $this->form_validation->set_rules('member_school', 'Asal Sekolah', 'trim|required|xss_clean');
        $this->form_validation->set_rules('member_mentor', 'Nama Pembimbing', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            $nip = $this->input->post('member_nip');
            $params['member_id'] = $this->input->post('member_id');
            $params['member_last_update'] = date('Y-m-d H:i:s');
            $params['member_full_name'] = stripslashes($this->input->post('member_full_name'));
            $params['member_sex'] = $this->input->post('member_sex');
            $params['member_birth_place'] = $this->input->post('member_birth_place');
            $params['member_birth_date'] = $this->input->post('member_birth_date');
            $params['member_school'] = $this->input->post('member_school');
            $params['member_phone'] = $this->input->post('member_phone');
            $params['member_address'] = $this->input->post('member_address');
            $params['member_mentor'] = $this->input->post('member_mentor');
            $params['member_entry_date'] = $this->input->post('member_entry_date');
            $params['member_division'] = $this->input->post('member_division');
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

            $this->session->set_flashdata('success', $data['operation'] . ' Profil Berhasil');
            redirect('member/profile');
        } else {

            // Edit mode
            $data['member'] = $this->Member_model->get(array('id' => $this->session->userdata('member_id')));
            $data['button'] = 'Ubah';
            $data['title'] = $data['operation'] . ' Profil';
            $data['main'] = 'member/profile/profile_edit';
            $this->load->view('member/layout', $data);
        }
    }

    // Setting Upload File Requied
    function do_upload($name, $createdate, $nip) {
        $this->load->library('upload');
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
//            echo $config['upload_path'];
            $this->session->set_flashdata('failed', $this->upload->display_errors(''));
            redirect(uri_string());
        }

        $upload_data = $this->upload->data();

        return $upload_data['file_name'];
    }

    function cpw($id = NULL) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[6]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|xss_clean|min_length[6]|matches[password]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        if ($_POST AND $this->form_validation->run() == TRUE) {
            $id = $this->input->post('member_id');
            $params['password'] = sha1($this->input->post('password'));
            $status = $this->Member_model->change_password($id, $params);

            $this->session->set_flashdata('success', 'Ubah Password Berhasil');
            redirect('member/profile');
        } else {
            if ($this->Member_model->get(array('id' => $id)) == NULL) {
                redirect('member/profile');
            }
            $data['member'] = $this->Member_model->get(array('id' => $id));
            $data['title'] = 'Ubah Password';
            $data['main'] = 'member/profile/change_pass';
            $this->load->view('member/layout', $data);
        }
    }

}

/* End of file user.php */
/* Location: ./application/controllers/ccp/user.php */
