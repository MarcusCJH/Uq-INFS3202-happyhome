<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('house_msg'); ?>
<?php $numberOfColumns = 3;

    $arrayChunks = array_chunk($data['houses'], $numberOfColumns);?>
    <div class="container" style="background-color: white">
      <?php require APPROOT . '/views/inc/ownernav.php'; ?>
<br>
<h2>My houses</h2>
<div class="container">
<br>
    <p>
      Click on the Listing button of the house you want to find home-sitter for!
    </p>

    <div class="row pt-4">

        <div class="col-lg-4 col-sm-6 py-2">
            <div class="card h-100">
                <div class="card-img-top">
                    <img src="<?php echo URLROOT; ?>/public/images/addhome.png" class="img-fluid mx-auto d-block" alt="card image 1">
                </div>
                <div class="card-block d-flex flex-column">
                    <h4 class="card-title"></h4>
                    <p class="card-text"></p>
                    <div class='text-center'>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <form class = "btn-group" action="<?php echo URLROOT; ?>/owners/house_register" method="post">
                                <button type="submit" class="mt-auto btn btn-lg btn-block btn-primary">Add Houses</button>
                            </form>
                        </div>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    <?php foreach($arrayChunks as $houses) :?>
        <?php foreach($houses as $house) :?>
        <div class="col-lg-4 col-sm-6 py-2">
            <div class="card h-100">
                <div class="card-img-top">
                    <img src="<?php echo URLROOT; ?>/public/images/cover_image/<?php echo $house->cover_image;?>" class="img-fluid mx-auto d-block" alt="card image 1" height="114.3" width="190.5">

                </div>
                <div align="center">
                <div class="card-block d-flex flex-column">
                    <h4 class="card-title"><?php echo $house->full_address; ?></h4>
                    <?php
                    $out = strlen($house->description) > 100 ? substr($house->description,0,100)."..." : $house->description;?>
                    <p class="card-text"><?php echo $out;?></p>
                    <p class="card-text">Created on: <?php echo $house->created_at;?></p>
                    <div class='text-center'>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="mt-auto btn btn-lg btn-block btn-primary" href="<?php echo URLROOT; ?>/owners/house_details/<?php echo $house->id; ?>">Listing</a>
                            <a class="mt-auto btn btn-lg btn-block btn-primary" href="<?php echo URLROOT; ?>/owners/house_edit/<?php echo $house->id; ?>">Edit</a>
                            <form class = "btn-group" action="<?php echo URLROOT; ?>/owners/house_delete/<?php echo $house->id; ?>" method="post">
                                <button type="submit" class="mt-auto btn btn-lg btn-block btn-primary">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </div>
    <div class="fill10"></div>
    <?php require APPROOT . '/views/inc/footer.php'; ?>

  </div>
</div>
