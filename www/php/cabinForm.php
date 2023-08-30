
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Insert Cabin</title>
<link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
<link href="../style/sunny.css" rel="stylesheet" type="text/css">


</head>
<body>
<header>
    <div class="logo"> 
    <h1>Sunnyspot <img src="../images/accommodation.png" alt="Accommodation"> Accommodation</h1>
   </div>
  </header>
  <div class="navigation">
   <nav>
    <ul>
      <li><a href="../index.html">Home</a></li>
      <li><a href="../php/showAllCabins.php">Cabins</a></li>
      <li><a href="contact.html">Contact</a></li>
      <li><a href="../php/adminLogout.php">Log Out</a></li> 
    </ul>
   </nav>
  </div>
  <main>
<form class="add_cabin" action="insertCabin.php" method="POST" enctype="multipart/form-data">         
<h1>Add a New Cabin</h1>

<label>CabinType:</label>
<input type="text" id="cabin_type" name="cabin_type" required>

<label>CabinDescription:</label>
<textarea type="messege " id="description" name="cabin_description" rows="4" cols="50"></textarea>

<label>PricePerNight:</label>
<input type="select" id="price" name="price_day">

<label>PricePerWeek:</label>
<input type="select" id="price" name="price_week">

<label for="cabinimage" class="file-upload">CabinImages:</label>
<input type="file" id="cabinimage" name="cabinimage" accept="image/*" required>
<br>

<input type="submit" name="add_cabin" id="add_cabin" class="btn_add" value="Add Cabin">
<a  class="btn-cancel" href="showAllCabins.php">Cancel</a>

</form>
</main>
    <footer> 
    <a href="../php/adminLogout.php">Log Out</a>
    <p>Copywrite © - Create by Sunny Spot develop 2023</p>  
  </footer>
</body>
</html>
