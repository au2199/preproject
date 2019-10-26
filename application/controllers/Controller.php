<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller extends CI_Controller
{
	public function __construct()
	{
		$state = false;
		parent::__construct();
		$this->load->helper('url');

		$this->load->library('csvimport');
		$this->load->model('csv_model');
	}

	/* #################################################################################################################### */
	/* #################################################################################################################### */
	/* #################################################################################################################### */
	/* #################################################################################################################### */
	/* ###########################################      LOGIN      ######################################################## */
	public function index()
	{
		if (isset($_GET['code'])) {
			$this->googleplus->getAuthenticate();
			$this->session->set_userdata('login', true);
			$this->session->set_userdata('userProfile', $this->googleplus->getUserInfo());
			echo $this->session;
			redirect('Controller/profile');
		}

		$data['loginURL'] = $this->googleplus->loginURL();
		$this->load->view('login/firstpage', $data);
	}
	public function profile()
	{
		if ($this->session->userdata('login') == true) {
			$data['profileData'] = $this->session->userdata('userProfile');
			$this->load->view('pages/teacher/home_tch', $data);
		} else {
			redirect('');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		$this->googleplus->revokeToken();
		redirect('');
	}

	/* #################################################################################################################### */
	/* ###########################################      TAB      ########################################################## */
	public function ui_main()
	{
		$this->load->view('bin/ui_main');
	}
	public function ui_footer()
	{
		$this->load->view('bin/ui_footer');
	}
	public function ui_tabtch()
	{
		$this->load->view('bin/ui_tabtch');
	}
	public function ui_tabstd()
	{
		$this->load->view('bin/ui_tabstd');
	}

	/* #################################################################################################################### */
	/* ###########################################      ADMIN      ######################################################## */
	// Pages
	public function home_admin()
	{
		$this->load->model('model');
		$data['show'] = $this->model->m_show_notice();
		$this->load->view('pages/admin/home_admin', $data);
	}
	public function control_room()
	{
		// $this->load->model('model');
		// $data['show'] = $this->model->m_show_teacher();
		// $this->load->view('db/db_user', $data);
		$this->load->view('pages/admin/control_room');
	}
	public function commit_result()
	{
		$this->load->model('model');
		$data_grp['show_grp'] = $this->model->m_show_group();
		$data_tch['show_tch'] = $this->model->m_show_teacher();
		$data['show'] = array($data_grp['show_grp'], $data_tch['show_tch']);
		$this->load->view('pages/admin/commit_result', $data);
	}
	public function log_score()
	{
		$this->load->model('model');
		$data['show'] = $this->model->m_show_student();
		$this->load->view('pages/admin/log_score', $data);
	}
	public function create_notice()
	{
		$this->load->view('pages/admin/create_notice');
	}
	public function test_score_edit()
	{
		$this->load->model('model');
		$data_grp['show_grp'] = $this->model->m_show_group();
		$data_sco['show_sco'] = $this->model->m_show_score();
		$data['show'] = array($data_grp['show_grp'], $data_sco['show_sco']);
		$this->load->view('pages/admin/test_score_edit', $data);
	}
	// Functions
	public function register_notice()
	{
		$data = array(
			'topic' => $this->input->post('topic'),
			'info_notice' => $this->input->post('info_notice'),
		);
		$this->load->model('model');
		$this->model->insert_notice($data);
		$data['show'] = $this->model->m_show_notice();
		$this->load->view('pages/admin/home_admin', $data);
	}
	public function datastd_ad()
	{
		$this->load->model('model');
		$data['show'] = $this->model->m_show_student();

		$this->load->view('pages/admin/datastd_ad', $data);
	}
	public function editstd_ad($x='')
	{
		echo "Welcome".$x;
		$data = array('student_id'=>$x);
		$this->load->model('model');
		// echo "<pre>"; print_r($data); // เอาไว้เช็คค่า id
		$result['show'] = $this->model->r_show_student($data);
		// echo "<pre>"; print_r($result); //ดูค่าในข้อมูลที่ส่งมา
		$this->load->view('pages/admin/editstd_ad',$result);
	}
	public function update_std()
	{
		$btnup = $this->input->post('up');
		$btncan = $this->input->post('can');
		$student_id = $this->input->post('ID');
		$title = $this->input->post('title');
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$email = $this->input->post('email');

		$uparr = array(
									'student_id' => $this->input->post('ID'),
                  'title' => $this->input->post('title'),
                  'fname' => $this->input->post('fname'),
									'lname' => $this->input->post('lname'),
									'email' => $this->input->post('email')
                  );

		$this->load->model('model');
		// $result = $this->model->log($uparr);
		 // echo "<pre>";print_r($delarr);
	 if($btnup == 'up')
	 {
				 $this->model->update_std($uparr);
				 // echo "<script type='text/javascript'>alert('update password success');</script> ";
				 redirect(base_url('Controller/datastd_ad'));
	 }
	 else if($btncan =='can')
	 {
				 redirect(base_url('Controller/datastd_ad'));
	 }
	}
	public function delstd_ad($x='')
	{
		// echo $x;
		$data = array('student_id'=>$x);
		$this->load->model('model');
		// echo "<pre>"; print_r($data); // เอาไว้เช็คค่า id
		$this->model->delstd_ad($data);
		echo "<script type='text/javascript'>alert('delete password success');</script> ";
		redirect(base_url('Controller/datastd_ad'));
	}
	// //////////////////////end edit std//////////////////
	////////////////// start edit del teacher/////////////////////
	public function datatch_ad()
	{
		$this->load->model('model');
		$data['show'] = $this->model->m_show_teacher();
		$this->load->view('pages/admin/datatch_ad',$data);
	}
	public function edittch_ad($x='')
	{
		// echo "Welcome".$x;
		$data = array('teacher_id'=>$x);
		$this->load->model('model');
		// echo "<pre>"; print_r($data); // เอาไว้เช็คค่า id
		$result['show'] = $this->model->r_show_teacher($data);
		// echo "<pre>"; print_r($result); //ดูค่าในข้อมูลที่ส่งมา
		$this->load->view('pages/admin/edittch_ad',$result);
	}
	public function update_tch()
	{
		$btnup = $this->input->post('up');
		$btncan = $this->input->post('can');
		$teacher_id = $this->input->post('ID');
		$title = $this->input->post('titleso');
		$fname = $this->input->post('fnameso');
		$lname = $this->input->post('lnameso');
		$ability = $this->input->post('abilityso');
		$email = $this->input->post('emailso');

		$uparr = array(
			'teacher_id' => $this->input->post('ID'),
			'title' => $this->input->post('titleso'),
			'fname' => $this->input->post('fnameso'),
			'lname' => $this->input->post('lnameso'),
			'ability' => $this->input->post('abilityso'),
			'email' => $this->input->post('emailso')
		);

			$this->load->model('model');
		 if($btnup == 'up')
		 {
					 $this->model->update_tch($uparr);
					 // echo "<script type='text/javascript'>alert('update password success');</script> ";
					 redirect(base_url('Controller/datatch_ad'));
		 }
		 else if($btncan =='can')
		 {
					 redirect(base_url('Controller/datatch_ad'));
		 }
	}
	public function deltch_ad($x='')
	{
		// echo $x;
		$data = array('teacher_id'=>$x);
		$this->load->model('model');
		$this->model->deltch_ad($data);
		redirect(base_url('Controller/datatch_ad'));
	}
	public function edit_score()
	{
		$i = $this->input->post('i');
		$group_name = $this->input->post('group_name');
		$score_document = $this->check_max_score($this->input->post('score_document' . $i));
		$score_knowledge = $this->check_max_score($this->input->post('score_knowledge' . $i));
		$score_completly = $this->check_max_score($this->input->post('score_completly' . $i));
		$score_present = $this->check_max_score($this->input->post('score_present' . $i));
		$group_id = 0;
		$this->load->model('model');
		$show_grp = $this->model->m_show_group();
		foreach ($show_grp->result() as $row_grp) {
			if ($row_grp->name_project == $group_name) {
				$group_id = $row_grp->group_id;
			}
		}
		$this->model->update_score($group_id, $score_document, $score_knowledge, $score_completly, $score_present);

		$data_grp['show_grp'] = $this->model->m_show_group();
		$data_sco['show_sco'] = $this->model->m_show_score();
		$data['show'] = array($data_grp['show_grp'], $data_sco['show_sco']);
		$this->load->view('pages/admin/test_score_edit', $data);
	}

	// /////////////////////////end edit del teacher//////////////////
	///////////start_csv////////////////
	public function importdata_admin()
	{
		$this->load->model('model');
		$data['student'] = $this->model->get_addressbook();
		$this->load->view('pages/admin/importdata_admin', $data);
		// $data['student'] = $this->csv_model->get_addressbook();
		// $this->load->view('pages/admin/importdata_admin',$data);
	}
	public function importcsv()
	{
		$this->load->model('model');
		$data['student'] = $this->model->get_addressbook();
		$data['error'] = '';    //initialize image upload error array to empty

		//convigure upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = '*';
		$config['max_size'] = '1000';

		$this->load->library('upload', $config);


		// jika upload gagal, muncul error
		if (!$this->upload->do_upload()) {
			$data['error'] = $this->upload->display_errors();

			$this->load->view('pages/admin/importdata_admin', $data);
		} else {

			//prosses upload csv berhasil serta memproses insert data ke database
			$file_data = $this->upload->data();
			$file_path =  './uploads/' . $file_data['file_name'];

			if ($this->csvimport->get_array($file_path)) {
				$csv_array = $this->csvimport->get_array($file_path);
				foreach ($csv_array as $row) {
					$insert_data = array(
						'title' => $row['title'],
						'fname' => $row['fname'],
						'lname' => $row['lname'],
						'email' => $row['email'],
					);
					$this->load->model('model');
					$this->model->insert_csv($insert_data);
				}
				$this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
				redirect(base_url() . 'Controller/importdata_admin');
				// echo "<pre>"; print_r($insert_data);
			} else
				$data['error'] = "Error occured";
			$this->load->view('pages/admin/importdata_admin', $data);
		}
	}
	// end std//////////////////////
	public function importdatatch_ad()
	{
		$this->load->model('model');
		$data['teacher'] = $this->model->get_addresstch();
		$this->load->view('pages/admin/importdatatch_ad', $data);
	}
	public function importcsvtch()
	{
		$this->load->model('model');
		$data['teacher'] = $this->model->get_addresstch();
		$data['error'] = '';    //initialize image upload error array to empty

		//convigure upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = '*';
		$config['max_size'] = '1000';

		$this->load->library('upload', $config);


		// jika upload gagal, muncul error
		if (!$this->upload->do_upload()) {
			$data['error'] = $this->upload->display_errors();

			$this->load->view('pages/admin/importdatatch_ad', $data);
		} else {

			//prosses upload csv berhasil serta memproses insert data ke database
			$file_data = $this->upload->data();
			$file_path =  './uploads/' . $file_data['file_name'];

			if ($this->csvimport->get_array($file_path)) {
				$csv_array = $this->csvimport->get_array($file_path);
				foreach ($csv_array as $row) {
					$insert_data = array(
						'type' => $row['type'],
						'title' => $row['title'],
						'fname' => $row['fname'],
						'lname' => $row['lname'],
						'ability' => $row['ability'],
						'email' => $row['email'],
					);
					$this->load->model('model');
					$this->model->inserttch_csv($insert_data);
				}
				$this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
				redirect(base_url() . 'Controller/importdatatch_ad');
				// echo "<pre>"; print_r($insert_data);
			} else
				$data['error'] = "Error occured";
			$this->load->view('pages/admin/importdatatch_ad', $data);
		}
	}
	//////end_csv//////////////////
	// okpokpokpokpokpokpokpokpokpokp//

	/* #################################################################################################################### */
	/* ###########################################      OTHER      ######################################################## */
	// Pages
	public function test_room()
	{
		$this->load->model('model');
		$data['show'] = $this->model->m_show_teacher();
		$this->load->view('pages/other/test_room', $data);
	}
	public function commit_show()
	{
		$this->load->model('model');
		$data_grp['show_grp'] = $this->model->m_show_group();
		$data_tch['show_tch'] = $this->model->m_show_teacher();
		$data_sta['show_sta'] = array('state' => '');
		$data['show'] = array($data_grp['show_grp'], $data_tch['show_tch'], $data_sta['show_sta']);
		$this->load->view('pages/other/commit_show', $data);
	}
	public function myGroup()
	{
		$group_id = $this->input->post('group_id');
		$this->load->model('model');
		$data_grp['show_grp'] = $this->model->m_show_group_select($group_id);
		$data_std['show_std'] = $this->model->m_show_student();
		$data_tch['show_std'] = $this->model->m_show_teacher();
		$data_com['show_com'] = array($data_grp['show_grp'], $data_std['show_std'], $data_tch['show_std']);
		$this->load->view('pages/other/myGroup', $data_com);
	}
	public function notice()
	{
		$notice_id = $this->input->post('notice_id');
		$this->load->model('model');
		$data_notice_select['show_not_select'] = $this->model->m_show_notice_select($notice_id);
		$data_notice['show_not'] = $this->model->m_show_notice();
		$data['show'] = array($data_notice['show_not'], $data_notice_select['show_not_select']);
		$this->load->view('pages/other/notice', $data);
	}
	public function test_show()
	{
		$this->load->model('model');
		$data_grp['show_grp'] = $this->model->m_show_group();
		$data_sco['show_sco'] = $this->model->m_show_score();
		$data['show'] = array($data_grp['show_grp'], $data_sco['show_sco']);
		$this->load->view('pages/other/test_show', $data);
	}
	// Functions

	/* #################################################################################################################### */
	/* ###########################################      TEACHER      ###################################################### */
	// Pages
	public function home_tch()
	{
		$this->load->model('model');
		$data['show'] = $this->model->m_show_notice();
		$this->load->view('pages/teacher/home_tch', $data);
	}
	public function test_score()
	{
		$this->load->model('model');
		$data_grp['show_grp'] = $this->model->m_show_group();
		$data_err['show_err'] = array('error' => '');
		$data['show'] = array($data_grp['show_grp'], $data_err['show_err']);
		$this->load->view('pages/teacher/test_score', $data);
	}
	public function create_group()
	{
		$this->load->model('model');
		$data_std['show_std'] = $this->model->m_show_student();
		$data_err['show_err'] = array('error' => '');
		$data['show'] = array($data_std['show_std'], $data_err['show_err']);
		$this->load->view('pages/teacher/create_group', $data);
	}
	public function sel_commit_tch()
	{
		$this->load->model('model');
		$data['show'] = $this->model->m_show_group();
		$this->load->view('pages/teacher/sel_commit_tch', $data);
	}
	public function show_adviser_tch()
	{
		$this->load->model('model');
		$data_grp['show_grp'] = $this->model->m_show_group();
		$data_std['show_std'] = $this->model->m_show_student();
		$data['show'] = array($data_grp['show_grp'], $data_std['show_std']);
		$this->load->view('pages/teacher/show_adviser_tch', $data);
	}
	// Funstion
	public function register()
	{
		$btn = $this->input->post('submit');
		// echo $btn . '<br>'; // check
		if ($btn == 'teacher') {
			// $type = $this->input->post('type');
			$title = $this->input->post('title');
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$ability = $this->input->post('ability');
			$adviser = $this->input->post('adviser');
			$committee = $this->input->post('committee');
			$data = array(
				// 'type' => $this->input->post('type'),
				'title' => $this->input->post('title'),
				'fname' => $this->input->post('fname'),
				'lname' => $this->input->post('lname'),
				'ability' => $this->input->post('ability'),
				'adviser' => $this->input->post('adviser'),
				'committee' => $this->input->post('committee'),
			);
			$this->load->model('model');
			$this->model->insert_tch($data);
			$this->load->view('pages/teacher/home_tch');
		} else if ($btn == 'student') {
			// create lockbook
			$type = $this->input->post('type');
			$data = array(
				'lock_adviser' => 'www.googledrive.com',
				'lock_commit' => 'www.googledrive.com',
			);
			$this->load->model('model');
			$this->model->insert_lockbook($data);
			// find last no. lockbook
			$this->load->model('model');
			$show = $this->model->m_show_lockbook();
			// create student
			if ($show->num_rows() > 0) {
				foreach ($show->result() as $row) { }
				// echo $row->lock_id . '<br>'; // check
			}
			$title = $this->input->post('title');
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$data = array(
				'title' => $this->input->post('title'),
				'fname' => $this->input->post('fname'),
				'lname' => $this->input->post('lname'),
				'lockbook_lock_id' => $row->lock_id,
			);
			$this->load->model('model');
			$this->model->insert_std($data);
			$this->load->view('pages/student/home_std');
		} else if ($btn == 'create_group') {
			if (!empty($this->input->post('student_student_id_1'))) {
				$data = array(
					'req_1' => 1,
					'req_2' => 2,
					'req_3' => 3,
					'req_4' => 4,
				);
				$this->load->model('model');
				$this->model->insert_request($data);
				// find last no. request
				$this->load->model('model');
				$show_request = $this->model->m_show_request();
				// create request
				$data = array(
					'document' => 0,
					'knowledge' => 0,
					'completly' => 0,
					'present' => 0,
				);
				$this->load->model('model');
				$this->model->insert_score($data);
				// find last no. score
				$this->load->model('model');
				$show_score = $this->model->m_show_score();
				// create score
				if ($show_request->num_rows() > 0) {
					foreach ($show_request->result() as $row_request) { }
				}
				if ($show_score->num_rows() > 0) {
					foreach ($show_score->result() as $row_score) { }
				}
				$this->load->model('model');
				if (!empty($this->input->post('student_student_id_1')) && !empty($this->input->post('student_student_id_2') && !empty($this->input->post('student_student_id_3')))) {
					$data = array(
						'data' => 'www.googledrive.com',
						'name_project' => $this->input->post('name_project'),
						'info_project' => $this->input->post('info_project'),
						'check1' => false,
						'check2' => false,
						'teacher_teacher_id' => $this->input->post('teacher_id'),
						'student_student_id_1' => $this->input->post('student_student_id_1'),
						'student_student_id_2' => $this->input->post('student_student_id_2'),
						'student_student_id_3' => $this->input->post('student_student_id_3'),
						'request_request_id' => $row_request->request_id,
						'score_score_id' => $row_score->score_id,
						'teacher_commit_id_1' => $this->input->post('teacher_id'),
						'teacher_commit_id_2' => $this->input->post('teacher_id'),
					);
				} else {
					$data = array(
						'data' => 'www.googledrive.com',
						'name_project' => $this->input->post('name_project'),
						'info_project' => $this->input->post('info_project'),
						'check1' => false,
						'check2' => false,
						'teacher_teacher_id' => $this->input->post('teacher_id'),
						'student_student_id_1' => $this->input->post('student_student_id_1'),
						'student_student_id_2' => $this->input->post('student_student_id_1'),
						'student_student_id_3' => $this->input->post('student_student_id_1'),
						'request_request_id' => $row_request->request_id,
						'score_score_id' => $row_score->score_id,
						'teacher_commit_id_1' => $this->input->post('teacher_id'),
						'teacher_commit_id_2' => $this->input->post('teacher_id'),
					);
				}
				$this->model->insert_group($data);
				$data_err['show_err'] = array('error' => '');
			} else {
				// echo "NOT COMPLETE";
				$data_err['show_err'] = array('error' => 'error');
			}
			$this->load->model('model');
			$data_std['show_std'] = $this->model->m_show_student();
			$data['show'] = array($data_std['show_std'], $data_err['show_err']);
			$this->load->view('pages/teacher/create_group', $data);
		}
	}
	public function cal_sel_commit_tch()
	{
		$this->load->model('model');;
		for ($i = 1; $i <= $this->input->post('submit'); $i++) {
			echo $this->input->post($i);
		}
		$data['show'] = $this->model->m_show_group();
		$this->load->view('pages/teacher/sel_commit_tch', $data);
	}
	public function check_max_score($score)
	{
		if ($score > 25) {
			return 25;
		} else {
			return $score;
		}
	}
	public function update_score()
	{
		if (!empty($this->input->post('group_name')) && !empty($this->input->post('score_document')) && !empty($this->input->post('score_knowledge')) && !empty($this->input->post('score_completly')) && !empty($this->input->post('score_present'))) {
			$weight_document = $this->input->post('weight_document');
			$weight_knowledge = $this->input->post('weight_knowledge');
			$weight_completly = $this->input->post('weight_completly');
			$weight_present = $this->input->post('weight_present');

			$group_name = $this->input->post('group_name');
			$score_document = $this->check_max_score($this->input->post('score_document')) * $weight_document;
			$score_knowledge = $this->check_max_score($this->input->post('score_knowledge')) * $weight_knowledge;
			$score_completly = $this->check_max_score($this->input->post('score_completly')) * $weight_completly;
			$score_present = $this->check_max_score($this->input->post('score_present')) * $weight_present;
			$group_id = 0;
			$this->load->model('model');
			$show_grp = $this->model->m_show_group();
			foreach ($show_grp->result() as $row_grp) {
				if ($row_grp->name_project == $group_name) {
					$group_id = $row_grp->group_id;
				}
			}
			$this->model->update_score($group_id, $score_document, $score_knowledge, $score_completly, $score_present);
			$data_err['show_err'] = array('error' => '');
		} else {
			$data_err['show_err'] = array('error' => 'error');
		}
		$this->load->model('model');
		$data_grp['show_grp'] = $this->model->m_show_group();
		$data['show'] = array($data_grp['show_grp'], $data_err['show_err']);
		$this->load->view('pages/teacher/test_score', $data);
	}

	/* #################################################################################################################### */
	/* ###########################################      STUDENT      ###################################################### */
	// Pages
	public function home_std()
	{
		$this->load->model('model');
		$data['show'] = $this->model->m_show_notice();
		$this->load->view('pages/student/home_std', $data);
	}
	public function infotch_std()
	{
		$this->load->model('model');
		$data['show'] = $this->model->m_show_teacher();
		$this->load->view('pages/student/infotch_std', $data);
	}
	// Function

	/* #################################################################################################################### */
	/* #################################################################################################################### */
	/* #################################################################################################################### */
	/* #################################################################################################################### */
	/* #################################################################################################################### */
	/*
	public function news()
	{
		$this->load->view('pages/other/news');
	}
	public function view_proj()
	{
		// $group_id = 1;
		$group_id = $this->input->post('group_id');
		$this->load->model('model');
		$data_grp['show_grp'] = $this->model->m_show_group_select($group_id);
		$data_std['show_std'] = $this->model->m_show_student();
		$data_tch['show_std'] = $this->model->m_show_teacher();
		$data_com['show_com'] = array($data_grp['show_grp'], $data_std['show_std'], $data_tch['show_std']);
		$this->load->view('P01', $data_com);
	}
	public function progress_project()
	{
		$this->load->view('student/progress_project');
	}
	public function mange_project()
	{
		$this->load->view('student/mange_project');
	}
	public function regist_tch()
	{
		$this->load->view('teacher/register');
	}
	public function regist_std()
	{
		$this->load->view('student/register');
	}
	public function upload_photo()
	{
		$this->load->view('student/upload_photo');
	}
	public function show_consult()
	{
		$this->load->view('student/commit_show');
	}
	public function info()
	{
		$this->load->view('teacher/info');
	}
	public function adviser()
	{
		$this->load->view('student/adviser');
	}
	public function commit()
	{
		$this->load->model('model');
		$data['show'] = $this->model->m_show_group();
		$this->load->view('teacher/commit', $data);
	}
	public function consult()
	{
		$this->load->model('model');
		$data['show'] = $this->model->m_show_group();
		$this->load->view('teacher/consult', $data);
	}
	public function recieve()
	{
		$user = $this->input->post('username');
		//echo $user ;
		$pass = $this->input->post('password');
		$submit = $this->input->post('Submit'); // เก็บค่า post('name') ของปุ่ม Submit
		$cancel = $this->input->post('Cancel');
		$plus = $this->input->post('plus');
		$del = $this->input->post('delete');
		$log = $this->input->post('Log');
		$out = $this->input->post('Out');
		$name = array(
			'user' => $this->input->post('username'), // 'user' ใส่แทน ตน.แรก ของอาเรย์ แล้วรับค่า  name จากไฟล์ login_form
			'pass' => $this->input->post('password'),
			'id' => $this->input->post('id')
		);
		if ($submit == 'submit') // $submit =='value' ของ login_form
		{
			// $data['todo_list'] = array('Clean House', 'Call Mom', 'Run Errands');
			//
			//      $data['title'] = "My Real Title";
			//      $data['heading'] = "My Real Heading";

			//$this->load->view('blogview', $data);

			echo "<pre/>"; //เว้นบรรทัด
			// print_r($name); //ปริ้น array
			// print_r($data);
			//echo "<br/>".$this->input->post('username'); //แสดงค่า  username จากฝั่ง login_formตัว input
			//var_dump($name);
			// //sort($name); //มีสำเร็จรูป sort เรียงข้อมูล count เก็บจำนวนทั้งหมดในarray
			// $length = count($name);
			//   for($x = 0; $x < $length; $x++) {
			//       echo $name[$x];
			//       echo "<br>";
			//     }

			foreach ($name as $x => $x_value) //นำค่าใน อาเรมาเเสดง
			{
				echo  "<input type = 'button' class = 'button' value= '" . $x . " is " . $x_value . "'/>";
				//echo "<input type ='button' class='button' value='" .intval($array2[$i]+$array2[$i+1])."' />";
				echo "<br>";
			}
		} elseif ($plus == 'plus') {
			// echo $user."<br/>";
			// echo $pass."<br/>";
			$sum = $user + $pass;
			echo "<input type='button' class= 'button' value='" . " sum is " . $sum . "' />";
		} elseif ($del == 'delete') {
			$minus = $user - $pass;
			echo "<input type = 'button' class = 'button' value='" . "minus is " . $minus . "'/>";
		} elseif ($log == 'Log') {
			if ($user == $name['user'] && $pass == $name['pass']) {
				echo "success";
			}
		}
		// elseif($out == 'Out')
		// {
		//   for($i=0;$i<$name[];)
		// }
		else {
			//echo $cancel; // แสดง value ของ login_form
			echo 'error';
		}
	}
	// public function picture()
	// {
	//       $pic = $this->input->post('photo');
	//       if($pic == 'photo')
	//       {
	//         echo "<input type='button' class='center' value='"."picture"."'/>";
	//       }
	// }
	public function lo()
	{
		$this->load->view('login_form');
	}
	public function Re()
	{
		$btn = $this->input->post('submit');
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
		$data = array(
			'name' => $this->input->post('user'),
			'pass' => $this->input->post('pass')
		);

		$this->load->model('model');
		$this->model->insert($data);

		echo "<pre>";
		print_r($data);
		echo $user;
		echo $pass;

		// redirect(base_url('Test/index'));

		//$this->model->show();
	}

	public function cha()
	{
		$this->load->view('chaview');
	}
	public function c_show()
	{
		$this->load->model('model');
		// $this->model->insert($data);
		$s = $this->model->get();
		echo "<pre>"; //print_r($s);
		// print_r($data);
		// echo $s->row('user') . "<br>";
		foreach ($s->result() as $row) {
			if ($row->user ==  'gill') {
				// echo "user is " . $row->user . "<br>";
				// $s['user'] = $s + 1;
				// print_r($s);
				$this->load->view('db/db_user', $s);
			}
			// echo "password is " . $row->pass . "<br>";
		}
	}
	public function ui_login()
	{
		$this->load->view('bin/ui_login');
	}
	public function test()
	{
		$this->load->view('test');
	}
	*/
}
?>



<!-- ถ้าจะใช้pgadmin ต้องไปxampp กด config apache php.ini clt+f หาคำว่า pdo เอา ; ออกตรง extension=php_pdo_mysql -->
<!-- อย่าลืมสร้างไฟล์นอก โปรเจคเรา ชื่อ .htaccess แล้วก็อปมาว่างเลย   -->
