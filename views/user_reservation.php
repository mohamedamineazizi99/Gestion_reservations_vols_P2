<?php
    include_once('../models/User.php');
    include_once('../models/Reservation.php');
	include_once('../app/classes/Session.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Sky flight</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
		integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <section class="p-5 m-5">
        <div class="continer p-5">
            <div id="historique">
                <h1 class="title">Historique des commandes</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Date reservation</th>
                            <th scope="col">Détails</th>
                            <th scope="col">For ?</th>
                        </tr>
                    </thead>

                    <?php
                    $info = new Reservation();
                    $res = $info -> reservation_join();
                    ?>
                    <tbody>
                        <tr>
                            <?php foreach ($res as $row):?>
                            <td><?= $row['id_reservation']; ?></td>
                            <td><?= $row['date_reservation']; ?></td>
                            <td>
                                <?php
                                    if($row['cin_passager'] === $_SESSION['cin']){
                                        echo "you";
                                    }else{
                                        echo "howa";
                                    }
                                ?>
                            </td>
                            <td>
                                <input type="button" name="view" value="Détails" id="<?= $row['id_reservation']; ?>"
                                    class="btn btn-info btn-xs view_data">
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                    
                </table>
                <div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalCenterTitle">détails de Reservation</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="detail">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo "wolcom user_reservation"; ?>

    <script>
        $(document).ready(function () {
            $('.view_data').click(function () {
                var rid = $(this).attr("id");
                $.ajax({
                    url: "../controllers/user_back.php",
                    method: "post",
                    data: {
                        rid: rid
                    },
                    success: function (data) {
                        $('#detail').html(data);
                        $('#exampleModalCenter').modal("show");
                    }
                });
            });
        });
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- 
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
		integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
	</script> -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
		integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
		integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
	</script>
</body>
</html>