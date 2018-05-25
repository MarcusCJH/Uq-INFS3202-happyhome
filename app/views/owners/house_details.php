<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="wrapper row2">
  <?php require APPROOT . '/views/inc/ownernav.php'; ?>
  <div class="container" style="background-color: white">
    <div class="card mb-3">
      <div align="center">
        <br>
      <img src="<?php echo URLROOT; ?>/public/images/cover_image/<?php echo $data['house']->cover_image;?>" width="600" height="300">
    </div>
      <div class="card-body">

        <h5 class="card-title"><?php echo $data['house']->full_address?></h5>
        <p class="card-text"><b>Description:</b><?php echo $data['house']->description?></p>
        <?php if($data['house']->pet == '0') { ?>
          <p class="card-text"><b>Pets:</b> No</p>
          <?php }else { ?>
          <p class="card-text"><b>Pets:</b> Yes</p>
          <?php }?>

          <?php if($data['house']->plant == '0') { ?>
              <p class="card-text"><b>Plants:</b> No</p>
          <?php }else { ?>
              <p class="card-text"><b>Plants:</b> Yes</p>
          <?php }?>

        <p class="card-text"><small class="text-muted">Created on: <?php echo $data['house']->created_at?></small></p>

          <p class="card-text"><b>Status:</b>
          <?php
          if(empty($data['houseListing'])){
              echo "Available for listing";
          }
          else{
            if($data['houseListing']->status == "finished"){
                echo $data['houseListing']->status.". Last Listed on ".$data['houseListing']->end_date;
            }
            elseif($data['houseListing']->status == "taken"){
                echo $data['houseListing']->status.". House is currently under on-going sitting job.";
            }
             else {
              echo $data['houseListing']->status.". House is available to be list for sitting job.";
            }
          }
          ?>

        </p>
          <?php if(empty($data['houseListing']) || $data['houseListing']->status == "finished" ){?>
              <a class="mt-auto btn btn-lg btn-block btn-primary" href="<?php echo URLROOT; ?>/owners/new_listing/<?php echo $data['house']->id; ?>">List house to look for sitter </a>
         <?php }else {?>
              <p>Have already listed</p>
          <?php }?>
      </div>
    </div>
    <?php require APPROOT . '/views/inc/footer.php'; ?>

  </div>
</div>
