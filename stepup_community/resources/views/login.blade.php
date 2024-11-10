<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StepUp Community Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/login_page.css') }}">
</head>
  <body>
        <div class="d-flex justify-content-center align-items-center w-100 login-container">
            <div class="login text-center rounded bg-white">
                <div class="mt-5 mb-3">
                    <img src="{{ asset('img/logo.png') }}" alt="">
                </div>
                <h4 class="text-muted px-2 mb-4">Welcome To StepUp Community</h4>
                @if (session('err'))
                    <div class="alert alert-danger mx-3">
                        {{ session('err') }}
                    </div>
                @endif
                <div class="pt-2 mx-3">
                    <a href="{{ route('google_login') }}" class="d-flex justify-content-center align-items-center text-decoration-none gap-2"><img src="{{ asset('img/google.png') }}" alt="google.png">Continue with google</a>
                </div>
                <div class="mb-3">
                    <small class="lgoin-text">login with google.</small>
                </div>
            </div>
        </div>
  </body>
</html>
