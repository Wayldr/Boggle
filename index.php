<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boggle</title>
</head>
<body>
    <div class="container">
        <div class="plateau"></div>
    </div>
<script>
    var xmlhttp = new XMLHttpRequest();
    var url = "RollDices.php";
    xmlhttp.open("GET", url, true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
             if (this.readyState == 4 && this.status == 200) {
                    out=JSON.parse(this.responseText);
                    console.log(out);
                }
        }
    };
    xmlhttp.send();
</script>
</body>
</html>
