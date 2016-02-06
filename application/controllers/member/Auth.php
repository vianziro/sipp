<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Auth controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Achyar Anshorie
 */
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->library('form_validation');
        $this->load->helper('string');
        $this->load->helper('url');
    }

    function index() {
        redirect('member/auth/login');
    }

    public function register($id = NULL) {
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|xss_clean');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|min_length[6]|matches[password]');
        $this->form_validation->set_rules('member_full_name', 'Nama Lengkap', 'trim|required|xss_clean');
        $this->form_validation->set_rules('member_phone', 'No. Tlp/HP', 'trim|required|xss_clean');
        $this->form_validation->set_rules('member_sex', 'Jenis Kelamin', 'trim|required|xss_clean');
        $this->form_validation->set_rules('member_school', 'Asal Sekolah', 'trim|required|xss_clean');
        $this->form_validation->set_rules('member_mentor', 'Nama Pembimbing', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

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
            $status = $this->Member_model->add($params);

            if (!empty($_FILES['member_image']['name'])) {
                $createdate = date('Y-m-d H:i');
                $paramsupdate['member_image'] = $this->do_upload($name = 'member_image', $createdate, $nip);
            }
            $paramsupdate['member_id'] = $status;
            $this->Member_model->add($paramsupdate);

            $this->session->set_flashdata('alert', 'Registrasi anda telah berhasil, silakan tunggu untuk konfirmasi dari Administrator, Kemudian Login Kembali');
            redirect('member/auth/login');
        } else {

            $this->session->set_flashdata('failed', 'Maaf, Registrasi anda tidak berhasil, Mohon Periksa kembali');
            redirect('member/auth/login');
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

    function present($lokasi = '') {
        $this->load->model('Present_model');
        if ($this->session->userdata('logged_member')) {
            redirect('member');
        }

        if ($lokasi != '') {
            $lokasi = $this->input->post('location');
        } else {
            $lokasi = NULL;
        }
        $this->form_validation->set_rules('nip', 'Nip', 'trim|required');
        $this->form_validation->set_rules('desc', 'Keterangan', 'trim|required');
        if ($_POST AND $this->form_validation->run() == TRUE) {
            $nip = $this->input->post('nip', TRUE);
            $password = $this->input->post('password', TRUE);
            $desc = $this->input->post('desc', TRUE);
            $this->db->from('member');
            $this->db->where('member_nip', $nip);
            $this->db->where('member_status', TRUE);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $params['member_member_nip'] = $nip;
                $params['member_member_id'] = $query->row('member_id');
                $params['present_year'] = date('Y');
                $params['present_month'] = date('m');
                $params['present_date'] = date('Y-m-d');
                if ($desc == 0) {
                    $checkin = $this->Present_model->get(array('date' => date('Y-m-d'), 'member_nip' => $nip));
                    if (!empty($checkin)) {
                        $this->session->set_flashdata('failedpresent', 'Maaf, anda sudah mengisi jam kedatangan untuk hari ini');
                        header("Location:" . site_url('member/auth/login') . "?location=" . urlencode($lokasi));
                    } else {
                        if (date('H:i:s') > '08:15:59') {
                            $params['present_is_late'] = TRUE;
                        }
                        $params['present_desc'] = 'Hadir';
                        $params['present_entry_time'] = date('H:i:s');
                        $this->Present_model->add($params);
                        if ($lokasi != '') {
                            $this->session->set_flashdata('alert', 'Selamat datang, ' . $query->row('member_full_name') . ' absen masuk berhasil diinput.');
                            header("Location:" . site_url('member/auth/login') . "?location=" . urlencode($lokasi));
                        } else {
                            $this->session->set_flashdata('alert', 'Selamat datang, ' . $query->row('member_full_name') . ' absen masuk berhasil diinput.');
                            redirect('member/auth/login');
                        }
                    }
                } else {
                    if (date('H:i:s') < '17:00:00') {
                        $params['present_is_before'] = TRUE;
                    }
                    $checkout = $this->Present_model->get(array('date' => date('Y-m-d'), 'member_nip' => $nip));
                    if (empty($checkout)) {
                        $this->session->set_flashdata('failedpresent', 'Maaf, Anda belum presensi masuk');
                        header("Location:" . site_url('member/auth/login') . "?location=" . urlencode($lokasi));
                    } else {
                        $params['present_id'] = $checkout['present_id'];
                        $params['present_out_time'] = date('H:i:s');
                        $this->Present_model->add($params);
                        if ($lokasi != '') {
                            $this->session->set_flashdata('alert', 'Selamat jalan, ' . $query->row('member_full_name') . ' Absen pulang berhasil diinput hati-hati dijalan.');
                            header("Location:" . site_url('member/auth/login') . "?location=" . urlencode($lokasi));
                        } else {
                            $this->session->set_flashdata('alert', 'Selamat jalan, ' . $query->row('member_full_name') . ' Absen pulang berhasil diinput hati-hati dijalan.');
                            redirect('member/auth/login');
                        }
                    }
                }
            } else {
                if ($lokasi != '') {
                    $this->session->set_flashdata('failedpresent', 'Maaf, NIP yang anda masukan tidak terdaftar');
                    header("Location:" . site_url('member/auth/login') . "?location=" . urlencode($lokasi));
                } else {
                    $this->session->set_flashdata('failedpresent', 'Maaf, NIP yang anda tidak terdaftar');
                    redirect('member/auth/login');
                }
            }
        } else {
            $this->session->set_flashdata('failedpresent', 'Maaf, NIP yang anda masukan tidak terdaftar');
            header("Location:" . site_url('member/auth/login') . "?location=" . urlencode($lokasi));
        }
    }

    function login($lokasi = '') {
        $this->load->model('Posts_model');
        $this->load->model('Present_model');
		$this->load->model('Member_model');
        $this->load->helper('text');
		$this->load->library('pagination');
        if ($this->session->userdata('logged_member')) {
            redirect('member');
        }
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $data['posts'] = $this->Posts_model->get(array('limit' => 3, 'status' => TRUE));
        $data['present'] = $this->Present_model->get(array('date' => date('Y-m-d')));
		$data['member'] = $this->Member_model->get(array('status' => TRUE,'order_by' => 'member_full_name'));
        if ($_POST AND $this->form_validation->run() == TRUE) {
            if ($this->input->post('location')) {
                $lokasi = $this->input->post('location');
            } else {
                $lokasi = NULL;
            }
            $this->process_login($lokasi);
        } else {
            $this->load->view('member/login', $data);
        }
    }

    // Login Prosessing
    function process_login($lokasi = '') {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);
            $this->db->from('member');
            $this->db->where('username', $username);
            $this->db->where('password', sha1($password));
            $this->db->where('member_status', TRUE);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $this->session->set_userdata('logged_member', TRUE);
                $this->session->set_userdata('member_id', $query->row('member_id'));
                $this->session->set_userdata('member_name', $query->row('username'));
                $this->session->set_userdata('member_full_name', $query->row('member_full_name'));
                if ($lokasi != '') {
                    header("Location:" . htmlspecialchars($lokasi));
                } else {
                    redirect('member');
                }
            } else {
                if ($lokasi != '') {
                    $this->session->set_flashdata('failed', 'Sorry, username and password do not match');
                    header("Location:" . site_url('member/auth/login') . "?location=" . urlencode($lokasi));
                } else {
                    $this->session->set_flashdata('failed', 'Sorry, username and password do not match');
                    redirect('member/auth/login');
                }
            }
        } else {
            $this->session->set_flashdata('failed', 'Sorry, username and password are not complete');
            redirect('member/auth/login');
        }
    }

    // Logout Processing
    function logout() {
        $this->session->unset_userdata('logged_member');
        $this->session->unset_userdata('member_id');
        $this->session->unset_userdata('member_name');
        $this->session->unset_userdata('member_full_name');
        if ($this->input->post('location')) {
            $lokasi = $this->input->post('location');
        } else {
            $lokasi = NULL;
        }
        header("Location:" . $lokasi);
    }

}
