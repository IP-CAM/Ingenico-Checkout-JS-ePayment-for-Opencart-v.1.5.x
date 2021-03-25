<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
</div>
<div id="content">
<!DOCTYPE html>
	<html lang="en">
		<head>
		</head>
		<body>
		<div class="container">
		<div class="row">
			<div class="text">
			<h2><?php echo $heading_title; ?></h2>
		</div>
		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-payment" class="form-horizontal">

	     From Date: <input type="date" name="fromdate" placeholder="dd-mm-YYYY" required/>
	     To Date: <input type="date" name="todate" placeholder="dd-mm-YYYY" required/>          
         	&nbsp; &nbsp; &nbsp;   <button id="btnSubmit" type="submit" class="btn btn-primary" name="submit" value="Submit" >Submit</button>
        </form>
		<br>
		<br>
		<p><?php echo (isset($message)) ? $message: null; ?></p>
		</div>
		</body>
		<br>
		<br>
	</html>

</div> 
<?php echo $footer; ?>