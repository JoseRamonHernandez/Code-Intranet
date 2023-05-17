<?php

if(empty($_GET['idSolicitud']))
{
    echo ("No se reciben parámetros");
}
else
{
    ?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clerprem</title>

    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

</head>
<body>
    <?php
    $idSolicitud = $_GET['idSolicitud'];

    ?>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'question',
        title: '¿Quiere eliminar este registro por completo?',
        showConfirmButton: true,
        showDenyButton: true,
        confirmButtonText: 'ELIMINAR',
        confirmButtonColor: 'red',
        denyButtonText: 'Cancelar',
        denyButtonColor: 'grey',
    }).then((result) => {
        if(result.isConfirmed)
        {
            
            Swal.fire({
                icon: 'success',
                title: 'Registro eliminado',
                showConfirmButton: true,
                confirmButtonText: 'OK',
                confirmButtonColor: 'blue',
            }).then((resp) => {
                if(resp.isConfirmed)
                {
            
                    window.location="aplicatorsDelete.php?idSolicitud=<?php echo $idSolicitud; ?>"
                }
            })
        }else if(result.isDenied)
        {
            window.location="aplicatorsPage.php"
        }
    })
</script>

</body>
</html>
<?php
}