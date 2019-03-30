<?php $core->pageTitle("Registrering"); ?>

<body class="login">
    <form class="form-signup" action="" method="POST">
        <center><a href="/?page=login"><img class="mb-4" src="../assets/img/logo.png" width="80%" height="80%"></a>
        <h1 class="h3 mb-3 font-weight-normal">Registrering</h1></center>

        <?php if(isset($_POST['register'])){ $core->userRegister(); } ?>
        <input type="email" name="email" class="form-control" placeholder="E-post adresse" required>
        <input type="text" name="studnr" class="form-control" placeholder="Student/ansatt nummer" required>
        <input type="text" name="name" class="form-control" placeholder="Fullt navn" required>
        <input type="password" name="password" class="form-control" placeholder="Ønsket passord" required>
        <input type="password" name="repeatpwd" class="form-control" placeholder="Gjenta passord" required>

        <p class="mt-3 mb-3"><strong>Husk:</strong> Ikke bruk samme passord som din ansatt eller student bruker på Canvas. Dette er på grunn av sikkerhetsårsaker.</p>

        <button class="btn btn-lg btn-primary btn-block" name="register" type="submit">Opprett bruker</button>
        
        <center><p class="mt-5 mb-2 text-muted">&copy; 2019 - Utviklet av Sirajuddin Asjad</p></center>
    </form>
</body>
</html>