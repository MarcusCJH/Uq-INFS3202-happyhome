<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('house_msg'); ?>

<?php $numberOfColumns = 3;

$arrayChunks = array_chunk($data['houses'], $numberOfColumns);?>
<div class="container" style="background-color: white">

  <?php require APPROOT . '/views/inc/ownernav.php'; ?>
</br>
    <h2>My Current Available Listing</h2>
    </br>
    <p>Your listing that is available to take at the moment. If you can't find a sitter, consider increase your rates!</p>
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
                  <p class="card-text"><b>Listing Created on:</b> <?php echo $house->created_date; ?></p>
                  <a class="btn btn-primary" href="<?php echo URLROOT; ?>/owners/listing_edit/<?php echo $house->id; ?>">Edit</a>
                    <form class = "btn-group" action="<?php echo URLROOT; ?>/owners/delete_listing/<?php echo $house->id; ?>" method="post">
                        <button type="submit" class="btn btn-primary">Delete Listing</button>
                    </form>
                </div>
              </div>
              </br>

          <?php endforeach; ?>
      <?php endforeach; ?>


</div>
<div class="fill"></div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
</div>
</div>

  </div>
</div>
