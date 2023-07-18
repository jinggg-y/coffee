<!DOCTYPE html>
<!-- main page display all courses -->
  <?php 
  for ($i = $start; $i < count($courses); $i++): 
    $course = $courses[$i];
  ?>
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
    <?php endfor ?>

  </div>
