<!DOCTYPE html>

<section class="content-wrapper">
    <?php echo form_open(base_url()."reset-password?token=".$token, array('method' => 'post')); ?>
    <h1 class="text-center mt-5 mb-5">Reset Password</h1>

    <div class="d-grid col-5 mx-auto">

        <div class="mb-4">
            <label class="form-label">New password</label>
            <input type="password" class="form-control" placeholder="New password" name="newpassword"
                required="required">
        </div>

        <?php if ($error = validation_show_error('new password')): ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
        <?php endif ?>

        <div class="mb-4">
            <label class="form-label">Retype password</label>
            <input type="password" class="form-control" placeholder="Retype password" name="retypepassword"
                required="required">
        </div>

        <?php if ($error = validation_show_error('retype password')): ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
        <?php endif ?>

        <div class="mb-2">
            <button type="submit" class="btn btn-primary mx-auto w-100">Reset Password</button>
        </div>

        <div class="clearfix mb-2">
            <a href="login" class="float-end">Back to login</a>
        </div>

    </div>
    <?php echo form_close(); ?>
</section>