<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Planner U</title>
    @vite(['resources/css/auth.css'])
</head>

<body>

    <div class="auth-wrapper">
        <div class="auth-wrapper">
            <div class="title">
                <img src="{{ asset('images/logo-planneru.png') }}" alt="Planner U Logo">
            </div>
            <div class="subtitle">Project Management Planner Telkom University</div>

            <div class="card">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label>USERNAME</label>
                        <input type="text" name="name" placeholder="name" required>
                    </div>

                    <div class="form-group">
                        <label>EMAIL ADDRESS</label>
                        <input type="email" name="email" placeholder="name@gmail.com" required>
                    </div>

                    <div class="form-group">
                        <label>PASSWORD</label>
                        <input type="password" name="password" placeholder="********" required id="password">
                        <svg class="password-icon" onclick="togglePassword()" xmlns="http://www.w3.org/2000/svg"
                            width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </div>

                    <button type="submit" class="btn">Sign Up</button>
                </form>
            </div>

            <div class="bottom-text">
                already have an account? <a href="{{ route('login') }}">Sign In</a>
            </div>
        </div>

        <script>
            function togglePassword() {
                const pwd = document.getElementById('password');
                if (pwd.type === 'password') {
                    pwd.type = 'text';
                } else {
                    pwd.type = 'password';
                }
            }
        </script>

</body>

</html>
