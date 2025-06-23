<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - New Generation School</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <style>
    body {
      background-color: #fddcc1;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-container {
      background-color: #2e7d32;
      border: 20px solid #7a3e14;
      border-radius: 10px;
      margin: 30px auto;
      max-width: 800px;
      height: 500px;
      position: relative;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }

    .form-box {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(255, 255, 255, 0.1);
      padding: 30px;
      border-radius: 10px;
      width: 300px;
    }

    .form-box h2 {
      color: white;
      text-align: center;
      margin-bottom: 20px;
      font-weight: bold;
    }

    .form-control {
      margin-bottom: 15px;
    }

    .btn-login {
      width: 100%;
    }

    .books {
      position: absolute;
      bottom: 20px;
      left: 30px;
      display: flex;
      align-items: end;
    }

    .books div {
      width: 20px;
      height: 60px;
      margin: 0 5px;
      border-radius: 3px;
    }

    .grass {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 60px;
      background-color: #4caf50;
      border-top-left-radius: 30px;
      border-top-right-radius: 30px;
    }

    @media (max-width: 576px) {
      .form-box {
        width: 90%;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="form-box">
      <h2>New Generation School</h2>
<form method="POST" action="{{ route('login.submit') }}">
  @csrf
  <input type="text" class="form-control" placeholder="User Name" name="user_name" required />
  <input type="password" class="form-control" placeholder="Password" name="password" required />
  <button type="submit" class="btn btn-success btn-login">Log in</button>

  @if(session('error'))
    <div class="alert alert-danger mt-3 text-center">
      {{ session('error') }}
    </div>
  @endif
</form>
    </div>
    <div class="books">
      <div style="background-color: #ffda44;"></div>
      <div style="background-color: #3c9ee5;"></div>
      <div style="background-color: #ef476f;"></div>
      <div style="background-color: #06d6a0; width: 10px; height: 40px;"></div>
      <div style="background-color: #f78c6b; width: 10px; height: 40px;"></div>
    </div>
    <div class="grass"></div>
  </div>
</body>
</html>
