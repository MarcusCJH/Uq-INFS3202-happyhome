<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('error_msg'); ?>

<div class="container" style="background-color: white">
  <?php require APPROOT . '/views/inc/ownernav.php'; ?>
<div class="container">
<div class="row">
  <div class="col-md-10 mx-auto">
    <div class="card card-body bg-light mt-5">
      <h2>Find a housesitter for this home</h2>
      <p>Please out this form to submit the listing for this home.</p>
        <div class="card mb-3">
            <img class="card-img-top" src="../../public/images/cover_image/<?php echo $data['house']->cover_image?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?php echo $data['house']->full_address?></h5>
                <p class="card-text"><b>Description:</b><?php echo $data['house']->description?></p>
                <p class="card-text"><b>Pets:</b> <?php echo $data['house']->pet?></p>
                <p class="card-text"><b>Plants:</b> <?php echo $data['house']->plant?></p>
                <p class="card-text"><small class="text-muted">Created on: <?php echo $data['house']->created_at?></small></p>
            </div>
        </div>


        <form action="<?php echo URLROOT; ?>/owners/new_listing/<?php echo $data['house']->id;?>" method="post">
            <div class="form-group">
                <label>Pay Rates per hour: <sup>*</sup></label>
                <input type="text" name="price" class="field form-control <?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>" value="1">
                <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>
            </div>

            <div class="form-group">
              <label for="example-date-input" class="col-2 col-form-label">Starts:</label>
              <div class="col-10">
                <input class="form-control" type="date" name="start_date" class="field form-control <?php echo (!empty($data['start_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo date("Y-m-d");?>">
                <span class="invalid-feedback"><?php echo $data['start_date_err']; ?></span>
              </div>
            </div>

            <div class="form-group">
              <label for="example-date-input" class="col-2 col-form-label">Ends:</label>
              <div class="col-10">
                <input class="form-control" type="date" name="end_date" class="field form-control <?php echo (!empty($data['end_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo date("Y-m-d");?>">
                <span class="invalid-feedback"><?php echo $data['end_date_err']; ?></span>
              </div>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success btn-block" value="Submit Listing">
            </div>


        </form>
    </div>
  </div>
</div>
<div class="fill10"></class>
<?php require APPROOT . '/views/inc/footer.php'; ?>
</div>
</div>
