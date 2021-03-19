<?php
session_start();
if (isset($_SESSION['login'])) {
  header("Location: http://localhost/inventory/index");
  exit;
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/login.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <title>SMANGER</title>
</head>

<body>

  <div class="container">
    <div class="wrapper">
      <h1>SMANGER</h1>
      <div class="form">
        <h2>Connect</h2>
        <div class="inp">
          <label for="email">Your EMAIL :</label>
          <input id="email" type="text" autocomplete="off">
        </div>
        <div class="inp">
          <label for="password">Password :</label>
          <input id="password" type="password" autocomplete="off">
        </div>
        <button id="login">Login</button>
      </div>
      <div class="action">
        <span>any action you take on this website will be on your responsibility.</span>
      </div>
    </div>
  </div>
</body>
<script>
  let email = document.querySelector("#email");
  let password = document.querySelector("#password");

  document.querySelector("#login").addEventListener('click', () => {
    let validEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email.value);
    let validPassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/.test(password.value);

    if (password.value.trim() === '' || email.value.trim() === '' || !validEmail || validPassword) {
      Swal.fire('Oops...', 'Something went wrong!', 'error');
    } else {
      let fd = new FormData();
      fd.append('email', email.value);
      fd.append('password', password.value);
      postData('http://localhost/inventory/inc/login', fd);
    }

  });

  let postData = async (url, data) => {
    let response = await fetch(url, {
      method: 'POST',
      body: data
    });
    let result = await response.json();

    if (result.message == true) {
      location.href = 'http://localhost/inventory/index.php';
    } else {
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: result.message,
        showConfirmButton: false,
        timer: 2000
      });
    }
  }
</script>

</html>