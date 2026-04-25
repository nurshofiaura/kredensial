<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Web extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
	}

	public function home()
	{
		if(is_admin()){
			$data['attendance_total'] = $this->Web_model->get_attendance_by_admin_today_total();
			$data['timeoff_total']    = $this->Web_model->get_time_off_admin_today_total();
		}
		if(is_employee()){
			$id_employee = $this->session->id_employee;
			$data['attendance_today'] = $this->Web_model->get_attendance_by_employee_today($id_employee);
			$data['attendance_month'] = $this->Web_model->get_attendance_by_employee_month($id_employee);
			$data['attendance_total'] = $this->Web_model->get_attendance_by_employee_month_total($id_employee);
			$data['timeoff_total']    = $this->Web_model->get_time_off_month_total($id_employee);
		}

		$data['title']       = 'Home';
		$data['leaderboard'] = $this->Web_model->get_attendance_today();
		$data['setting']     = $this->Web_model->get_setting();
		$data['content']     = 'home/index';
		$this->load->view('layouts/wrapper', $data);
	}

	public function menu()
	{
		$data['title']   = 'Menu';
		$data['content'] = 'home/menu';
		$this->load->view('layouts/wrapper', $data);
	}

	public function account()
	{
		$data['title']   = 'Account';
		$data['content'] = 'account/index';
		$this->load->view('layouts/wrapper', $data);
	}

	public function information_support()
	{
		$data['title']   = 'Information Support';
		$data['setting'] = $this->Web_model->get_setting();
		$data['content'] = 'account/information_support';
		$this->load->view('layouts/wrapper', $data);
	}

	public function profile()
	{
		if(is_admin()){
			$id      = sha1($this->session->id_user);
			$account = $this->Web_model->get_user_by_id($id);
		}else{
			$id      = sha1($this->session->id_employee);
			$account = $this->Web_model->get_employee_by_id($id);
		}
		// echo "<pre>";print_r($account);die;
		if($account){
			$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
			$this->form_validation->set_rules('address', 'Phone', 'trim|required');

			if ($this->form_validation->run()) {
				if(!empty($_FILES['photo']['name'])){
					$filename = strtolower(url_title($this->input->post('name'))).'-'.date('YmdHis');

					$config['upload_path']   = './uploads/avatar/';
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
					$config['max_size']      = '2048';
					$config['file_name']     = $filename;

					$this->load->library('upload', $config);

					if($account->photo != 'default.png'){
						$old_photo = './uploads/avatar/'.$account->photo;
						if(is_file($old_photo)) unlink($old_photo);
					}

					if (!$this->upload->do_upload('photo')) {
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('danger', $error);
						redirect('profile','refresh');
					} else {
						$data = [
							'name'    => $this->input->post('name', true),
							'phone'   => $this->input->post('phone', true),
							'address' => $this->input->post('address', true),
							'photo'   => $this->upload->data('file_name'),
						];
					}
				}else{
					$data = [
						'name'    => $this->input->post('name', true),
						'phone'   => $this->input->post('phone', true),
						'address' => $this->input->post('address', true),
					];
				}

				if(is_admin()){
					$this->Web_model->update_user($id, $data);
				}else{
					$this->Web_model->update_employee($id, $data);
				}
				$this->session->set_flashdata('success', 'Data account updated has been successfully.');
				redirect('profile','refresh');
			} else {
				$data['title']   = 'Update Profile';
				$data['account'] = $account;
				$data['content'] = 'account/profile';
				$this->load->view('layouts/wrapper', $data);
			}
		}else{
			$this->session->set_flashdata('warning', 'Data account not found.');
			redirect('home','refresh');
		}
	}

	public function change_password()
	{
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'trim|required|min_length[8]|matches[new_password]');

		if ($this->form_validation->run()) {
			$data['password'] = password_hash($this->input->post('new_password', true), PASSWORD_DEFAULT);
			if(is_admin()){
				$id = sha1($this->session->id_user);
				$this->Web_model->update_user($id, $data);
			}else{
				$id = sha1($this->session->id_employee);
				$this->Web_model->update_employee($id, $data);
			}
			$this->session->set_flashdata('success', 'Data password updated has been successfully.');
			redirect('password/change','refresh');
		} else {
			$data['title']    = 'Change Password';
			$data['content']  = 'account/change_password';
			$this->load->view('layouts/wrapper', $data);
		}
	}

	public function setting()
	{
		$setting = $this->Web_model->get_setting();

		$this->form_validation->set_rules('company', 'Company', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('location', 'Location', 'trim|required');
		$this->form_validation->set_rules('radius', 'Location', 'trim|required|numeric');
		$this->form_validation->set_rules('clock_in', 'Clock In', 'trim|required');
		$this->form_validation->set_rules('director', 'Director', 'trim|required');
		$this->form_validation->set_rules('report_place', 'Report Place', 'trim|required');
		$this->form_validation->set_rules('zoom_level', 'Zoom Level', 'trim|required');

		if ($this->form_validation->run()) {
			if(!empty($_FILES['logo']['name'])){
				$filename = 'logo-'.date('YmdHis');

				$config['upload_path']   = './assets/img/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size']      = '2048';
				$config['file_name']     = $filename;

				$this->load->library('upload', $config);

				if($setting->logo != 'default.png'){
					$old_logo = './assets/img/'.$setting->logo;
					if(is_file($old_logo)) unlink($old_logo);
				}

				if (!$this->upload->do_upload('logo')) {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('danger', $error);
					redirect('setting','refresh');
				} else {
					$data = [
						'company'      => $this->input->post('company', true),
						'email'        => $this->input->post('email', true),
						'phone'        => $this->input->post('phone', true),
						'address'      => $this->input->post('address', true),
						'location'     => $this->input->post('location', true),
						'radius'       => $this->input->post('radius', true),
						'clock_in'     => $this->input->post('clock_in', true),
						'director'     => $this->input->post('director', true),
						'report_place' => $this->input->post('report_place', true),
						'zoom_level'   => $this->input->post('zoom_level', true),
						'logo'         => $this->upload->data('file_name'),
					];
				}
			}else{
				$data = [
					'company'      => $this->input->post('company', true),
					'email'        => $this->input->post('email', true),
					'phone'        => $this->input->post('phone', true),
					'address'      => $this->input->post('address', true),
					'location'     => $this->input->post('location', true),
					'radius'       => $this->input->post('radius', true),
					'clock_in'     => $this->input->post('clock_in', true),
					'director'     => $this->input->post('director', true),
					'report_place' => $this->input->post('report_place', true),
					'zoom_level'   => $this->input->post('zoom_level', true),
				];
			}

			$where['id_setting'] = 1;
			$this->Web_model->update_setting($data, $where);
			$this->session->set_flashdata('success', 'Data setting updated has been successfully.');
			redirect('setting','refresh');
		} else {
			$data['title']   = 'Setting';
			$data['setting'] = $setting;
			$data['content'] = 'setting/index';
			$this->load->view('layouts/wrapper', $data);
		}
	}

	public function user()
	{
		$this->form_validation->set_rules('keyword', 'Keyword', 'trim|required');

		if ($this->form_validation->run()) {
			$keyword = $this->input->post('keyword', true);

			$data['title']   = 'User';
			$data['user']    = $this->Web_model->get_user($keyword);
			$data['content'] = 'user/index';
			$this->load->view('layouts/wrapper', $data);
		} else {
			$data['title']   = 'User';
			$data['user']    = $this->Web_model->get_user();
			$data['content'] = 'user/index';
			$this->load->view('layouts/wrapper', $data);
		}
	}

	public function user_create()
	{
		$this->form_validation->set_rules('id_role', 'Position', 'trim|required');
		$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[8]|matches[password]');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');

		if ($this->form_validation->run()) {
			if(!empty($_FILES['photo']['name'])){
				$filename = strtolower(url_title($this->input->post('name'))).'-'.date('YmdHis');

				$config['upload_path']   = './uploads/avatar/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size']      = '2048';
				$config['file_name']     = $filename;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('photo')) {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('danger', $error);
					redirect('user/create','refresh');
				} else {
					$data = [
						'id_role'   => $this->input->post('id_role', true),
						'name'      => $this->input->post('name', true),
						'email'     => $this->input->post('email', true),
						'password'  => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
						'phone'     => $this->input->post('phone', true),
						'photo'     => $this->upload->data('file_name'),
						'is_active' => 1,
					];
				}
			}else{
				$data = [
					'id_role'   => $this->input->post('id_role', true),
					'name'      => $this->input->post('name', true),
					'email'     => $this->input->post('email', true),
					'password'  => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
					'phone'     => $this->input->post('phone', true),
					'is_active' => 1,
				];
			}

			try {
				$this->Web_model->insert_user($data);
				$this->session->set_flashdata('success', 'Data user created has been successfully.');
			} catch (Exception $e) {
				$this->session->set_flashdata('danger', $e->getMessage());
			}

			redirect('user','refresh');
		} else {
			$data['title']    = 'Create New User';
			$data['position'] = $this->Web_model->get_role();
			$data['content']  = 'user/create';
			$this->load->view('layouts/wrapper', $data);
		}
	}

	public function user_update($id_user)
	{
		$user = $this->Web_model->get_user_by_id($id_user);

		$this->form_validation->set_rules('id_role', 'Position', 'trim|required');
		$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');

		if ($this->form_validation->run()) {
			if(!empty($_FILES['photo']['name'])){
				$filename = strtolower(url_title($this->input->post('name'))).'-'.date('YmdHis');

				$config['upload_path']   = './uploads/avatar/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size']      = '2048';
				$config['file_name']     = $filename;

				$this->load->library('upload', $config);

				if($user->photo != 'default.png'){
					$old_photo = './uploads/avatar/'.$user->photo;
					if(is_file($old_photo)) unlink($old_photo);
				}

				if (!$this->upload->do_upload('photo')) {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('danger', $error);
					redirect('user/create','refresh');
				} else {
					$data = [
						'id_role'   => $this->input->post('id_role', true),
						'name'      => $this->input->post('name', true),
						'phone'     => $this->input->post('phone', true),
						'photo'     => $this->upload->data('file_name'),
						'is_active' => $this->input->post('is_active', true),
					];
				}
			}else{
				$data = [
					'id_role'   => $this->input->post('id_role', true),
					'name'      => $this->input->post('name', true),
					'phone'     => $this->input->post('phone', true),
					'is_active' => $this->input->post('is_active', true),
				];
			}

			try {
				$this->Web_model->update_user($id_user, $data);
				$this->session->set_flashdata('success', 'Data user updated has been successfully.');
			} catch (Exception $e) {
				$this->session->set_flashdata('danger', $e->getMessage());
			}

			redirect('user','refresh');
		} else {
			$status = [
				'0' => 'Suspend',
				'1' => 'Active',
			];
			$data['title']    = 'Update User';
			$data['position'] = $this->Web_model->get_role();
			$data['status']   = $status;
			$data['user']     = $user;
			$data['content']  = 'user/update';
			$this->load->view('layouts/wrapper', $data);
		}
	}

	public function user_delete($id_user){
		$user = $this->Web_model->get_user_by_id($id_user);
		if($user){
			if(sha1($user->id_user) != $id_user){
				$file_photo = '';
				$delete = $this->Web_model->delete_user($id_user, $file_photo);
				if($delete){
					if($file_photo != 'default.png'){
						$old_photo = './uploads/avatar/'.$file_photo;
						if(is_file($old_photo)) unlink($old_photo);
					}
					$this->session->set_flashdata('success', 'Data user deleted has been successfully.');
					redirect('user','refresh');
				}else{
					$this->session->set_flashdata('danger', 'Data user deleted has been failed.');
					redirect('user','refresh');
				}
			}else{
				$this->session->set_flashdata('danger', 'Data user deleted has been failed.');
				redirect('user','refresh');
			}
		}else{
			$this->session->set_flashdata('danger', 'Data user not found.');
			redirect('user','refresh');
		}
	}

	public function position()
	{
		$this->form_validation->set_rules('keyword', 'Keyword', 'trim|required');

		if ($this->form_validation->run()) {
			$keyword  = $this->input->post('keyword', true);
			$position = $this->Web_model->get_position($keyword);
		} else {
			$position = $this->Web_model->get_position();
		}

		$data['title']    = 'Position';
		$data['position'] = $position;
		$data['content']  = 'position/index';
		$this->load->view('layouts/wrapper', $data);
	}

	public function position_create()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');

		if ($this->form_validation->run()) {
			$data = ['name' => $this->input->post('name', true)];
			$this->Web_model->insert_position($data);
			$this->session->set_flashdata('success', 'Data position created has been successfully.');
			redirect('position','refresh');
		} else {
			$data['title']   = 'Create New Position';
			$data['content'] = 'position/create';
			$this->load->view('layouts/wrapper', $data);
		}
	}

	public function position_update($id_position)
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');

		if ($this->form_validation->run()) {
			$data = ['name' => $this->input->post('name', true)];
			$this->Web_model->update_position($id_position, $data);
			$this->session->set_flashdata('success', 'Data position updated has been successfully.');
			redirect('position','refresh');
		} else {
			$data['title']    = 'Update Employee';
			$data['position'] = $this->Web_model->get_position_by_id($id_position);
			$data['content']  = 'position/update';
			$this->load->view('layouts/wrapper', $data);
		}
	}

	public function position_delete($id_position){
		$delete = $this->Web_model->delete_position($id_position);
		if($delete){
			$this->session->set_flashdata('success', 'Data position deleted has been successfully.');
		}else{
			$this->session->set_flashdata('danger', 'Data position deleted has been failed.');
		}
		redirect('position','refresh');
	}

	public function employee()
	{
		$this->form_validation->set_rules('keyword', 'Keyword', 'trim|required');

		if ($this->form_validation->run()) {
			$keyword = $this->input->post('keyword', true);

			$data['title']    = 'Employee';
			$data['employee'] = $this->Web_model->get_employee($keyword);
			$data['content']  = 'employee/index';
			$this->load->view('layouts/wrapper', $data);
		} else {
			$data['title']    = 'Employee';
			$data['employee'] = $this->Web_model->get_employee();
			$data['content']  = 'employee/index';
			$this->load->view('layouts/wrapper', $data);
		}
	}

	public function employee_create()
	{
		$this->form_validation->set_rules('id_position', 'Position', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|is_unique[tbl_employee.nik]');
		$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('address', 'Phone', 'trim|required');

		if ($this->form_validation->run()) {
			if(!empty($_FILES['photo']['name'])){
				$filename = strtolower(url_title($this->input->post('name'))).'-'.date('YmdHis');

				$config['upload_path']   = './uploads/avatar/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size']      = '2048';
				$config['file_name']     = $filename;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('photo')) {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('danger', $error);
					redirect('employee/create','refresh');
				} else {
					$data = [
						'id_position' => $this->input->post('id_position', true),
						'nik'         => $this->input->post('nik', true),
						'name'        => $this->input->post('name', true),
						'email'       => $this->input->post('email', true),
						'password'    => password_hash($this->input->post('nik', true), PASSWORD_DEFAULT),
						'phone'       => $this->input->post('phone', true),
						'address'     => $this->input->post('address', true),
						'photo'       => $this->upload->data('file_name'),
						'is_active'   => 1,
					];
				}
			}else{
				$data = [
					'id_position' => $this->input->post('id_position', true),
					'nik'         => $this->input->post('nik', true),
					'name'        => $this->input->post('name', true),
					'email'       => $this->input->post('email', true),
					'password'    => password_hash($this->input->post('nik', true), PASSWORD_DEFAULT),
					'phone'       => $this->input->post('phone', true),
					'address'     => $this->input->post('address', true),
					'is_active'   => 1,
				];
			}
			$this->Web_model->insert_employee($data);
			$this->session->set_flashdata('success', 'Data employee created has been successfully.');
			redirect('employee','refresh');
		} else {
			$data['title']    = 'Create New Employee';
			$data['position'] = $this->Web_model->get_position();
			$data['content']  = 'employee/create';
			$this->load->view('layouts/wrapper', $data);
		}
	}

	public function employee_update($id_employee)
	{
		$employee = $this->Web_model->get_employee_by_id($id_employee);

		$this->form_validation->set_rules('id_position', 'Position', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required');
		$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('address', 'Phone', 'trim|required');

		if ($this->form_validation->run()) {
			if(!empty($_FILES['photo']['name'])){
				$filename = strtolower(url_title($this->input->post('name'))).'-'.date('YmdHis');

				$config['upload_path']   = './uploads/avatar/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size']      = '2048';
				$config['file_name']     = $filename;

				$this->load->library('upload', $config);

				if($employee->photo != 'default.png'){
					$old_photo = './uploads/avatar/'.$employee->photo;
					if(is_file($old_photo)) unlink($old_photo);
				}

				if (!$this->upload->do_upload('photo')) {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('danger', $error);
					redirect('employee/create','refresh');
				} else {
					$data = [
						'id_position' => $this->input->post('id_position', true),
						'nik'         => $this->input->post('nik', true),
						'name'        => $this->input->post('name', true),
						'email'       => $this->input->post('email', true),
						'phone'       => $this->input->post('phone', true),
						'address'     => $this->input->post('address', true),
						'photo'       => $this->upload->data('file_name'),
						'is_active'   => 1,
					];
				}
			}else{
				$data = [
					'id_position' => $this->input->post('id_position', true),
					'nik'         => $this->input->post('nik', true),
					'name'        => $this->input->post('name', true),
					'email'       => $this->input->post('email', true),
					'phone'       => $this->input->post('phone', true),
					'address'     => $this->input->post('address', true),
					'is_active'   => $this->input->post('is_active', true),
				];
			}
			$this->Web_model->update_employee($id_employee, $data);
			$this->session->set_flashdata('success', 'Data employee updated has been successfully.');
			redirect('employee','refresh');
		} else {
			$status = [
				'0' => 'Suspend',
				'1' => 'Active',
			];
			$data['title']    = 'Update Employee';
			$data['position'] = $this->Web_model->get_position();
			$data['status']   = $status;
			$data['employee'] = $employee;
			$data['content']  = 'employee/update';
			$this->load->view('layouts/wrapper', $data);
		}
	}

	public function employee_delete($id_employee){
		$employee = $this->Web_model->get_employee_by_id($id_employee);
		$file_photo = '';
		$delete = $this->Web_model->delete_employee($id_employee, $file_photo);
		if($delete){
			if($file_photo != 'default.png'){
				$old_photo = './uploads/avatar/'.$file_photo;
				if(is_file($old_photo)) unlink($old_photo);
			}
			$this->session->set_flashdata('success', 'Data employee deleted has been successfully.');
			redirect('employee','refresh');
		}else{
			$this->session->set_flashdata('danger', 'Data employee deleted has been failed.');
			redirect('employee','refresh');
		}
	}

	public function attendance()
	{
		$check = $this->Web_model->check_attendance();
		if(empty($check)){
			$title      = 'Attendance Clock In';
			$clock_type = 'in';
		}else{
			$title      = 'Attendance Clock Out';
			$clock_type = 'out';
		}
		$data['title']      = $title;
		$data['clock_type'] = $clock_type;
		$data['setting']    = $this->Web_model->get_setting();
		$data['content']    = 'attendance/index';
		$this->load->view('layouts/wrapper', $data);
	}

	public function attendance_live(){
		$setting      = $this->Web_model->get_setting();
		$clock_type   = $this->input->post('clock_type');
		$image_base64 = $this->input->post('image');
		$location     = $this->input->post('location');

		if($clock_type == 'out'){
			$agenda_today = $this->Web_model->get_agenda_by_employee_today($this->session->id_employee);
			if(empty($agenda_today)){
				$result = [
					'success' => false,
					'message' => 'You must be create the agenda today.',
				];
				echo json_encode($result);
				exit;
			}
		}

		$location_user_exp   = explode(',', $location);
		$latitude_user       = $location_user_exp[0];
		$longitude_user      = trim($location_user_exp[1]);

		$location_office_exp = explode(',', $setting->location);
		$latitude_office     = $location_office_exp[0];
		$longitude_office    = trim($location_office_exp[1]);
		$radius_office       = $setting->radius;

		$distance = $this->distance($latitude_office, $longitude_office, $latitude_user, $longitude_user);
		$distance = round($distance['meters']);
		if($distance < $radius_office){
			$path         = 'uploads/attendance/';
			$image_parts  = explode(';base64', $image_base64);
			$image_decode = base64_decode($image_parts[1]);
			$filename     = $this->session->nik.'-'.date('YmdHis').'-'.$clock_type.'.jpg';
			$path_file    = $path.$filename;

			if($clock_type == 'in'){
				$data = [
					'id_employee' => $this->session->id_employee,
					'date'        => date('Y-m-d'),
					'clock_in'    => date('H:i:s'),
					'photo_in'    => $filename,
					'location_in' => $location,
				];
				$save = $this->Web_model->insert_attendance($data);
			}else{
				$data = [
					'clock_out'    => date('H:i:s'),
					'photo_out'    => $filename,
					'location_out' => $location,
				];
				$where = [
					'id_employee' => $this->session->id_employee,
					'date'        => date('Y-m-d'),
				];
				$save = $this->Web_model->update_attendance($data, $where);
			}
			if($save){
				file_put_contents($path_file, $image_decode);
				$result = [
					'success' => true,
					'message' => 'Clock '.ucwords($clock_type).' Successfully!',
				];
			}else{
				$result = [
					'success' => false,
					'message' => 'Clock '.ucwords($clock_type).' Failed!',
				];
			}
		}else{
			$result = [
				'success' => false,
				'message' => 'Your distance exceeds the maximum office radius.',
			];
		}
		echo json_encode($result);
	}

	public function attendance_history()
	{
		$this->form_validation->set_rules('month', 'Month', 'trim|required');
		$this->form_validation->set_rules('year', 'Year', 'trim|required');

		if ($this->form_validation->run()) {
			$id_employee = $this->session->id_employee;
			$month       = $this->input->post('month', true);
			$year        = $this->input->post('year', true);

			$history = $this->Web_model->get_attendance_history($id_employee, $month, $year);
			// echo "<pre>";print_r($history);die;
			$data['title']   = 'Attendance History';
			$data['subtitle']   = 'Data '.month_en()[$month].' '.$year;
			$data['history'] = $history;
			$data['content'] = 'attendance/history';
			$this->load->view('layouts/wrapper', $data);
		} else {
			$data['title']   = 'Attendance History';
			$data['content'] = 'attendance/history';
			$this->load->view('layouts/wrapper', $data);
		}
	}

	public function attendance_report()
	{
		$this->form_validation->set_rules('month', 'Month', 'trim|required');
		$this->form_validation->set_rules('year', 'Year', 'trim|required');
		$this->form_validation->set_rules('id_employee', 'Employee', 'trim|required');

		if ($this->form_validation->run()) {
			$month       = $this->input->post('month', true);
			$year        = $this->input->post('year', true);
			$id_employee = $this->input->post('id_employee', true);

			$data['subtitle']   = 'Data Period '.month_en()[$month].' '.$year;
			$data['attendance'] = $this->Web_model->get_attendance_by_employee_month($id_employee, $month, $year);

			$this->session->unset_userdata('report');
			$report = new stdClass();
			$report->id_employee = $id_employee;
			$report->month       = $month;
			$report->year        = $year;
			$session['report']   = $report;
			$this->session->set_userdata($session);
		}

		$data['title']    = 'Attendance Report';
		$data['employee'] = $this->Web_model->get_employee();
		$data['content']  = 'attendance/report';
		$this->load->view('layouts/wrapper', $data);
	}

	public function attendance_report_print()
	{
		$id_employee = $this->session->report->id_employee;
		$month       = $this->session->report->month;
		$year        = $this->session->report->year;

		$data['title']      = 'Print Attendance Report';
		$data['month']      = $month;
		$data['year']       = $year;
		$data['employee']   = $this->Web_model->get_employee_by_id(sha1($id_employee));
		$data['attendance'] = $this->Web_model->get_attendance_by_employee_month($id_employee, $month, $year);
		$data['setting']    = $this->Web_model->get_setting();
		$this->load->view('attendance/report_print', $data);
	}

	public function distance($lat1, $lon1, $lat2, $lon2){
		$theta      = $lon1 - $lon2;
		$miles      = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
		$miles      = acos($miles);
		$miles      = rad2deg($miles);
		$miles      = $miles * 60 * 1.1515;
		$feet       = $miles * 5280;
		$yards      = $feet / 3;
		$kilometers = $miles * 1.609344;
		$meters     = $kilometers * 1000;
		return compact('meters');
	}

	public function agenda()
	{
		$this->form_validation->set_rules('id_employee', 'Employee', 'trim');

		if ($this->form_validation->run()) {
			$id_employee = $this->input->post('id_employee', true);
			$agenda = $this->Web_model->get_agenda($id_employee);
		} else {
			if(is_admin()){
				$agenda = $this->Web_model->get_agenda();
			}
		}

		if(is_admin()){
			$data['employee'] = $this->Web_model->get_employee();
		}
		if(is_employee()){
			$agenda = $this->Web_model->get_agenda($this->session->id_employee);
		}
		$data['title']   = 'Agenda';
		$data['agenda']  = $agenda;
		$data['content'] = 'agenda/index';
		$this->load->view('layouts/wrapper', $data);
	}

	public function agenda_create()
	{
		$this->form_validation->set_rules('note', 'Note', 'trim|required');

		if ($this->form_validation->run()) {
			$data = [
				'id_employee' => $this->session->id_employee,
				'datetime'    => date('Y-m-d H:i:s'),
				'note'        => $this->input->post('note', true),
			];
			$this->Web_model->insert_agenda($data);
			$this->session->set_flashdata('success', 'Data agenda created has been successfully.');
			redirect('agenda','refresh');
		} else {
			if(is_employee()){
				$id_employee = $this->session->id_employee;
				$data['attendance_today'] = $this->Web_model->get_attendance_by_employee_today($id_employee);
				$data['agenda_today']     = $this->Web_model->get_agenda_by_employee_today($id_employee);
			}
			$data['title']   = 'Create Agenda';
			$data['content'] = 'agenda/create';
			$this->load->view('layouts/wrapper', $data);
		}
	}

	public function payslip()
	{
		$this->form_validation->set_rules('id_employee', 'Employee', 'trim');

		if ($this->form_validation->run()) {
			$id_employee = $this->input->post('id_employee', true);
			$payslip = $this->Web_model->get_payslip($id_employee);
		} else {
			if(is_admin()){
				$payslip = $this->Web_model->get_payslip();
			}
		}

		if(is_admin()){
			$data['employee'] = $this->Web_model->get_employee();
		}
		if(is_employee()){
			$payslip = $this->Web_model->get_payslip($this->session->id_employee);
		}
		$data['title']   = 'Payslip';
		$data['payslip']  = $payslip;
		$data['content'] = 'payslip/index';
		$this->load->view('layouts/wrapper', $data);
	}

	public function payslip_create()
	{
		if(is_employee()){
			redirect('payslip','refresh');
		}

		$this->form_validation->set_rules('id_employee', 'Employee', 'trim|required');
		$this->form_validation->set_rules('period', 'Period', 'trim|required');
		if(empty($_FILES['receipt']['name'])){
			$this->form_validation->set_rules('receipt', 'Receipt', 'trim|required');
		}

		if ($this->form_validation->run()) {
			$id_employee = $this->input->post('id_employee', true);
			$period      = $this->input->post('period', true);
            // Jika user upload receipt
            if(!empty($_FILES['receipt']['name'])) {
            	// Get detail employee
				$employee = $this->Web_model->get_employee_by_id(sha1($id_employee));
                // Rename nama receipt yang diupload
                $filename = $employee->nik.'-'.str_replace('-', '', $period);
                // Konfigurasi receipt
				$config['upload_path']   = './uploads/receipt/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']      = '2048';
				$config['file_name']     = $filename;
                
                $this->load->library('upload', $config);
                
                if(!$this->upload->do_upload('receipt')){
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('danger', $error);
                    redirect('payslip/create','refresh');
                }else{
					$data = [
						'id_employee' => $id_employee,
						'period'      => $period,
						'receipt'     => $this->upload->data('file_name'),
					];
					$this->Web_model->insert_payslip($data);
					$this->session->set_flashdata('success', 'Data payslip created has been successfully.');
					redirect('payslip','refresh');
				}
			}
		} else {
			$year = date('Y');
			$month = [
				$year.'-01-01' => 'January '.$year,
				$year.'-02-01' => 'February '.$year,
				$year.'-03-01' => 'March '.$year,
				$year.'-04-01' => 'April '.$year,
				$year.'-05-01' => 'May '.$year,
				$year.'-06-01' => 'June '.$year,
				$year.'-07-01' => 'July '.$year,
				$year.'-08-01' => 'August '.$year,
				$year.'-09-01' => 'September '.$year,
				$year.'-10-01' => 'October '.$year,
				$year.'-11-01' => 'November '.$year,
				$year.'-12-01' => 'December '.$year,
			];
			$data['title']    = 'Create Payslip';
			$data['month']    = $month;
			$data['employee'] = $this->Web_model->get_employee();
			$data['content']  = 'payslip/create';
			$this->load->view('layouts/wrapper', $data);
		}
	}

	public function payslip_show($id_payslip)
	{
		$data['title']   = 'Detail Payslip';
		$data['payslip'] = $this->Web_model->get_payslip_by_id($id_payslip);
		$data['content'] = 'payslip/show';
		$this->load->view('layouts/wrapper', $data);
	}

	public function time_off()
	{
		$this->form_validation->set_rules('id_employee', 'Employee', 'trim');

		if ($this->form_validation->run()) {
			$id_employee = $this->input->post('id_employee', true);
			$timeoff = $this->Web_model->get_time_off($id_employee);
		} else {
			if(is_admin()){
				$timeoff = $this->Web_model->get_time_off();
			}
		}

		if(is_admin()){
			$data['employee'] = $this->Web_model->get_employee();
		}else{
			$timeoff = $this->Web_model->get_time_off_by_employee($this->session->id_employee);
		}

		$data['title']   = 'Time Off';
		$data['timeoff'] = $timeoff;
		$data['content'] = 'time_off/index';
		$this->load->view('layouts/wrapper', $data);
	}

	public function time_off_create()
	{
		$this->form_validation->set_rules('date', 'Date', 'trim|required');
		$this->form_validation->set_rules('type', 'Status', 'trim|required');
		$this->form_validation->set_rules('note', 'Note', 'trim|required');

		$type = $this->input->post('type', true);
		if($type == 1 && empty($_FILES['attachment']['name'])){
			$this->form_validation->set_rules('attachment', 'Attachment', 'trim|required');
		}

		if ($this->form_validation->run()) {
			$date = $this->input->post('date', true);
            // Jika user upload attachment
            if(!empty($_FILES['attachment']['name'])) {
            	// Get detail employee
				$employee = $this->Web_model->get_employee_by_id(sha1($this->session->id_employee));
                // Rename nama attachment yang diupload
                $filename = $employee->nik.'-'.str_replace('-', '', $date);
                // Konfigurasi attachment
				$config['upload_path']   = './uploads/timeoff/';
				$config['allowed_types'] = 'jpg|jpeg|png|pdf';
				$config['max_size']      = '2048';
				$config['file_name']     = $filename;
                
                $this->load->library('upload', $config);
                
                if(!$this->upload->do_upload('attachment')){
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('danger', $error);
                    redirect('timeoff/create','refresh');
                }else{
                	$data['attachment'] = $this->upload->data('file_name');
				}
			}
				
			$data = [
				'id_employee' => $this->session->id_employee,
				'date'        => $date,
				'type'        => $type,
				'note'        => $this->input->post('note', true),
			];
			$last_id = $this->Web_model->insert_time_off($data);

			$data_inbox = [
				'table'      => 'tbl_time_off',
				'id_table'   => $last_id,
				'is_read'    => 0,
				'is_admin'   => 1,
				'created_at' => date('Y-m-d H:i:s'),
			];
			$this->Web_model->insert_inbox($data_inbox);

			$this->session->set_flashdata('success', 'Data time off requested has been successfully.');
			redirect('timeoff','refresh');
		} else {
			$data['title']   = 'Create Request Time Off';
			$data['content'] = 'time_off/create';
			$this->load->view('layouts/wrapper', $data);
		}
	}

	public function time_off_show($id_time_off)
	{
		$data['title']   = 'Detail Time Off';
		$data['timeoff'] = $this->Web_model->get_time_off_by_id($id_time_off);
		$data['content'] = 'time_off/show';
		$this->load->view('layouts/wrapper', $data);
	}

	public function reimbursement()
	{
		$this->form_validation->set_rules('id_employee', 'Employee', 'trim');

		if ($this->form_validation->run()) {
			$id_employee = $this->input->post('id_employee', true);
			$reimbursement = $this->Web_model->get_reimbursement($id_employee);
		} else {
			if(is_admin()){
				$reimbursement = $this->Web_model->get_reimbursement();
			}
		}

		if(is_admin()){
			$data['employee'] = $this->Web_model->get_employee();
		}else{
			$reimbursement = $this->Web_model->get_reimbursement_by_employee($this->session->id_employee);
		}

		$data['title']         = 'Reimbursement';
		$data['reimbursement'] = $reimbursement;
		$data['content']       = 'reimbursement/index';
		$this->load->view('layouts/wrapper', $data);
	}

	public function reimbursement_create()
	{
		$this->form_validation->set_rules('date', 'Date', 'trim|required');
		$this->form_validation->set_rules('type', 'Type', 'trim|required');
		$this->form_validation->set_rules('note', 'Note', 'trim|required');
		if(empty($_FILES['attachment']['name'])){
			$this->form_validation->set_rules('attachment', 'Attachment', 'trim|required');
		}

		if ($this->form_validation->run()) {
			$date = $this->input->post('date', true);
            // Jika user upload attachment
            if(!empty($_FILES['attachment']['name'])) {
            	// Get detail employee
				$employee = $this->Web_model->get_employee_by_id(sha1($this->session->id_employee));
                // Rename nama attachment yang diupload
                $filename = $employee->nik.'-'.str_replace('-', '', $date);
                // Konfigurasi attachment
				$config['upload_path']   = './uploads/reimbursement/';
				$config['allowed_types'] = 'jpg|jpeg|png|pdf';
				$config['max_size']      = '2048';
				$config['file_name']     = $filename;
                
                $this->load->library('upload', $config);
                
                if(!$this->upload->do_upload('attachment')){
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('danger', $error);
                    redirect('reimbursement/create','refresh');
                }else{
					$data = [
						'id_employee' => $this->session->id_employee,
						'date'        => $date,
						'type'        => $this->input->post('type', true),
						'note'        => $this->input->post('note', true),
						'attachment'  => $this->upload->data('file_name'),
					];
					$last_id = $this->Web_model->insert_reimbursement($data);

					$data_inbox = [
						'table'      => 'tbl_reimbursement',
						'id_table'   => $last_id,
						'is_read'    => 0,
						'is_admin'   => 1,
						'created_at' => date('Y-m-d H:i:s'),
					];
					$this->Web_model->insert_inbox($data_inbox);

					$this->session->set_flashdata('success', 'Data reimbursement has been successfully.');
					redirect('reimbursement','refresh');
				}
			}
		} else {
			$data['title']   = 'Create Reimbursement';
			$data['content'] = 'reimbursement/create';
			$this->load->view('layouts/wrapper', $data);
		}
	}

	public function reimbursement_show($id_reimbursement)
	{
		$data['title']         = 'Detail Reimbursement';
		$data['reimbursement'] = $this->Web_model->get_reimbursement_by_id($id_reimbursement);
		$data['content']       = 'reimbursement/show';
		$this->load->view('layouts/wrapper', $data);
	}

	public function monitoring()
	{
		$this->form_validation->set_rules('date', 'Date', 'trim|required');

		if ($this->form_validation->run()) {
			$date = $this->input->post('date', true);
		} else {
			$date = date('Y-m-d');
		}

		$data['title']      = 'Monitoring Attendance';
		$data['date']       = $date;
		$data['attendance'] = $this->Web_model->get_attendance_by_admin_date($date);
		$data['content']    = 'monitoring/index';
		$this->load->view('layouts/wrapper', $data);
	}

	public function monitoring_export($date){
		$attendance = $this->Web_model->get_attendance_by_admin_date($date);
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Employee');
		$sheet->setCellValue('C1', 'Date');
		$sheet->setCellValue('D1', 'Clock In');
		$sheet->setCellValue('E1', 'Clock Out');
		$sheet->setCellValue('F1', 'Note');
		$no = 1;
		$rows = 2;
		foreach ($attendance as $val){
			$note = ($val->clock_in > setting()->clock_in)?'Overdue ('.diff_time(setting()->clock_in, $val->clock_in).')':'On Time';
			$sheet->setCellValue('A' . $rows, $no++);
			$sheet->setCellValue('B' . $rows, $val->employee);
			$sheet->setCellValue('C' . $rows, $val->date);
			$sheet->setCellValue('D' . $rows, $val->clock_in);
			$sheet->setCellValue('E' . $rows, $val->clock_out);
			$sheet->setCellValue('F' . $rows, $note);
			$rows++;
		}

        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

		$filename = 'attendance-employee-report-'.str_replace('-', '', $date).'-'.date('His').'.xlsx';
		$writer = new Xlsx($spreadsheet);
		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment;filename="'. $filename .'"');
		$writer->save('php://output');
		exit;
	}

	public function monitoring_detail($id_attendance)
	{
		$data['title']      = 'Detail Attendance';
		$data['attendance'] = $this->Web_model->get_attendance_by_id($id_attendance);
		$data['content']    = 'monitoring/detail';
		$this->load->view('layouts/wrapper', $data);
	}

	public function monitoring_print($date)
	{
		$date = urldecode($date);

		$data['title']      = 'Monitoring Attendance';
		$data['date']       = $date;
		$data['attendance'] = $this->Web_model->get_attendance_by_admin_date($date);
		$data['setting']    = $this->Web_model->get_setting();
		$this->load->view('monitoring/print', $data);
	}

	public function recapitulation()
	{
		$this->form_validation->set_rules('month', 'Month', 'trim|required');
		$this->form_validation->set_rules('year', 'Year', 'trim|required');
		$this->form_validation->set_rules('type', 'Type', 'trim');

		if ($this->form_validation->run()) {
			$month = $this->input->post('month', true);
			$year  = $this->input->post('year', true);
			$type  = $this->input->post('type', true);
			$recap = $this->Web_model->get_attendance_recapitulation($month, $year);

			if($recap){
				$data['subtitle'] = 'Data Period '.month_en()[$month].' '.$year;

				$this->session->unset_userdata('recapitulation');
				$recapitulation = new stdClass();
				$recapitulation->month     = $month;
				$recapitulation->year      = $year;
				$recapitulation->recap     = $recap;
				$session['recapitulation'] = $recapitulation;
				$this->session->set_userdata($session);
			}else{
				$recapitulation = array();
				$this->session->set_flashdata('danger', 'Data Not Found.');
				redirect('recapitulation','refresh');
			}
		} else {
			$recapitulation = array();
		}

		$data['title']          = 'Recapitulation';
		$data['recapitulation'] = $recapitulation;
		$data['content']        = 'attendance/recapitulation';
		$this->load->view('layouts/wrapper', $data);
	}

	public function recapitulation_print()
	{
		$data['title']          = 'Print Recapitulation';
		$data['month']          = $this->session->recapitulation->month;
		$data['year']           = $this->session->recapitulation->year;
		$data['recapitulation'] = $this->session->recapitulation->recap;
		$data['setting']        = $this->Web_model->get_setting();
		$this->load->view('attendance/recapitulation_print', $data);
	}

	public function recapitulation_export(){
		$month          = $this->session->recapitulation->month;
		$year           = $this->session->recapitulation->year;
		$recapitulation = $this->session->recapitulation->recap;
		// echo "<pre>";print_r($recapitulation);die;

		$date = $year.'-'.$month.'-01';
		$end_date = date('t', strtotime($date));
		$month_year = date('F Y', strtotime($date));

		$alpha = array('AA','AB','AC','AD');

		$index = -1;
		foreach(range('A','Z') as $letter){
			$alpha_arr[$index] = $letter;
			$index++;
		}
		$index = 25;
		foreach($alpha_arr as $key => $val){
			if($key <= 5){
				$alpha_arr[$index] = 'A'.$val;
				$index++;
			}
		}
		$indexEnd = end($alpha_arr);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Employee');
		$sheet->setCellValue('C1', $month_year);
		for($i=1; $i<=$end_date; $i++){
			$sheet->setCellValue($alpha_arr[$i].'2', $i);
		}
		$no = 1;
		$rows = 3;
		foreach ($recapitulation as $val){
			$sheet->setCellValue('A' . $rows, $no++);
			$sheet->setCellValue('B' . $rows, $val->employee);
			for($i=1; $i<=$end_date; $i++){
				$day = 'day'.$i;
				$exp = explode('-', $val->$day);
				if(isset($exp[0])){
					$clock = $clock_in = substr($exp[0], 0, 5);
				}
				if(isset($exp[1])){
					$clock = $clock_out = substr($exp[1], 0, 5);
				}
				if(isset($exp[0]) && isset($exp[1])){
					$clock = $clock_in.'-'.$clock_out;
				}
				$sheet->setCellValue($alpha_arr[$i] . $rows, $clock);
			}
			$rows++;
		}

        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getStyle('A1:'.$indexEnd.'1')->getFont()->setBold(true);
        $sheet->getStyle('C2:'.$indexEnd.'2')->getFont()->setBold(true);
		$sheet->getStyle('A1:A'.$rows)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('C2:'.$indexEnd.'2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('A1:A2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
		$sheet->getStyle('B1:B2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
		$sheet->getStyle('C1:'.$indexEnd.'1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->mergeCells('A1:A2');
		$sheet->mergeCells('B1:B2');
		$sheet->mergeCells('C1:'.$indexEnd.'1');

		$filename = 'recapitulation-attendance-'.str_replace('-', '', $date).'-'.date('His').'.xlsx';
		$writer = new Xlsx($spreadsheet);
		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment;filename="'. $filename .'"');
		$output = $writer->save('php://output');
	}

	public function inbox()
	{
		$data['title']   = 'Inbox';
		$data['inbox']   = $this->Web_model->get_inbox();
		$data['content'] = 'inbox/index';
		$this->load->view('layouts/wrapper', $data);
	}

	public function inbox_show($id_inbox)
	{
		$data['is_read'] = 1;
		$this->Web_model->update_inbox($id_inbox, $data);

		$data['title']   = 'Detail Inbox';
		$data['inbox']   = $this->Web_model->get_inbox_by_id($id_inbox);
		$data['content'] = 'inbox/show';
		$this->load->view('layouts/wrapper', $data);
	}

	public function inbox_approve($id_inbox)
	{
		$inbox = $this->Web_model->get_inbox_by_id($id_inbox);
		if($inbox->table == 'tbl_time_off'){
			try {
				$data['status'] = 1;
				$id_time_off    = $inbox->id_table;
				$this->Web_model->update_time_off($id_time_off, $data);

				$data_inbox = [
					'table'      => 'tbl_time_off',
					'id_table'   => $inbox->id_time_off,
					'is_read'    => 0,
					'is_admin'   => 0,
					'created_at' => date('Y-m-d H:i:s'),
				];
				$this->Web_model->insert_inbox($data_inbox);

				$this->session->set_flashdata('success', 'Data submission approved has been successfully.');
				redirect('inbox/show/'.$id_inbox,'refresh');
			} catch (Exception $e) {
				$this->session->set_flashdata('danger', $e->getMessage());
				redirect('inbox/show/'.$id_inbox,'refresh');
			}
		}
		if($inbox->table == 'tbl_reimbursement'){
			try {
				$data['status'] = 1;
				$id_reimbursement    = $inbox->id_table;
				$this->Web_model->update_reimbursement($id_reimbursement, $data);

				$data_inbox = [
					'table'      => 'tbl_reimbursement',
					'id_table'   => $inbox->id_reimbursement,
					'is_read'    => 0,
					'is_admin'   => 0,
					'created_at' => date('Y-m-d H:i:s'),
				];
				$this->Web_model->insert_inbox($data_inbox);

				$this->session->set_flashdata('success', 'Data submission approved has been successfully.');
				redirect('inbox/show/'.$id_inbox,'refresh');
			} catch (Exception $e) {
				$this->session->set_flashdata('danger', $e->getMessage());
				redirect('inbox/show/'.$id_inbox,'refresh');
			}
		}
	}

	public function inbox_reject($id_inbox)
	{
		$inbox = $this->Web_model->get_inbox_by_id($id_inbox);
		if($inbox->table == 'tbl_time_off'){
			try {
				$data['status'] = 2;
				$id_time_off    = $inbox->id_table;
				$this->Web_model->update_time_off($id_time_off, $data);

				$data_inbox = [
					'table'      => 'tbl_time_off',
					'id_table'   => $inbox->id_time_off,
					'is_read'    => 0,
					'is_admin'   => 0,
					'created_at' => date('Y-m-d H:i:s'),
				];
				$this->Web_model->insert_inbox($data_inbox);

				$this->session->set_flashdata('success', 'Data submission rejected has been successfully.');
				redirect('inbox/show/'.$id_inbox,'refresh');
			} catch (Exception $e) {
				$this->session->set_flashdata('danger', $e->getMessage());
				redirect('inbox/show/'.$id_inbox,'refresh');
			}
		}
		if($inbox->table == 'tbl_reimbursement'){
			try {
				$data['status'] = 2;
				$id_reimbursement    = $inbox->id_table;
				$this->Web_model->update_reimbursement($id_reimbursement, $data);

				$data_inbox = [
					'table'      => 'tbl_reimbursement',
					'id_table'   => $inbox->id_reimbursement,
					'is_read'    => 0,
					'is_admin'   => 0,
					'created_at' => date('Y-m-d H:i:s'),
				];
				$this->Web_model->insert_inbox($data_inbox);

				$this->session->set_flashdata('success', 'Data submission rejected has been successfully.');
				redirect('inbox/show/'.$id_inbox,'refresh');
			} catch (Exception $e) {
				$this->session->set_flashdata('danger', $e->getMessage());
				redirect('inbox/show/'.$id_inbox,'refresh');
			}
		}
	}

}

/* End of file Web.php */
/* Location: ./application/controllers/Web.php */