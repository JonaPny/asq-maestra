<?php 
date_default_timezone_set('Asia/Manila');
include('header1.php');

include "tools/salondb.php";
$dbConnection = getDatabaseConnection();

$email = $_GET['email'] ?? ''; // Autofill if redirected
$password = "";
$email_error = $password_error = "";
$error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
        $error = true;
    }

    if (empty($password)) {
        $password_error = "Password is required";
        $error = true;
    }

    if (!$error) {
        // Add 'name' to the SELECT query
        $statement = $dbConnection->prepare("SELECT id, first_name, last_name, password FROM users WHERE email = ?");
        $statement->bind_param("s", $email);
        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows == 1) {
            $statement->bind_result($user_id, $first_name, $last_name, $hashed_password);
            $statement->fetch();

            if (password_verify($password, $hashed_password)) {
                // Set session variables including the user's name
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['name'] = $first_name . ' ' . $last_name; // Store the user's name in the session
                header("Location: index.php");
                exit;
            } else {
                $password_error = "Incorrect password";
            }
        } else {
            $email_error = "Email not found";
        }

        $statement->close();
    }

}
?>

<!-- Login Form -->
<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto border shadow p-4">
            <h2 class="text-center mb-4">Login</h2>
            <hr />

            <form method="post">
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="email" type="email" value="<?= htmlspecialchars($email); ?>">
                        <span class="text-danger"><?= $email_error ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="password" type="password">
                        <span class="text-danger"><?= $password_error ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="offset-sm-4 col-sm-4 d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <div class="col-sm-4 d-grid">
                        <a href="/login_register/index.php" class="btn btn-outline-primary">Cancel</a>
                    </div>
                </div>
            </form>

            <p class="text-center mt-3">Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</div>

<?php include('footer1.php'); ?>
