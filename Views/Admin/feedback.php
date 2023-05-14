<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Feedbacks</title>
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
        <h1>Feedback</h1>

        <div id="search-bar">
          <label>Search Feedback :</label>
          <input type="text" id="search" autocomplete="off">
        </div>
      </td>
    </tr>
    <tr>
      <td id="table-data">
      </td>
    </tr>
  </table>
</div>
</div>


<script type="text/javascript" src="../../Assets/js/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    // Load Table Records
    function loadTable(){
      $.ajax({
        url : "../../Controller/Feedback/feedbackTable.php?page=",
        type : "POST",
        success : function(data){
          $("#table-data").html(data);
        }
      });
    }
    loadTable(); // Load Table Records on Page Load


    // Live Search
     $("#search").on("keyup",function(){
       var search_term = $(this).val();

       $.ajax({
         url: "../../Controller/Feedback/feedbackSearch.php",
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