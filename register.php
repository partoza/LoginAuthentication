<?php
include 'helpers/not_authenticated.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Music Player</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/musicplayer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<style>
    <style>body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
        overflow: hidden;
    }

    .login.btn:hover {
        background-color: #128c44 !important;
        color: rgb(29, 29, 29) !important;
    }

    #toggle-password.btn:hover {
        background-color: rgb(255, 255, 255) !important;
        color: rgb(29, 29, 29) !important;
    }

    #confirm-toggle-password.btn:hover {
        background-color: rgb(255, 255, 255) !important;
        color: rgb(29, 29, 29) !important;
    }

    a:hover {
        color: rgb(28, 150, 12) !important;
    }
</style>
<div class="video-container position-fixed w-100 h-100 zindex-n1">
    <video class="w-100 h-100" autoplay loop muted style="object-fit: cover;">
        <source src="assets/backgroundvideo.mp4" type="video/mp4">
    </video>
</div>

<div class="container">
    <div class="d-flex mx-5 mx-md-2 justify-content-center align-items-center vh-100 position-relative">
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-md-12 text-center mb-4 position-fixed" style="margin-top: -150px">
                    <p class="display-1" id="phrases"></p>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-card card pt-4 px-4 shadow-lg bg-dark text-white">
                        <p class="display-6 fw-bold mb-2" style="color: #1ED760">Register Now</p>
                        <?php if (isset($_SESSION['errors'])): ?>
                            <div class="alert alert-danger py-1 my-0">
                                <?php
                                echo $_SESSION['errors'];
                                unset($_SESSION['errors']);
                                ?>
                            </div>
                        <?php endif; ?>
                        <form class="form" action="actions/register_action.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="password"
                                        required />
                                    <button type="button" class="btn btn-outline-secondary bg-white border-0"
                                        id="toggle-password">
                                        <i class="bi bi-eye-slash-fill" style="font-size: 20px;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="confirmpassword"
                                        id="confirmpassword" required />
                                    <button type="button" class="btn btn-outline-secondary bg-white border-0"
                                        id="confirm-toggle-password">
                                        <i class="bi bi-eye-slash-fill" style="font-size: 20px;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit"
                                    class="login btn text-white d-flex justify-content-center align-items-center"
                                    style="width: 100%; background-color: #1ED760; transition: background-color 0.3s;">
                                    Register&nbsp;
                                    <i class="bi bi-box-arrow-in-right mt-1" style="font-size: 20px;"></i>
                                </button>
                            </div>
                            <div class="text-center fs-6 fw-lighter">
                                <hr style="color: #1ED760;">
                                <a href="login.php" style="color: #1ED760" class="text-decoration-none">I have
                                    account, back to login.</a>
                            </div>
                        </form>
                        <br>
                    </div>
                </div>
                <div class="position-fixed" style="margin-top: 500px">
                    <?php include './features/footer.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
<script>
    new Typed('#phrases', {
        strings: [
            'Join us <span style="color: #1ED760; padding-left: 10px; padding-right: 10px;">today.</span>',
            'Start your <span style="color: #1ED760; padding-left: 10px; padding-right: 10px;">journey.</span>',
            'Start <span style="color: #1ED760; padding-left: 10px; padding-right: 10px;">listening now.</span>',
            'Your <span style="color: #1ED760; padding-left: 10px; padding-right: 10px;">playlist,</span> Your <span style="color: #1ED760; padding-left: 10px; padding-right: 10px;">vibe.</span>'
        ],
        typeSpeed: 100,
        loop: true,
        backDelay: 1000,
        backSpeed: 50,
        showCursor: false
    });

    const togglePassword = document.getElementById('toggle-password');
    const confirmtogglePassword = document.getElementById('confirm-toggle-password');
    const passwordInput = document.getElementById('password');
    const confirmpasswordInput = document.getElementById('confirmpassword');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;

        this.querySelector('i').classList.toggle('bi-eye-fill');
        this.querySelector('i').classList.toggle('bi-eye-slash-fill');
    });

    confirmtogglePassword.addEventListener('click', function () {
        const type = confirmpasswordInput.type === 'password' ? 'text' : 'password';
        confirmpasswordInput.type = type;

        this.querySelector('i').classList.toggle('bi-eye-fill');
        this.querySelector('i').classList.toggle('bi-eye-slash-fill');
    });
</script>
</body>

</html>