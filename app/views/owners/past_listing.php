<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('house_msg'); ?>

<?php $numberOfColumns = 3;

$arrayChunks = array_chunk($data['houses'], $numberOfColumns);?>
<div class="container" style="background-color: white">
    <?php require APPROOT . '/views/inc/ownernav.php'; ?>
  <br>
  <h2>PAST LISTING</h2>
</br>
<p>
  Your past listing jobs which have been completed. Leave a review for the house-sitter so they can improve their services!
</p>
<div class="container">
    <div class="row pt-4">
        <?php foreach($arrayChunks as $houses) :?>
            <?php foreach($houses as $house) :?>
                <div class="col-lg-4 col-sm-6 py-2">
                    <div class="card h-100">
                        <div class="card-img-top">
                            <img src="<?php echo URLROOT; ?>/public/images/cover_image/<?php echo $house->cover_image;?>" class="img-fluid mx-auto d-block" alt="card image 1">

                        </div>
                        <div class="card-block d-flex flex-column">
                            <h4 class="card-title"><?php echo $house->full_address; ?></h4>
                            <p class="card-text"><?php echo $house->description;?></p>
                            <?php if($house->review_score === null){ ?>
                                <a class="mt-auto btn btn-lg btn-block btn-primary" href="<?php echo URLROOT; ?>/owners/review_listing/<?php echo $house->id; ?>">Review Their Service</a>
                            <?php } elseif($house->review_score >= 0){ ?>
                                <p class="card-text"><b>You have submitted a review:</b>
                                      <br>Score: <?php echo $house->review_score; ?>
                                      <br>Review: <?php echo $house->review; ?>
                                </p>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
    <div class="fill30"></class>
    <?php require APPROOT . '/views/inc/footer.php'; ?>
  </div>
</div>
