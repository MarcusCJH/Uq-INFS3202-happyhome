<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container" style="background-color: white">

<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
      <h2>Create An Account</h2>
      <p>Please fill this form to register with us</p>
      <form action="<?php echo URLROOT; ?>/users/register" method="post">
        <div class="form-group">
            <label>First Name:<sup>*</sup></label>
            <input type="text" name="first_name" class="form-control form-control-lg <?php echo (!empty($data['first_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['first_name']; ?>">
            <span class="invalid-feedback"><?php echo $data['first_name_err']; ?></span>
        </div>
        <div class="form-group">
            <label>Last Name:<sup>*</sup></label>
            <input type="text" name="last_name" class="form-control form-control-lg <?php echo (!empty($data['last_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['last_name']; ?>">
            <span class="invalid-feedback"><?php echo $data['last_name_err']; ?></span>
        </div>
        <div class="form-group">
            <label>Email Address:<sup>*</sup></label>
            <input type="text" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
        </div>
        <div class="form-group">
            <label>Password:<sup>*</sup></label>
            <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
        </div>
        <div class="form-group">
            <label>Confirm Password:<sup>*</sup></label>
            <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
            <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
        </div>
        <div class="form-group">
             <label>Contact Number:<sup>*</sup></label>
             <input type="text" name="contact_number" class="form-control form-control-lg <?php echo (!empty($data['contact_number_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['contact_number']; ?>">
             <span class="invalid-feedback"><?php echo $data['contact_number_err']; ?></span>
         </div>
        <div class="form-group">
            <input type="radio" name="type" value="sitter" checked> I want to be a <b>house sitter</b> and look for jobs<br>
            <input type="radio" name="type" value="owner"> I'm a <b>home owner</b> looking for a house sitter<br>
            <?php echo $data['type']; ?>
        </div>
        <div class="form-row">
          <div class="col">
              <div class="g-recaptcha" data-sitekey="[SITE KEY]"></div>
            <input type="submit" class="btn btn-success btn-block" value="Register">
          </div>
          <div class="col">
            <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Have an account? Login</a>
          </div>
        </div>
      </form>
    </div>
    <div class="fill10"></div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
</div>
