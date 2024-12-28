<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pilih Metode</title>
        <!-- Link Custom CSS -->
        <link rel="stylesheet" href="../css/styles.css">
        <!-- Link Bootstrap -->
        <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    </head>

    <body>
        <form action="#" method="post">
            <div class="text-center mt-5 pt-5">
                <h2 class="pb-2">Pilih Metode</h2>
                <button type="submit" name="order_method" value="drop_off" class="btn btn-primary btn-lg mx-2"
                    formaction="drop-off/form-drop-off.php">
                    Drop Off
                </button>
                <button type="submit" name="order_method" value="pick_up" class="btn btn-success btn-lg mx-2"
                    formaction="pick-up/form-pick-up.php">
                    Pick Up
                </button>
            </div>
        </form>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../js/script.js"></script>
    </body>

</html>