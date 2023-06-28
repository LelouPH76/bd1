<?php include('connect.php');?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
<body>
    <div>
        <form action="" method="POST">
            <input type="text" name="fn" placeholder="nome"><br><br>
            <input type="text" name="ln" placeholder="sobrenome"><br><br>
            <input type="number" name="age" placeholder="idade"><br><br>
            <input type="submit" name="save_btn">
            <button><a href= "view.php">Vizu</a></button>
        </form>
    </div>
    <?php
    if(isset($_POST['save_btn'])){
        $fname= $_POST['fn'];
        $lname= $_POST['ln'];
        $age= $_POST['age'];
        $query="INSERT INTO students(firstname, lastname, age) VALUES('$fname', '$lname', '$age')";
        $data = mysqli_query($mysqli, $query);
        if($data){
            ?>
            <script type="text/javascript">
                alert("DEU BOM FAMÍLIA!!!!!");
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
</body>
</html>
