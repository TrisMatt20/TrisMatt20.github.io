<nav class="navbar navbar-expand-sm sticky-top px-1 px-sm-4">
    <div class="container-fluid">
        <a class="navbar-brand d-flex flex-row align-items-center gap-2 p-0 my-2 my-md-0" href="./">
            <img src="assets/img/logo.png" alt="Logo" width="35">
            <h4 class="m-0">SkillStation</h4>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasGuest" aria-controls="offcanvasNavbarGuest">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasGuest" aria-modal="true" role="dialog" aria-labelledby="offcanvasGuestLabel">
            <div class="offcanvas-header" id="offcanvasGuestLabel">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
                <div class="d-flex flex-row justify-content-center align-items-center gap-2 my-2 d-sm-none">
                    <img src="assets/img/logo_w.png" alt="Logo" width="35">
                    <h4 class="m-0" style="color: white;">SkillStation</h4>
                </div>

                <ul class="navbar-nav justify-content-end flex-grow-1 my-5 my-sm-1 pe-3 gap-2 text-center">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="login.php">
                            Login
                        </a>
                    </li>
                    <li class="nav-item d-none d-sm-block mx-1" href="register.php">
                        <a class="btn btn-primary" aria-current="page" href="register.php">
                            Sign Up
                        </a>
                    </li>
                    <li class="nav-item d-block d-sm-none">
                        <a class="nav-link" aria-current="page" href="register.php">
                            Sign Up
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>