<!DOCTYPE html>

<section class="content-wrapper d-grid col-7 mx-auto">

<?php echo form_open_multipart(base_url()."create-course");?>
    <div class="mb-4">
        <label class="form-label">Course name</label>
        <input class="form-control" placeholder="Course name" name="coursename" required="required">
        
        <?php if ($error = validation_show_error('coursename')) : ?>
            <div class="text-danger p-2"><?= $error ?></div>
        <?php endif ?>
    </div>
    
    <div class="mb-4"> 
        <label class="form-label">Description</label>
        <textarea class="form-control" placeholder="Description" name="description" required="required" rows="3"> </textarea>
    
        <?php if ($error = validation_show_error('description')) : ?>
            <div class="text-danger p-2"><?= $error ?></div>
        <?php endif ?>
    </div>

    <div class="mb-4">
        <label for="formFile" class="form-label">Cover image (optional)</label>
        <input class="form-control" type="file" name="img" id="formFile">
        
        <?php if ($error = validation_show_error('img')) : ?>
            <div class="text-danger p-2"><?= $error ?></div>
        <?php endif ?>
    </div>

    <div class="mb-4">
        <button type="submit" class="btn btn-primary mx-auto w-100">Create a course</button>
    </div>
<?php echo form_close();?>
</section>