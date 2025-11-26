<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edvizo Register</title>
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
                <h2>Register</h2>
                
                <form action="{{ route('register.action') }}" method="POST">
                    @csrf
                    @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li><i class="fas fa-exclamation-triangle"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
                    <div class="input-group">
                        <input type="text" name="name" placeholder="Full Name / Username" required>
                    </div>

                    <div class="input-group">
                        <input type="email" name="email" placeholder="Email Address" required>
                    </div>
                    
                    <div class="input-group password-group">
                        <input type="password" name="password" id="passInput" placeholder="Password" required>
                        <i class="fas fa-eye-slash toggle-password" onclick="togglePass('passInput', this)"></i>
                    </div>

                    <div class="input-group password-group">
                        <input type="password" name="password_confirmation" id="confPassInput" placeholder="Confirm Password" required>
                        <i class="fas fa-eye-slash toggle-password" onclick="togglePass('confPassInput', this)"></i>
                    </div>

                    <div class="options" style="justify-content: flex-start; gap: 10px;">
                        <input type="checkbox" required> 
                        <span style="font-size: 11px;">I agree with <b>Terms & Conditions</b> and <b>Privacy Policy</b></span>
                    </div>

                    <button type="submit" class="btn-signin">Sign Up</button>
                    
                    <div class="divider">Or</div>

                    <button type="button" class="btn-google">
                        <i class="fab fa-google"></i> Sign Up with Google
                    </button>
                </form>

                <p class="register-link">Already have an Account? <a href="{{ route('login') }}">Login.</a></p>
            </div>
        </div>
    </div>

    <script>
        function togglePass(inputId, icon) {
            const input = document.getElementById(inputId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            icon.classList.toggle('fa-eye-slash');
            icon.classList.toggle('fa-eye');
        }
    </script>

</body>
</html>