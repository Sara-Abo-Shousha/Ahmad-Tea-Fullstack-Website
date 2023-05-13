<?php
   $db = mysqli_connect("localhost", "root", "", "webproject");
   $table1 = '';
   $ASC = 0;
   $statusMsg='';
if (isset($_POST['upload'])) {


    $count = 1;
    //file upload path
    $targetDir = "Products/" . $count . "/";
    while (file_exists($targetDir)) {
        $targetDir = "Products/" . $count . "/";
        $count++;
        
    }
    if(!file_exists($targetDir)) mkdir($targetDir);

    $count = count($_FILES['image']['name']);


    for ($i = 0; $i < $count; $i++) {
        $fileName = $_FILES["image"]["name"][$i];
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
            //upload file to server
            if (move_uploaded_file($_FILES["image"]["tmp_name"][$i], $targetFilePath))
                $statusMsg = "The file " . $fileName . " has been uploaded.";
        }
    }
 
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST["Desc"];
    $category = $_POST["genere"];
    $img_loc = $targetDir;
    $sql = "INSERT INTO products (Name, Price, Description, Category, image_file) VALUES ('$name','$price', '$desc', '$category', '$img_loc')";
    mysqli_query($db, $sql);
}
if (isset($_POST["search"]))
{
    if(is_numeric($_POST["search"]))
    $searchqr = "SELECT * FROM products WHERE Product_ID LIKE '%".
    $_POST["search"]."%'";
    else
    $searchqr = "SELECT * FROM products WHERE Name LIKE '%".
    $_POST["search"]."%' OR Description LIKE '%".$_POST["search"]."%'";
    $resultsrch = mysqli_query($db, $searchqr);

    if (mysqli_num_rows($resultsrch) == 0) {
        $table1 = "<tr><td colspan=5 class='history'> There are no products </td></tr>";
      } else {
        foreach ($resultsrch as $rowtable) {

          $table1 .= "<tr class='history'>
                      <td class='history'>#" . $rowtable["Product_ID"] . "</td>
                      <td class='history'>" . $rowtable["Name"] . "</td>
                      <td class='history'>$" . $rowtable["Price"] . "</td>
                      <td class='history'>" . $rowtable["Description"] . "</td>
                      <td class='history'>" . $rowtable["Category"] . "</td>
                      <td class='history'><a href='account.php?prod_id=".$rowtable["Product_ID"]."'>Edit</a> </td>
                    </tr>";
        }
      }

}
else
{

    $searchqr = "SELECT * FROM Products";
    if(isset($_POST["ASC"]))
    {
        switch($_POST["ASC"])
        {
            case 1:  $searchqr .= " ORDER BY Product_ID ASC";
            break;
            case 2: $searchqr .= " ORDER BY Name ASC";
            break;
            case 3: $searchqr .= " ORDER BY Price ASC";
            break;
            case 4: $searchqr .= " ORDER BY Description ASC";
            break;
            case 5: $searchqr .= " ORDER BY Category ASC";
            break;
            default: $searchqr .= ""; break;
        }
    }
    elseif(isset($_POST["DESC"]))
    {
        switch($_POST["DESC"])
        {
            case 1: $searchqr .= " ORDER BY Product_ID DESC";
            break;
            case 2: $searchqr .= " ORDER BY Name DESC";
            break;
            case 3: $searchqr .= " ORDER BY Price DESC";
            break;
            case 4: $searchqr .= " ORDER BY Description DESC";
            break;
            case 5: $searchqr .= " ORDER BY Category DESC";
            break;
            default: $searchqr .= ""; break;
        }
    }
    $resultsrch = mysqli_query($db, $searchqr);

    if (mysqli_num_rows($resultsrch) == 0) {
        $table1 = "<tr><td colspan=5 class='history'> There are no products </td></tr>";
      } else {
        foreach ($resultsrch as $rowtable) {

          $table1 .= "<tr class='history'>
                      <td class='history'>#" . $rowtable["Product_ID"] . "</td>
                      <td class='history'>" . $rowtable["Name"] . "</td>
                      <td class='history'>$" . $rowtable["Price"] . "</td>
                      <td class='history'>" . $rowtable["Description"] . "</td>
                      <td class='history'>" . $rowtable["Category"] . "</td>
                      <td class='history'><a href='account.php?prod_id=".$rowtable["Product_ID"]."'>Edit</a> </td>
                    </tr>";
        }
      }


}
if(isset($_POST["edit"]))
{
    $count = count($_FILES['image2']['name']);


    for ($i = 0; $i < $count; $i++) {
        $fileName = $_FILES["image2"]["name"][$i];
        $targetFilePath = $_POST["file_loc"] . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
            //upload file to server
            if (move_uploaded_file($_FILES["image2"]["tmp_name"][$i], $targetFilePath))
                $statusMsg = "The file " . $fileName . " has been uploaded.";
            else
                $statusMsg = "error";
        }
        else
        $statusMsg = "wrong file type";
    }
    
    $updateedit = "UPDATE products SET Name='".$_POST["Name"]
    ."',Price=".$_POST["price"].",Description='".$_POST["Desc"]."',Category='".$_POST["genere"]."'WHERE Product_ID = ".$_GET["prod_id"]."";

    mysqli_query($db, $updateedit);

}
elseif (isset($_POST["deleteimg"]))
{
    unlink($_POST["img"]);
}
elseif (isset($_POST["deleteprod"]))
{
    
    $deleteimg = scandir($_POST["file_loc"]);

    foreach ($deleteimg as $remove)
    {
      if($pic !== "." && $pic !== "..")
        unlink($_POST["file_loc"].$remove);
    }
    rmdir($_POST["file_loc"]);

    $delete = "DELETE FROM products WHERE Product_ID = ".$_GET["prod_id"]."";
    mysqli_query($db, $delete);
    unset($_GET);
}

if(isset($_POST["goback"]))
{
  unset($_GET);
}
?>

<script>
function showResult(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}
</script>

<div class="tabcontent" id="add">
 <h2>Add Products</h2>
    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        <table class="forms">
            <tr>
                <td colspan="2">
                    <label for="file" class="button"> Upload Images of Product </label><br>
                    <input type="file" id="file" name="image[]" multiple required>
                </td>
            </tr>
            <tr>

                <td colspan="2"><label class="custom">
                        <input type="text" name="name" required><span class="placeholder">Name of Tea:</span></label></td>

            </tr>
            <tr>

                <td colspan="2"><label class="custom"> <input type="number" name="price" step="0.01" required><span class="placeholder" >Price:</span></label></td>
            </tr>
            <tr>
                <td colspan="2"> 
                <p>Description:</p> 
                <label class="custom"><textarea name="Desc" style="resize: none;" cols="40" rows="4" placeholder="Add a Description for this product"></textarea></label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <label class="custom">
                    <select name="genere" required>
                        <option value="" hidden selected></option>
                        <option value="Black Tea">Black Tea</option>
                        <option value="Green Tea">Green Tea</option>
                        <option value="Fruit"> Fruit</option>
                        <option value="Various">Various</option>
                        <option value="Teabags"> Teabags</option>
                    </select><span class="placeholder">Category:</span></label>
            </tr>
            <tr>
                <td>
                    <input type="submit" class="button" name="upload" value="upload">
                </td>
            </tr>
        </table>
    </form>
</div>

<div class="tabcontent" id="edit">
    <?php if(!isset($_GET["prod_id"])) { ?>
 <h2>Edit Products</h2>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="search" id="srch" placeholder="Search by Name" value = "<?php if(isset($_POST["search"])) echo $_POST["search"]; ?>" onkeyup="showResult(this.value)">
    </form>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method = "post">
    <table class = "history">
        <tr>
            <?php if(isset($_POST["ASC"])) { ?>
            <th class = "history"> <button class="sort" name = "DESC" data-hover="ID ▼" value="1"><span>ID</span></button></th>
            <th class = "history"> <button class="sort" name = "DESC" data-hover="Name ▼" value="2"><span>Name</span></button></th>
            <th class = "history"> <button class="sort" name = "DESC" data-hover="Price ▼" value="3"><span>Price</span></button></th>
            <th class = "history"> <button class="sort" name = "DESC" data-hover="Description ▼" value="4"><span>Description</span></button></th>
            <th class = "history"> <button class="sort" name = "DESC" data-hover="Category ▼" value="5"><span>Category</span></button></th>
            <th class = "history">Edit</th>
            <?php } else { ?>
            <th class = "history"> <button class="sort" name = "ASC" data-hover="ID ▲" value="1"><span>ID</span></button></th>
            <th class = "history"> <button class="sort" name = "ASC" data-hover="Name ▲" value="2"><span>Name</span></button></th>
            <th class = "history"> <button class="sort" name = "ASC" data-hover="Price ▲" value="3"><span>Price</span></button></th>
            <th class = "history"> <button class="sort" name = "ASC" data-hover="Description ▲" value="4"><span>Description</span></button></th>
            <th class = "history"> <button class="sort" name = "ASC" data-hover="Category ▲" value="5"><span>Category</span></button></th>
            <th class = "history">Edit</th>
            <?php } ?>
        </tr>
            <?php echo $table1; ?>
    </table>
    </form>
    <?php } else {
        $editquery = "SELECT * FROM Products WHERE Product_ID = ".$_GET["prod_id"]."";
        $editresult = mysqli_query($db, $editquery);
        $editrow = mysqli_fetch_assoc($editresult);
        echo $statusMsg;
        ?>
        <div>
          <form action="<?php $_SERVER['PHP_SELF']; ?>" method="get"><button type="submit" name="goback" class="backbtn" value="Back">🠔Back</button></form>
          <h2 id="edit">Edit Product</h2>
        </div>
        
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method = "post" enctype="multipart/form-data">
        <table class="forms">
            <tr>
              <td colspan="2">
                <p>Product ID:</p>  
                <label class="custom">
                  <input type="text" name="ID" value="<?php echo $editrow["Product_ID"];  ?>" required disabled>
                </label>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <label class="custom">
                  <input type="text" name="Name" value="<?php echo $editrow["Name"];  ?>" required><span class="placeholder">Name:</span>
                </label>
              </td>
            </tr>
            <tr>
              <td colspan="2">

                <label class="custom">
                  <input type="number" name="price" value="<?php echo $editrow["Price"];  ?>" step="0.01" required><span class="placeholder">Price:</span>
                </label>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <p>Description:</p> 
                <label class="custom"><textarea name="Desc" style="resize: none;" cols="40" rows="4" placeholder="Add a Description for this product"><?php echo $editrow["Description"];  ?></textarea></label>
                </label>
              </td>
            </tr>
            <tr>
                <td colspan="2">
                <label class="custom">
                    <select name="genere" required>
                        <option value="<?php echo $editrow["Category"];?>" hidden selected><?php echo $editrow["Category"];  ?></option>
                        <option value="Black Tea">Black Tea</option>
                        <option value="Green Tea">Green Tea</option>
                        <option value="Fruit"> Fruit</option>
                        <option value="Various">Various</option>
                        <option value="Teabags"> Teabags</option>
                    </select><span class="placeholder">Category:</span></label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="file2" class="button"> Upload Images of Product </label><br>
                    <input type="file" id="file2" name="image2[]" multiple>
                </td>
            </tr>
            <input type="hidden" name="file_loc" value="<?php echo $editrow["image_file"]; ?>">
            <?php $images = scandir($editrow["image_file"]);
            
               foreach ($images as $pic)
               {
                   if($pic !== "." && $pic !== "..")
                   echo '<tr><td class="img right"><img src="'.$editrow["image_file"].$pic.'"></td>
                   <td class="img left"> <form action method = "post">
                   <input type="hidden" name="img" value="'.$editrow["image_file"].$pic.'">
                   <input type="submit" name="deleteimg" class="removebtn" value="REMOVE"></form></td></tr>';
               }
            
            ?>


            <tr>
              <td class="right">
                <input type="submit" class="button" name="edit" value="Edit">
              </td>
              <td class="left">
                <input type="submit" class="removebtn" name="deleteprod" value="DELETE">
              </td>
            </tr>
            <tr>
              <td>
                <p style="color:green;"> <?php echo $message; ?> </p>
              </td>
            </tr>
          </table>
        </form>
    <?php } ?>
</div>