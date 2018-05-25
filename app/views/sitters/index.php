<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('house_msg'); ?>

<?php $numberOfColumns = 3;

$arrayChunks = array_chunk($data['houses'], $numberOfColumns);
?>
<div class="container" style="background-color: white">
  <?php require APPROOT . '/views/inc/sitternav.php'; ?>
</br>
  <h2>My Current Jobs</h2>
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
                  <p class="card-text"><b>House Description:</b> <?php echo $house->description; ?> </p>
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


                  <?php
                  $nowDate = strtotime(date('Y-m-d'));
                  $endDate = strtotime(date('Y-m-d', strtotime($house->end_date) ) ).' ';;
                  if($endDate <= $nowDate) { ?>
                    <form class = "btn-group" action="<?php echo URLROOT; ?>/sitters/job_finish/<?php echo $house->id; ?>" method="post">
                        <button type="submit" class="mt-auto btn btn-lg btn-block btn-primary">Finish Job</button>
                    </form>
                  <?php }else { ?>
                    <form class = "btn-group" action="<?php echo URLROOT; ?>/sitters/job_cancel/<?php echo $house->id; ?>" method="post">
                        <button type="submit" class="mt-auto btn btn-lg btn-block btn-primary">Cancel Job</button>
                    </form>
                  <?php }?>


                    <div title="Add to Calendar" class="addeventatc">
                        Add to Calendar
                        <span class="start"><?php echo $house->start_date;?></span>
                        <span class="end"><?php echo $house->end_date; ?></span>
                        <span class="all_day_event">true</span>
                        <span class="title"><?php echo $house->full_address; ?></span>
                        <span class="description"><?php echo $house->description; ?> </span>
                        <span class="location"><?php echo $house->full_address; ?></span>
                    </div>

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
