<?php $core->pageTitle("Behandle fag"); ?>

<body class="d-flex flex-column h-100">
    <?php $core->getNavbar(); ?>
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5"><?php $core->getSubjectName($core->getId()); ?></h1>
            <p class="lead">Her kan du se oversikt over oppmøte, behandle faget og fagets studenter.</p>

            <div class="mt-3 mb-4">
                <a href="/?page=search-student&id=<?php echo $core->getId(); ?>" class="btn btn-primary btn-lg">Søk student</a>
                <a href="#" class="btn btn-primary btn-lg ml-2">Eksporter data</a>
                <a href="/?page=manage-students&id=<?php echo $core->getId(); ?>" class="btn btn-primary btn-lg ml-2">Behandle studenter</a>
                <button type="button" class="btn btn-primary btn-lg ml-2" data-toggle="modal" data-target="#endreModal">Endre fag</button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="endreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Endre fag</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>

                        <form action="" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Fagemne:</label>
                                    <input type="text" name="subject" class="form-control" value="<?php $core->getSubjectName($core->getId()); ?>" required>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-5 mr-2">
                                        <label>Semester:</label>
                                        <select name="semester" class="form-control">
                                            <option value="0" selected disabled>Velg periode</option>
                                            <option value="VÅR">Vår</option>
                                            <option value="HØST">Høst</option>
                                        </select>
                                    </div>
                                
                                    <div class="form-group col-md-3">
                                        <label>Årstall:</label>
                                        <input type="text" name="year" class="form-control" placeholder="F.eks 2019" required>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Lukk</button>
                                <button type="submit" class="btn btn-primary" name="edit-subject">Oppdater fag</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php if(isset($_POST['edit-subject'])){ $core->updateSubject(); } ?>
            <table class="table table-hover mt-5 mb-5" style="table-layout: fixed;">
                <?php $core->listAttendance(); ?>
            </table>
        </div>
    </main>
    <?php $core->getFooter(); ?>

</body>
</html>