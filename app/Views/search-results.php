<section class="content-wrapper d-grid col-9 mt-5 mx-auto">
    <div class="row row-cols-lg-4 row-cols-md-2">
    <?php foreach ($results as $course): ?>
    <div class="col">
      <a class="link-underline link-underline-opacity-0" href="<?='/coffee/course/'.$course['courseid']?>"> 
      <div class="card d-flex p-0 m-1 align-items-stretch">
        <img src="<?= base_url(). 'writable/uploads/courses/' . $course['img'] ?>" class="card-img-top" alt="cover img">
        <div class="card-body">
          <h5 class="card-title"><?= $course['coursename'] ?></h5>
          <p class="card-text"><?= $course['description'] ?></p>
        </div>
      </div>
      </a>
    </div>
    <?php endforeach ?>
    </div>
</section>