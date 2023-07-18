<!DOCTYPE html>

<div class="content-wrapper">
    <?php echo form_open(base_url()."signup");?>
        <h1 class="text-center mt-5 mb-5 title">Sign up</h1>

        <form>
        <div class="d-grid col-5 mx-auto">

            <div class="row">
                <div class="col mb-3 align-items-baseline">
                    <label class="form-label me-3">First Name</label>
                    <input type="text" class="form-control" placeholder="First name" name="firstname" required="required">
                
                    <?php if ($error = validation_show_error('firstname')): ?>
                    <div class="text-danger p-2"><?= $error ?></div>
                    <?php endif ?>
                </div>

                <div class="col mb-3 align-items-baseline">
                    <label class="form-label me-3">Last Name</label>
                    <input type="text" class="form-control" placeholder="Last name" name="lastname" required="required">
                
                    <?php if ($error = validation_show_error('lastname')): ?>
                    <div class="text-danger p-2"><?= $error ?></div>
                    <?php endif ?>
                </div>
            </div>

            <div class="mb-3 align-items-baseline">
                <label class="form-label me-3">Email</label>
                <input class="form-control" placeholder="Email" name="email" required="required">
            
                <?php if ($error = validation_show_error('email')): ?>
                <div class="text-danger p-2"><?= $error ?></div>
                <?php endif ?>
            
            </div>
            
            <div class="mb-3 align-items-baseline">
                <label class="form-label me-3">New Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required="required">

                <?php if ($error = validation_show_error('password')): ?>
                <div class="text-danger p-2"><?= $error ?></div>
                <?php endif ?>

            </div>
            
            <?php if (session('error')) : ?>
                <div class="mb-2 d-flex align-items-baseline text-danger"><?= session('error') ?></div>
            <?php endif; ?>
            
            <div class="mb-2 d-flex align-items-baseline">
                <button type="submit" class="btn btn-primary mx-auto w-100">Create Account</button>
            </div>
        </form>
        <?php echo form_close();?>
            <div class="clearfix mb-2">
                <a href="login" class="float-end">Back to Login</a>
            </div>
            
        </div>
        
   
</div>