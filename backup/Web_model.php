<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_model extends CI_Model {

	public function get_role(){
		$this->db->select('*');
		$this->db->from('tbl_role');
		$this->db->order_by('name', 'asc');
		return $this->db->get()->result();
	}

	public function get_user($keyword=null){
		$this->db->select('a.*, b.name as role');
		$this->db->from('tbl_user a');
		$this->db->join('tbl_role b', 'a.id_role = b.id_role', 'left');
		if($keyword) $this->db->like('a.name', $keyword, 'BOTH');
		$this->db->order_by('a.name', 'asc');
		return $this->db->get()->result();
	}

	public function get_user_by_id($id_user){
		$this->db->select('a.*, b.name as role');
		$this->db->from('tbl_user a');
		$this->db->join('tbl_role b', 'a.id_role = b.id_role', 'left');
		$this->db->where('sha1(a.id_user)', $id_user);
		return $this->db->get()->row();
	}

	public function insert_user($data){
		$this->db->insert('tbl_user', $data);
		return $this->db->insert_id();
	}

	public function update_user($id_user, $data){
		$this->db->update('tbl_user', $data, ['sha1(id_user)'=>$id_user]);
		return $this->db->affected_rows();
	}

	public function delete_user($id_user, &$file_photo){
		$user = $this->Web_model->get_user_by_id($id_user);
		if($user) $file_photo = $user->photo;
		$this->db->delete('tbl_user', ['sha1(id_user)'=>$id_user]);
		return $this->db->affected_rows();
	}

	public function check_login_admin($email, $password, &$result){
		$this->db->select('a.*, b.name as role');
		$this->db->from('tbl_user a');
		$this->db->join('tbl_role b', 'a.id_role = b.id_role', 'left');
		$this->db->where('a.email', $email);
		$this->db->where('a.is_active', '1');
		$user = $this->db->get()->row();
		if($user){
			if(password_verify($password, $user->password)){
				if($user->is_active == '1'){
					$result = (array)$user;
					return true;
				}else{
					$result['type']    = 'danger';
					$result['message'] = 'Account is not active.';
					return false;
				}
			}else{
				$result['type']    = 'danger';
				$result['message'] = 'Wrong password.';
				return false;
			}
		}else{
			$result['type']    = 'danger';
			$result['message'] = 'Email is not registered.';
			return false;
		}
	}

	public function check_login_employee($nik, $password, &$result){
		$this->db->select('a.*, b.name as position');
		$this->db->from('tbl_employee a');
		$this->db->join('tbl_position b', 'a.id_position = b.id_position', 'left');
		$this->db->where('a.nik', $nik);
		$this->db->where('a.is_active', '1');
		$user = $this->db->get()->row();
		if($user){
			if(password_verify($password, $user->password)){
				if($user->is_active == '1'){
					$result = (array)$user;
					return true;
				}else{
					$result['type']    = 'danger';
					$result['message'] = 'Account is not active.';
					return false;
				}
			}else{
				$result['type']    = 'danger';
				$result['message'] = 'Wrong password.';
				return false;
			}
		}else{
			$result['type']    = 'danger';
			$result['message'] = 'NIK is not registered.';
			return false;
		}
	}

	public function get_setting(){
		$this->db->select('*');
		$this->db->from('tbl_setting');
		$this->db->where('id_setting', '1');
		return $this->db->get()->row();
	}

	public function update_setting($data, $where){
		$this->db->update('tbl_setting', $data, $where);
		return $this->db->affected_rows();
	}

	public function get_position($keyword=null){
		$this->db->select('*');
		$this->db->from('tbl_position');
		if($keyword) $this->db->like('name', $keyword, 'BOTH');
		$this->db->order_by('name', 'asc');
		return $this->db->get()->result();
	}

	public function get_position_by_id($id_position){
		$this->db->select('*');
		$this->db->from('tbl_position');
		$this->db->where('sha1(id_position)', $id_position);
		return $this->db->get()->row();
	}

	public function insert_position($data){
		$this->db->insert('tbl_position', $data);
		return $this->db->insert_id();
	}

	public function update_position($id_position, $data){
		$this->db->update('tbl_position', $data, ['sha1(id_position)'=>$id_position]);
		return $this->db->affected_rows();
	}

	public function delete_position($id_position){
		$this->db->delete('tbl_position', ['sha1(id_position)'=>$id_position]);
		return $this->db->affected_rows();
	}

	public function get_employee($keyword=null){
		$this->db->select('a.*, b.name as position');
		$this->db->from('tbl_employee a');
		$this->db->join('tbl_position b', 'a.id_position = b.id_position', 'left');
		if($keyword) $this->db->like('a.name', $keyword, 'BOTH');
		$this->db->order_by('a.name', 'asc');
		return $this->db->get()->result();
	}

	public function get_employee_by_id($id_employee){
		$this->db->select('a.*, b.name as position');
		$this->db->from('tbl_employee a');
		$this->db->join('tbl_position b', 'a.id_position = b.id_position', 'left');
		$this->db->where('sha1(a.id_employee)', $id_employee);
		return $this->db->get()->row();
	}

	public function insert_employee($data){
		$this->db->insert('tbl_employee', $data);
		return $this->db->insert_id();
	}

	public function update_employee($id_employee, $data){
		$this->db->update('tbl_employee', $data, ['sha1(id_employee)'=>$id_employee]);
		return $this->db->affected_rows();
	}

	public function delete_employee($id_employee, &$file_photo){
		$employee = $this->Web_model->get_employee_by_id($id_employee);
		if($employee) $file_photo = $employee->photo;
		$this->db->delete('tbl_employee', ['sha1(id_employee)'=>$id_employee]);
		return $this->db->affected_rows();
	}

	public function check_attendance(){
		$this->db->select('*');
		$this->db->from('tbl_attendance');
		$this->db->where('id_employee', $this->session->id_employee);
		$this->db->where('date', date('Y-m-d'));
		return $this->db->get()->row();
	}

	public function get_attendance_by_id($id_attendance){
		$this->db->select('a.*, b.nik, b.name as employee, b.photo as employee_photo, c.name as position');
		$this->db->from('tbl_attendance a');
		$this->db->join('tbl_employee b', 'a.id_employee = b.id_employee', 'left');
		$this->db->join('tbl_position c', 'b.id_position = c.id_position', 'left');
		$this->db->where('sha1(a.id_attendance)', $id_attendance);
		$this->db->order_by('a.clock_in', 'asc');
		return $this->db->get()->row();
	}

	public function get_attendance_today(){
		$this->db->select('a.*, b.name as employee, b.photo as employee_photo, c.name as position');
		$this->db->from('tbl_attendance a');
		$this->db->join('tbl_employee b', 'a.id_employee = b.id_employee', 'left');
		$this->db->join('tbl_position c', 'b.id_position = c.id_position', 'left');
		$this->db->where('a.date', date('Y-m-d'));
		$this->db->order_by('a.clock_in', 'asc');
		return $this->db->get()->result();
	}

	public function get_attendance_history($id_employee, $month, $year){
		$this->db->select('*');
		$this->db->from('tbl_attendance');
		$this->db->where('id_employee', $id_employee);
		$this->db->where('MONTH(date)', $month);
		$this->db->where('YEAR(date)', $year);
		$this->db->order_by('date', 'asc');
		return $this->db->get()->result();
	}

	public function get_attendance_by_employee_today($id_employee){
		$this->db->select('*');
		$this->db->from('tbl_attendance');
		$this->db->where('id_employee', $id_employee);
		$this->db->where('date', date('Y-m-d'));
		return $this->db->get()->row();
	}

	public function get_attendance_by_employee_month($id_employee, $month=null, $year=null){
		$this->db->select('*');
		$this->db->from('tbl_attendance');
		$this->db->where('id_employee', $id_employee);
		if($month){
			$this->db->where('MONTH(date)', $month);
		}else{
			$this->db->where('MONTH(date)', date('m'));
		}
		if($year){
			$this->db->where('YEAR(date)', $year);
		}else{
			$this->db->where('YEAR(date)', date('Y'));
		}
		if($month && $year){
			$this->db->order_by('date', 'asc');
		}else{
			$this->db->order_by('date', 'desc');
		}
		return $this->db->get()->result();
	}

	public function get_attendance_by_employee_month_total($id_employee){
		$setting = $this->get_setting();
		$this->db->select("COUNT(id_employee) as total_present, SUM(IF(clock_in > '$setting->clock_in', 1, 0)) as total_overdue");
		$this->db->from('tbl_attendance');
		$this->db->where('id_employee', $id_employee);
		$this->db->where('YEAR(date)', date('Y'));
		$this->db->where('MONTH(date)', date('m'));
		return $this->db->get()->row();
	}

	public function get_attendance_by_admin_date($date){
		$this->db->select('a.*, b.name as employee, b.photo as employee_photo, c.name as position');
		$this->db->from('tbl_attendance a');
		$this->db->join('tbl_employee b', 'a.id_employee = b.id_employee', 'left');
		$this->db->join('tbl_position c', 'b.id_position = c.id_position', 'left');
		$this->db->where('a.date', $date);
		$this->db->order_by('a.clock_in', 'asc');
		return $this->db->get()->result();
	}

	public function get_attendance_by_admin_today_total(){
		$setting = $this->get_setting();
		$this->db->select("COUNT(id_employee) as total_present, SUM(IF(clock_in > '$setting->clock_in', 1, 0)) as total_overdue");
		$this->db->from('tbl_attendance');
		$this->db->where('date', date('Y-m-d'));
		return $this->db->get()->row();
	}

	public function insert_attendance($data){
		$this->db->insert('tbl_attendance', $data);
		return $this->db->insert_id();
	}

	public function update_attendance($data, $where){
		$this->db->update('tbl_attendance', $data, $where);
		return $this->db->affected_rows();
	}

	public function get_agenda($id_employee=null){
		$this->db->select('a.*, b.name as employee');
		$this->db->from('tbl_agenda a');
		$this->db->join('tbl_employee b', 'a.id_employee = b.id_employee', 'left');
		if($id_employee){
			$this->db->where('a.id_employee', $id_employee);
		}
		$this->db->order_by('a.datetime', 'desc');
		return $this->db->get()->result();
	}

	public function get_agenda_by_employee_today($id_employee){
		$this->db->select('*');
		$this->db->from('tbl_agenda');
		$this->db->where('id_employee', $id_employee);
		$this->db->where('DATE(datetime)', date('Y-m-d'));
		return $this->db->get()->row();
	}

	public function insert_agenda($data){
		$this->db->insert('tbl_agenda', $data);
		return $this->db->insert_id();
	}

	public function get_payslip($id_employee=null){
		$this->db->select('a.*, b.name as employee');
		$this->db->from('tbl_payslip a');
		$this->db->join('tbl_employee b', 'a.id_employee = b.id_employee', 'left');
		if($id_employee){
			$this->db->where('a.id_employee', $id_employee);
		}
		$this->db->order_by('a.period', 'desc');
		return $this->db->get()->result();
	}

	public function get_payslip_by_id($id_payslip){
		$this->db->select('a.*, b.name as employee');
		$this->db->from('tbl_payslip a');
		$this->db->join('tbl_employee b', 'a.id_employee = b.id_employee', 'left');
		$this->db->where('sha1(a.id_payslip)', $id_payslip);
		$this->db->order_by('a.period', 'desc');
		return $this->db->get()->row();
	}

	public function insert_payslip($data){
		$this->db->insert('tbl_payslip', $data);
		return $this->db->insert_id();
	}

	public function get_time_off($id_employee=null){
		$this->db->select('a.*, b.name as employee');
		$this->db->from('tbl_time_off a');
		$this->db->join('tbl_employee b', 'a.id_employee = b.id_employee', 'left');
		if($id_employee){
			$this->db->where('a.id_employee', $id_employee);
		}
		$this->db->order_by('a.date', 'desc');
		return $this->db->get()->result();
	}

	public function get_time_off_by_id($id_time_off){
		$this->db->select('a.*, b.name as employee');
		$this->db->from('tbl_time_off a');
		$this->db->join('tbl_employee b', 'a.id_employee = b.id_employee', 'left');
		$this->db->where('sha1(a.id_time_off)', $id_time_off);
		$this->db->order_by('a.date', 'desc');
		return $this->db->get()->row();
	}

	public function get_time_off_by_employee($id_employee){
		$this->db->select('*');
		$this->db->from('tbl_time_off');
		$this->db->where('id_employee', $id_employee);
		$this->db->order_by('date', 'desc');
		return $this->db->get()->result();
	}

	public function get_time_off_month_total($id_employee){
		$this->db->select('SUM(IF(type = 1, 1, 0)) as total_sick, SUM(IF(type = 2, 1, 0)) as total_permission');
		$this->db->from('tbl_time_off');
		$this->db->where('id_employee', $id_employee);
		$this->db->where('YEAR(date)', date('Y'));
		$this->db->where('MONTH(date)', date('m'));
		$this->db->where('status', '1');
		return $this->db->get()->row();
	}

	public function get_time_off_admin_today_total(){
		$this->db->select('SUM(IF(type = 1, 1, 0)) as total_sick, SUM(IF(type = 2, 1, 0)) as total_permission');
		$this->db->from('tbl_time_off');
		$this->db->where('date', date('Y-m-d'));
		$this->db->where('status', '1');
		return $this->db->get()->row();
	}

	public function insert_time_off($data){
		$this->db->insert('tbl_time_off', $data);
		return $this->db->insert_id();
	}

	public function update_time_off($id_time_off, $data){
		$this->db->update('tbl_time_off', $data, ['id_time_off'=>$id_time_off]);
		return $this->db->affected_rows();
	}

	public function get_reimbursement($id_employee=null){
		$this->db->select('a.*, b.name as employee');
		$this->db->from('tbl_reimbursement a');
		$this->db->join('tbl_employee b', 'a.id_employee = b.id_employee', 'left');
		if($id_employee){
			$this->db->where('a.id_employee', $id_employee);
		}
		$this->db->order_by('a.date', 'desc');
		return $this->db->get()->result();
	}

	public function get_reimbursement_by_id($id_reimbursement){
		$this->db->select('a.*, b.name as employee');
		$this->db->from('tbl_reimbursement a');
		$this->db->join('tbl_employee b', 'a.id_employee = b.id_employee', 'left');
		$this->db->where('sha1(a.id_reimbursement)', $id_reimbursement);
		$this->db->order_by('a.date', 'desc');
		return $this->db->get()->row();
	}

	public function get_reimbursement_by_employee($id_employee){
		$this->db->select('*');
		$this->db->from('tbl_reimbursement');
		$this->db->where('id_employee', $id_employee);
		$this->db->order_by('date', 'desc');
		return $this->db->get()->result();
	}

	public function insert_reimbursement($data){
		$this->db->insert('tbl_reimbursement', $data);
		return $this->db->insert_id();
	}

	public function update_reimbursement($id_reimbursement, $data){
		$this->db->update('tbl_reimbursement', $data, ['id_reimbursement'=>$id_reimbursement]);
		return $this->db->affected_rows();
	}

	public function get_attendance_recapitulation($month, $year){
		$this->db->select('
			b.nik,
			b.name as employee,
			MAX(IF(DAY(a.date) = 1, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day1,
			MAX(IF(DAY(a.date) = 2, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day2,
			MAX(IF(DAY(a.date) = 3, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day3,
			MAX(IF(DAY(a.date) = 4, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day4,
			MAX(IF(DAY(a.date) = 5, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day5,
			MAX(IF(DAY(a.date) = 6, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day6,
			MAX(IF(DAY(a.date) = 7, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day7,
			MAX(IF(DAY(a.date) = 8, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day8,
			MAX(IF(DAY(a.date) = 9, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day9,
			MAX(IF(DAY(a.date) = 10, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day10,
			MAX(IF(DAY(a.date) = 11, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day11,
			MAX(IF(DAY(a.date) = 12, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day12,
			MAX(IF(DAY(a.date) = 13, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day13,
			MAX(IF(DAY(a.date) = 14, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day14,
			MAX(IF(DAY(a.date) = 15, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day15,
			MAX(IF(DAY(a.date) = 16, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day16,
			MAX(IF(DAY(a.date) = 17, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day17,
			MAX(IF(DAY(a.date) = 18, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day18,
			MAX(IF(DAY(a.date) = 19, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day19,
			MAX(IF(DAY(a.date) = 20, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day20,
			MAX(IF(DAY(a.date) = 21, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day21,
			MAX(IF(DAY(a.date) = 22, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day22,
			MAX(IF(DAY(a.date) = 23, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day23,
			MAX(IF(DAY(a.date) = 24, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day24,
			MAX(IF(DAY(a.date) = 25, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day25,
			MAX(IF(DAY(a.date) = 26, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day26,
			MAX(IF(DAY(a.date) = 27, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day27,
			MAX(IF(DAY(a.date) = 28, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day28,
			MAX(IF(DAY(a.date) = 29, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day29,
			MAX(IF(DAY(a.date) = 30, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day30,
			MAX(IF(DAY(a.date) = 31, CONCAT(a.clock_in, "-", IFNULL(a.clock_out,"00:00:00")), "")) as day31,
		');
		$this->db->from('tbl_attendance a');
		$this->db->join('tbl_employee b', 'a.id_employee = b.id_employee', 'left');
		$this->db->where('MONTH(a.date)', $month);
		$this->db->where('YEAR(a.date)', $year);
		$this->db->group_by('a.id_employee');
		return $this->db->get()->result();
	}

	public function get_inbox(){
		$result = array();
		$this->db->select('*');
		$this->db->from('tbl_inbox');
		if(is_admin()){
			$this->db->where('is_admin', '1');
		}
		if(is_employee()){
			$this->db->where('is_admin', '0');
			$this->db->where('is_read', '0');
		}
		$this->db->order_by('created_at', 'desc');
		$inbox = $this->db->get()->result();
		if($inbox){
			foreach($inbox as $row){
				if($row->table == 'tbl_time_off'){
					$this->db->select('a.*, b.*, c.name as employee');
					$this->db->from('tbl_inbox a');
					$this->db->join('tbl_time_off b', 'a.id_table = b.id_time_off', 'left');
					$this->db->join('tbl_employee c', 'b.id_employee = c.id_employee', 'left');
					$this->db->where('a.id_inbox', $row->id_inbox);
					if(is_admin()){
						$this->db->where('b.status', '0');
					}
					if(is_employee()){
						$this->db->where('b.id_employee', $this->session->id_employee);
					}
					$data = $this->db->get()->row();
					if($data){
						array_push($result, $data);
					}
				}
				if($row->table == 'tbl_reimbursement'){
					$this->db->select('a.*, b.*, c.name as employee');
					$this->db->from('tbl_inbox a');
					$this->db->join('tbl_reimbursement b', 'a.id_table = b.id_reimbursement', 'left');
					$this->db->join('tbl_employee c', 'b.id_employee = c.id_employee', 'left');
					$this->db->where('a.id_inbox', $row->id_inbox);
					if(is_admin()){
						$this->db->where('b.status', '0');
					}
					if(is_employee()){
						$this->db->where('b.id_employee', $this->session->id_employee);
					}
					$data = $this->db->get()->row();
					if($data){
						array_push($result, $data);
					}
				}
			}
		}
		return $result;
	}

	public function get_inbox_by_id($id_inbox){
		$this->db->select('*');
		$this->db->from('tbl_inbox');
		$this->db->where('sha1(id_inbox)', $id_inbox);
		$inbox = $this->db->get()->row();
		if($inbox){
			if($inbox->table == 'tbl_time_off'){
				$this->db->select('a.*, b.*, c.name as employee');
				$this->db->from('tbl_inbox a');
				$this->db->join('tbl_time_off b', 'a.id_table = b.id_time_off', 'left');
				$this->db->join('tbl_employee c', 'b.id_employee = c.id_employee', 'left');
				$this->db->where('a.id_inbox', $inbox->id_inbox);
				$result = $this->db->get()->row();
			}
			if($inbox->table == 'tbl_reimbursement'){
				$this->db->select('a.*, b.*, c.name as employee');
				$this->db->from('tbl_inbox a');
				$this->db->join('tbl_reimbursement b', 'a.id_table = b.id_reimbursement', 'left');
				$this->db->join('tbl_employee c', 'b.id_employee = c.id_employee', 'left');
				$this->db->where('a.id_inbox', $inbox->id_inbox);
				$result = $this->db->get()->row();
			}
		}
		return $result;
	}

	public function insert_inbox($data){
		$this->db->insert('tbl_inbox', $data);
		return $this->db->insert_id();
	}

	public function update_inbox($id_inbox, $data){
		$this->db->update('tbl_inbox', $data, ['sha1(id_inbox)'=>$id_inbox]);
		return $this->db->affected_rows();
	}

}

/* End of file Web_model.php */
/* Location: ./application/models/Web_model.php */