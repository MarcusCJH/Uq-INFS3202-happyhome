<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container" style="background-color: white">
  <?php require APPROOT . '/views/inc/ownernav.php'; ?>
<div class="container">
<div class="row">
  <div class="col-md-10 mx-auto">
    <div class="card card-body bg-light mt-5">
      <h2>Register your home</h2>
      <p>Please fill this form to register with us</p>


        <form id="myForm" action="<?php echo URLROOT; ?>/owners/house_register" method="post" enctype="multipart/form-data">



            <div class="form-group">
                <label>Unit No.: </label>
                <input type="text" id="unit" required name="unit_no" class="form-control form-control <?php echo (!empty($data['unit_no_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['unit_no']; ?>">
                <span class="invalid-feedback"><?php echo $data['unit_no_err']; ?></span>
            </div>

            <div class="form-group">
                <label>Full address: <sup>*</sup></label>
                <input id="autocomplete" onfocus="geolocate()" name="full_address" type="text" required class="form-control form-control" <?php echo (!empty($data['full_address_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['full_address']; ?>">
                <span class="invalid-feedback"><?php echo $data['full_address_err']; ?></span>
            </div>

            <div class ="form-group">
                <label>Stress Address: </label>
                <input type="text" id="street_number" name="street_number" class="form-control form-control" <?php echo (!empty($data['street_number_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['street_number']; ?>">
                <span class="invalid-feedback"><?php echo $data['street_number_err']; ?></span>
            </div>

            <div class ="form-group">
                <label>Route: </label>
                <input type="text" id="route" name="route" class="form-control form-control" <?php echo (!empty($data['route_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['route']; ?>">
                <span class="invalid-feedback"><?php echo $data['route_err']; ?></span>
            </div>

            <div class ="form-group">
                <label>City: <sup>*</sup></label>
                <input type="text" required id="locality" name="locality" class="form-control form-control" <?php echo (!empty($data['locality_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['locality']; ?>">
                <span class="invalid-feedback"><?php echo $data['locality_err']; ?></span>
            </div>

            <div class ="form-group">
                <label>State: </label>
                <input type="text" id="administrative_area_level_1" name="administrative_area_level_1" class="form-control form-control" <?php echo (!empty($data['administrative_area_level_1_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['administrative_area_level_1']; ?>">
                <span class="invalid-feedback"><?php echo $data['administrative_area_level_1_err']; ?></span>
            </div>

            <div class ="form-group">
                <label>Zip-Code<sup>*</sup></label>
                <input type="text" required id="postal_code" name="postal_code" class="form-control form-control" <?php echo (!empty($data['postal_code_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['postal_code']; ?>">
                <span class="invalid-feedback"><?php echo $data['postal_code_err']; ?></span>
            </div>

            <div class ="form-group">
                <label>Country <sup>*</sup></label>
                <input type="text" required id="country" name="country" class="form-control form-control" <?php echo (!empty($data['country_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['country']; ?>">
                <span class="invalid-feedback"><?php echo $data['country_err']; ?></span>
            </div>


            <div class ="form-group">
                <input type="hidden" id="lat" name="latitude" class="form-control form-control" <?php echo (!empty($data['latitude_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['latitude']; ?>">
                <span class="invalid-feedback"><?php echo $data['latitude_err']; ?></span>
            </div>

            <div class ="form-group">
                <input type="hidden" id="lng" name="longitude" class="form-control form-control" <?php echo (!empty($data['longitude_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['longitude']; ?>">
                <span class="invalid-feedback"><?php echo $data['longitude_err']; ?></span>
            </div>


            <div class ="form-group">
                <label>Contact Number <sup>*</sup></label>
                <input type="text" required id="contact_number" name="contact_number" class="form-control form-control" <?php echo (!empty($data['contact_number_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['contact_number']; ?>">
                <span class="invalid-feedback"><?php echo $data['contact_number_err']; ?></span>
            </div>

            <div class="form-group">
                <label>Description: </label>
                <textarea name="description" class="form-control form-control" rows="5" id="description"><?php echo $data['description']; ?> </textarea>
            </div>

            <div class="form-group">
                <label><input type="hidden" name="pet" value="0" />
                    <input type="checkbox" id="pet" name="pet" value="1">I have <b>pets</b> to be looked after</label>

            </div>

            <div class="form-group">
                <label><input type="hidden" name="plant" value="0" />
                    <input type="checkbox" id="plant" name="plant" value="1">I have <b>plants</b> to be looked after</label>

            </div>

            <div class="form-group">
                <label>Upload an image of your house</label>
                <input type="file" enctype="multipart/form-data" id="cover_image" name="cover_image" class="form-control-file" accept="image/*" onchange="loadFile(event)" ondrop="return false;"  aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">(Image must be less than 2mb)<br>


                    <img style="max-width: calc(100% - 20px);" id="output"/>

                    <script src="<?php echo URLROOT; ?>/js/filevalidation.js"></script>
            </div>

            <div class="form-group">
              <input type="button" class="btn btn-light btn-block" onclick="clearForm()" value="Reset form"/>
              <input type="submit" class="btn btn-success btn-block" value="Register your house">
            </div>


        </form>


    </div>

        <script src="<?php echo URLROOT; ?>/js/googlemapautocomplete.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=[API KEY]&libraries=places&callback=initAutocomplete"
                async defer></script>


        <script>
        function clearForm(){
          document.getElementById("myForm").reset();
        }
        </script>


    </div>
  </div>
  <?php require APPROOT . '/views/inc/footer.php'; ?>

</div>
</div>
