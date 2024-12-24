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
        <?php include "../includes/header.php" ?>
        <form action="process_order.php" method="post">
            <div class="text-center mt-5 pt-5">
                <h2 class="pb-2">Pilih Metode</h2>
                <button type="submit" name="order_method" value="drop_off" class="btn btn-primary btn-lg mx-2">
                    Drop Off
                </button>
                <button type="submit" name="order_method" value="pick_up" class="btn btn-success btn-lg mx-2">
                    Pick Up
                </button>
            </div>
        </form>
    </body>

</html>