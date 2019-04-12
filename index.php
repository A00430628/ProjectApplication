<?php
$GLOBALS['state'] = 0;
?>
<script type="text/javascript">
  var mailVal = localStorage.getItem("email");
  if(mailVal){
      window.location.href = 'view.php';
  }
</script>
<?php include "templates/header.php"; ?>
<div class="indexBackgroundImage">
	<div class="indexBackgroundCover">
      <h1>MCDA5540-Assignment2</h1>
  </div>
</div>
<?php include "templates/footer.php"; ?>
