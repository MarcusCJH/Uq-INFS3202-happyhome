<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container" style="background-color: white">
<div class="container">
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Update your home</h2>
            <p>Please fill this form to update houses</p>


            <form action="<?php echo URLROOT; ?>/owners/house_edit/<?php echo $data['id']; ?>" method="post">

                <div class ="form-group">
                    <label>Contact Number<sup>*</sup></label>
                    <input type="text" id="contact_number" name="contact_number" class=" form-control" value="<?php echo $data['contact_number']; ?>">
                    <span class="invalid-feedback"><?php echo $data['contact_number_err']; ?></span>


                </div>

                <div class="form-group">
                    <label>Description:</label>
                    <textarea name="description" class=" form-control" rows="5" id="description"><?php echo $data['description']; ?> </textarea>
                </div>

                <?php if($data['pet'] == 0) {?>
                    <label><input type="hidden" name="pet" value="0" />
                        <input type="checkbox" name="pet" value="1">I have <b>pets</b> to be looked after</label>

                <?php }elseif ($data['pet'] == 1) {?>
                    <label><input type="hidden" name="pet" value="0" />
                        <input type="checkbox" name="pet" value="1" checked>I have <b>pets</b> to be looked after</label>
                <?php } ?>


                <div class="form-group">
                    <?php if($data['plant'] == 0) {?>
                        <label><input type="hidden" name="plant" value="0" />
                        <input type="checkbox" name="plant" value="1">I have <b>plants</b> to be looked after</label>

                    <?php }elseif ($data['plant'] == 1) {?>
                        <label><input type="hidden" name="plant" value="0" />
                        <input type="checkbox" name="plant" value="1" checked>I have <b>plants</b> to be looked after</label>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block" value="Update your house">
                </div>


            </form>
        </div>
    </div>
</div>
  <div class="fill10"></div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
</div>
</div>
