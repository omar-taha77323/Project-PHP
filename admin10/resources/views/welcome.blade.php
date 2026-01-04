<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        /* نفس CSS الموجود عندك (Tailwind preflight + utilities) */
        /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */
        *,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, sans-serif;font-feature-settings:normal}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}
        .min-h-screen{min-height:100vh}.flex{display:flex}.grid{display:grid}.items-center{align-items:center}.justify-center{justify-content:center}.justify-between{justify-content:space-between}.gap-6{gap:1.5rem}.gap-4{gap:1rem}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-10{padding-top:2.5rem;padding-bottom:2.5rem}.max-w-7xl{max-width:80rem}.mx-auto{margin-left:auto;margin-right:auto}
        .rounded-lg{border-radius:0.5rem}.rounded-2xl{border-radius:1rem}.rounded-full{border-radius:9999px}
        .bg-white{background-color:#fff}.bg-gray-100{background-color:#f3f4f6}.text-center{text-align:center}
        .text-sm{font-size:.875rem;line-height:1.25rem}.text-base{font-size:1rem;line-height:1.5rem}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-3xl{font-size:1.875rem;line-height:2.25rem}.text-5xl{font-size:3rem;line-height:1}
        .font-semibold{font-weight:600}.font-bold{font-weight:700}
        .text-gray-600{color:#4b5563}.text-gray-700{color:#374151}.text-gray-900{color:#111827}.text-white{color:#fff}
        .shadow-2xl{box-shadow:0 25px 50px -12px rgb(0 0 0 / 0.25)}.shadow{box-shadow:0 1px 3px 0 rgb(0 0 0 / 0.1),0 1px 2px -1px rgb(0 0 0 / 0.1)}
        .border{border-width:1px}.border-gray-200{border-color:#e5e7eb}
        .w-full{width:100%}.max-w-xl{max-width:36rem}
        .inline-flex{display:inline-flex}.cursor-pointer{cursor:pointer}
        .transition{transition:all .2s ease}
        .btn{display:inline-flex;align-items:center;justify-content:center;gap:.5rem;padding:.75rem 1rem;border-radius:.75rem;font-weight:600}
        .btn-primary{background:#111827;color:#fff}
        .btn-primary:hover{transform:translateY(-1px);filter:brightness(1.05)}
        .btn-ghost{border:1px solid #e5e7eb;color:#111827;background:#fff}
        .btn-ghost:hover{transform:translateY(-1px);background:#f9fafb}
        .badge{display:inline-flex;align-items:center;gap:.5rem;padding:.35rem .65rem;border-radius:9999px;background:#f3f4f6;color:#374151;font-size:.875rem}
        .muted{color:#6b7280}
        .bg-dots-darker{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")}
        .bg-center{background-position:center}
        .hero-wrap{position:relative}
        .topbar{position:absolute;top:0;right:0;left:0;padding:1rem 1.5rem;display:flex;justify-content:flex-end}
        .link{font-weight:600;color:#374151}
        .link:hover{color:#111827;text-decoration:underline}
        .card{background:#fff;border:1px solid #e5e7eb;border-radius:1rem;box-shadow:0 25px 50px -12px rgb(0 0 0 / 0.12)}
        .divider{height:1px;background:#e5e7eb;margin:1.25rem 0}
        @media (min-width: 768px){
            .text-5xl{font-size:3.5rem}
        }
    </style>
</head>

<body class="antialiased">
<div class="hero-wrap min-h-screen bg-dots-darker bg-center bg-gray-100">
    @if (Route::has('login'))
        <div class="topbar">
            @auth
                <a class="link" href="{{ url('/home') }}">Home</a>
            @else
                <div class="inline-flex" style="gap: 1rem;">
                    <a class="link" href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a class="link" href="{{ route('register') }}">Register</a>
                    @endif
                </div>
            @endauth
        </div>
    @endif

    <div class="flex items-center justify-center px-6 py-10">
        <div class="w-full max-w-xl card p-6">
            <div class="text-center" style="margin-top: .5rem;">
                <div class="badge" style="margin: 0 auto;">
                    <span>🚀</span>
                    <span>Laravel Starter</span>
                </div>

                <h1 class="text-5xl font-bold text-gray-900" style="margin-top: 1rem;">
                    مرحبًا بك في <span style="text-decoration: underline;">{{ config('app.name', 'Laravel') }}</span>
                </h1>

                <p class="text-base muted" style="margin-top: .75rem; line-height: 1.8;">
                    صفحة ترحيبية بسيطة وأنيقة مع أزرار تسجيل الدخول/التسجيل.
                    يمكنك تعديل النصوص والروابط بسهولة.
                </p>
            </div>

            <div class="divider"></div>

            <div class="grid gap-4">
                @auth
                    <a href="{{ url('/home') }}" class="btn btn-primary transition">
                        الذهاب إلى لوحة التحكم
                        <span aria-hidden="true">→</span>
                    </a>

                    <p class="text-sm muted text-center">
                        أنت مسجّل دخولًا باسم: <strong class="text-gray-700">{{ auth()->user()->name ?? auth()->user()->email }}</strong>
                    </p>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary transition">
                        تسجيل الدخول
                        <span aria-hidden="true">→</span>
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-ghost transition">
                            إنشاء حساب جديد
                        </a>
                    @endif

                    <p class="text-sm muted text-center">
                        لمساعدتك: بعد تسجيل الدخول سيصبح رابط <strong class="text-gray-700">Home</strong> ظاهرًا بالأعلى تلقائيًا.
                    </p>
                @endauth
            </div>

            <div class="divider"></div>

            <div class="text-center text-sm muted">
                <span>© {{ date('Y') }}</span>
                <span>—</span>
                <span>{{ config('app.name', 'Laravel') }}</span>
                hellow world
            </div>
        </div>
    </div>
</div>
</body>
</html>
