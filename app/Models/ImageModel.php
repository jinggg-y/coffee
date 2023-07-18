<?php namespace App\Models;

use CodeIgniter\Model;

class ImageModel extends Model {
    protected $allowedFields = ['filename', 'path'];

    public function crop_image($imgname) {
        $image = \Config\Services::image();

        $image->withFile(ROOTPATH."writable/uploads/courses/".$imgname)
                ->fit(400, 300, 'center')
                ->save(ROOTPATH."writable/uploads/courses/thumb_".$imgname);
        // $image = \Config\Services::image('imagick')->withFile(ROOTPATH."writable/uploads/courses/".$imgname);
        // // $imagick = new \Imagick(ROOTPATH."writable/uploads/courses/".$imgname);
    
        // $orig_width = $image->getImageWidth();
        // $orig_height = $image->getImageHeight();            

        // $target_ratio = 4/3;
        // $orig_ratio = $orig_width / $orig_height;  
        // if ($orig_ratio > $target_ratio) {
        //     $width = round(($orig_height/3)*4);
        //     $height = $orig_height;
        //     $x_axis = round(($orig_width - $width) / 2);
        //     $y_axis = 0;
        // } else {
        //     $height = round(($orig_width/4)*3);
        //     $width = $orig_width;
        //     $x_axis = 0;
        //     $y_axis = round(($orig_height - $height) / 2);
        // }

        // $image->cropImage(560, 420, 0, 20);
        
        return 'thumb_'.$imgname;
    }
}