<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beautiful Form</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <form action="distance_calculate.php" method="post">
            <div class="form-group">
                <label for="pincode">Enter PIN code 1</label>
                <input type="text" class="form-control" id="pincode" name="zip_code_1" placeholder="Enter PIN code">
            </div>
            <div class="form-group">
                <label for="pincode">Enter PIN code 2</label>
                <input type="text" class="form-control" id="pincode" name="zip_code_2" placeholder="Enter PIN code">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Add Bootstrap JS and Popper.js scripts (optional but may be required for some Bootstrap features) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
