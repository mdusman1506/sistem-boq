<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIM BOQ Enterprise</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --surface: #ffffff;
            --background: #f8fafc;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: url('https://images.unsplash.com/photo-1541888086425-d81bb19240f5?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        /* Overlay Gradient */
        .overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(15,23,42,0.9) 0%, rgba(30,58,138,0.7) 100%);
            z-index: -1;
        }
        .login-wrapper {
            width: 100%;
            max-width: 480px;
            padding: 2rem;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            padding: 3rem;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .login-card:hover {
            transform: translateY(-5px);
        }
        .title {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        .subtitle {
            color: #64748b;
            font-size: 0.95rem;
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .form-floating > label {
            color: #64748b;
        }
        .form-control {
            border-radius: 0.75rem;
            border: 1px solid #cbd5e1;
            background-color: #f8fafc;
            height: 3.5rem;
            padding-left: 1.25rem;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            background-color: #ffffff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15);
        }
        .btn-login {
            background: linear-gradient(135deg, var(--primary) 0%, #3b82f6 100%);
            border: none;
            border-radius: 0.75rem;
            padding: 0.875rem;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 1.05rem;
            letter-spacing: 0.5px;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.4);
            transform: translateY(-2px);
            background: linear-gradient(135deg, var(--primary-hover) 0%, #2563eb 100%);
        }
        .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            border-radius: 0.75rem;
            padding: 1rem;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }
        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="text-center mb-4">
                @if(!empty($globalSettings['logo_path']))
                    <img src="{{ asset('storage/' . $globalSettings['logo_path']) }}" alt="Logo" class="mb-2" style="max-width: 100%; max-height: 90px; object-fit: contain;">
                @else
                    <div class="d-inline-block bg-primary text-white p-3 rounded-4 mb-3 shadow-sm" style="background: linear-gradient(135deg, var(--primary), #3b82f6) !important;">
                        <i class="bi bi-buildings-fill fs-2"></i>
                    </div>
                    <h2 class="title">SIM BOQ</h2>
                @endif
            </div>
            
            <p class="subtitle">Sistem Informasi Manajemen Dokumen Proyek</p>

            @if($errors->any())
                <div class="alert-error">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-floating mb-4 position-relative">
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>
                    <label for="username">Username</label>
                    <i class="bi bi-person input-icon"></i>
                </div>
                
                <div class="form-floating mb-4 position-relative">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required style="padding-right: 2.5rem;">
                    <label for="password">Password</label>
                    <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent toggle-password" data-target="password" style="z-index: 10; color: #94a3b8; padding-right: 1.25rem;">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                
                <div class="d-grid mt-5">
                    <button type="submit" class="btn btn-login">Masuk ke Sistem <i class="bi bi-arrow-right ms-2"></i></button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('click', function(e) {
            if (e.target.closest('.toggle-password')) {
                const btn = e.target.closest('.toggle-password');
                const targetId = btn.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = btn.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            }
        });
    </script>
</body>
</html>
