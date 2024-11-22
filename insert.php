<?php
  require_once 'connect.php';
  // require_once 'update.php';
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


  /* _GET : NOT SECURE, $_POST: SECURE */
  if(isset($_POST['book_id']) && isset($_POST['title']) && isset($_POST['author']) && isset($_POST['publication']) && isset($_POST['isbn']) ){ 

    $id = sanitize($pdo, $_POST['book_id']);
    $title = sanitize($pdo, $_POST['title']);
    $author = sanitize($pdo, $_POST['author']);
    $date = sanitize($pdo, $_POST['publication']);
    $isbn= sanitize($pdo, $_POST['isbn']);
    
    $query = "INSERT INTO books (book_id, title, author, publication, isbn) VALUES($id, $title, $author, $date, $isbn)";
    // var_dump($query);
    $pdo->exec($query); //exec : execute
    // echo "Success..";
  }

  $query = "SELECT * FROM books";
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
        font-family:fantasy;
        width : auto;
        height : auto;
      }
      
      /* body{
        background-color : #fefeff;
      } */

      .container-fluid{
        padding : 10px;
        padding-top : 30px;
        padding-bottom : 30px;
        margin-top : 10px;
        margin-left : 50px;
        margin-right: 50px;
        border : 1px solid black;
        display : flex;
        flex-direction: row;
        justify-content : center;
      }
      h4{
        margin-left : 50px;
        font-family: fantasy;
      }
      .container-fluid{
        border-radius: 25px;
        background:#a2a2b5;
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

  <h4>Input Book Informations</h4>
  <div class="container-fluid">
    <div>
      <form class="row g-3" method="POST" action="insert.php">
        <div class="col-md-6" style="padding: 10px">
          <label for="inputEmail4" class="form-label">Book ID</label>
          <input type="number" min='001' max='200' name="book_id" class="form-control" id="inputEmail4" placeholder="id">
        </div>
        <div class="col-md-6" style="padding: 10px">
          <label for="inputPassword4" class="form-label">Title</label>
          <input type="text" name="title" class="form-control" id="inputPassword4" placeholder="title">
        </div>
        <div class="col-12" style="padding: 10px">
          <label for="inputAddress" class="form-label">Author</label>
          <input type="text" name="author" class="form-control" id="inputAddress" placeholder="author">
        </div>
        <div class="col-12" style="padding: 10px">
          <label for="inputAddress2" class="form-label">Publication</label>
          <input type="text" name="publication" class="form-control" id="inputAddress2" placeholder="date">
        </div>
        <div class="col-md-6" style="padding: 10px">
          <label for="inputCity" class="form-label">ISBN</label>
          <input type="text" name="isbn" class="form-control" id="inputCity" placeholder="isbn">
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
require_once 'select.php';
?>
