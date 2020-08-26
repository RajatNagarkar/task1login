<?php
    session_start();
    if(!isset($_SESSION['name'])){
        header("Location: http://localhost/login%20Task1/");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello <?php echo $_SESSION['name'] ?></title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body onunload="<?php session_destroy(); ?>">
    <div class="wrapper">
        <div class="hello">
            <h1>Hello World!</h1>
        </div>
        <div class="greeting">
            <h2 id="greeting"></h2>
        </div>
        <div class="plan-container">
            <h3 id="title">
                Plan Your Day:
            </h3>
            <div class="plan-input">
                <div class="field">
                    <input name="plan" class="form-field" type="text" required />
                </div>
                <div class="btn-class">
                    <button class="btn" id="plan">Plan</button>
                </div>
            </div>
            <div class="plan-area">
                <h4>Plans</h4>
                <div class="plans"></div>
            </div>
        </div>
    </div>
</body>
<script src="../js/jquery.min.js"></script>
<script src="../js/index.js"></script>
</html>