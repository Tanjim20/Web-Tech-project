<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Foods</title>
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
        <h1>Food List</h1>

        <div id="search-bar">
          <label>Search Food :</label>
          <input type="text" id="search" autocomplete="off">
        </div>
      </td>
    </tr>
    <tr>
      <td id="table-form">
        <form id="addForm">
          Food Name : <input type="text" id="food_name" style="margin-top:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Food Description : <textarea rows='3' type="text" id="description" style="margin-top:10px;"></textarea>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
          Food Price : <input type="text" id="price" style="margin-top:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Code : <input type="text" id="code" style="margin-top:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
          Image : <input type="file" name="image" id="image" style="margin-top:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Catagory Name :
<select style="margin-top:10px;" id="catagory_id" name="catagory_id">
  <?php
    $sql = "SELECT id, name FROM catagories ";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo "<option value='{$row['id']}'>{$row['name']}</option>";
    }
  ?>
</select>

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
      <h2>Edit Food</h2>
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
        url : "../../Controller/Items/itemsTable.php",
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
  var food_name = $("#food_name").val();
  var description = $("#description").val();
  var price = $("#price").val();
  var code = $("#code").val();
  var image = $("#image")[0].files[0]; // get the actual file data
  var catagory_id = $("#catagory_id").val();
  if(food_name == "" || description == "" || price == "" || code == "" || catagory_id == "" || image == ""){
    $("#error-message").html("All fields are required.").slideDown();
    $("#success-message").slideUp();
  }else{
    var formData = new FormData(); // create a new FormData object
    formData.append('food_name', food_name);
    formData.append('description', description);
    formData.append('price', price);
    formData.append('code', code);
    formData.append('catagory_id', catagory_id);
    formData.append('image', image);
    $.ajax({
      url: "../../Controller/Items/itemsInsert.php",
      type : "POST",
      data : formData, // use the FormData object as the data
      processData: false, // tell jQuery not to process the data
      contentType: false, // tell jQuery not to set the content type
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
        var foodId = $(this).data("id");
        var element = this;

        $.ajax({
          url: "../../Controller/Items/itemsDelete.php",
          type : "POST",
          data : {id : foodId},
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
      var foodId = $(this).data("eid");

      $.ajax({
        url: "../../Controller/Items/itemsEditShow.php",
        type: "POST",
        data: {id: foodId },
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
        var foodId = $("#edit-id").val();
        var food_name = $("#edit-food_name").val();
        var description = $("#edit-description").val();
        var price = $("#edit-price").val();
        var code = $("#edit-code").val();
        var catagory_id = $("#edit-catagory_id").val();

        $.ajax({
          url: "../../Controller/Items/itemsEdit.php",
          type : "POST",
          data : {id: foodId, food_name: food_name, description: description, price: price, code: code, catagory_id: catagory_id},
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
         url: "../../Controller/Items/itemsSearch.php",
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
