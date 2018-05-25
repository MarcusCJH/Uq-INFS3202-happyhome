
<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('contact_msg'); ?>
<!-- content -->
<div class="container" style="background-color: white">
    <div id="container" class="clear">
        <div class = "row">
            <div class="col-md-7">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3539.159139687802!2d153.00984141536412!3d-27.495425824380927!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b91508241eb7c49%3A0x9ae9946d3710eee9!2sThe+University+of+Queensland!5e0!3m2!1sen!2sau!4v1524328474815" width="100%" height="315" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>

            <div class="col-md-5">
                <h4><strong>Get in Touch</strong></h4>
                <form action="<?php echo URLROOT; ?>/pages/sendmail" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="" placeholder="Your Name">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="" placeholder="Your Email">
                      <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>
                    <div class="form-group">
                      <input type="text" name="phone" class="form-control form-control <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?>" value="" placeholder="Your Phone">
                      <span class="invalid-feedback"><?php echo $data['phone_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="" name="message" rows="3" placeholder="Message"></textarea>
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
                    <button class="btn btn-default" type="submit" name="button">
                        <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Submit
                    </button>
                </form>
            </div>
        </div>
        <div class="fill30"></div>
        <?php require APPROOT . '/views/inc/footer.php'; ?>

    </div>
