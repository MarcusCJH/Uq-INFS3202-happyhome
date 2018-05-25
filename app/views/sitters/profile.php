<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container" style="background-color: white">
  <?php require APPROOT . '/views/inc/sitternav.php'; ?>
<br>
  <h2>My Profile</h2>
  </br>
<div class="container">
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">Home Sitter</h5>
        <p class="card-text"><b>Full Name:</b> <?php echo $data['user']->first_name?> <?php echo $data['user']->last_name?></p>
          <p class="card-text"><b>Contact Number:</b> <?php echo $data['user']->contact_number?></p>
          <p class="card-text"><b>Email:</b> <?php echo $data['user']->email?></p>
        <p class="card-text"><small class="text-muted">Joined on: <?php echo $data['user']->created_at?></small></p>

      </div>
    </div>
    <div class="fill"></div>
  <?php require APPROOT . '/views/inc/footer.php'; ?>
</div>
</div>
