<section class="content-wrapper">

<?php if ($courseID):?>
    <div class="row">
        <div class="ps-5 py-3 bg-dark text-white" id="coursetitle"><?= $courseName ?></div>
    </div>

    <div class="row align-items-center">
        <div class="col">
            <img src=" <?= base_url('writable/uploads/courses/') . $img ?>" alt="cover img">        
        </div>
        <!------------ update course form ------------>
    <div class="col">
    <?php echo form_open_multipart(base_url()."teach-item/".$courseID);?>
    <div class="mb-4">
        <label class="form-label">Course name</label>
        <input class="form-control" value="<?= $courseName ?>" name="coursename" required="required">
        
        <?php if ($error = validation_show_error('coursename')) : ?>
            <div class="text-danger p-2"><?= $error ?></div>
        <?php endif ?>
    </div>
    
    <div class="mb-4"> 
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" required="required" rows="3"><?= $description ?></textarea>
    
        <?php if ($error = validation_show_error('description')) : ?>
            <div class="text-danger p-2"><?= $error ?></div>
        <?php endif ?>
    </div>

    <div class="mb-4">
        <button type="submit" class="btn btn-primary mx-auto w-100">Update</button>
    </div>
    <?php echo form_close();?>
    </div>
    <!--------------- course update end ---------------->
    </div>
    
<!------------ lectures (multi files upload) ------------->
    <div class="row border">
        <div class="col-md-5 m-4">
            <h5 class="py-3">Upload Lectures</h5>
        <?php echo form_open_multipart(base_url()."teach-item/".$courseID."/upload-files");?>
            <div class="mb-4">
                <input  class="form-control" type="file" name="files[]" multiple>
            </div>
            
            <div class="mb-4">
                <button type="submit" class="btn btn-primary mx-auto w-100">Upload Files</button>
            </div>
            <?php echo form_close();?>
        </div>
    
        <!-- sidebar -->
        <!-- for each to get the file name -->
        <div class="col ps-4 pe-5 border-start list-group list-group-flush">
            <?php foreach ($lectures as $lecture): ?>
            <a class="list-group-item" href= <?= base_url().'writable/uploads/lectures/'. $lecture['file_name'] ?> ><?= $lecture['file_name'] ?></a>
            <?php endforeach ?>         
        </div>
        <!-- sidebar end -->
    </div>
    <!-------- lectures end ---------->
    

<!-- comments start -->
    <div class="container py-4">
        <h5>Comments</h5></div>
    <?php foreach ($reviews as $review): ?>
    <div class="container">
        <h6><?= $review['firstname'] . ' ' . $review['lastname'] ?>
            <span class="ps-2 fw-normal fs-6 text-body-secondary"><?= $review['reviewdate'] ?></span>
        </h6>
        
        <p><?= $review['review'] ?></p>
    </div>
    <?php endforeach ?>    
<!-- comments end -->

    <?php echo form_open(base_url()."cert/".$courseID); ?>
    <button type="submit" class="btn btn-outline-danger d-grid col-3 mx-auto mb-4">Close Course</button>
    <?php echo form_close(); ?>


<?php endif ?>

</section>
