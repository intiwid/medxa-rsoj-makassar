<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="#" onclick="myFunction();">test</a>
</body>
<script>
    function myFunction() {
        setTimeout(function() {
            swal({
                title: 'Data berhail diinput',
                text: '!',
                type: 'success',
                timer: 3000,
                showConfirmButton: true
            });
        }, 10);
        window.setTimeout(function() {
            window.location.replace('view_ae.php');
        }, 3000);
    }
</script>

</html>