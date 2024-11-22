<?php
require_once 'connect.php';

try {
    $pdo = new PDO($attr, $username, $password, $opts);
   
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

// Fetch User IDs and Book IDs
// $query = "SELECT * FROM customer";
// $result = $pdo->query($query);

//oy vea insert jol
if(isset($_POST['submit'])){
  // declare vai = prevent injection(param1, field we want to pjol)
  $username = sanitize($pdo, $_POST['username']);
  // echo $username;
  $gender = sanitize($pdo, $_POST['gender']);
  // echo $gender
  $ice = $_POST['ice'];
  $icecream = implode(',', $ice);
  // echo $icecream;
  //Explode vs Implode 
  //explode : string -> array (in midterm : $words= explode("", $text)) then count($words)
  //implode : array -> string
  //implode : pel click ler data muy muy vea jenh jea array vea insert into table jea string 

  //sanitize : generally use ler data del trov input 

  //query data jol
  $query = "INSERT INTO customer (username, gender, flavor) VALUES ($username, $gender, '$icecream')";
  // $pdo->exec($query);
  // $result = $pdo->query($query);
  $stmt = $pdo->prepare($query);
  $stmt->execute([$username, $gender, $icecream]);
  // if($result){

  // }
  // else{
  //   echo "Something is incorrect";
  // }
}

// Check if form is submitted
/*
if (isset($_POST['username']) && isset($_POST['gender']) && isset($_POST['flavor']) ) {
    //$id = sanitize($pdo, $_POST['review_id']);
    $username = sanitize($pdo, $_POST['username']);
    $gender = sanitize($pdo, $_POST['gender']);
    $flavor = sanitize($pdo, $_POST['flavor']);

    $query = "INSERT INTO customer (username, gender, flavor) VALUES ($username, $gender, $flavor)";
    $pdo->exec($query);
    // echo "Success..";
}
*/

// $query = "SELECT * FROM customer";
// $result = $pdo->query($query);

function sanitize($pdo, $var)
{
    return $pdo->quote($var);
}
?>


<?php
$query = "SELECT * FROM customer";
$stmt = $pdo->prepare($query);
$stmt->execute();

$display = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
    <style>
        * {
            padding: 10;
            margin: 10;
            font-family: fantasy;
            width: auto;
            height: auto;
        }
        .container-fluid {
            padding: 10px;
            padding-top: 30px;
            padding-bottom: 30px;
            margin-top: 10px;
            margin-left: 50px;
            margin-right: 50px;
            border: 1px solid black;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }
        h4 {
            margin-left: 50px;
        }
        .container-fluid {
            border-radius: 25px;
            background: #a2a2b5;
            padding: 20px;
            width: 350px;
            height: 500px;
        }
    </style>
</head>
<body>
<div class="col-12" style="padding: 10px">
    <a href="insert.php" class="btn btn-secondary">Book</a>
    <a href="user.php" class="btn btn-secondary">User</a>
    <a href="review.php" class="btn btn-secondary">Review</a>
    <a href="genre.php" class="btn btn-secondary">Genre</a>
    <a href="rating.php" class="btn btn-secondary">Rating</a>
    <a href="icecream.php" class="btn btn-secondary">IceCream</a>
</div>

<!-- <h4>Ice Cream Options</h4> -->
<div class="container-fluid">
<div>
      <form class="row g-3" method="POST" action="icecream.php">
        <div class="col-md-6" style="padding: 10px">
          <label for="inputEmail4" class="form-label">Name</label>
          <input type="text" name="username" class="form-control" id="inputEmail4" placeholder="username">
        </div>

        <!-- radio for gender -->
        <fieldset class="row mb-3"  style="padding-left : 10px">
        <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
          <div class="col-sm-10">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="Female" checked>
              <label class="form-check-label" for="gridRadios1">
               Female
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="Male">
              <label class="form-check-label" for="gridRadios2">
              Male
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="gridRadios3" value="Others">
              <label class="form-check-label" for="gridRadios3">
               Others
              </label>
            </div>
    
          </div>
        </fieldset>
        

        <!-- checkbox of flavor -->
        <fieldset class="row mb-3" style="padding-left : 10px">
          <legend class="col-form-label col-sm-2 pt-0">Flavor</legend>
          <div class="col-sm-10 offset-sm-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="gridCheck1">

              <label for="form-check-label">Vanilla</label>
              <input type="checkbox" name="ice[]" value="Vanilla"> 
              <!-- [] means array meaning jomlery mean 2 3 + men mean tae muy te   -->
              <label for="form-check-label">Chocolate</label>
              <input type="checkbox" name="ice[]" value="Chocolate"> 

              <label for="form-check-label">Strawberry </label>
              <input type="checkbox" name="ice[]" value="Strawberry">

              <label for="form-check-label">MintChocolate </label>
              <input type="checkbox" name="ice[]" value="MintChocolate">

              <label for="form-check-label">Coconut </label>
              <input type="checkbox" name="ice[]" value="Coconut">

              <label for="form-check-label">Coffee</label>
              <input type="checkbox" name="ice[]" value="Coffee">

            </div>
          </div>
        </fieldset>
      <!-- </div> -->
        
        <!-- submit -->
        <div class="col-12" style="padding: 10px">
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
</div>
<div>
  
</body>

<?php
require_once 'select5.php';
?>




