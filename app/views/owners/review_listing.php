<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container" style="background-color: white">
<?php require APPROOT . '/views/inc/ownernav.php'; ?>
<?php flash('house_msg'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card card-body bg-light mt-5">
                    <h2>Give a review to sitter <?php echo $data['user']->first_name?></h2>
                    <p>Please fill this form to give a review</p>


                    <form action="<?php echo URLROOT; ?>/owners/review_listing/<?php echo $data['id']; ?>" method="post">
                        <div class="form-group">
                            <fieldset class="rating">
                                <input type="radio" id="star5" name="review_score" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                <input type="radio" id="star4half" name="review_score" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                <input type="radio" id="star4" name="review_score" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                <input type="radio" id="star3half" name="review_score" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                <input type="radio" id="star3" name="review_score" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                <input type="radio" id="star2half" name="review_score" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                <input type="radio" id="star2" name="review_score" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                <input type="radio" id="star1half" name="review_score" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                <input type="radio" id="star1" name="review_score" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                <input type="radio" id="starhalf" name="review_score" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>

                            </fieldset>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label>Review Description:</label>
                            <textarea name="review" class=" form-control" id="review"><?php echo $data['review']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-block" value="Submit Review">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="fill10"></class>
<?php require APPROOT . '/views/inc/footer.php'; ?>
</div>
