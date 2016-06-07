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
                echo "<div class='FLashCardDiv' id='FLashCardDiv1'>";
                echo "<div class='SubTitle' id='welcome'>";
                echo "<p> Current Categories </p> ";
                echo "<button type='button' class='btn btn-primary btn-sm' id='buttonCat' 
                      data-toggle='modal' data-target='#myModal'>";
                echo "Register Category</button> </div>";
                echo '<div class="container">';
                echo '<div class="row">';

                $i = 0;
                $color = array("#428bca","#ec971f","#c9302c","#5cb85c","#bb39d7");

                while( $row = mysqli_fetch_array($result) ){
                  echo '<div class="col-md-3 text-center">';
                  echo '<div class="box">';
                  echo '<div class="border" style="background-color:'.$color[$i].'"> 
                        <i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="modal" 
                        data-target="#myModal"> </i>  <i id="exitIcon" 
                        class="fa fa-trash-o" aria-hidden="true"></i> </div>';
                  $title = $row['TITLE'];
                  echo '<div id="box-content" class="box-content" > 
                        <h1 id="tag-title" class="tag-title">' .$title. "</h1>";
                  $description = $row['DESCRIPTION'];
                  echo "<p id='tag-description'>" .$description. "</p>";  
                  echo "</div> </div> </div>";
                  $i++;
                  if($i == 5){ 
                    $i = 0;
                  }
                  
                }
                echo "</div> </div> </div>";

                 
                echo "<div class='modal fade' id='myModal' tabindex='-1' 
                      role='dialog' aria-labelledby='myModalLabel'>";
          		  echo "<div class='modal-dialog' role='document'>";
           		  echo "<div class='modal-content'>";
              	echo "<div class='modal-header'>";
                echo "<button type='button' class='close' data-dismiss='modal' 
                      aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
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
                echo "<button type='button' id='close-button' class='btn btn-default' 
                      data-dismiss='modal'>Close</button>";
                echo "<button type='submit' id='saved-button' class='btn 
                      btn-primary'>Save changes</button>";
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

        /* Add a Category */

        $(document).on("click","#buttonCat", function() {
          $('#myInput').focus();
          $(".input-sm").val("");
          $(".input-lg").val("");


          $("#saved-button").unbind().click(function(){
            if($(".input-sm").val() =='') {
                    alert("Please enter a Title.");
                    return false;
            }

            if($("#buttonCat").text() == 'Register Category'){
              $.ajax( {
                  type: 'POST',
                 url: '/FlashCard/respond.php',
                 data: {ADD_CATEGORY_TITLE: $(".input-sm").val(), ADD_CATEGORY_DES: $(".input-lg").val()},

                  success:function(respond) {
                    $('#myModal').modal('hide');
                    $('.modal-backdrop').remove();
                    var titles   = $(".input-sm").val();
                    var descript = $(".input-lg").val();
                    var colors   = ["#428bca","#ec971f","#c9302c","#5cb85c","#bb39d7"];
                    var count    = $(".row").children().size();
                    count        = count % 5;

                    $(".row").append('<div class="col-md-3 text-center">  <div class="box"> <div class="border" style="background-color:'+colors[count]+'"> <i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="modal" data-target="#myModal"> </i> <i id="exitIcon" class="fa fa-trash-o" aria-hidden="true" ></i>  </div> <div id="box-content" class="box-content" > <h1 id="tag-title" class="tag-title">' + titles + '</h1>  <p id="tag-description">' + descript + '</p> </div> </div> ');
                  },
                  error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                  }
              });
            }
            else {
              $.ajax( {
                type: 'POST',
                url: '/FlashCard/respond.php',
                data: {ADD_QUESTION_TITLE: $(".input-sm").val(), ADD_QUESTION_DEF: $(".input-lg").val()},

                success:function(respond) {
                  $('#myModal').modal('hide');
                  $('.modal-backdrop').remove();
                  var titles   = $(".input-sm").val();
                  var descript = $(".input-lg").val();
                  var colors   = ["#428bca","#ec971f","#c9302c","#5cb85c","#bb39d7"];
                  var count    = $(".row").children().size();
                  count        = count % 5;

                  $(".row").append('<div class="col-md-3 text-center">  <div class="box"> <div class="border" style="background-color:'+colors[count]+'"> <i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="modal" data-target="#myModal"> </i> <i id="exitIcon" class="fa fa-trash-o" aria-hidden="true" ></i>  </div> <div id="box-content" class="box-content" > <h1 id="tag-title" class="tag-title">' + titles + '</h1>  <p id="tag-description">' + descript + '</p> </div> </div> ');
                },
                error:function (xhr, ajaxOptions, thrownError){
                  alert(thrownError);
                }
              });
            }
          });
        });

        /* Edit a Category */
        $(document).on("click",".fa-pencil-square-o",function() {
          
          $(document).on("focus",'#myInput');

          var old_titles          = $(this).parent().parent().children("#box-content").children("#tag-title").text();
          var descript            = $(this).parent().parent().children("#box-content").children("#tag-description").text();
          var old_titles_obj      = $(this).parent().parent().children("#box-content").children("#tag-title");
          var old_descript_obj    = $(this).parent().parent().children("#box-content").children("#tag-description");

          $(".input-sm").val(old_titles);
          $(".input-lg").val(descript);
          $("#saved-button").unbind().click(function(){ 
            
          if ($(".input-sm").val()==='') {
            alert("Please enter a Title.");
            return false;
          }

            var titles    = $(".input-sm").val();
            var descript  = $(".input-lg").val();

            $.ajax( {
              type: 'POST',
              url: '/FlashCard/respond.php',
              data: {EDIT_CATEGORY_TITLE: titles, EDIT_CATEGORY_DES: descript, OLD_CATEGORY_TITLE: old_titles},

              success:function(respond) {
                 $('#myModal').modal('hide');
                 $('.modal-backdrop').remove();
                 old_titles_obj.text(titles);
                 old_descript_obj.text(descript);
              },
              error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError);
              }
            });
             
          });

          

          
        });


        /* Delete a Category */
        $(document).on("click",".fa-trash-o", function() {

           var title  = $(this).parent().parent().children("#box-content").children("#tag-title").text();
           var box    = $(this).parent().parent().parent();
           var mydata = 'DEL_CATEGORY=' + title;
           $(this).hide();

           $.ajax( {
              type: 'POST',
              url: '/FlashCard/respond.php',
              data: mydata,

              success:function(respond) {
                box.remove();
              },
              error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError);
              }
           });
        });

        /* Open a Category */
          $(document).on("click",".tag-title", function(){
            var catTitle        = $(this).parent().parent().children("#box-content").children("#tag-title").text();
            var thedata         = 'SHOW_CAT=' + catTitle
            var whatwas         = $("#FLashCardDiv1").clone().prop('id','FLashCardDiv-clone');

            
            $.ajax( {
              type: 'POST',
              url: '/FlashCard/respond.php',
              data: thedata,
              dataType: 'json',

              success:function(respond) {
                $("#FLashCardDiv1").load("category.php" ,{ catTitle });
              },
              error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError);
              }
           });

            $(document).on("click","#buttonCat1", function(){
              $("#FLashCardDiv1").html(whatwas.html());
            });
            
          }); 

     });   

  </script>
   
</html>

