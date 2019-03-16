  <?php
  $hostname="localhost";
  $username="root";
  $password="";
  $dbname="cr10_florian_rechberger_biglibrary";

  $conn=mysqli_connect($hostname,$username,$password,$dbname);
  if(!$conn){
    echo "connection error";
  }

$isbnError="";
$titleError="";
$authorError="";
$imageError="";
$descriptionError="";
$dateError="";
$publisherError="";
$typeError="";

$error = false;

if(isset($_POST['add']) ) {

  $isbn= $_POST["isbn"];
  $title= $_POST["title"];
  $author_first_name= $_POST["author_first_name"];
  $author_last_name= $_POST["author_last_name"];
  $image= $_POST["image"];
  $description= $_POST["description"];
  $date= $_POST["date"];
  $publisher_name= $_POST["publisher_name"]; 
  $publisher_address= $_POST["publisher_address"];
  $publisher_size= $_POST["publisher_size"];
  $type= $_POST["type"];
 
######################################## I cannot get the error messages work --- what am I missing? ##############################
  if(empty($isbn)){
  $error = true;
  $isbnError = "I Sould Bother Not?!";
  }
  if(empty($title)){
  $error = true;
  $titleError = "Don't be a turtle, just write the title.";
  }
  if(empty($author_first_name)){
  $error = true;
  $authorError = "First of all, pay the author credit.";
  }
  if(empty($author_last_name)){
  $error = true;
  $authorError = "It may come last, but it's required.";
  }
  if(empty($image)){
  $error = true;
  $imgeError = "How should someone judge the book by its cover?";
  }
  if(empty($description)){
  $error = true;
  $descriptionError = "So, so; an 'empty book'...";
  }
  if(empty($date)){
  $error = true;
  $dateError = "It can be fantastic, yet not timeless.";
  }
  if(empty($publisher_name)){
  $error = true;
  $publisherError = "All information for publisher is required.";
  }
  if(empty($publisher_address)){
  $error = true;
  $publisherError = "All information for publisher is required.";
  }
  if(empty($publisher_size)){
  $error = true;
  $publisherError = "All information for publisher is required.";
  }
  if(empty($type)){
  $error = true;
  $typeError = "Please enter an ISBN.";
  }

  ################################### as soon as, in this case, the publisher would be douplicated the entry still is correctly saved to the db, however, only to the authors and not to media #################################### with a normal 'insert into <table name> () values ()' data is stored correctly, if ther is no duplicate of either book, publisher or author, which is unavoidable.##################################
  if (!$error) {
    $query = "
      INSERT INTO publishers (name, address, size)
      SELECT '$publisher_name', '$publisher_address', '$publisher_size'
        FROM DUAL
        WHERE NOT EXISTS (
          SELECT 1
          FROM publishers
          WHERE name = '$publisher_name' AND address = '$publisher_address'
        LIMIT 1
        );";
    $query .= "
      INSERT INTO authors (first_name, last_name)
        VALUES ('$author_first_name', '$author_last_name');";
    $query .= "
      INSERT INTO media (isbn, title, fk_author_id, image, publish_date, short_description, fk_publisher_id, type)
        VALUES ('$isbn', '$title', (SELECT author_id FROM authors WHERE last_name = '$author_last_name'), '$image', '$date', '$description', (SELECT publisher_id FROM publishers WHERE name = '$publisher_name'), '$type');";   
  
    if (mysqli_multi_query($conn, $query)) {  ////////////very handy those multi_queries
      echo "Entry successfully created!";
    } else {
      echo "Error creating table: " . mysqli_error($conn);
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset=UTF-8">
  <title>Big Library</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <nav class="container navbar sticky-top navbar-light bg-light mb-4 d-flex justify-content-center">
    <a class="navbar-brand" href="big_library.php"><h1>Library</h1></a>
  </nav>
  <div class="container d-flex flex-column">
    <section class="container">
      <h3> Add new media</h3>
      <form action="big_library.php" method="post">
        <p>ISBN: <input type="number" name="isbn" required="required" placeholder="ISBN" maxlength="40" />
        <span class="text-danger"><?php echo $isbnError; ?></span></p>
        
        <p>Title: <input type="text" name="title" required="required" placeholder="Title of Book, CD, or DVD" maxlength="80" />
        <span class="text-danger"><?php echo $titleError; ?></span></p>
        
        <p>Image: <input type="text" name="image" required="required" placeholder="Link to image" maxlength="2000" />
        <span class="text-danger"><?php echo $imageError; ?></span></p>
        
        <p>Author / Director / Artist: <input type="text" name="author_first_name" required="required" placeholder="First Name" maxlength="40" />
        <span class="text-danger"><?php echo $authorError; ?></span> <input type="text" name="author_last_name" required="required" placeholder="Last Name" maxlength="40" /><span class="text-danger"><?php echo $authorError; ?></span></p>
        
        <p>Short Description: <input type="text" size="55" name="description" required="required" placeholder="Short description" maxlength="2000" />
        <span class="text-danger"><?php echo $descriptionError; ?></span></p>
        
        <p>Publish Date: <input type="number" name="date" required="required" placeholder="YYYY" maxlength="4" />
        <span class="text-danger"><?php echo $dateError; ?></span></p>

        <p>Publisher: <input type="text" name="publisher_name" required="required" placeholder="Publisher name" maxlength="40" />
        <span class="text-danger"><?php echo $publisherError; ?></span>
          <input type="text" name="publisher_address" required="required" placeholder="Address" maxlength="60" />
          <span class="text-danger"><?php echo $publisherError; ?></span>
          <input type="text" name="publisher_size" required="required" placeholder="Size" maxlength="40" />
          <span class="text-danger"><?php echo $publisherError; ?></span></p>

        <p>Type: <input type="text" name="type" required="required" placeholder="Book/CD/DVD" maxlength="4" />
        <span class="text-danger"><?php echo $typeError; ?></span></p>
        
        <p>
        <button type="submit" name="add">Add media</button>
        </p>

      </form>

      <hr>
    
    </section>
    <section class="container d-flex flex-column">
      <div class="row">
        <div class="col"><h3>Title</h3></div><div class="col"><h3>Author</h3></div><div class="col"></div>
      </div>
      <!----I CANNOT FIND THE MISTAKE----------------THE PART BELOW WORKS------------------
      <?php /* 
      $sql =
      not working
      "SELECT media.title, authors.first_name, authors.last_name, media.isbn, media.image, media.short_description, media.publish_date, media.type, publisher.name
        FROM media
          INNER JOIN authors ON media.fk_author_id=authors.author_id,
          INNER JOIN publishers ON media.fk_publisher_id=publishers.publisher_id";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo
              //////the nth-child(2) isn't working
              "
              <div class='row border-bottom bg-row'>
                <div class='col'>".$row['title']."</div>      
                <div class='col'>".$row['first_name']." ".$row['last_name']."</div>

                <div class='col text-right ex'>
                    <input type='checkbox' name='checkbox' class='hidden' id='details_toggle' value='value'>
                    <label for='details_toggle'>Show more</label>
                
                    <p><img src='".$row['image']."' alt='library item' height='42' width='42'> ".$row['ISBN'].", ".$row['name'].", ".$row['publish_date'].", Type of media: ".$row['type']." Short Description: ".$row['short_description']."</p>
                        <button name='delete' type='submit'>Delete</button>
                        <button name='Update' type='submit'>Update</button>
                </div>    
              </div>
            ";
          }
        }
      */?>
      -------------------------------------HERE FOLLOWS THE WORKING PAER------------------->
      <?php  
        $sql = "SELECT media.title, authors.first_name, authors.last_name, media.isbn FROM media INNER JOIN authors ON media.fk_author_id=authors.author_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo
            //////the nth-childe(2) isn't working
            "
              <div class='row border-bottom bg-row'>
                <div class='col'>".$row['title']."</div>      
                <div class='col'>".$row['first_name']." ".$row['last_name']."</div>

                <div class='col text-right ex'>
                  <a href='big_library.php?id=".$row['isbn']."' for='details_toggel'>Details</a>
                  <input type='checkbox' class='hidden' id='details_toggel'>
                  <div class='show'>
                      <p>Here should be futher information.Here should be futher informationHere should be futher information</p>
                      <div>
                        <button class='right' name='delete' type='submit'>Delete</button>
                        <button class='right' name='Update' type='submit'>Update</button>
                      </div>
                  </div>
                </div>
                  
              </div>
            ";
          }
        }
      ?>
    </section>
  </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>