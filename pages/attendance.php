<?php $core->pageTitle("Oppmøte"); ?>

<body class="d-flex flex-column h-100">
    <?php $core->getNavbar(); ?>
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Oppmøte</h1>
            <p class="lead">Velg ett fag under for å registrere oppmøte.</p>

            <table class="table mt-4">
                <?php $core->listSubjects(); ?>
            </table>
        </div>
    </main>
    <?php $core->getFooter(); ?>

</body>
</html>