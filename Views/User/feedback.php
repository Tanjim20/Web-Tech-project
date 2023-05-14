<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Contact</title>
  <link rel="stylesheet" href="../../Assets/Css/user1.css">
</head>
<body>
<?php include 'userHeader.php'; ?>
    <div class="admin-container">
       <div class="content">
  <table id="main" cellspacing="0">
    <tr>
      <td id="header">
        <h1>Feedback</h1>
      </td>
    </tr>
    <tr>
      <td id="table-form">
        <form id="addForm">
          Name : <input type="text" id="name" style="margin-top:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Feedback : <textarea rows='3' type="text" id="feedback" style="margin-top:10px;"></textarea>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
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


<script type="text/javascript" src="../../Assets/js/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

    function loadTable(){
      $.ajax({
        url : "../../Controller/UserFeedback/feedback.php",
        type : "POST",
        success : function(data){
          $("#table-data").html(data);
        }
      });
    }
    loadTable();

  });

 $("#save-button").on("click",function(e){
      e.preventDefault();
      var name = $("#name").val();
      var feedback = $("#feedback").val();
      if(name == "" || feedback == "" ){
        $("#error-message").html("All fields are required.").slideDown();
        $("#success-message").slideUp();
      }else{
        $.ajax({
          url: "../../Controller/UserFeedback/insertFeedback.php",
          type : "POST",
          data : {name: name, feedback: feedback},
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

</script>
</body>
</html>