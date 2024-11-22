<?php
require_once 'connect.php';

try {
    $pdo = new PDO($attr, $username, $password, $opts);
    // echo "success";
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

// Fetch User IDs and Book IDs
$userQuery = "SELECT user_id FROM users";
$userResult = $pdo->query($userQuery);

$bookQuery = "SELECT book_id FROM books";
$bookResult = $pdo->query($bookQuery);

// Check if form is submitted
if (isset($_POST['user_id']) && isset($_POST['book_id']) && isset($_POST['genre']) && isset($_POST['description'])) {
    $id = sanitize($pdo, $_POST['user_id']);
    $u_id = sanitize($pdo, $_POST['book_id']);
    $b_id = sanitize($pdo, $_POST['genre']);
    $text = sanitize($pdo, $_POST['description']);

    $query = "INSERT INTO detail(user_id, book_id, genre, description) VALUES ($id, $u_id, $b_id, $text)";
    $pdo->exec($query);
    // echo "Success..";
}

$query = "SELECT * FROM reviews";
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
    <a href="review.php" class="btn btn-secondary">Detail</a>
    <a href="rating.php" class="btn btn-secondary">Rating</a>
    <a href="icecream.php" class="btn btn-secondary">IceCream</a>

</div>

<h4>Details</h4>
<div class="container-fluid">
    <div>
        <form class="row g-3" method="POST" action="review.php">
            
            <div class="col-md-6" style="padding: 10px">
                <label for="inputEmail4" class="form-label">User ID</label>
                <select name="user_id" class="form-control" id="inputEmail4">
                    <?php while ($row = $userResult->fetch()): ?>
                        <option value="<?= $row['user_id'] ?>"><?= $row['user_id'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-6" style="padding: 10px">
                <label for="inputEmail4" class="form-label">Book ID</label>
                <select name="book_id" class="form-control" id="inputEmail4">
                    <?php while ($row = $bookResult->fetch()): ?>
                        <option value="<?= $row['book_id'] ?>"><?= $row['book_id'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-6" style="padding: 10px">
                <label for="inputPassword4" class="form-label">Genre</label>
                <input type="text" name="genre" class="form-control" id="inputPassword4" placeholder="genre">
            </div>
            <div class="col-12" style="padding: 10px">
                <label for="inputAddress" class="form-label">Description</label>
                <input type="text" name="description" class="form-control" id="inputAddress" placeholder="description">
            </div>
            <div class="col-12" style="padding: 10px">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<h4>Reviews</h4>
<div class="container-fluid">
    <table class="table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Book ID</th>
                <th>Genre</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch()): ?>
                <tr>
                    <td><?= $row['user_id'] ?></td>
                    <td><?= $row['book_id'] ?></td>
                    <td><?= $row['genre'] ?></td>
                    <td><?= $row['description'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>

