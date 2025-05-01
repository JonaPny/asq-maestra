<?php 
date_default_timezone_set('Asia/Manila');
include('header1.php'); 

// Redirect to home if already logged in
if (isset($_SESSION["email"])) {
    header("location: /login_register/index.php");
    exit;
}

$first_name = $last_name = $email = $phone = $address = "";
$first_name_error = $last_name_error = $email_error = $phone_error = $address_error = $password_error = $confirm_password_error = "";
$error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($first_name)) {
        $first_name_error = "First name is Required";
        $error = true;
    }

    if (empty($last_name)) {
        $last_name_error = "Last name is Required";
        $error = true;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Email format is not valid";
        $error = true;
    }

    include "tools/salondb.php";
    $dbConnection = getDatabaseConnection();

    $statement = $dbConnection->prepare("SELECT id FROM users WHERE email = ?");
    $statement->bind_param("s", $email);
    $statement->execute();
    $statement->store_result();

    if ($statement->num_rows > 0) {
        $email_error = "Email is already used"; 
        $error = true;
    }

    $statement->close();

    // Phone Number Validation
    if (empty($phone)) {
        $phone_error = "Phone number is required.";
        $error = true;
    } elseif (!preg_match('/^(09|\+639)/', $phone)) {
        $phone_error = "Phone number is not valid. It must start with 09 or +639.";
        $error = true;
    } elseif ((strpos($phone, '09') === 0 && strlen($phone) != 11) || 
            (strpos($phone, '+639') === 0 && strlen($phone) != 13)) {
        $phone_error = "Phone number must be " . (strpos($phone, '+639') === 0 ? "13" : "11") . " digits long.";
        $error = true;
    }


    if (strlen($password) < 6) {
        $password_error = "Password must have at least 6 characters";
        $error = true;
    }

    if ($confirm_password != $password) {
        $confirm_password_error = "Password and Confirm Password do not match";
        $error = true;
    }

    if (!$error) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');

        $statement = $dbConnection->prepare(
            "INSERT INTO users (first_name, last_name, email, phone, address, password, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        $statement->bind_param('sssssss', $first_name, $last_name, $email, $phone, $address, $password, $created_at);
        $statement->execute();
        $statement->close();

        // Store the full name in the session after successful registration
        $_SESSION['name'] = $first_name . ' ' . $last_name;
        
        $_SESSION['registered_email'] = $email;
        header("Location: register.php?success=1");
        exit;
}

}
?>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <!-- Custom pink header -->
          <div class="modal-header" style="background-color: #ff3e9a;">
            <h5 class="modal-title" id="successModalLabel" style="color: white;">Registration Successful</h5>
          </div>
          <div class="modal-body">
            Your account has been created successfully.
          </div>
          <div class="modal-footer">
            <a href="login.php?email=<?= urlencode($_SESSION['registered_email'] ?? '') ?>" class="btn" style="background-color: #ff3e9a; color: white;">OK</a>
          </div>
        </div>
      </div>
    </div>

    <script>
      // Show the modal when the page loads
      window.onload = function() {
        var myModal = new bootstrap.Modal(document.getElementById('successModal'));
        myModal.show();
      };
    </script>
<?php endif; ?>


<!-- Registration Form -->
<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto border shadow p-4">
            <h2 class="text-center mb-4">Register</h2>
            <hr />

            <form method="post">
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">First Name*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="first_name" value="<?= $first_name; ?>">
                        <span class="text-danger"><?= $first_name_error ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Last Name*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="last_name" value="<?= $last_name; ?>">
                        <span class="text-danger"><?= $last_name_error ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Email*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="email" value="<?= $email; ?>">
                        <span class="text-danger"><?= $email_error ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Phone*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="phone" value="<?= $phone; ?>">
                        <span class="text-danger"><?= $phone_error ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Address</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="address" value="<?= $address; ?>">
                        <span class="text-danger"><?= $address_error ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Password*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="password" type="password">
                        <span class="text-danger"><?= $password_error ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Confirm Password*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="confirm_password" type="password">
                        <span class="text-danger"><?= $confirm_password_error ?></span>
                    </div>
                </div>

                <!-- Already have an account? Login -->
                <div class="row mb-3">
                    <div class="col-sm-12 text-center">
                        <p>Already have an account? <a href="/login_register/login.php">Login</a></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="offset-sm-4 col-sm-4 d-grid">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    <div class="col-sm-4 d-grid">
                        <a href="/login_register/index.php" class="btn btn-outline-primary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include('footer1.php'); ?>
