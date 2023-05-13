<?php
if (!($mysqli = mysqli_connect("localhost", "root"))) {
  die("Could not connect");
}
if (!(mysqli_select_db($mysqli, "webproject")))
  die("Could not open");

include("session.php");
$passmessage = "";
$message = "";
$addressmessage = "";
$table = "";
$default = "id='defaultOpen'";

if (isset($_POST["submit"])) {
  $query3 = "SELECT Email FROM users WHERE Email='" .
    $_POST["email"] . "'";
  $result1 = mysqli_query($mysqli, $query3);
  if($result1){
    if (mysqli_num_rows($result1) == 0) {
  
      $query2 = "UPDATE users SET Email='" . $_POST["email"]
        . "',Fname='" . $_POST["fname"] . "',Lname='" . $_POST["lname"] . "',Birthday='" . $_POST["birth"] . "' WHERE Email='" . $_SESSION["Email"] . "'";
      if (mysqli_query($mysqli, $query2))
        $message = "<p style='color:green;'>Update Succesfull</p>";
      $_SESSION["Email"] = $_POST["email"];
      setcookie("Email", $_POST["email"], time() + (86400 * 30));
    } else {
      $query4 = "UPDATE users SET Fname='" .
        $_POST["fname"] . "',Lname='" . $_POST["lname"] . "',Birthday='" . $_POST["birth"] . "' WHERE Email='" . $_POST["email"] . "'";
      if (mysqli_query($mysqli, $query4))
        $message = "<p style='color:green;'>Update Succesful - Email already exists</p>";
    }
  }
  else
  {
    $message = "<p style='color:red;'>An error has occurred</p>";
  }
}

if (isset($_POST["submit1"])) {
  $querypass = "SELECT Password FROM users WHERE Email = '" .
    $_SESSION['Email'] . "'";

  $resultpass = mysqli_query($mysqli, $querypass);
  $rowpass = mysqli_fetch_assoc($resultpass);

  if (password_verify($_POST["old_pass"], $rowpass["Password"])) {
    $hashed_Pass = password_hash($_POST["new_pass"], PASSWORD_DEFAULT);
    $queryupdatepass = "UPDATE users SET Password = '" .
      $hashed_Pass . "'";

    mysqli_query($mysqli, $queryupdatepass);
    unset($_SESSION["Password"]);
    $_SESSION["Password"] = $hashed_Pass;
    $passmessage = "<span style='color:green;'>Update Succesfull</span>";
  } else {
    $passmessage = "Incorrect Password";
  }
}

if (isset($_POST["submitaddress"])) {
  $queryaddress = "SELECT * FROM address WHERE cutomer_id='" .
    $_SESSION["Email"] . "'";
  if(mysqli_query($mysqli, $queryaddress)){
    
    if (mysqli_num_rows(mysqli_query($mysqli, $queryaddress)) == 0) {
  
      $queryaddressadd = "INSERT INTO address(cutomer_id, Address, City, Country, Zip) VALUES ('" .
        $_SESSION["Email"] . "','" . $_POST["address"] . "','" . $_POST["city"] . "','" . $_POST["country"] . "'," . $_POST["zip"] . ")";
      mysqli_query($mysqli, $queryaddressadd);
      $addressmessage = "New Address Added Successfully";
    } else {
      $queryaddressupdate = "UPDATE address SET Address='" .
        $_POST["address"] . "',City='" . $_POST["city"] . "',Country='" . $_POST["country"] . "',Zip = " . $_POST["zip"] . " WHERE cutomer_id='" . $_SESSION["Email"] . "'";
      mysqli_query($mysqli, $queryaddressupdate);
      $addressmessage = "Address Updated Successfully";
    }
  }
  else
    {$addressmessage="<span style='color:red;'>Failed to Update<span>";}
}


$query = "SELECT * FROM users WHERE Email = '" . $_SESSION["Email"]
  . "'";

$result = mysqli_query($mysqli, $query);
$row = mysqli_fetch_assoc($result);


$queryaddressinfo = "SELECT * FROM address WHERE cutomer_id = '" .
  $_SESSION["Email"] . "'";
$resultaddressinfo = mysqli_query($mysqli, $queryaddressinfo);
$rowaddress = (mysqli_num_rows($resultaddressinfo) == 0 ? array("Address" => "", "City" => "", "Country" => "", "Zip" => NULL) : mysqli_fetch_assoc($resultaddressinfo));

$querysales = "SELECT * FROM sales WHERE Customer_email = '" .
  $_SESSION["Email"] . "' ORDER BY date DESC";

$resultsales = mysqli_query($mysqli, $querysales);
if (mysqli_num_rows($resultsales) == 0) {
  $table = "<tr><td colspan=6 class='history'> You have not purchased anything yet </td></tr>";
} else {
  foreach ($resultsales as $sales) {
    $queryproduct = "SELECT * FROM Products WHERE Product_ID = " . $sales["Product_ID"] . "";
    $resultprod = mysqli_query($mysqli, $queryproduct);
    $rowproduct = mysqli_fetch_assoc($resultprod);
    if ($sales["Arrived"] == 0) {
      $arrived = "NO";
    } else {
      $arrived = "YES";
    }
    $date = $sales["Date"];
    $dt = new DateTime($date);

    $formatdt = $dt->format('jS M, Y');

    $table .= "<tr class='history'>
                <td class='history'>" . $rowproduct["Name"] . "</td>
                <td class='history'>$" . $rowproduct["Price"] * $sales["Quantity"] . "</td>
                <td class='history'>" . $sales["Quantity"] . "</td>
                <td class='history'>" . $rowproduct["Category"] . "</td>
                <td class='history'>" . $formatdt . "</td>
                <td class='history'>" . $arrived . "</td>
              </tr>";
  }
}
if (isset($_SESSION["Password"])) {

?>

  <!DOCTYPE html>
  <html>

  <head>
    <link rel="stylesheet" type="text/css" href="css/account.css">

  </head>

  <body>
    <?php include("top.php") ?>
    <div class="header2"></div> 
    <div class="container">
      <div class="tab">
        <?php if(isset($_POST["submitaddress"])) { ?>
        <button class="tablinks" onclick="openCity(event, 'Account')" >My Account</button> <br>
        <button class="tablinks" onclick="openCity(event, 'Billing')" id='defaultOpen'>Billing Info</button> <br>
        <button class="tablinks" onclick="openCity(event, 'Purchase')">Purchase History</button> <br>
        <?php if($row["Type"] == 0) {echo '<button class="tablinks" onclick="openCity(event, '."'add'".')">Add Product</button>';
        echo '<button class="tablinks" onclick="openCity(event, '."'edit'".')">Edit Product</button>';} ?>
        <?php } elseif(isset($_POST["upload"])) { ?>
          <button class="tablinks" onclick="openCity(event, 'Account')" >My Account</button> <br>
        <button class="tablinks" onclick="openCity(event, 'Billing')">Billing Info</button> <br>
        <button class="tablinks" onclick="openCity(event, 'Purchase')">Purchase History</button> <br>
        <?php if($row["Type"] == 0) {echo '<button class="tablinks" onclick="openCity(event, '."'add'".')" id="defaultOpen">Add Product</button>';
        echo '<button class="tablinks" onclick="openCity(event, '."'edit'".')">Edit Product</button>';} ?>
        <?php } elseif(isset($_POST["search"]) || isset($_POST["ASC"]) || isset($_POST["DESC"]) || isset($_GET["prod_id"])){ ?>
          <button class="tablinks" onclick="openCity(event, 'Account')" >My Account</button> <br>
        <button class="tablinks" onclick="openCity(event, 'Billing')">Billing Info</button> <br>
        <button class="tablinks" onclick="openCity(event, 'Purchase')">Purchase History</button> <br>
        <?php if($row["Type"] == 0) {echo '<button class="tablinks" onclick="openCity(event, '."'add'".') ">Add Product</button>';
        echo '<button class="tablinks" onclick="openCity(event, '."'edit'".')" id="defaultOpen">Edit Product</button>';} ?>
        <?php } else { ?>
          <button class="tablinks" onclick="openCity(event, 'Account')" id='defaultOpen'>My Account</button> <br>
        <button class="tablinks" onclick="openCity(event, 'Billing')" >Billing Info</button> <br>
        <button class="tablinks" onclick="openCity(event, 'Purchase')">Purchase History</button> <br>
        <?php if($row["Type"] == 0) {echo '<button class="tablinks" onclick="openCity(event, '."'add'".')">Add Product</button>';
        echo '<button class="tablinks" onclick="openCity(event, '."'edit'".')">Edit Product</button>';} ?>
        <?php } ?>
        <form action="session.php" method="GET">
          <input type="submit" name="logout" class="logout" value="Logout">
        </form>
      </div>

      <div id="Account" class="tabcontent">
        <h2>Account details</h2>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
          <table class="forms">
            <tr>
              <td>
                <label class="custom">
                  <input type="text" name="fname" value="<?php echo $row["Fname"];  ?>" required><span class="placeholder">First Name:</span>
                </label>
              </td>
            </tr>
            <tr>
              <td>
                <label class="custom">
                  <input type="text" name="lname" value="<?php echo $row["Lname"];  ?>" required><span class="placeholder">Last Name:</span>
                </label>
              </td>
            </tr>
            <tr>
              <td>

                <label class="custom">
                  <input type="text" name="email" value="<?php echo $row["Email"];  ?>" required><span class="placeholder">Email Address:</span>
                </label>
              </td>
            </tr>
            <tr>
              <td>
                <label class="custom">
                  <input type="date" name="birth" value="<?php echo $row["Birthday"];  ?>"><span class="placeholder">Birthday:</span>
                </label>
              </td>
            </tr>
            <tr>
              <td>
                <input type="submit" class="button" name="submit" value="Update">
              </td>
            </tr>
            <tr>
              <td>
                <p class="message" style="color:green; right: 0px;"> <?php echo $message; ?> </p>
              </td>
            </tr>
          </table>
        </form>


        <h2>Change Password</h2>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="updatepass">
          <table>
            <tr>
              <td>
                <label class="custom">
                  <input type="password" name="old_pass" required="true"><span class="placeholder">Current Password:</span>
                </label>
              </td>
            </tr>
            <tr>
              <td>
                <label class="custom">
                  <input type="password" name="new_pass" id="newpass" required="true"><span class="placeholder">New Password:</span>
                </label>
              </td>
            </tr>
            <tr>
              <td>
                <label class="custom">
                  <input type="password" name="con_pass" id="conpass" required="true"><span class="placeholder">Confirm Password:</span>
                </label> <br>

              </td>
            </tr>
            <tr>
              <td>
                <button type="button" class="button" onclick="passupdate()" value="">Update</button>
              </td>
            </tr>
            <tr>
              <td>
                <p class="message" style="color:red;   right: 0px;"><?php echo $passmessage ?></p>

              </td>
            </tr>
            <input type="hidden" name="submit1">
          </table>
        </form>

      </div>
      <div id="Billing" class="tabcontent">
        <h2>Payment Info</h2>
        <form action="">
          <table>
            <tr>
              <td>
                <label class="custom">
                  <input type="text" name="c_card" required><span span class="placeholder">Credit Card Info:</span>
                </label>

              </td>
            </tr>
            <tr>
              <td>
                <label class="custom">
                  <input type="text" name="expirecard" required>
                  <spanspan class="placeholder">Expiration date (mm/yy):</span>
                </label>
              </td>
            </tr>
            <tr>
              <td>
                <input type="submit" class="button">
              </td>
            </tr>
          </table>
        </form>
        <h2>Shippment Info</h2>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
          <table>
            <tr>
              <td>
                <label class="custom">
                  <input type="text" name="address" value="<?php echo $rowaddress["Address"]; ?>" required><span class="placeholder">Address:</span></label>

              </td>
            </tr>
            <tr>
              <td>
                <label class="custom">
                  <input type="text" name="city" value="<?php echo $rowaddress["City"]; ?>" required><span class="placeholder">City:</span></label>

              </td>
            </tr>
            <tr>
              <td>
                <label class="custom">
                  <select id="country" name="country" required>
                    <option value="<?php echo $rowaddress["Country"]; ?>"><?php echo $rowaddress["Country"]; ?></option>
                    <option hidden disabled value></option>
                    <option value="Afganistan">Afghanistan</option>
                    <option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Aruba">Aruba</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaijan">Azerbaijan</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Belize">Belize</option>
                    <option value="Benin">Benin</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bonaire">Bonaire</option>
                    <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Brazil">Brazil</option>
                    <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                    <option value="Brunei">Brunei</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Canada">Canada</option>
                    <option value="Canary Islands">Canary Islands</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Cayman Islands">Cayman Islands</option>
                    <option value="Central African Republic">Central African Republic</option>
                    <option value="Chad">Chad</option>
                    <option value="Channel Islands">Channel Islands</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Christmas Island">Christmas Island</option>
                    <option value="Cocos Island">Cocos Island</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Congo">Congo</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cote DIvoire">Cote DIvoire</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Curaco">Curacao</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czech Republic</option>
                    <option value="Denmark">Denmark</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="East Timor">East Timor</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egypt">Egypt</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="Falkland Islands">Falkland Islands</option>
                    <option value="Faroe Islands">Faroe Islands</option>
                    <option value="Fiji">Fiji</option>
                    <option value="Finland">Finland</option>
                    <option value="France">France</option>
                    <option value="French Guiana">French Guiana</option>
                    <option value="French Polynesia">French Polynesia</option>
                    <option value="French Southern Ter">French Southern Ter</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Germany">Germany</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Great Britain">Great Britain</option>
                    <option value="Greece">Greece</option>
                    <option value="Greenland">Greenland</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guam">Guam</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Hawaii">Hawaii</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="India">India</option>
                    <option value="Iran">Iran</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Isle of Man">Isle of Man</option>
                    <option value="Israel">Israel</option>
                    <option value="Italy">Italy</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japan">Japan</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Korea North">Korea North</option>
                    <option value="Korea Sout">Korea South</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Laos">Laos</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libya">Libya</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macau">Macau</option>
                    <option value="Macedonia">Macedonia</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Maldives">Maldives</option>
                    <option value="Mali">Mali</option>
                    <option value="Malta">Malta</option>
                    <option value="Marshall Islands">Marshall Islands</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Midway Islands">Midway Islands</option>
                    <option value="Moldova">Moldova</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="Nambia">Nambia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Netherland Antilles">Netherland Antilles</option>
                    <option value="Netherlands">Netherlands (Holland, Europe)</option>
                    <option value="Nevis">Nevis</option>
                    <option value="New Caledonia">New Caledonia</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Niue">Niue</option>
                    <option value="Norfolk Island">Norfolk Island</option>
                    <option value="Norway">Norway</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Palau Island">Palau Island</option>
                    <option value="Palestine">Palestine</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Phillipines">Philippines</option>
                    <option value="Pitcairn Island">Pitcairn Island</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Republic of Montenegro">Republic of Montenegro</option>
                    <option value="Republic of Serbia">Republic of Serbia</option>
                    <option value="Reunion">Reunion</option>
                    <option value="Romania">Romania</option>
                    <option value="Russia">Russia</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="St Barthelemy">St Barthelemy</option>
                    <option value="St Eustatius">St Eustatius</option>
                    <option value="St Helena">St Helena</option>
                    <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                    <option value="St Lucia">St Lucia</option>
                    <option value="St Maarten">St Maarten</option>
                    <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                    <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                    <option value="Saipan">Saipan</option>
                    <option value="Samoa">Samoa</option>
                    <option value="Samoa American">Samoa American</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Slovakia">Slovakia</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="Spain">Spain</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Swaziland">Swaziland</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Syria">Syria</option>
                    <option value="Tahiti">Tahiti</option>
                    <option value="Taiwan">Taiwan</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Tanzania">Tanzania</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Togo">Togo</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Uganda">Uganda</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Erimates">United Arab Emirates</option>
                    <option value="United States of America">United States of America</option>
                    <option value="Uraguay">Uruguay</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Vatican City State">Vatican City State</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Vietnam">Vietnam</option>
                    <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                    <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                    <option value="Wake Island">Wake Island</option>
                    <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Zaire">Zaire</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option>
                  </select><span class="placeholder">Country:</span></label>

              </td>
            </tr>
            <tr>
              <td>
                <label class="custom">
                  <input type="number" name="zip" value="<?php echo $rowaddress["Zip"]; ?>" required><span class="placeholder">Zip code:</span></label>

              </td>
            </tr>
            <tr>
              <td>
                <input type="submit" class ="button" name="submitaddress">
              </td>
            </tr>
            <tr>
              <td>
                <p class="message" style="color:green; right: 0px;"><?php echo $addressmessage; ?></p>
              </td>
            </tr>
          </table>
        </form>
      </div>

      <div id="Purchase" class="tabcontent">
        <h2>Purchase History</h2>
        <table class="history">
          <tr class="history">
            <th class="history">Product Name</th>
            <th class="history">Price</th>
            <th class="history">Quntity</th>
            <th class="history">Category</th>
            <th class="history">Date</th>
            <th class="history">Status</th>
          </tr>
          <?php echo $table; ?>
        </table>
      </div>
      <?php if($row["Type"] == 0) include("profileAdmin.php")?>
    </div>
    
    <?php include("end.php")?>

    <script>
      function passupdate() {
        var pass = document.getElementById("newpass");
        var conpass = document.getElementById("conpass");

        if (pass.value != conpass.value) {
          document.getElementById("message").innerHTML = "*Passwords do not match";
          conpass.value = "";
          pass.value = "";
        } else {
          document.getElementById("updatepass").submit();
        }
      }
    </script>
  </body>
  <script src="javascript/account.js"></script>

  </html>

<?php } ?>