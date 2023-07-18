<!DOCTYPE html>
<!-- main page display all courses -->
<section class="content-wraper mx-5">
  <h2>Let's Learn!</h2>
  <div class="row row-cols-1 row-cols-md-3 g-4">
  <?php foreach ($courses as $course): ?>
    <div class="col">
      <a class="link-underline link-underline-opacity-0" href="<?='course/'.$course['courseid']?>"> 
      <div class="card h-100">
        <img src="<?= 'writable/uploads/courses/' . $course['img'] ?>" class="card-img-top" alt="cover img">
        <div class="card-body">
          <h5 class="card-title"><?= $course['coursename'] ?></h5>
          <p class="card-text"><?= $course['description'] ?></p>
        </div>
      </div>
      </a>
    </div>
    <?php endforeach ?>


    <div class="row row-cols-1 row-cols-md-3 g-4">
  <?php 
  for ($i = 9; $i < count($courses); $i++): 
    $course = $courses[$i];
  ?>
    <div class="col">
      <a class="link-underline link-underline-opacity-0" href="<?='course/'.$course['courseid']?>"> 
      <div class="card h-100" id="course-card">
        <img src="<?= 'writable/uploads/courses/' . $course['img'] ?>" class="card-img-top" alt="cover img">
        <div class="card-body">
          <h5 class="card-title"><?= $course['coursename'] ?></h5>
          <p class="card-text"><?= $course['description'] ?></p>
        </div>
      </div>
      </a>
    </div>
    <?php endfor ?>
  </div>

  </section>