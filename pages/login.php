<?php $core->pageTitle("Logg inn"); ?>

<body class="login">
    <form class="form-signin" action="" method="POST">
        <center><img class="mb-4" src="../assets/img/logo.png" width="80%" height="80%">
        <h1 class="h3 mb-3 font-weight-normal">Logg inn</h1></center>

        <?php if(isset($_POST['login'])){ $core->userLogin(); } ?>
        <input type="email" name="email" class="form-control" placeholder="E-post adresse" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Passord" required>

        <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Logg inn</button>

        <center><p class="mt-3 mb-2">Ønsker du tilgang? <a href="/?page=register" style="color:#444aa2"><strong>Trykk her</strong></a> for å registrere en brukerkonto!</p>
        <p class="mt-5 mb-2 text-muted">&copy; 2019 - Utviklet av Sirajuddin Asjad</p></center>
    </form>
</body>
</html>