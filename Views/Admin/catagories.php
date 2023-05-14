<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Catagories</title>
  <link rel="stylesheet" href="../../Assets/Css/admin1.css">
</head>
<body>
<?php include 'adminHeader.php'; ?>
    <div class="admin-container">
       <?php include 'adminLeftbar.php'; ?>
       <div class="content">
  <table id="main" cellspacing="0">
    <tr>
      <td id="header">
        <h1>Catagories</h1>

        <div id="search-bar">
          <label>Search Catagory :</label>
          <input type="text" id="search" autocomplete="off">
        </div>
      </td>
    </tr>
    <tr>
      <td id="table-form">
        <form id="addForm">
        Catagory Name : <input type="text" id="name" style="margin-top:10px;">
          <input type="submit" id="save-button" value="Save" style="margin-top:10px;">
        </form>
      </td>
    </tr>
    <tr>
      <td id="table-data">
      </td>
    </tr>
  </table>
</div>
</div>
  <div id="error-message"></div>
  <div id="success-message"></div>
  <div id="modal">
    <div id="modal-form">
      <h2>Edit Catagory</h2>
      <table cellpadding="10px" width="100%">
      </table>
      <div id="close-btn">X</div>
    </div>
  </div>


<script type="text/javascript" src="../../Assets/js/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    // Load Table Records
    function loadTable(){
      $.ajax({
        url : "../../Controller/Catagories/catagoryTable.php",
        type : "POST",
        success : function(data){
          $("#table-data").html(data);
        }
      });
    }
    loadTable(); // Load Table Records on Page Load

    // Insert New Records
    $("#save-button").on("click",function(e){
      e.preventDefault();
      var name = $("#name").val();
      if(name == ""){
        $("#error-message").html("All fields are required.").slideDown();
        $("#success-message").slideUp();
      }else{
        $.ajax({
          url: "../../Controller/Catagories/catagoryInsert.php",
          type : "POST",
          data : {name: name},
          success : function(data){
            if(data == 1){
              loadTable();
              $("#addForm").trigger("reset");
              $("#success-message").html("Data Inserted Successfully.").slideDown();
              $("#error-message").slideUp();
            }else{
              $("#error-message").html("Can't Save Record.").slideDown();
              $("#success-message").slideUp();
            }

          }
        });
      }

    });

    //Delete Records
    $(document).on("click",".delete-btn", function(){
      if(confirm("Do you really want to delete this record ?")){
        var catId = $(this).data("id");
        var element = this;

        $.ajax({
          url: "../../Controller/Catagories/catagoryDelete.php",
          type : "POST",
          data : {id : catId},
          success : function(data){
              if(data == 1){
                $(element).closest("tr").fadeOut();
              }else{
                $("#error-message").html("Can't Delete Record.").slideDown();
                $("#success-message").slideUp();
              }
          }
        });
      }
    });

    //Show Modal Box
    $(document).on("click",".edit-btn", function(){
      $("#modal").show();
      var catId = $(this).data("eid");

      $.ajax({
        url: "../../Controller/Catagories/catagoryEditShow.php",
        type: "POST",
        data: {id: catId },
        success: function(data) {
          $("#modal-form table").html(data);
        }
      })
    });

    //Hide Modal Box
    $("#close-btn").on("click",function(){
      $("#modal").hide();
    });

    //Save Update Form
      $(document).on("click","#edit-submit", function(){
        var catId = $("#edit-id").val();
        var name = $("#edit-name").val();

        $.ajax({
          url: "../../Controller/Catagories/catagoryEdit.php",
          type : "POST",
          data : {id: catId, name: name},
          success: function(data) {
            if(data == 1){
              $("#modal").hide();
              loadTable();
            }
          }
        })
      });

    // Live Search
     $("#search").on("keyup",function(){
       var search_term = $(this).val();

       $.ajax({
         url: "../../Controller/Catagories/catagorySearch.php",
         type: "POST",
         data : {search:search_term },
         success: function(data) {
           $("#table-data").html(data);
         }
       });
     });
  });
</script>
</body>
</html>