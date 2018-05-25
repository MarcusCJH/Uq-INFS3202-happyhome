<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('house_msg'); ?>
<?php $numberOfColumns = 3;

$arrayChunks = array_chunk($data['houses'], $numberOfColumns);
?>

<div class="container" style="background-color: white">
  <?php require APPROOT . '/views/inc/sitternav.php'; ?>
  <br>
  <h2>Jobs I have Finished</h2>
  </br>

<div class="container">
  <div class="row pt-4">
  <div class="col-lg-10 ">
      <?php foreach($arrayChunks as $houses) :?>
          <?php foreach($houses as $house) :?>

              <div class="card">
                <div class="card-header">
                  From <?php echo $house->start_date; ?> To <?php echo $house->end_date; ?>
                </div>
                <div class="card-body">
                  <h5 class="card-title"><?php echo $house->full_address; ?></h5>
                  <h5 class="card-title">Rates: $<?php echo $house->price; ?></h5>
                  <p class="card-text"><b>Listed By:</b> <?php echo $house->first_name; ?> </b> <?php echo $house->last_name; ?></p>
                  <p class="card-text"><b>Contact Number:</b> <?php echo $house->contact_number; ?></p>
                  <p class="card-text"><b>Contact Email:</b> <?php echo $house->email; ?></p>
                    <p class="card-text"><b>Review Score:</b> <?php echo $house->review_score; ?></p>
                  <p class="card-text"><b>Review:</b> <?php echo $house->review; ?> </p>

                </div>
              </div>
              </br>

          <?php endforeach; ?>
      <?php endforeach; ?>


  </div>
</div>
<div class="fill"></div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
</div>
</div>
</div>
