<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Registration Form Example</title>
    <style>
        .error {
            color: red;
            font-family: Arial, sans-serif;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            margin: 50px auto;
            text-align: center;
            width: 800px;
            font-family: Arial, sans-serif;
        }

        h1 {
            font-size: 2rem;
            font-weight: bold;
            color: hotpink;
            text-transform: uppercase;
        }

        label {
            width: 150px;
            display: inline-block;
            text-align: left;
            font-size: 1.5rem;
        }

        input, textarea {
            border: 2px solid #ccc;
            font-size: 1.5rem;
            padding: 10px;
            margin-bottom: 10px;
        }

        form {
            margin: 25px auto;
            padding: 20px;
            border: 5px solid #ccc;
            width: 500px;
            background: #f3e7e9;
        }

        input[type=submit] {
            border: 3px solid;
            border-radius: 2px;
            color: #fff;
            background-color: hotpink;
            font-size: 1em;
            font-weight: bold;
            padding: 10px 20px;
            text-transform: uppercase;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #ff69b4;
        }
    </style>
</head>
<body>
<?php
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["website"])) {
        $website = "";
    } else {
        $website = test_input($_POST["website"]);
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
            $websiteErr = "Invalid URL";
        }
    }

    $comment = test_input($_POST["comment"]);

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<h1>PHP Registration Form Example</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-element">
        <label for="name">Enter Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name;?>">
        <span class="error">* <?php echo $nameErr;?></span>
    </div>
    <div class="form-element">
        <label for="email">Enter E-mail:</label>
        <input type="text" id="email" name="email" value="<?php echo $email;?>">
        <span class="error">* <?php echo $emailErr;?></span>
    </div>
    <div class="form-element">
        <label for="website">Enter Website:</label>
        <input type="text" id="website" name="website" value="<?php echo $website;?>">
        <span class="error"><?php echo $websiteErr;?></span>
    </div>
    <div class="form-element">
        <label for="comment">Message:</label>
        <textarea id="comment" name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
    </div>
    <div class="form-element">
        <label>Select Gender:</label>
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other
        <span class="error">* <?php echo $genderErr;?></span>
    </div>
    <input type="submit" name="submit" value="Register">
</form>
<?php
echo "<h2>Your Input:</h2>";
echo "Name: " . $name . "<br>";
echo "Email: " . $email . "<br>";
echo "Website: " . $website . "<br>";
echo "Comment: " . $comment . "<br>";
echo "Gender: " . $gender . "<br>";
?>
</body>
</html>
