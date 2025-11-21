<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="insert.php" method="post" enctype="multipart/form-date">
        <table>
            <tr>
                <td><h2>Inserting new recipe</h2></td>
            </tr>
            <tr>
                <td>Recipe Name:</td>
                <td><input type="text" name="New_recipe"></td>
            </tr>
            <tr>
                <td>Recipe Category:</td>
                <td><input type="text" name="New_category"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Add recipe"></td>
            </tr>


        </table>



    </form>
</body>
</html>

<?php
    include "../backend/connection.php";
    
    if(isset($_POST['submit'])){
         $recipe_name = $_POST['New_recipe'];
         $recipe_category = $_POST['New_category'];

         $insert_query = "INSERT INTO recipes(recipeName, recipeCategory) VALUES('$recipe_name', '$recipe_category')";
            if(mysqli_query($conn,$insert_query)){
                 echo"<script>alert('Data Inserted')</script>";
    }else{
        
    }
    }
    
?>