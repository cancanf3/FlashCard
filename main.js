     $(document).ready(function() {

        /* Add Information */
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
                data: {ADD_QUESTION_TITLE: $(".input-sm").val(), ADD_QUESTION_DEF: $(".input-lg").val(), 
                       ADD_QUESTION_C_TITLE: $(".title").attr("id")},

                success:function(respond) {
                  $('#myModal').modal('hide');
                  $('.modal-backdrop').remove();
                  var titles   = $(".input-sm").val();
                  var descript = $(".input-lg").val();
                  var colors   = ["#428bca","#ec971f","#c9302c","#5cb85c","#bb39d7"];
                  var count    = $(".row").children().size();
                  count        = count % 5;

                  $("#FlashCardDiv2").append('<div class="col-md-3 text-center">  <div class="box"> <div class="border" style="background-color:'+colors[count]+'"> <i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="modal" data-target="#myModal"> </i> <i id="exitIcon" class="fa fa-trash-o" aria-hidden="true" ></i>  </div> <div id="box-content" class="box-content" > <h1 id="tag-title" >' + titles + '</h1>  <p id="tag-description">' + descript + '</p> </div> </div> ');
                },
                error:function (xhr, ajaxOptions, thrownError){
                  alert(thrownError);
                }
              });
            }
          });
        });

        /* Edit Information */
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

            if ($("#buttonCat").text() == 'Register Category') {
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
            }
            else {
              $.ajax( {
                type: 'POST',
                url: '/FlashCard/respond.php',
                data: {EDIT_QUESTION_TITLE: titles, EDIT_QUESTION_DES: descript, OLD_QUESTION_TITLE: old_titles, 
                       EDIT_QUESTION_C_TITLE: $(".title").attr("id")},

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

            }
    
          });

        });


        /* Delete Information */
        $(document).on("click",".fa-trash-o", function() {

           var title  = $(this).parent().parent().children("#box-content").children("#tag-title").text();
           var box    = $(this).parent().parent().parent();
           $(this).hide();

           if (($("#buttonCat").text() == 'Register Category')) {
             $.ajax( {
                type: 'POST',
                url: '/FlashCard/respond.php',
                data: {DEL_CATEGORY: title},

                success:function(respond) {
                  box.remove();
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
                data: {DEL_QUESTION: title, DEL_QUESTION_C_TITLE: $(".title").attr("id") },

                success:function(respond) {
                  box.remove();
                },
                error:function (xhr, ajaxOptions, thrownError){
                  alert(thrownError);
                }
             });

            }
        });

        /* Open/Close Questions */
          $(document).on("click",".tag-title", function(){
            var catTitle        = $(this).parent().parent().children("#box-content").children("#tag-title").text();
            var whatwas         = $("#FLashCardDiv1").clone().prop('id','FLashCardDiv-clone');

            $("#FLashCardDiv1").load("category.php" ,{ catTitle });
            $(document).on("click","#buttonCat1", function(){
              $("#FLashCardDiv1").html(whatwas.html());
            });

          }); 

     }); 