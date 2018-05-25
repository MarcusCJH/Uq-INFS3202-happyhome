
<?php require APPROOT . '/views/inc/header.php'; ?>

<!-- content -->
<div class="container" style="background-color: white">
  <div id="container" class="clear">
    <!-- Slider -->
    <div class = "row">
     <div class="col-sm-6"><section id="slider"><a href="<?php echo URLROOT; ?>/users/register"><img src="public/images/LFhomeowner.png" width="480" height="369"></a></section></div>
       <div class="col-sm-6"><section id="slider"><a href="<?php echo URLROOT; ?>/users/register"><img src="public/images/LFhomesitter.png" width="480" height="369"></a></section></div>
  </div>
        <h2>
        Featured Homes
        </h2>
        <br>
        <div class="row" align="center">

        <?php $numberOfColumns = 3;

        $arrayChunks = array_chunk($data['houses'], $numberOfColumns);
        $i = 0;?>
        <?php foreach($arrayChunks as $houses) :?>
              <?php foreach($houses as $house) :?>
                  <?php if($i++ == 3){
                     break;
                  }?>
                        <div class="col-md-4">
                            <figure><img src="public/images/cover_image/<?php echo $house->cover_image;?>
" width="250" height="180" alt=""></figure>
                              <p><?php echo $house->description;?></p>
                            </div>


              <?php endforeach; ?>
      <?php endforeach; ?>
    </div>
    <div class="fill10"></div>
  <?php require APPROOT . '/views/inc/footer.php'; ?>
</div>
