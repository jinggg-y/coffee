<?php
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class CourseModel extends Model {
    protected $db;
    protected $builder_course;
    protected $builder_lec;

    protected $table_course      = 'courses';
    protected $table_lec         = 'lectures';
    protected $primaryKey_course = 'courseid';
    protected $primaryKey_lec    = 'lecture_id';
    protected $allowedFields     = ['course_id', 'teacher_id', 'file_name','uploaded_on', 'teacher', 'coursename', 'descriptoin','img'];
    // protected $allowedFields_lec     = ['course_id', 'teacher_id', 'file_name','uploaded_on'];

    protected $validationRules   = [];

    protected $useAutoIncrement  = true;

    public function __construct() {
        if (empty($db)) {
            $db = \Config\Database::connect();
        }
        $this->db = &$db;
        $this->builder_course = $this->db->table($this->table_course);
        $this->builder_lec = $this->db->table($this->table_lec);
    }

    public function createCourse($teacher, $coursename, $description, $img) {
        $course = [
            'teacher'     => $teacher, 
            'coursename'  => $coursename, 
            'description' => $description ,
            'img'         => $img,
        ];
        return $this->builder_course->insert($course);
    }

    public function getCourseById($courseid) {
        return $this->builder_course->where('courseid', $courseid)
                                    ->get()
                                    ->getRow();
    }

    public function getTeaching($userid) {
        return $this->builder_course->where('teacher',$userid)
                            ->get()
                            ->getResultArray();
    }


    public function getAllCourse() {
        return $this->builder_course->select('courseid, coursename, description, img')
                            ->orderBy('courseid', 'DESC')
                            ->get()
                            ->getResultArray();
        // return $this->builder_course->where('teacher', $userid)->get()->getResult();
    }

    public function updateCourse($courseid, $coursename, $description) {

        $data = [
            'coursename'       => $coursename,
            'description'      => $description,
        ];
       
        return $this->builder_course->where('courseid', $courseid)->set($data)->update();
    }

/* -------------- lec model ----------------- */
    public function createLecture($course_id, $teacher_id, $file_name) {
        $now = Time::now('Australia/Brisbane', 'en_AU');
        $lec = [
            'course_id'        => $course_id, 
            'teacher_id'       => $teacher_id, 
            'file_name'        => $file_name ,
            'uploaded_on'      => $now,
        ];
        return $this->builder_lec->insert($lec);
    }

    public function getLectures($course_id)
    {
        return $this->builder_lec->where('course_id', $course_id)
                                ->get()
                                ->getResultArray();
    }
/* -------------- search ------------ */
    public function search($keyword)
    {
       return $this->builder_course->like('coursename', $keyword)
                            ->get()
                            ->getResultArray();
    }
}