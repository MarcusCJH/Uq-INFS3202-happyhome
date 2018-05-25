<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('house_msg'); ?>
<div class="container" style="background-color: white">

<?php $numberOfColumns = 3;

$arrayChunks = array_chunk($data['houses'], $numberOfColumns);?>
  <?php require APPROOT . '/views/inc/ownernav.php'; ?>
</br>
    <h2>My Current On-going Listing</h2>
    </br>
    <p>
      Your listing that is on-going at the moment. You can contact your friendly house-sitter to find out.
    </p>
  </br>
<div class="container">
      <?php foreach($arrayChunks as $houses) :?>
          <?php foreach($houses as $house) :?>

              <div class="card">
                <div class="card-header">
                  From <?php echo $house->start_date; ?> To <?php echo $house->end_date; ?>
                </div>
                <div class="card-body">
                  <h5 class="card-title"><?php echo $house->full_address; ?></h5>
                  <h5 class="card-title">Rates: $<?php echo $house->price; ?></h5>
                  <p class="card-text"><b>Taken By:</b> <?php echo $house->first_name; ?> </b> <?php echo $house->last_name; ?></p>
                  <p class="card-text"><b>Contact Number:</b> <?php echo $house->contact_number; ?></p>
                  <p class="card-text"><b>Contact Email:</b> <?php echo $house->email; ?></p>
                </div>
              </div>
              </br>

          <?php endforeach; ?>
      <?php endforeach; ?>


      <div class="fill"></div>
      <?php require APPROOT . '/views/inc/footer.php'; ?>
</div>
  </div>
</div>
