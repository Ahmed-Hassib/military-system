<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="soldiers.php">
        <img src="<?php echo $assets ?>air-defence-logo-2.png" alt="<?php echo language("AUTOMATED 830 CENTER") ?>" class="d-inline-block align-text-top">
        <?php echo language("AUTOMATED 830 CENTER") ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link dropdown-toggle <?php if (strtolower($pageTitle) == languageEn("THE SOLDIERS")) {echo "active";} ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span><?php echo language("THE SOLDIERS") ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end text-capitalize" aria-labelledby="navbarDropdown">
            <li>
                <a class="dropdown-item" href="soldiers.php">
                  <span><?php echo language("THE SOLDIERS") ?></span>
                </a>
            </li>
            <li>
              <a class="dropdown-item" href="soldiers.php?do=addNewSoldier">
                  <span><?php echo language("ADD NEW SOLDIER") ?></span>
                  <i class="bi bi-plus"></i>
                </a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php if (strtolower($pageTitle) == languageEn("THE UNITS")) {echo "active";} ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span><?php echo language("THE UNITS", $_SESSION['systemLang']) ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end text-capitalize" aria-labelledby="navbarDropdown">
            <li>
                <a class="dropdown-item" href="units.php">
                  <span><?php echo language("THE UNITS") ?></span>
                </a>
            </li>
            <li>
              <span class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#addNewUnitModal">
                <?php echo language("ADD NEW UNIT", $_SESSION['systemLang']) ?>
                <i class="bi bi-plus"></i>
              </span>
            </li>
          </ul>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span><?php echo language("OTHERS", $_SESSION['systemLang']) ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end text-capitalize" aria-labelledby="navbarDropdown">
            <li>
                <span class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#editSpecialization">
                  <?php echo language("EDIT SPECIALIZATION", $_SESSION['systemLang']) ?>
                  <i class="bi bi-pencil"></i>
                </span>
            </li>
            <li>
                <span class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#addNewSpecialization">
                  <?php echo language("ADD NEW SPECIALIZATION", $_SESSION['systemLang']) ?>
                  <i class="bi bi-plus"></i>
                </span>
            </li>
            <hr class="dropdown-divider">
            <li>
              <span class="dropdown-item backupBtn text-capitalize w-100" style="cursor: pointer" id="backup" onclick="getBackup('<?php echo $_SESSION['UserID'] ?>')"><?php echo language('TAKE A BACKUP', $_SESSION['systemLang']) ?>&nbsp;<i class="bi bi-download"></i></span>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link"><?php echo language("LOGOUT", $_SESSION['systemLang']) ?></a>
        </li>
      </ul>
    </div>
  </div>
</nav>