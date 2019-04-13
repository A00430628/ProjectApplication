<?php include "templates/header.php"; ?>

<div class="login-form">
    <div class="sign-up-htm">
        <form method="post">
            <div class="group">
                <label for="id" class="label">Enter the Article ID:</label>
                <input id="id" name="id" type="text" >
            </div>   
            <div class="group">
                <label for="title" class="label">Enter the title:</label>
                <input id="title" name="title" type="text" >
            </div>
            <div class="group">
                <label for="pages" class="label">Enter the pages:</label>
                <input id="pages" name="pages" type="text">
            </div>
            <div class="group">
                <label for="volume" class="label">Enter Volume No.:</label>
                <input id="volume" name="volume" type="number" >
            </div>
            <div class="group">
                <label for="publicationYear" class="label">Publication Year:</label>
                <input id="publicationYear" name="publicationYear" type="date" >
            </div>
            <div class="group">
                <label for="magazineId" class="label">Magazine ID:</label>
                <input id="magazineId" name="magazineId" type="number" >
            </div>
            <div class="group">
                <input type="submit" name="addArticle"  value="ADD ARTICLE">
            </div>
        </form>
    </div>
</div>   
</body>

</html>
<?php
if (isset($_POST['addArticle'])) {
    require 'config.php';

    $id = $_POST['id'];
    $title = $_POST['title'];
    $pages = $_POST['pages'];
    $volume = $_POST['volume'];
    $publicationYear = $_POST['publicationYear'];
    $magazineId = $_POST['magazineId'];

    if (empty($id) || empty($title) || empty($pages) || empty($volume) || empty($publicationYear) || empty($magazineId)) {
        echo 'Please enter all the details';
        header("Location: addArticle.php");
        echo 'Please enter all the details';
        exit();
    } else {
        $query = "INSERT INTO articles(unique_id,title,pages,volume_number,publication_year,magazine_id) VALUES('$id','$title','$pages','$volume','$publicationYear',,'$magazineId')";
        $sql = "Select * from  articles where unique_id = '$id'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if (mysqli_num_rows($result) == 1) {
            echo 'Article ID Already exist';
        } else if (mysqli_query($conn, $query)) {
            echo 'Record Inserted';
        } else {
            echo 'Error: ' . $query . '<br>' . mysqli_error($conn);
        }
    }
}
?>

<?php include "templates/footer.php"; ?>
