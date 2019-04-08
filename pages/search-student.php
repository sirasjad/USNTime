<?php $core->pageTitle("Studentsøk"); ?>

<body class="d-flex flex-column h-100">
    <?php $core->getNavbar(); ?>
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Studentsøk</h1>
            <p class="lead">Fagemne: <?php $core->getSubjectName($_GET['id']); ?></p>

            <form action='' method='POST'>
                <div class="input-group mb-3">
                    <input class="form-control form-control-lg" type="text" name="studnr" placeholder="Skriv inn studentnummer..." required>

                    <div class="input-group-append">
                        <button type="submit" name="search" class="btn btn-outline-primary">Søk</button>
                    </div>
                </div>
            </form>

            <table class="table mt-4 mb-5">
                <?php if(isset($_POST['search'])){ $core->findStudent(); } ?>
            </table>
        </div>
    </main>
    <?php $core->getFooter(); ?>
</body>
</html>