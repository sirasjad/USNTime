<?php include('inc/header.php'); ?>

<body class="login text-center">
    <form class="form-signin">
        <img class="mb-4" src="../assets/img/logo.png" width="50%" height="50%">
        <h1 class="h3 mb-3 font-weight-normal">Logg inn</h1>

        <input type="email" name="email" class="form-control" placeholder="E-post adresse" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Passord" required>

        <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Logg inn</button>

        <p class="mt-3 mb-2">Ønsker du tilgang? <a href="#" style="color:#444aa2"><strong>Trykk her</strong></a> for å registrere deg!</p>
        <p class="mt-5 mb-2 text-muted">&copy; 2019 - Utviklet av Sirajuddin Asjad</p>
    </form>
</body>
</html>