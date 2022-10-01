<!-- ADD NEW SPECIALIZATION MODAL -->
<div class="modal fade" id="addNewSpecialization" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"><?php echo language("ADD NEW SPECIALIZATION", $_SESSION['systemLang']) ?></h5>
            </div>
            <div class="modal-body">
                <form action="soldiers.php?do=insertSpecialization" method="post" id="addSpecializationForm">
                    <div class="mb-3 position-relative">
                        <label for="specialization" class="form-label"><?php echo language("SPECIALIZATION NAME", $_SESSION['systemLang']) ?></label>
                        <input type="text" class="form-control" name="specialization" id="specialization" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo language("CLOSE", $_SESSION['systemLang']) ?></button>
                <button type="submit" class="btn btn-success" form="addSpecializationForm"><?php echo language("ADD NEW SPECIALIZATION", $_SESSION['systemLang']) ?></button>
            </div>
        </div>
    </div>
</div>

<!-- ADD NEW SPECIALIZATION MODAL -->
<div class="modal fade" id="editSpecialization" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"><?php echo language("EDIT SPECIALIZATION", $_SESSION['systemLang']) ?></h5>
            </div>
            <div class="modal-body">
                <form method="post" id="updateSpecializationForm">
                    <div class="mb-3 position-relative">
                        <label for="specialization-id-select"><?php echo language("SPECIALIZATION", $_SESSION['systemLang']) ?></label>
                        <input type="hidden" name="specialization-id" id="specialization-id" value="" required data-no-astrisk="true">
                        <select class="form-select" name="" id="specialization-id-select" onchange="putSpecId(this)">
                            <?php
                                # get all specialization
                                $specQ = "SELECT *FROM `specialization`";
                                $stmt = $con->prepare($specQ);
                                $stmt->execute();
                                $rows = $stmt->fetchAll();
                                $counter = $stmt->rowCount()
                            ?>
                            <?php if ($counter > 0) { ?>
                                <option disabled selected><?php echo language("SPECIALIZATIONS", $_SESSION['systemLang']) ?></option>
                                <?php foreach ($rows as $row) { ?>
                                    <option value="<?php echo $row['spec_id']?>"><?php echo $row['spec_name']?></option>
                                <?php } ?>
                                <?php } else { ?>
                                <option disabled selected><?php echo language("SPECIALIZATIONS NOT ENTERED", $_SESSION['systemLang']) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="specialization-new" class="form-label"><?php echo language("SPECIALIZATION NEW NAME", $_SESSION['systemLang']) ?></label>
                        <input type="text" class="form-control" name="specialization-new" id="specialization-new">
                    </div>
                    
                    <div class="mb-3 position-relative d-none" id="specIdMsg">
                        <div class="alert alert-danger" role="alert">
                            <?php echo language("YOU MUST CHOOSE A SPECIALIZATION", $_SESSION['systemLang']) ?>
                            <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>

                    <div class="mb-3 position-relative d-none" id="specMsg">
                        <div class="alert alert-danger" role="alert">
                            <?php echo language("SPECIALIZATION CANNOT BE EMPTY", $_SESSION['systemLang']) ?>
                            <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo language("CLOSE", $_SESSION['systemLang']) ?></button>
                <button type="button" class="btn btn-success" onclick="checkNewSpecValue(this)" data-target="update" form="updateSpecializationForm"><?php echo language("EDIT SPECIALIZATION", $_SESSION['systemLang']) ?></button>
                <button type="button" class="btn btn-outline-danger" onclick="checkNewSpecValue(this)" data-target="delete" form="updateSpecializationForm"><?php echo language("DELETE SPECIALIZATION", $_SESSION['systemLang']) ?></button>
            </div>
        </div>
    </div>
</div>

<!-- ADD UNIT MODAL -->
<div class="modal fade" id="addNewUnitModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"><?php echo language("ADD NEW UNIT", $_SESSION['systemLang']) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="units.php?do=insertUnit" method="post" id="addUnitForm">
                    <div class="mb-3">
                        <label for="unit-name-ar" class="form-label"><?php echo language("UNIT NAME IN ARABIC", $_SESSION['systemLang']) ?></label>
                        <input type="text" class="form-control" name="unit-name-ar" id="unit-name-ar" required>
                    </div>
                    <div class="mb-3">
                        <label for="unit-name-en" class="form-label"><?php echo language("UNIT NAME IN ENGLISH", $_SESSION['systemLang']) ?></label>
                        <input type="text" class="form-control" name="unit-name-en" id="unit-name-en">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo language("CLOSE", $_SESSION['systemLang']) ?></button>
                <button type="submit" class="btn btn-primary" form="addUnitForm"><?php echo language("ADD NEW UNIT", $_SESSION['systemLang']) ?></button>
            </div>
        </div>
    </div>
</div>

<!-- DELETE SOLDIER INFO MODAL -->
<div class="modal fade" id="deleteSoldierModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"><?php echo language("DELETE SOLDIER INFO", $_SESSION['systemLang']) ?></h5>
            </div>
            <div class="modal-body">
                <form action="soldiers.php?do=deleteSoldier" method="POST" id="deleteSoldierForm">
                    <input type="hidden" class="form-control" name="soldierid" id="soldierid" data-no-astrisk="true" value="<?php echo $soldier['id'] ?>" required>
                    <div class="mb-3 position-relative">
                        <h4 class="h4 text-capitalize"><?php echo language("ARE YOU SURE TO DELETE THIS SOLDIER?", $_SESSION['systemLang']) ?></h4>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo language("CLOSE", $_SESSION['systemLang']) ?></button>
                <button type="submit" class="btn btn-outline-danger" form="deleteSoldierForm"><?php echo language("DELETE SOLDIER INFO", $_SESSION['systemLang']) ?></button>
            </div>
        </div>
    </div>
</div>