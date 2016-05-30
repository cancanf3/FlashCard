<html>
<head>
<title>Category</title>
	  <link rel="stylesheet" type="text/css" href="style.css">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> 
      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>

<div class="container" id="FlashCardDiv2">
<button type='button' class='btn btn-primary btn-sm' id='buttonCat' data-toggle='modal' data-target='#myModal'> Back to Categories </button>
<h1>Current File</h1>
<p>My first paragraph.</p>

</div>

</body>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script type="text/javascript">
		/* Open Category Page  */
		$(document). ready(function(){
        $("#buttonCat"). click(function(){

        $("body"). load ("welcome.php");
        });

      });
	</script>

</html>