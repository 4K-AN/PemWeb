<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edvizo Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="container">
        <div class="login-card">
            
            <div class="left-panel">
                <div class="logo">
                    <img src="{{ asset('img/Logo.png') }}" alt="Logo"> Edvizo
                </div>
                <div class="slogan">
                    <h1><span class="highlight">Kompas</span> Anda untuk <span class="highlight">Jurusan</span> yang Tepat.</h1>
                </div>
            </div>

            <div class="right-panel">
                <h2>Login</h2>
                
                @if(session('success'))
                    <div class="alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif
                
                <form action="{{ route('login.action') }}" method="POST">
                    @csrf

                    @if($errors->any())
                        <div class="alert-error">
                            @foreach($errors->all() as $error)
                                <p><i class="fas fa-exclamation-circle"></i> {{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="input-group">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    
                    <div class="input-group password-group">
                        <input type="password" name="password" id="passwordInput" placeholder="Password" required>
                        <i class="fas fa-eye-slash toggle-password" id="togglePassword"></i>
                    </div>

                    <div class="options">
                        <label>
                           <input type="checkbox" name="remember" id="remember"> Remember Me
                        </label>
                        <a href="#">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn-signin">Sign In</button>
                    
                    <div class="divider">Or</div>

                    <button type="button" class="btn-google">
                        <i class="fab fa-google"></i> Sign In with Google
                    </button>
                </form>

                <p class="register-link">Does not have an account? <a href="{{ route('register') }}">Register here.</a></p>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#passwordInput');

        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });
    </script>

</body>
</html>