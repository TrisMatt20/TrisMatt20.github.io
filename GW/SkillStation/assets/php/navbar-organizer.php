<nav class="navbar navbar-dark navbar-expand-lg sticky-top px-1 px-md-4">
    <div class="container-fluid">
        <a class="navbar-brand d-flex flex-row align-items-center gap-2 p-0 my-2 my-lg-0" href="./">
            <img src="../assets/img/logo_w.png" alt="Logo" width="35">
            <h4 class="m-0">SkillStation</h4>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasOrg" aria-controls="offcanvasNavbarGuest">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasOrg" aria-modal="true" role="dialog" aria-labelledby="offcanvasOrgLabel">
            <div class="offcanvas-header" id="offcanvasOrgLabel">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
                <div class="d-flex flex-row justify-content-center align-items-center gap-2 my-2 d-lg-none">
                    <img src="../assets/img/logo.png" alt="Logo" width="35">
                    <h4 class="m-0" style="color: white;">SkillStation</h4>
                </div>

                <ul class="navbar-nav justify-content-end flex-grow-1 my-5 my-lg-1 pe-3 gap-2 text-center">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="archived.php">
                            Archived Events
                        </a>
                    </li>
                    <li class="nav-item d-none d-lg-block mx-1">
                        <a class="btn btn-primary-w" aria-current="page" href="create-event.php">
                            Create Event
                        </a>
                    </li>
                    <li class="nav-item d-block d-lg-none">
                        <a class="btn btn-primary" aria-current="page" href="create-event.php">
                            Create Event
                        </a>
                    </li>
                    <li class="nav-item dropdown profile-dropdown d-none d-lg-flex align-items-center">
                        <button class="btn dropdown-toggle p-0 mx-1" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #ffffff; border: none !important;">
                            <img src="../assets/img/avatar.png" class="rounded-circle" style="height: 35px; border: none;">
                            <?php echo $username ?>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="../" style="font-family: 'Poppins';">
                                    <i class="bi bi-box-arrow-right text-danger px-1"></i> Log Out
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item d-block d-lg-none">
                        <a class="nav-link" aria-current="page" href="../">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>