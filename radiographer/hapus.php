<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Makes the gender radio buttons required.</title>

</head>

<body>
    <form id="myform" action="" method="post">
        <label for="gender_male">
            <input type="radio" id="gender_male" value="m" name="gender" />
            Male
        </label>
        <label for="gender_female">
            <input type="radio" id="gender_female" value="f" name="gender" />
            Female
        </label>
        <label for="">
            <input type="text" name="sex">
        </label>
        <label for="gender" class="error">Please select your gender</label>
        <br />
        <input type="submit" value="Validate!">
    </form>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        $("#myform").validate({
            rules: {
                gender: {
                    required: true
                }
            }
        });
    </script>
</body>

</html>