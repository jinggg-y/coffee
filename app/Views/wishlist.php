<section class="content-wrapper">
    <h1 class="text-center mt-5 mb-5">Wishlist</h1>
    <ul class="d-grid col-5 list-group mx-auto">

    <?php if(!$courses): ?>
        <h5 class="text-center">Your Wishlist is Empty</h5>
    <?php endif ?>
        <?php foreach ($courses as $course): ?>
        <li class="list-group-item d-flex justify-content-between">

        <a class="link-dark link-underline link-underline-opacity-0" href="<?='/coffee/course/'.$course['courseid']?>"> 
        <div class="d-flex">
            <img class="d-grid col-3 " src="<?= base_url('writable/uploads/courses/') . $course['img'] ?>" alt="cover img">
            <p class="ms-2 fs-5"><?= $course['coursename'] ?></p>
        </div>
        </a>

<?php echo form_open(base_url('wishlist/') .'delete/'. $course['courseid']); ?>        
        <button type="submit" class="btn btn-outline-danger align-self-center">
            <i class="bi bi-trash fs-5"></i>
        </button>
<?php echo form_close(); ?>
                        
        </li>
        <?php endforeach ?>
    </ul>
    

</section>