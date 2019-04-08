<?php $core->pageTitle("Brukerlogg"); ?>

<body class="d-flex flex-column h-100">
    <?php $core->getNavbar(); ?>
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Brukerlogg</h1>
            <p class="lead">Her kan du se logg over alle dine handlinger. Det er kun du som har tilgang til disse loggene.</p>

            <table class="table mt-4 mb-5">
                <?php $core->loadLogs(); ?>
            </table>
        </div>
    </main>
    <?php $core->getFooter(); ?>

</body>
</html>