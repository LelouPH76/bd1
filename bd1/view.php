<?php include 'connect.php' ?>
<table border="1px" cellpadding="10px" cellspacing="0">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Age</th>
        <th colspan="2">Actions</th>

    </tr>
    <?php 
    $query = "SELECT * FROM students";
    $data = mysqli_query($mysqli, $query);
    $result = mysqli_num_rows($data);
    if($result){
        while($row=mysqli_fetch_assoc($data)){
            ?>
            <tr>
                <td><?php echo $row['firstname']?></td>
                <td><?php echo $row['lastname']?></td>
                <td><?php echo $row['age']?></td>
                <td><a href="update.php?id=<?php echo $row['id']; ?>">Edit</a></td>
            </tr>
            <?php
        }
    }
    ?>
</table>