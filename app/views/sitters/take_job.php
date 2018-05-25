<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/sitternav.php'; ?>
<div class="container" style="background-color: white">
<br>
<h2>Review job details to Confirm</h2>
<br>

<div class="container">
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title"><?php echo $data['listing']->full_address?></h5>
        <p class="card-text"><b>Description:</b> <?php echo $data['listing']->description?></p>
        <?php if($data['listing']->pet == '0') { ?>
          <p class="card-text"><b>Pets:</b> No</p>
          <?php }else { ?>
          <p class="card-text"><b>Pets:</b> Yes</p>
          <?php }?>

          <?php if($data['listing']->plant == '0') { ?>
              <p class="card-text"><b>Plants:</b> No</p>
          <?php }else { ?>
              <p class="card-text"><b>Plants:</b> Yes</p>
          <?php }?>

          <p class="card-text"><b>Job Starts From:</b> <?php echo $data['listing']->start_date?></p>
          <p class="card-text"><b>Job Ends From:</b> <?php echo $data['listing']->end_date?></p>

        <p class="card-text"><small class="text-muted">Listing created on: <?php echo $data['listing']->created_date?></small></p>
        <form class = "btn-group" action="<?php echo URLROOT; ?>/sitters/listing_taken/<?php echo $data['listing']->id; ?>" method="post">
            <button type="submit" class="mt-auto btn btn-lg btn-block btn-primary">Confirm Taking this Job</button>
        </form>
      </div>
    </div>
    <?php require APPROOT . '/views/inc/footer.php'; ?>

</div>
</div>
