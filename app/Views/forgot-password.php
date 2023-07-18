<!DOCTYPE html>

<section class="content-wrapper">
    <?php echo form_open(base_url()."forgot-password");?>
        <h1 class="text-center mt-5 mb-5">Reset Password</h1>

        <div class="d-grid col-5 mx-auto">

            <div class="mb-4">
                <label class="form-label">Email</label>
                <input class="form-control" placeholder="Email" name="email" required="required">
            </div>
                
            <?php if ($error = session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif ?>
            
            <div class="mb-2">
                <button type="submit" class="btn btn-primary mx-auto w-100">Reset Password</button>
            </div>
            
            <div class="clearfix mb-2">
                <a href="login" class="float-end">Back to login</a>
            </div>
            
        </div>
        
    <?php echo form_close();?>
</section>