<?php
class model extends CI_model
{
  private $db_teacher = 'teacher';
  private $db_student = 'student';
  private $db_lockbook = 'lockbook';
  private $db_group = 'group';
  private $db_request = 'request';
  private $db_score = 'score';
  private $db_notice = 'notice';
  public function __construct()
  {
      parent::__construct();
  }
  public function insert_tch($data)
  {
    $this->db->insert($this->db_teacher, $data);
  }
  public function insert_std($data)
  {
    $this->db->insert($this->db_student, $data);
  }
  public function insert_lockbook($data)
  {
    $this->db->insert($this->db_lockbook, $data);
  }
  public function insert_group($data)
  {
    $this->db->insert($this->db_group, $data);
  }
  public function insert_request($data)
  {
    $this->db->insert($this->db_request, $data);
  }
  public function insert_score($data)
  {
    $this->db->insert($this->db_score, $data);
  }
  public function insert_notice($data)
  {
    $this->db->insert($this->db_notice, $data);
  }

  public function m_show_teacher()
  {
    // $query = $this->db->get('teacher');
    // $query = $this->db->query("SELECT * FROM teacher ORDER BY teacher_id DESC");
    $this->db->select("*");
    $this->db->from("teacher");
    $query = $this->db->get();
    return $query;
  }

  public function m_show_student()
  {
    $this->db->select("*");
    $this->db->from("student");
    $query = $this->db->get();
    return $query;
  }

  public function m_show_group()
  {
    $this->db->select("*");
    $this->db->from("group");
    $query = $this->db->get();
    return $query;
  }

  public function m_show_group_select($group_id)
  {
    $this->db->select("*");
    $this->db->from("group");
    $this->db->where("group_id = $group_id");
    // $this->db->join('student', 'student_student_id = student_id', 'right');
    $query = $this->db->get();
    return $query;
  }

  public function m_show_lockbook()
  {
    $this->db->select("*");
    $this->db->from("lockbook");
    $query = $this->db->get();
    return $query;
  }

  public function m_show_request()
  {
    $this->db->select("*");
    $this->db->from("request");
    $query = $this->db->get();
    return $query;
  }

  public function m_show_score()
  {
    $this->db->select("*");
    $this->db->from("score");
    $query = $this->db->get();
    return $query;
  }

  public function m_show_notice()
  {
    $this->db->select("*");
    $this->db->from("notice");
    $query = $this->db->get();
    return $query;
  }

  public function m_show_notice_select($notice_id)
  {
    $this->db->select("*");
    $this->db->from("notice");
    $this->db->where("notice_id = $notice_id");
    // $this->db->join('student', 'student_student_id = student_id', 'right');
    $query = $this->db->get();
    return $query;
  }

  // public function get()
  // {
  //   $query = $this->db->get('teacher');
  //   foreach ($query->result() as $row) {
  //     // echo $row->user;
  //     // $row->user;
  //     // $row->pass;
  //   }
  //   return $query;
  // }

  public function update_score($score_id, $score_document, $score_knowledge, $score_completly, $score_present)
  {
    $this->db->set('document', $score_document);
    $this->db->set('knowledge', $score_knowledge);
    $this->db->set('completly', $score_completly);
    $this->db->set('present', $score_present);
    $this->db->where('score_id', $score_id);
    $this->db->update('score');
  }

  public function upcolor($arr)
  {
    $group_id = $arr['group_id'];
    $this->db->where('group_id',$group_id);
    $this->db->update($this->db_group,$arr);
  }
  public function log($uparr)
  {
    $id = $uparr['teacher_id'];
    $this->db->select('*');
    $this->db->from($this->db_teacher);
    $this->db->where('teacher_id',$id);

    $query = $this->db->get();
    return $query;
  }
  public function update($uparr)
  {
    $teacher_id = $uparr['teacher_id'];
    $this->db->where('teacher_id',$teacher_id);
    $this->db->update($this->db_teacher,$uparr);
  }

  public function del($uparr)
  {
    $teacher_id= $uparr['teacher_id'];
    $this->db->where('teacher_id',$teacher_id);
    $this->db->delete($this->db_teacher,$uparr);
  }
  ////////importfilecsv//////////////////////////
  public function get_addressbook()
  {
      $query = $this->db->get('student');
      if ($query->num_rows() > 0) {
          return $query->result_array();
      } else {
          return FALSE;
      }
  }
  public function insert_csv($data)
  {
      $this->db->insert('student', $data);
  }
  // ////////end std////////////////
  public function get_addresstch()
  {
      $query = $this->db->get('teacher');
      if ($query->num_rows() > 0) {
          return $query->result_array();
      } else {
          return FALSE;
      }
  }
  public function inserttch_csv($data)
  {
      $this->db->insert('teacher', $data);
  }
  // ///////////////////end_importfilecsv///////////////////////////////

}
