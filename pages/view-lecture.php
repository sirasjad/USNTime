<?php $core->pageTitle("Behandle fag"); ?>

<body class="d-flex flex-column h-100">
    <?php $core->getNavbar(); ?>
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5"><?php $core->getSubjectName($core->getId()); ?></h1>
            <p class="lead">Oppmøte for: <?php echo $core->getPrettyDate($_GET['date']); ?></p>

            <table class="table mt-4 mb-5">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Navn</th>
                        <th scope="col">Studentnummer</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $core->loadAttendees(); ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php $core->getFooter(); ?>

</body>
</html>