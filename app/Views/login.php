<!DOCTYPE html>

<section class="content-wrapper">
    <?php echo form_open(base_url()."login",  array('method'=>'post'));?>
        <h1 class="text-center mt-5 mb-5">Login</h1>

        <div class="d-grid col-5 mx-auto">

            <div class="mb-4">
                <label class="form-label">Email</label>
                <input class="form-control" placeholder="Email" name="email" required="required">
            </div>
            
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required="required">
            </div>
                
            <?php if ($error = session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif ?>
            
            <div class="mb-2">
                <button type="submit" class="btn btn-primary mx-auto w-100">Log in</button>
            </div>
            <div class="mb-2">
                <label class="form-check-label float-right"><input type="checkbox" name="remember"> Remember me</label>
            </div>
            
            <div class="clearfix mb-2">
                <a href="forgot-password" class="float-end">Forgot Password?</a>
            </div>
            
            <div class="clearfix mb-2">
                <a href="signup" class="float-end">Don't have an account? Sign up</a>
            </div>
            
        </div>
        
    <?php echo form_close();?>
</section>