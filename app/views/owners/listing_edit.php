<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container" style="background-color: white">
<div class="container">
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Update your listing</h2>
            <p>Please fill this form to update your listing</p>


            <form action="<?php echo URLROOT; ?>/owners/listing_edit/<?php echo $data['id']; ?>" method="post">

                <div class ="form-group">
                    <label>Price<sup>*</sup></label>
                    <input type="text" id="price" name="price" class=" form-control" value="<?php echo $data['price']; ?>">
                    <span class="invalid-feedback"><?php echo $data['contact_number_err']; ?></span>


                </div>

                <div class="form-group">
                  <label for="example-date-input" class="col-2 col-form-label">Start:</label>
                  <div class="col-10">
                    <input class="form-control" type="date" name="start_date" class="field form-control <?php echo (!empty($data['start_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo date("Y-m-d");?>">

                    <span class="invalid-feedback"><?php echo $data['start_date_err']; ?></span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="example-date-input" class="col-2 col-form-label">End:</label>
                  <div class="col-10">
                    <input class="form-control" type="date" name="end_date" class="field form-control <?php echo (!empty($data['end_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo date("Y-m-d");?>">
                    <span class="invalid-feedback"><?php echo $data['end_date_err']; ?></span>
                  </div>
                </div>



                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block" value="Update your listing">
                </div>


            </form>
        </div>
    </div>
</div>
<div class="fill10"></div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
