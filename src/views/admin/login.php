<?php include(__DIR__ . '/../partials/head.php'); ?>
<body>
    
    
<?php include(__DIR__ . '/../partials/nav.php'); ?>

<main class="container">
  <form action="admin" method="post">
    <input type="hidden" name="module" value="dashboard">
    <input type="hidden" name="action" value="login">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

    <img class="mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Admin Login</h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
       <input type="password" class="form-control" id="floatingInput"  name="password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
    <p class="mt-5 mb-3 text-muted">&copy; <?= date('Y'); ?></p>
  </form>
</main>


    <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

      
  </body>
</html>
