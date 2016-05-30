<html>
   <head>
      <title>Welcome </title>
      <link rel="stylesheet" type="text/css" href="style.css">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> 
      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
      
   </head>
   
   <body> 
   <div class="container-fluid">
      <div class="container">
         <div class="WelTitle">

      <?php
         include($_SERVER["DOCUMENT_ROOT"]. '/FlashCard/Config.php');
         
         session_start();

         $email   = $_SESSION['login_user'];
         $sql     = "SELECT TITLE, DESCRIPTION FROM CATEGORY WHERE U_EMAIL = '$email'";
         $result  = mysqli_query($db, $sql);

         echo "<h1> Welcome ".$_SESSION['login_user']."</h1>";
         echo "</div>";
         echo "<div class='FLashCardDiv' id='FLashCardDiv2'>";
         echo "<div class='SubTitle'>";
         echo "<p> Current Categories </p> ";
         echo "<button type='button' class='btn btn-primary btn-sm' id='buttonCat' data-toggle='modal' data-target='#myModal'>";  // Modal Button
         echo "Register Category</button> </div>";
         echo '<div class="container">';
         echo '<div class="row">';

         $i = 0;
         $color = array("#428bca","#ec971f","#c9302c","#5cb85c","#bb39d7");

         while( $row = mysqli_fetch_array($result) ){
            echo '<div class="col-md-3 text-center">';
            echo '<div class="box">';
            echo '<div class="border" style="background-color:'.$color[$i].'"> <i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="modal" data-target="#myModal"> </i>  <i id="exitIcon" class="fa fa-trash-o" aria-hidden="true"></i> </div>';
            $title = $row['TITLE'];
            echo '<div id="box-content" class="box-content" > <h1 id="tag-title" class="tag-title">' .$title. "</h1>";
            $description = $row['DESCRIPTION'];
            echo "<p id='tag-description'>" .$description. "</p>";  
            //echo '<button type="button" class="btn btn-primary btn-round-lg btn-lg">  </button>';
            echo "</div> </div> </div>";
            $i++;
            if($i == 5){ 
               $i = 0;
            }
          
         }
         echo "</div> </div> </div>";

         
         echo "<div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>";
  		   echo  "<div class='modal-dialog' role='document'>";
   		   echo "<div class='modal-content'>";
      	 echo "<div class='modal-header'>";
         echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
         echo "<h4 class='modal-title' id='myModalLabel'>Modal title</h4>";
      	 echo "</div>";
      	 echo "<div class='form-group'>
    			     <label for='inputsm'>Category Title</label>
    			     <input class='form-control input-sm' id='inputsm' type='text' value=''>
  			       </div>
  			       <div class='form-group'>
  			         <label for='inputlg'>Description</label>
    			       <input class='form-control input-lg' id='inputlg' type='text' value=''>
  			       </div>";
      	 echo "<div class='modal-footer'>";
         echo "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
         echo "<button type='button' id='saved-button' class='btn btn-primary'>Save changes</button>";
      	 echo "</div>";
   		   echo "</div>";
  		   echo "</div>" ;
		     echo "</div>"; // End Modal */
      ?>   
      <?php echo $login_session; ?> 
      <h2><a href = "/FlashCard/Logout.php">Sign Out</a></h2>

   </body>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script type="text/javascript">
   $(document).ready(function() {

      /* Modal for Register a Category */
      $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus();

      });

      /* Modal for Edit a Category */
      $('.fa-pencil-square-o').click(function() {
        $('#myInput').focus();
        var titles           = $(this).parent().parent().children("#box-content").children("#tag-title").val();
        var descript         = $(this).parent().parent().children("#box-content").children("#tag-description").val();
        $(".input-sm").val(titles);
        $(".input-lg").val(descript);
        
      });


      /* Add a Category */
      $("#saved-button").click(function(){

         if($(".input-sm").val()==='') {
                alert("Please enter a Title.");
                return false;
         }


         $.ajax( {
            type: 'POST',
            url: '/FlashCard/respond.php',
            data: {ADD_CATEGORY_TITLE: $(".input-sm").val(), ADD_CATEGORY_DES: $(".input-lg").val()},

            success:function(respond) {
               $(".fade").fadeOut();
               var titles 	= $(".input-sm").val();
               var descript	= $(".input-lg").val();
               $(".row").append('<div class="col-md-3 text-center">  <div class="box"> <div class="border" style="background-color:#000"> <a href=""> <i class="fa fa-pencil-square-o" aria-hidden="true"> </i> </a>  <i id="exitIcon" class="fa fa-trash-o" aria-hidden="true"></i>  </div> <div id="box-content" class="box-content" > <h1 id="tag-title" class="tag-title">' + titles + '</h1>  <p>' + descript + '</p> </div> </div> ');
            }
         }); 
      });


      /* Delete Category */

      $(".fa-trash-o").click(function() {

         var title  = $(this).parent().parent().children("#box-content").children("#tag-title").text();
         var box    = $(this).parent().parent().parent();
         var mydata = 'DEL_CATEGORY=' + title;
         $(this).hide();

         $.ajax( {
            type: 'POST',
            url: '/FlashCard/respond.php',
            data: mydata,

            success:function(respond) {
               box.fadeOut();
            }
         });
      });

      /* Open Category */
      $(document). ready(function(){
        $("#tag-title"). click(function(){

        $("#FLashCardDiv2"). load ("category.php");
        });

      });



   });   

</script>
   
</html>

