<?php
/*
 *
 *
 *
 *
 *
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Update Student</title>
</head>

<body class="p-5">

<button
    class="btn btn-outline-primary btn-sm"
    data-bs-toggle="modal"
    data-bs-target="#updateModal"
    data-id="12"
    data-voornaam="Jan"
    data-achternaam="Jansen">
    Update
</button>


<div class="modal fade" id="updateModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Update Student</h5>
            </div>

            <div class="modal-body">

                <form method="post">

                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="modal-id">

                    <input class="form-control mb-2" type="text" name="voornaam" id="modal-voornaam">

                    <input class="form-control mb-2" type="text" name="achternaam" id="modal-achternaam">

                    <button class="btn btn-success" type="submit">Opslaan</button>

                </form>

            </div>

        </div>
    </div>
</div>

</body>
</html>
<?php
if (isset($_POST["action"]) && $_POST["action"] === "update") {

    updateStudent(
        $connection,
        (int)$_POST["id"],
        $_POST["voornaam"],
        $_POST["achternaam"]
    );

}
?>