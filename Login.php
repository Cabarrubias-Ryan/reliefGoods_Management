<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <section class="vh-100" style="background-color: #9A616D;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
                <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="image/picture.jfif"
                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                    <form action="Login/LoginPro.php" method="post">

                    <div class="d-flex align-items-center mb-3 pb-1">
                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                        <span class="h1 fw-bold mb-0"></span>
                    </div>

                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example17">Username</label>
                        <input type="text" name="Username" id="form2Example17" value = "<?php echo isset($_GET['username']) ? htmlspecialchars($_GET['username']) : '';  ?>" class="form-control form-control-lg" required/>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example27">Password</label>
                        <input type="password" name="Password" id="form2Example27" class="form-control form-control-lg" required/>
                    </div>
                    <?php if(isset($_GET['Input']) && $_GET['Input'] == "wrong"): ?>
                        <div class="alert alert-danger" style="letter-spacing: 1px;">
                            <strong>Invalid Username or Password</strong>
                        </div>
                    <?php endif ?>

                    <div class="pt-1 mb-4">
                        <input type="submit" class="btn btn-dark btn-lg btn-block" value="Login">
                    </div>

                    </form>

                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>
</body>
</html>