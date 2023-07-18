<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{   protected $db;
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $builder_wishlist;
    protected $table_whishlist = 'wishlist';
    protected $primaryKey_wishlist = 'id';
    protected $allowedFields = ['email', 'password', 'firstname', 'lastname', 'uid', 'course_id'];
    protected $useAutoIncrement  = true;

    protected $email;

    public function __construct() {

        parent::__construct();

        if (empty($db)) {
            $db = \Config\Database::connect();
        }
        $this->db = &$db;
        $this->builder_wishlist = $this->db->table($this->table_whishlist);

        if (empty($email)) {
            $email = \Config\Services::email();
        }
        $this->email = &$email;
    }

    public function createUser($email, $password, $firstname, $lastname, $email_token) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'email'       => $email,
            'password'    => $hashed_password,
            'firstname'   => $firstname,
            'lastname'    => $lastname,
            'email_token' => $email_token,
        ];
       
        $this->db->table('users')->insert($data);
        return $this->db->insertID();
    }

    public function getUserbyEmail($email) {
        $user = $this->db->table('users')->where('email',$email)->get()->getRow();
        return $user;
    }

    public function getUserbyID($id) {
        $user = $this->db->table('users')
                        ->where('id',$id)
                        ->get()
                        ->getRow();
        return $user;
    }

    public function updateUser($id, $email, $mobile, $firstname, $lastname) {

        $data = [
            'email'       => $email,
            'mobile'      => $mobile,
            'firstname'   => $firstname,
            'lastname'    => $lastname,
        ];
       
        $this->db->table('users')->where('id', $id)->set($data)->update();
    }

    public function getUserbyToken($token) {
        $user = $this->db->table('users')->where('email_token',$token)->get()->getRow();
        return $user;
    }

    public function updateEmailVerification($id) {
        $this->db->table('users')->where('id', $id)->set('emailverified', true)->update();
    }

    public function updatePassToken($email) {
        $pass_token = bin2hex(random_bytes(32));
        $this->db->table('users')->where('email', $email)->set('pass_token', $pass_token)->update();
        return $pass_token;
    }

    public function getUserbyPassToken($pass_token) {
        $user = $this->db->table('users')->where('pass_token',$pass_token)->get()->getRowArray();
        return $user;
    }

    public function updatePassword($id, $hashed_password) {
        $this->db->table('users')->where('id',$id)->set('password', $hashed_password)->update();
    }


    // --------- wishlist ----------
    public function addToWishlist($uid, $courseID)
    {
        $course = [
            'uid'       => $uid,
            'course_id' => $courseID,
        ];
        return $this->builder_wishlist->insert($course);
    }

    public function getWishlist($uid)
    {
        return $this->builder_wishlist->select('courses.courseid, courses.coursename, courses.img')
                            ->where('uid', $uid)
                            ->join('users', 'wishlist.uid = users.id')
                            ->join('courses', 'wishlist.course_id = courses.courseid')
                            ->get()
                            ->getResultArray();
    }

    public function deleteWishlistItem($uid, $courseID)
    {
        return $this->builder_wishlist-> where('uid', $uid)
                                    -> where('course_id', $courseID)
                                    -> delete();
    }
}