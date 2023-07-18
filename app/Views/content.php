<?php if ($courseID):?>
    <!-- <div class="row">!!! -->
        <div class="ps-5 py-3 bg-dark text-white" id="coursetitle"><?= $courseName ?></div>
    <!-- </div>!!! -->
    <section class="content-wrapper">
    <div class="row border">
        <div class="col min-vh-50">
            <img src=" <?= base_url('writable/uploads/courses/') . $img ?>" alt="cover img">        
        </div>
        <!-- sidebar -->
        <div class="col ps-4 pe-5 border-start list-group list-group-flush">
            <?php foreach ($lectures as $lecture): ?>
            <a class="list-group-item" href= <?= base_url().'writable/uploads/lectures/'. $lecture['file_name'] ?> ><?= $lecture['file_name'] ?></a>
            <?php endforeach ?>         
        </div>
        <!-- sidebar end -->
    </div>
<!-- course overview starts -->
<!--     <div class="container pt-3 d-flex justify-content-between">
        <div>
            <h4> <?= $courseName ?> </h4>
            <p> <?= $description ?></p>
            <p>Instructor: <?= $teacher?></p>
        </div>
        <div>
        <?php echo form_open_multipart(base_url()."course/".$courseID.'/add-to-wishlist');?>
        <div class="mb-4">
            <button type="submit" class="btn btn-primary mx-auto w-100">Add to Wishlist</button>
        </div>
        <?php echo form_close();?>
        </div>
    </div> -->
<!-- course overview ends -->

    <!-- tabs -->
    <ul class="nav nav-underline container py-2" id="myTab" role="tablist">
        <li class="nav-item me-3" role="presentation">
            <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">Overview</button>
        </li>
        <li class="nav-item me-3" role="presentation">
            <button class="nav-link" id="notes-tab" data-bs-toggle="tab" data-bs-target="#notes" type="button" role="tab" aria-controls="notes" aria-selected="false">Notes</button>
        </li>
        <li class="nav-item me-3" role="presentation">
            <button class="nav-link" id="Q&A-tab" data-bs-toggle="tab" data-bs-target="#Q&A" type="button" role="tab" aria-controls="Q&A" aria-selected="false">Q&A</button>
        </li>
        <hr>
    </ul>


    <div class="tab-content pt-2 container" id="myTabContent">
        <div class="tab-pane show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
            <div class="d-flex justify-content-between">
                <div class="col-10">
                    <h4> <?= $courseName ?> </h4>
                    <p><?= $description ?></p>
                    <p>Instructor: <?= $teacher?></p>
                </div>
                <div>
                    <?php echo form_open_multipart(base_url()."course/".$courseID.'/add-to-wishlist');?>
                    <div class="mb-4 me-4">
                        <button type="submit" class="btn btn-primary mx-auto w-100">Add to Wishlist</button>
                    </div>
                    <?php echo form_close();?>
                    </div>
            </div>

            <h5 class="mt-3">Course structure</h5>
            <ul>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
            </ul>
        </div>
        <div class="tab-pane" id="notes" role="tabpanel" aria-labelledby="notes-tab">
            Nesciunt totam et. Consequuntur magnam aliquid eos nulla dolor iure eos quia. Accusantium distinctio omnis et atque fugiat. Itaque doloremque aliquid sint quasi quia distinctio similique. Voluptate nihil recusandae mollitia dolores. Ut laboriosam voluptatum dicta.
        </div>
        <div class="tab-pane" id="Q&A" role="tabpanel" aria-labelledby="Q&A-tab">
            Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
        </div>
    </div> 
<!-- End Tabs -->

    <hr class="divider">

    <!-- comment form -->
    <div class="container py-2">
    <?php echo form_open_multipart(base_url()."course/".$courseID);?>
    <div class="d-flex"> 
        <h5 class="form-label">How do you rate this course? </h5>
        <div class="ms-2" id="stars">
            <i class="bi bi-star-fill text-body-tertiary" data-value='1'></i>
            <i class="bi bi-star-fill text-body-tertiary" data-value='2'></i>
            <i class="bi bi-star-fill text-body-tertiary" data-value='3'></i>
            <i class="bi bi-star-fill text-body-tertiary" data-value='4'></i>
            <i class="bi bi-star-fill text-body-tertiary" data-value='5'></i>
        </div>
        <input type="hidden" id="rating" name="rating" required ='required'>

        <!-- <input class="form-control" name="rate" required="required"> </input> -->
    </div>
    <div class="mb-4"> 
        <label class="form-label">Leave your comment:</label>
        <textarea class="form-control" placeholder="Description" name="comment" required="required" rows="3"> </textarea>
    </div>
    <div class="mb-4">
        <button type="submit" class="btn btn-primary mx-auto w-100">Submit</button>
    </div>
    <?php echo form_close();?>
    </div>
    <!-- comment form end -->

<!-- comments start -->
    <?php foreach ($reviews as $review): ?>
    <div class="container mb-4">
        <h5><?= $review['firstname'] . ' ' . $review['lastname']  ?>
            <span class="ps-2 fw-normal fs-6 text-body-secondary"><?= $review['reviewdate'] ?></span>
        </h5>
        <p class="mb-0">Rating: <?= $review['rating'] ?></p>
        <p><?= $review['review'] ?></p>
    </div>
    <?php endforeach ?>    
<!-- comments end -->

    <?php endif ?>

</section>
