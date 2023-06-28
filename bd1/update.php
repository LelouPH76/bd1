<?php include 'connect.php';
echo $id= $_GET['id'];
$select= "SELECT * FROM students WHERE id='$id'";
$data= mysqli_query($mysqli, $select);
$row= mysqli_fetch_array($data);

?>
<div>
        <form action="" method="POST">
            <input value= "<?php echo $row['firstname'] ?>" type="text" name="fn" placeholder="nome"><br><br>
            <input value= "<?php echo $row['lastname'] ?>" type="text" name="ln" placeholder="sobrenome"><br><br>
            <input value= "<?php echo $row['age'] ?>" type="number" name="age" placeholder="idade"><br><br>

            
            <input type="submit" name="update_btn" value="Update">
            <button><a href= "view.php">Volte</a></button>
        </form>
    </div>



    <?php
    if(isset($_POST['update_btn'])){
        $fname= $_POST['fn'];
        $lname= $_POST['ln'];
        $age= $_POST['age'];
        $update="UPDATE students SET firstname = '$fname', lastname= '$lname', age= '$age' WHERE id='$id'";
        $data = mysqli_query($mysqli, $update);
        if($data){
            ?>
            <script type="text/javascript">
                alert("DEU BOM FAMÍLIA!!!!!");
                window.open("http://localhost/bd1/view.php");
            </script>
            <?php 
        }
        else{
            ?>
            <script type="text/javascript">
                alert("DEU RUIM, CORRE!!!!!");
            </script>
            <?php 
        }
    }
    ?>