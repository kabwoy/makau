

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="course-processing.php" method="post">

        <input type="text" placeholder="course name" name="coursename">
        <input type="text" placeholder="course code" name="coursecode">

        <select name="department" id="">
           
            <option value="1">Computing</option>
            <option value="2">Health</option>
            <option value="3">Medical</option> 
            ?> 
            
        </select>
        <button type="submit">Add Course</button>
    </form>
</body>
</html>