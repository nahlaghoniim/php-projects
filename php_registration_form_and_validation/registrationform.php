<?php

// Security helper function
function post_data($field) {
    $_POST[$field] ??= '';
    return htmlspecialchars(stripslashes($_POST[$field]));
}

$errors = [];

$username = '';
$email = '';
$password = '';
$password_confirm = '';
$cv_url = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize inputs
    $username = post_data('username');
    $email = post_data('email');
    $password = post_data('password');
    $password_confirm = post_data('password_confirm');
    $cv_url = post_data('cv_url');

    // -----------------------
    // VALIDATION
    // -----------------------

    // Username validation
    if (!$username) {
        $errors['username'] = "Username is required.";
    } elseif (strlen($username) < 3) {
        $errors['username'] = "Username must be at least 3 characters.";
    } elseif (strlen($username) > 16) {
        $errors['username'] = "Username cannot exceed 16 characters.";
    }

    // Email validation
    if (!$email) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email.";
    }

    // Password validation
    if (!$password) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters.";
    }

    // Confirm password
    if (!$password_confirm) {
        $errors['password_confirm'] = "Please confirm your password.";
    } elseif ($password !== $password_confirm) {
        $errors['password_confirm'] = "Passwords do not match.";
    }

    // CV URL (optional)
    if ($cv_url && !filter_var($cv_url, FILTER_VALIDATE_URL)) {
        $errors['cv_url'] = "Please enter a valid URL.";
    }

    // Success message if all validation passes
    if (empty($errors)) {
        echo "<div style='padding:15px;background:#c8f7c5;margin:15px;border-radius:6px;'>
                <strong>Form submitted successfully!</strong>
              </div>";

        echo "<pre>";
        var_dump($username, $email, $cv_url);
        echo "</pre>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure Bootstrap Form</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="col-md-6 mx-auto">

        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-3 text-center">Register</h3>

                <form action="" method="post" novalidate>

                    <!-- Username -->
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input
                            type="text"
                            name="username"
                            class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $username; ?>"
                            placeholder="Enter your username"
                        >
                        <?php if (isset($errors['username'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['username']; ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $email; ?>"
                            placeholder="name@example.com"
                        >
                        <?php if (isset($errors['email'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>"
                            placeholder="At least 6 characters"
                        >
                        <?php if (isset($errors['password'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['password']; ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input
                            type="password"
                            name="password_confirm"
                            class="form-control <?php echo isset($errors['password_confirm']) ? 'is-invalid' : ''; ?>"
                            placeholder="Re-enter password"
                        >
                        <?php if (isset($errors['password_confirm'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['password_confirm']; ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- CV URL -->
                    <div class="mb-3">
                        <label class="form-label">Your CV URL (optional)</label>
                        <input
                            type="url"
                            name="cv_url"
                            class="form-control <?php echo isset($errors['cv_url']) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $cv_url; ?>"
                            placeholder="https://example.com/my-cv"
                        >
                        <?php if (isset($errors['cv_url'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['cv_url']; ?></div>
                        <?php endif; ?>
                    </div>

                    <button class="btn btn-primary w-100" type="submit">Register</button>

                </form>
            </div>
        </div>

    </div>
</div>

</body>
</html>

