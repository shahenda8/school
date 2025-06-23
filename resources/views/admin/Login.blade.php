<!-- login.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css')}}">
</head>
<body>
    <div class="background">
        <div class="login-container">
            <h2>New Generation School</h2>
            <form action="{{route('signin')}}" method="post">
                @csrf
                <input type="email" name="email" placeholder="E-mail">
                <div class="password-container">
                    <input type="password" name="password" id="password" placeholder="Password">
                    <span class="toggle-password" onclick="togglePassword()">👁️</span>
                </div>
                <button type="submit" class="btn">Log In</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/login.js')}}"></script>
</body>
</html>