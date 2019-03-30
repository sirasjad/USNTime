<?php $core->pageTitle("Registrer oppmøte"); ?>

<body class="d-flex flex-column h-100">
    <?php $core->getNavbar(); ?>
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Oppmøteregistrering</h1>
            <p class="lead">Fagemne: <?php $core->getSubjectName($_GET['id']); ?></p>

            <?php if(isset($_POST['register'])){ $core->newAttendance(); } ?>

            <form action='' method='POST'>
                <div class="input-group mb-2">
                    <input class="form-control form-control-lg" type="text" name="studnr" placeholder="Skriv inn studentnummer..." required>

                    <div class="input-group-append">
                        <button type="submit" name="register" class="btn btn-outline-primary">Registrer</button>
                    </div>
                </div>
            </form>

            <p>Skann studentkortet ditt eller skriv inn studentnummer manuelt for å registrere ditt oppmøte.</p>
        </div>
    </main>
    <?php $core->getFooter(); ?>

    <script src="../assets/js/jquery.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        setInterval(function(){
            $("#message").slideUp("slow");
        }, 5000);
    });
    </script>

</body>
</html>