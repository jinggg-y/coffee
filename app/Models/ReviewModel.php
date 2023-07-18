<?php
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;


class ReviewModel extends Model {
    protected $db;
    protected $builder;

    protected $table            = 'reviews';
    protected $primaryKey       = 'reviewid';
    protected $allowedFields    = ['courseid', 'userid', 'rating', 'review', 'reviewdate'];

    // protected $validationRules  = [];

    protected $useAutoIncrement = true;

    public function __construct() {
        if (empty($db)) {
            $db = \Config\Database::connect();
        }
        $this->db = &$db;
        $this->builder = $this->db->table($this->table);
    }

    public function createComment($uid, $courseid, $rating, $comment) {   
        $now = Time::now('Australia/Brisbane', 'en_AU');
        $review = [
        'userid' => $uid,
        'courseid' => $courseid,
        'rating' => $rating,
        'review' => $comment,
        'reviewdate' => $now
        ];
        return $this->builder->insert($review);
    }

    public function getComments($courseID){
        return $this->builder->select('reviews.rating, reviews.review, reviews.reviewdate, users.firstname, users.lastname')
                            ->where('courseid', $courseID)
                            ->join('users', 'reviews.userid = users.id')
                            ->get()
                            ->getResultArray();
    }
}