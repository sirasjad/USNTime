<?php $core->pageTitle("Behandle studenter"); ?>

<body class="d-flex flex-column h-100">
    <?php $core->getNavbar(); ?>
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Behandle studenter</h1>
            <p class="lead">Fagemne: <?php $core->getSubjectName($core->getId()); ?></p>

            <div class="mt-3 mb-4">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#importModal">Importer studentliste</button>
                <button type="button" class="btn btn-primary btn-lg ml-2" data-toggle="modal" data-target="#addModal">Legg til manuelt</button>
                <button type="button" class="btn btn-danger btn-lg ml-2" data-toggle="modal" data-target="#deleteModal">Slett studenter</button>
            </div>

            <!-- Import Students -->
            <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Importer studentliste</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>

                        <form action='' method='POST' enctype='multipart/form-data'>
                            <div class="modal-body">
                                Her kan du importere Excel dokumenter som inneholder navn og studentnummer. Det er veldig viktig at alle studentnummer står nedover i <u>kolonne A</u> og alle navn står nedover i <u>kolonne B</u>.<br><br>
                             
                                <label class="btn btn-primary">
                                    <input type="file" name="file" style="display:none" onchange="$('#upload-file-info').html(this.files[0].name)">Velg fil
                                </label>

                                <span class='label label-info' id="upload-file-info">Ingen fil valgt</span>
                              
                            </div>
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Lukk</button>
                                <button type="submit" class="btn btn-primary" name="import">Importer studentliste</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Add student -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Legg til student</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>

                        <form action="" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Navn:</label>
                                    <input type="text" name="name" class="form-control" placeholder="Skriv inn student navnet" required>
                                </div>

                                <div class="form-group">
                                    <label>Studentnummer:</label>
                                    <input type="text" name="studnr" class="form-control" placeholder="Skriv inn studentnummer" required>
                                </div>
                            </div>
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Lukk</button>
                                <button type="submit" class="btn btn-primary" name="add-student">Legg til student</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Students -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Slett alle studenter</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>

                        <form action="" method="POST">
                            <div class="modal-body">
                                <strong>OBS!</strong> Er du sikker på at du ønsker å slette alle studenter fra <?php $core->getSubjectName($core->getId()); ?> faget? Denne handlingen kan ikke reverseres.
                            </div>
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Lukk</button>
                                <button type="submit" class="btn btn-danger" name="delete">Slett alle studenter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php if(isset($_POST['import'])){ $core->importStudents(); } ?>
            <?php if(isset($_POST['add-student'])){ $core->addStudent(); } ?>
            <?php if(isset($_POST['delete'])){ $core->deleteStudents(); } ?>
            <table class="table table-hover mt-5 mb-5" style="table-layout: fixed;">
                <?php $core->listStudents(); ?>
            </table>
        </div>
    </main>
    <?php $core->getFooter(); ?>

</body>
</html>