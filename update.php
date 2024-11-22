<?php
  require_once 'connect.php';
  // require_once 'insert.php';

  try
  {
    $pdo = new PDO($attr, $username,$password, $opts);
    // echo "Success..";
  }
  catch (PDOException $e) 
  {
    throw new PDOException($e->getMessage(), (int)$e->getCode()); 
  }

  /* display entire info in classics (query it)*/
  if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $query = "SELECT * FROM classics WHERE id=$id";
    $result = $pdo->query($query);
    $row = $result->fetch(PDO::FETCH_BOTH);
    //echo $row['author];
  }

  if(isset($_POST['update'])){

    $id = $_POST['id'];
    $author = $_POST['author'];
    $title = $_POST['title'];
    $type = $_POST['type'];
    $year = $_POST['year'];
    $isbn = $_POST['isbn'];

    $query = "UPDATE classics SET author='$author', title='$title', type='$type', year='$year', isbn='$isbn' WHERE id='$id' ";
    $result = $pdo->query($query);
    header("location:insert.php");
  }

  if(isset($_POST['cancel'])){
    header("location:insert.php");
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
  <title>Edit</title>
  <style>

     *{
        padding: 10;
        margin: 10;
        font-family: "Times New Roman', Times, serif";
        width : auto;
        height : auto;
      }

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
      }
    
  </style>
</head>
<body>
  
  <h4>Create a Book</h4>
  <div class="container-fluid" style="margin : 10px; width : 50%;" >
    <div>
      <form class="row g-3" method="POST" action="insert.php">
        <h1 style= "text-align: center;"> Update book </h1>
        <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
        <div class="col-md-6" style="padding: 10px">
          <label for="inputEmail4" class="form-label">Author</label>
          <input type="text" name="author" class="form-control" id="inputEmail4" value="<?php echo $row['author'] ?>" placeholder="author" />
        </div>
        <div class="col-md-6" style="padding: 10px">
          <label for="inputPassword4" class="form-label">Title</label>
          <input type="text" name="title" class="form-control" id="inputPassword4" value="<?php echo $row['title'] ?>" placeholder="title" />
        </div>
        <div class="col-12" style="padding: 10px">
          <label for="inputAddress" class="form-label">Type</label>
          <input type="text" name="type" class="form-control" id="inputAddress" value="<?php echo $row['type'] ?>" placeholder="type"  />
        </div>
        <div class="col-12" style="padding: 10px">
          <label for="inputAddress2" class="form-label">Year</label>
          <input type="text" name="year" class="form-control" id="inputAddress2" value="<?php echo $row['year'] ?>" placeholder="year"  />
        </div>
        <div class="col-md-6" style="padding: 10px">
          <label for="inputCity" class="form-label">ISBN</label>
          <input type="text" name="isbn" class="form-control" id="inputCity" value="<?php echo $row['isbn'] ?>" placeholder="isbn"  />
        </div>
        
        <div class="col-12" style="padding-top: 10px">
          <button type="button" class="btn btn-primary">update</button>
          <button type="button" class="btn btn-danger">cancel</button>
        </div>
       
      </form>
    </div>
  </div>
</body>
</html>


