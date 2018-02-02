<!DOCTYPE html>
<html>
  <head>
    <title>Admin Panel</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   
  </head>
  <body style="background-color:#46afa5">
	<style>

	
.admin{
  background-color: #227f7c;
  padding-left:35px;
  padding-right:35px;
  padding-top:95px;
  padding-bottom:100px;
  width: 450px;
  float: left;
  left: 50%;
  position: absolute;
  margin-top:200px;
  margin-left: -220px;
  -moz-border-radius: 7px;
  -webkit-border-radius: 7px;
}

.admin h2{
  padding-left: 100px;
  margin-top:  -50px;
  margin-bottom: 30px;
  font-size: 50px;
}

#buton{
	float:left;
	width: 100%;
	border: #fbfbfb solid 4px;
	cursor:pointer;
	background-color: #0d7ccc;
	color:white;
	font-size:20px;
	padding-bottom:10px;
  padding-right: 20px;
  margin-left: 1px;
  margin-top: 30px;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
  font-weight:700;
}

#buton:hover{
	background-color: #02ff6f;
	color: #000;
}

.feedback-input {
	color:#3c3c3c;
  font-weight:500;
	font-size: 18px;
	border-radius: 0;
	line-height: 22px;
	background-color: #fbfbfb;
	padding: 13px 93px 10px 0px;
	margin-bottom: 10px;
	width:100%;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	-ms-box-sizing: border-box;
	box-sizing: border-box;
  border: 3px solid rgba(0,0,0,0);
}

.feedback-input:focus{
	background: #fff;
	box-shadow: 0;
	border: 3px solid #3498db;
	color: #000;
	outline: none;
  padding: 13px 13px 13px 0px;
}

	</style>
  </body>
</html>
<?php session_start(); ?>
<?php if ($_SESSION) {

}
else {
  ?>


  <div class="admin">
      <h2>Admin</h2>
      <?php include("kontrol.php");?>
      <form class="" method="post">

      <table>
        <tr>
          <td></td>
          <td>
            <span class="glyphicon glyphicon-user" style="color:white; font-size:20px;"></span>
            <input type="text" name="Name" class="feedback-input"  placeholder="Name" required>
           </td>
        </tr>

        <tr>
          <td><br></td>
          <td><br>
            <span class="glyphicon glyphicon-lock" style="color:white; font-size:20px;"></span>
            <input type="password" name="Password" class="feedback-input" placeholder="Password" required>
           </td>
        </tr>

        <tr>
          <td> <br> </td>
          <td> <br>
            <button type="submit" id="buton">LOGIN</button>
          </td>
        </tr>

      </table>
    </form>
  </div>
<?php  } ?>


