<!-- tabs -->
<ul class="nav nav-underline container" id="myTab" role="tablist">
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
            <div class="pt-3">
                <h4> <?= $courseName ?> </h4>
                <p class="col-11"><?= $description ?></p>
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
        <hr>
        <h5>Course structure</h5>
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