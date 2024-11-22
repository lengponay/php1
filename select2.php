<?php 
  require_once 'connect.php';

  try
  {
    $pdo = new PDO($attr, $username, $password, $opts);
    /* NOTE : $attr MUST GO FIRST  because it has to connect to db and server */
    
    $query = "SELECT * FROM users";
    $result = $pdo->query($query);

    //echo "<table><tr><th>Author</th><th>Title</th><th>type</th><th>year</th><th>ISBN</th></tr>";

    echo <<<_END
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <title>Document</title>
    </head>
    <style>
        .table-rate{
          padding-left : 10px;
          padding-top : 10px;
          padding-bottom : 100px;
          margin-top : 20px;
          margin-left : 10px;
          margin-right: 50px;
          border : 1px solid black;
          display : flex;
          flex-direction: column;
          justify-content : start;
          border-radius: 25px;
          background:#a2a2b5;
          width: 600px;
          height: 400px;
        }
      </style>

    <body>
      <div class="table-rate"> 
        <p> Lists of the Rreview table : </p>
        <table class="table table-striped table-dark">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Review ID</th>
              <th scope="col">User ID</th>
              <th scope="col">Book ID</th>
              <th scope="col">Review Text</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>
_END;

    while ( $row = $result->fetch()){
    
      $r0 = $row['user_id'];
      $r1 = $row['book_id'];
      $r2 = $row['genre'];
      $r3 = $row['description'];
    
     
      // echo "</tbody>";
      echo <<<_END

          <tbody>
            <tr>
              <td>$r0</td>
              <td>$r1</td>
              <td>$r2</td>
              <td>$r3</td>
              
              <td>
                <a class="btn btn-info" href='update.php?edit=$r0'>edit</a> 
                <a class="btn btn-danger" href='delete.php?delete=$r0'>delete</a> 
              </td>
            </tr>
            </tr>
          </tbody>
      
_END;

    }
    echo <<<_END
     </table>
    </div>
      </body>
    </html>
_END;

  }
  catch (PDOException $e) 
  {
    throw new PDOException($e->getMessage(), (int)$e->getCode()); 
  }

  // }
?>

