<?php
  require_once 'connect.php';
 
  try
  {
    $pdo = new PDO($attr, $username, $password, $opts);

  }
  catch (PDOException $e) 
  {
    throw new PDOException($e->getMessage(), (int)$e->getCode()); 
  }

  //check if in our input field we have entered or input anything or not? 
  //if it does, it will show what we have put
  $bookQuery = "SELECT book_id FROM books";
  $bookResult = $pdo->query($bookQuery);

  /* _GET : NOT SECURE, $_POST: SECURE */
  if(isset($_POST['book_id']) && isset($_POST['rating']) ){ 

    $id = sanitize($pdo, $_POST['book_id']);
    $value = sanitize($pdo, $_POST['rating']);
   
    $query = "INSERT INTO rating(book_id, rating) VALUES($id, $value)";
    // var_dump($query);
    $pdo->exec($query); //exec : execute
    // echo "Success..";
  }

  $query = "SELECT * FROM rating";
  $result = $pdo->query($query);
  

  function sanitize($pdo, $var)
  {
    return $pdo->quote($var);
  }
  

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
      *{
        padding: 10;
        margin: 10;
        font-family: fantasy;
        width: auto;
        height: auto;
      }

      .container-fluid{
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
        border-radius: 25px;
        background: #a2a2b5;
        width: 350px;
        height: 500px;
      }
      
      h4{
        margin-left: 50px;
      }

      .form-label {
        font-weight: bold;
        color: #fff;
      }

      #inputAddress {
        border: 2px solid #4a4a8c;
        border-radius: 15px;
        padding: 10px;
        background-color: #f5f5f5;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        width : 100px;
      }

      #inputAddress:focus {
        border-color: #4a4a8c;
        box-shadow: 0px 0px 10px rgba(74, 74, 140, 0.5);
        outline: none;
        background-color: #e8e8ff;
      }
    
  </style>
</head>
<body>
  <div class="col-12" style="padding: 10px">
    <a href="insert.php" class="btn btn-secondary">Book</a>
    <a href="user.php" class="btn btn-secondary">User</a>
    <a href="review.php" class="btn btn-secondary">Details</a>
 
    <a href="rating.php" class="btn btn-secondary">Rating</a>
    <a href="icecream.php" class="btn btn-secondary">IceCream</a>

  </div>

  <!-- <h4>Input Rating information</h4> -->
  <div class="container-fluid">
    <div>
      <form class="row g-3" method="POST" action="rating.php">
   
      <div class="col-md-6" style="padding: 10px">
                <label for="inputEmail4" class="form-label">Book ID</label>
                <select name="book_id" class="form-control" id="inputEmail4">
                    <?php while ($row = $bookResult->fetch()): ?>
                        <option value="<?= $row['book_id'] ?>"><?= $row['book_id'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        <div class="col-12" style="padding: 10px">
          <label for="inputAddress" class="form-label">Rate Value</label>
          <input type="number" min='1' max='10' name="rating" class="form-control" id="inputAddress" placeholder="Enter a value between 1 and 10">
        </div>
   
        
        <div class="col-12" style="padding: 10px">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
    
</body>
</html>

<?php
require_once 'select4.php';
?>
