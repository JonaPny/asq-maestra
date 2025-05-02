<?php
include('header1.php'); 


// Check if the user is logged in
if (!isset($_SESSION["email"])) {
    header("location: /login_register/index.php");
    exit;
}

// Fetch user data from the database
include "tools/salondb.php";
$dbConnection = getDatabaseConnection();

// Get user ID from session
$user_id = $_SESSION['user_id']; // Make sure user_id is set in session during login

// Prepare and execute query to fetch user data
$statement = $dbConnection->prepare("SELECT first_name, last_name, email, phone, address, created_at FROM users WHERE id = ?");
$statement->bind_param("i", $user_id);
$statement->execute();
$statement->store_result();

if ($statement->num_rows == 1) {
    // Bind the result to variables
    $statement->bind_result($first_name, $last_name, $email, $phone, $address, $created_at);
    $statement->fetch();

    // Store user data in session to use in the profile page
    $_SESSION["first_name"] = $first_name;
    $_SESSION["last_name"] = $last_name;
    $_SESSION["phone"] = $phone;
    $_SESSION["address"] = $address;
    $_SESSION["created_at"] = $created_at;
} else {
    // If user not found, redirect to login
    header("Location: login.php");
    exit;
}

$statement->close();
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto border shadow p-4"> 
            <h2 class="text-center mb-4">Profile</h2> 
            <hr />

            <div class="row mb-3">
                <div class="col-sm-4">First Name</div>
                <div class="col-sm-8"><?= htmlspecialchars($_SESSION["first_name"]) ?></div> 
            </div>

            <div class="row mb-3">
                <div class="col-sm-4">Last Name</div>
                <div class="col-sm-8"><?= htmlspecialchars($_SESSION["last_name"]) ?></div> 
            </div>

            <div class="row mb-3">
                <div class="col-sm-4">Email</div>
                <div class="col-sm-8"><?= htmlspecialchars($_SESSION["email"]) ?></div> 
            </div>

            <div class="row mb-3">
                <div class="col-sm-4">Phone</div>
                <div class="col-sm-8"><?= htmlspecialchars($_SESSION["phone"] ?? 'N/A') ?></div> 
            </div>

            <div class="row mb-3">
                <div class="col-sm-4">Address</div>
                <div class="col-sm-8"><?= htmlspecialchars($_SESSION["address"] ?? 'N/A') ?></div> 
            </div>

            <div class="row mb-3">
                <div class="col-sm-4">Registered At</div>
                <div class="col-sm-8"><?= htmlspecialchars($_SESSION["created_at"] ?? 'N/A') ?></div> 
            </div>

        </div>
    </div>
</div>

<?php include('footer1.php'); ?>