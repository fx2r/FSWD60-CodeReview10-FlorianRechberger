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
  $short_descriptionError="";
  $dateError="";
  $publisherError="";
  $typeError="";

  $error = false;

  if(isset($_POST['add']) ) {

    $isbn= $_POST['isbn'];
    $title= $_POST['title'];
    $author_first_name= $_POST['author_first_name'];
    $author_last_name= $_POST['author_last_name'];
    $image= $_POST['image'];
    $short_description= $_POST['short_description'];
    $date= $_POST['date'];
    $publisher_name= $_POST['publisher_name']; 
    $publisher_address= $_POST['publisher_address'];
    $publisher_size= $_POST['publisher_size'];
    $type= $_POST['type'];
  
  ####What's wrong with the imageError???####
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
    if(empty($short_description)){
      $error = true;
      $short_descriptionError = "So, so; an 'empty book'...";
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

    ################################### as soon as, in this case,
    #the publisher would be duplicated,
    #the entry still is correctly saved to the db, however,
    #only to the authors and not to media 
    ####################################
    #with a normal 'insert into <table name> () values ()'
    #data is stored correctly, if there is no duplicate of either
    #book, publisher or author, which is unavoidable.##################################
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
          VALUES ('$isbn', '$title', (SELECT author_id FROM authors WHERE last_name = '$author_last_name'), '$image', '$date', '$short_description', (SELECT publisher_id FROM publishers WHERE name = '$publisher_name'), '$type');";   
    
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
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
  <title>Big Library</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Old+Standard+TT:400,700" rel="stylesheet"> 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <nav class="container-fluid navbar sticky-top navbar-light bg-light mb-4 d-flex justify-content-center">
    <a class="navbar-brand" href="big_library.php">
      <img src="images/bookworm.png" alt="Bookworm" height="80">
    </a>
    <form class="form-inline">
      <input class="form-control mr-sm-2 py-4" type="search" placeholder="Will you get hooked?" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0 btn-lg mx-auto ml-sm-0 " type="submit">Take The Bait!</button>
    </form>
  </nav>
  <section class="d-flex flex-column">
    <div class="flex-row">
      <div class="container">
        <form action="big_library.php" method="post" class="d-flex justify-content-center flex-column">
          <!--bootstrap classes 'form-row', 'form-croup' and 'form-control', also adding ids with lables-->
          <div class="form-row justify-content-center ">
            <div class="form-group col-12 col-lg-8 m-auto">
              <h1>Add new media</h1>
            </div>
            <div class="form-group col-12 col-lg-8">
              <label for="isbn">ISBN</label>
                <input type="number" class="form-control" name="isbn" id="isbn" placeholder="ISBN" maxlength="40" />
                  <span class="text-danger"><?php echo $isbnError; ?></span>
            </div>
          </div>
          <div class="form-row justify-content-center ">
            <div class="form-group col-12 col-lg-8">
              <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Title of Book/CD/DVD" maxlength="80" />
                  <span class="text-danger"><?php echo $titleError; ?></span>
            </div>
          </div>
          <div class="form-row justify-content-center ">
            <div class="form-group col-12 col-lg-8">
            <label for="image">Image</label>
              <input type="text" class="form-control" name="image" idate="image" placeholder="Link to image" maxlength="2000" />
                <span class="text-danger"><?php echo $imageError; ?></span>
            </div>
          </div>
          <div class="form-row justify-content-center ">
            <div class="form-group col-md-6 col-lg-4">
              <label for="author_first_name">Author / Director / Artist</label>
              <input type="text" class="form-control" name="author_first_name" id="author_first_name" placeholder="First Name" maxlength="40" />
                <span class="text-danger"><?php echo $authorError; ?></span>
            </div>
            <div class="form-group col-md-6 col-lg-4">
              <label for="author_first_name">&nbsp</label>
              <input type="text" class="form-control" name="author_last_name" id="author_last_name" placeholder="Last Name" maxlength="40" />
                <span class="text-danger"><?php echo $authorError; ?></span>
            </div>
          </div>
          <div class="form-row justify-content-center ">
            <div class="form-group col-lg-8">
              <label for="short_description">Short Description</label>
              <input type="text" class="form-control" size="55" name="short_description" id="short_description" placeholder="Short description" maxlength="2000" />
                <span class="text-danger"><?php echo $short_descriptionError; ?></span>
            </div>
          </div>
          <div class="form-row justify-content-center ">
            <div class="form-group col-md-6 col-lg-4">
              <label for="publisher_name">Publisher</label>
                <input type="text" class="form-control" name="publisher_name" id="publisher_name" placeholder="Publisher name" maxlength="40" />
                  <span class="text-danger"><?php echo $publisherError; ?></span>
            </div>
            <div class="form-group col-md-6 col-lg-4">
              <label for="publisher_address">Address</label>
                <input type="text" class="form-control" name="publisher_address" placeholder="Address" maxlength="60" />
                  <span class="text-danger"><?php echo $publisherError; ?></span>
            </div>
          </div>
          <div class="form-row justify-content-center ">
            <div class="form-group col-md-4 col-lg-3">
              <label for="publisher_size">Size</label>
                <select name="publisher_size" id="publisher_size" class="form-control">
                  <option selected>Choose...</option>
                  <?php $sql = 'SELECT DISTINCT publishers.size FROM publishers';
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        echo '<option>'.$row['size'].'</option>';
                      }
                    }               
                  ?>
                </select>
                <span class="text-danger"><?php echo $publisherError; ?></span>  
            </div>  
            <div class="form-group col-md-4 col-lg-2">
            <label for="type">Type</label>
              <select name="type" id="type" class="form-control">
                <option selected>Choose...</option>
                <?php $sql = 'SELECT DISTINCT media.type FROM media';
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo '<option>'.$row['type'].'</option>';
                    }
                  }               
                ?>
              </select>
                <span class="text-danger"><?php echo $typeError; ?></span>
            </div>
            <div class="form-group col-md-4 col-lg-3">
            <label for="date">Publish Date</label>
              <input type="year" class="form-control" name="date" id="date" placeholder="YYYY" maxlength="4" />
                <span class="text-danger"><?php echo $dateError; ?></span>
            </div>
          </div>
          <div class="form-row justify-content-center">
            <div class="form-group col-lg-8">
              <button type="submit" name="add" class="btn btn-outline-info btn-lg">Add media</button>
            </div>
          </div>
        </form>
      </div>
    </section>
    <hr>
    <section class="d-flex flex-column justify-content-center">
      <div class="row">
        <div class="container d-flex justify-content-center my-4">
        <div class="jumbotron">
          <h1 class="display-4">Hello ... !</h1>
          <p class="lead">Puk, puk! Puck stood there with a buquet, reading from a book made of buk, when he screamed "I'm SEW into you!" Then he could nothing but ... </p>
          <hr class="my-4">
          <p>... Sew On and Forth ... </p>
          <a class="btn btn-secondary btn-lg" href="#" role="button">Continue</a>
          <a class="btn btn-secondary btn-lg" href="#" role="button">Make The First Stich</a>
        </div>
        </div>
      </div>
     
      <?php ///I don't believe it - I had searched for a whole day only to realise a week later that I spelt one instance of isbn with capitals. I do not see these things - never. ...and I've ruined sth again ...don't know what
      $i=1;
      $sql = "SELECT media.title, authors.first_name, authors.last_name, media.isbn, media.image, media.short_description, media.publish_date, media.type, publishers.name
        FROM media
        INNER JOIN authors ON media.fk_author_id=authors.author_id
        INNER JOIN publishers ON media.fk_publisher_id=publishers.publisher_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $i++;
            $zebra=($i%2==1) ? '' : ' border-bottom border-top bg-light';
            echo
              //////the nth-child(2) isn't working ...EVEN my zebra let me down, which is ODD!
              "
              <div class='d-flex ".$zebra."'>
                <div class='container d-flex flex-row-reverse ex align-items-center py-3 '>
                  <input type='checkbox' class='hidden' id='details_toggle-".$i."'>
                  <label for='details_toggle-".$i."' class='btn btn-info btn-lg hide my-0 ml-auto'>More</label>
                  <label for='details_toggle-".$i."' class='show col-2 col-md-1 align-self-start m-0 p-3 pr-3 justify-content-end text-dark'><b>Less</b></a></label>
                  <div class='show border-0 pt-md-4'>
                    <div class='col-12 col-md-3'>
                      <img src='".$row['image']."' class='img-fluid w-100 py-2' alt='library item'>
                    </div>
                    <div class='col-12 col-md-4 text-left'>
                      <ul>
                        <li>".$row['title']."</li>
                        <li>By: ".$row['first_name']." ".$row['last_name']."</li>
                        <li>ISBN: ".$row['isbn']."</li>
                        <li>Publisher: ".$row['name'].", ".$row['publish_date']."</li>
                        <li>Type: ".$row['type']."</li>
                      </ul>
                    </div>
                    <div class='col-12 col-md-4 text-left'>
                      ".$row['short_description']."
                    </div>
                    <div class='col-12 col-md-12 d-flex justify-content-start mb-4 mt-3'>
                      <a href='big_library.php?id=".$row['isbn']."&update' class='btn btn-warning btn-lg mr-3'>Update</a>
                      <a href='big_library.php?id=".$row['isbn']."&delete' class='btn btn-danger btn-lg'>Delete</a>
                    </div>
                  </div>
                  <div class='hide'>
                    <h3>".$row['title']."</h3>by ".$row['first_name']." ".$row['last_name']."
                  </div>
                </div>
              </div>        
            ";
          };
        };
      ?>
    </section>
  </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>