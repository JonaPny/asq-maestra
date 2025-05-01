<?php
session_start();
$authenticated = false;

if (isset($_SESSION["email"])) {
    $authenticated = true;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>A.S.Q MAESTRA SALON</title>
    <link rel="icon" href="/PHOTOS/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom shadow-sm">
      <div class="container">
        <a class="navbar-brand py-4" href="/login_register/index.php">
          <img src="/PHOTOS/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
          Jose Maestra Barbera Salon
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center gap-2">
            <!-- HOME first -->
            <li class="nav-item">
              <a class="nav-link text-dark" href="/login_register/index.php">HOME</a>
            </li>
            <!-- Gallery -->
            <li class="nav-item">
              <a class="nav-link text-dark" href="/gallery.php">GALLERY</a>
            </li>
            <!-- Lounge Menu -->
            <li class="nav-item">
              <a class="nav-link text-dark" href="/lounge_menu.php">LOUNGE MENU</a>
            </li>
            <!-- About -->
            <li class="nav-item">
              <a class="nav-link text-dark" href="/about.php">ABOUT</a>
            </li>

            <!-- Auth-based nav items -->
            <?php if ($authenticated) { ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php echo !empty($_SESSION['name']) ? $_SESSION['name'] : 'User'; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="/login_register/profile.php">Profile</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="/login_register/logout.php">Logout</a></li>
                </ul>
              </li>
            <?php } else { ?>
              <li class="nav-item">
                <a href="/login_register/register.php" class="btn" style="background-color: transparent; color: #ff3e9a; border: 1px solid #ff3e9a;">SIGN UP</a>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6/8bE3Tz1I65xjK5OGGz+f1Rtvtyvq6l9QDsP5eSmX0OlPfFv4S" crossorigin="anonymous"></script>
  </body>
</html>
