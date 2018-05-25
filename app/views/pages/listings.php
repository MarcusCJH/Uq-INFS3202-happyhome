
<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container" style="background-color: white">

<?php flash('house_msg'); ?>

<?php $numberOfColumns = 3;

$arrayChunks = array_chunk($data['houses'], $numberOfColumns);?>
<div class="container">
  <br>
  <h2>Available Jobs</h2>
  <br>
      <?php foreach($arrayChunks as $houses) :?>
          <?php foreach($houses as $house) :?>

              <div class="card">
                <div class="card-header">
                  From <?php echo $house->start_date; ?> To <?php echo $house->end_date; ?>
                </div>
                <div class="card-body">
                  <h5 class="card-title"><?php echo $house->full_address; ?></h5>
                  <h5 class="card-title">Rates: $<?php echo $house->price; ?></h5>
                  <p class="card-text"><b>House Description:</b> <?php echo $house->description; ?></p>
                  <?php if($house->pet == '0') { ?>
                        <p class="card-text"><b>Pets:</b> No</p>
                    <?php }else { ?>
                        <p class="card-text"><b>Pets:</b> Yes</p>
                    <?php }?>

                    <?php if($house->plant == '0') { ?>
                        <p class="card-text"><b>Plants:</b> No</p>
                    <?php }else { ?>
                        <p class="card-text"><b>Plants:</b> Yes</p>
                    <?php }?>

                    <?php if(!isset($_SESSION['user_id']) ||$_SESSION['type'] != 'owner') {?>
                        <a class="mt-auto btn btn-lg btn-block btn-primary" href="<?php echo URLROOT; ?>/sitters/take_job/<?php echo $house->id; ?>">Take Job</a>
                    <?php }?>


                </div>
              </div>
              </br>

          <?php endforeach; ?>
      <?php endforeach; ?>

      <div class="fill20"></div>
      <?php require APPROOT . '/views/inc/footer.php'; ?>

  </div>

</div>

</div>


</div>
