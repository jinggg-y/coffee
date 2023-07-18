<!DOCTYPE html>

<section class="content-wrapper">

    <?php echo form_open(base_url()."profile");?>
    <h1 class="text-center mt-5 mb-5">Profile</h1>

    <div class="d-grid col-5 mx-auto">

        <div class="mb-4">
            <label class="form-label">First Name</label>
            <input class="form-control" name="firstname" required="required" value="<?php echo set_value('firstname', $firstname); ?>">
        </div>

        <div class="mb-4">
            <label class="form-label">Last Name</label>
            <input class="form-control" name="lastname" required="required" value="<?php echo set_value('lastname', $lastname); ?>">
        </div>           

        <div class="mb-4">
            <label class="form-label">Email</label>
            <input class="form-control" name="email" required="required" value="<?php echo set_value('email', $email); ?>">
        </div>

        <div class="mb-4">
            <label class="form-label">Mobile (optional)</label>
            <input class="form-control" name="mobile" value="<?php echo set_value('mobile', $mobile);?>">
        </div> 
        
        <div class="mb-2">
            <button type="submit" class="btn btn-primary mx-auto w-100">Save</button>
        </div>
        
    </div>
    
    <?php echo form_close();?>    

    
</section>