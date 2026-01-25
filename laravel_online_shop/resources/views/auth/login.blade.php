@extends('user.layouts.app')

@section('title', 'User Login - E-Commerce Store')

@section('content')
<main class="flex flex-1 flex-col items-center justify-center py-12 px-6">
    <div class="layout-content-container flex flex-col max-w-[480px] w-full">

        {{-- رسائل نجاح عامة (مثلاً بعد التسجيل) --}}
        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- أخطاء التحقق/الدخول --}}
        @if($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Headline Section -->
        <div class="text-center mb-8">
            <h1 class="text-[#111618] dark:text-white tracking-light text-[32px] font-bold leading-tight pb-2">
                Welcome Back
            </h1>
            <p class="text-[#617c89] dark:text-gray-400 text-base font-normal">
                Login to your account to continue shopping
            </p>
        </div>

        <!-- Login Card -->
        <div class="p-6 md:p-8 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.08)] bg-white dark:bg-[#1a2a32] border border-[#dbe2e6] dark:border-[#24353d]">
            <form class="flex flex-col gap-6" method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Field -->
                <label class="flex flex-col w-full">
                    <p class="text-[#111618] dark:text-white text-sm font-medium leading-normal pb-2">Email Address</p>
                    <input
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111618] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#dbe2e6] dark:border-[#24353d] bg-white dark:bg-[#1a2a32] h-14 placeholder:text-[#617c89] p-[15px] text-base font-normal"
                        placeholder="name@example.com"
                        type="email"
                    />
                </label>

                <!-- Password Field -->
                <label class="flex flex-col w-full">
                    <div class="flex justify-between items-center pb-2">
                        <p class="text-[#111618] dark:text-white text-sm font-medium leading-normal">Password</p>

                        @if (Route::has('password.request'))
                            <a class="text-primary text-xs font-medium hover:underline" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <div class="flex w-full flex-1 items-stretch rounded-lg group">
                        <input
                            name="password"
                            required
                            autocomplete="current-password"
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111618] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#dbe2e6] dark:border-[#24353d] bg-white dark:bg-[#1a2a32] h-14 placeholder:text-[#617c89] p-[15px] rounded-r-none border-r-0 text-base font-normal"
                            placeholder="••••••••"
                            type="password"
                        />
                        <div class="text-[#617c89] flex border border-[#dbe2e6] dark:border-[#24353d] bg-white dark:bg-[#1a2a32] items-center justify-center pr-[15px] rounded-r-lg border-l-0 cursor-pointer">
                            <span class="material-symbols-outlined text-xl">visibility</span>
                        </div>
                    </div>
                </label>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center gap-2">
                    <input
                        class="w-4 h-4 text-primary bg-white dark:bg-[#1a2a32] border-[#dbe2e6] dark:border-[#24353d] rounded focus:ring-primary focus:ring-offset-0"
                        id="remember"
                        name="remember"
                        type="checkbox"
                        {{ old('remember') ? 'checked' : '' }}
                    />
                    <label class="text-sm font-normal text-[#617c89] dark:text-gray-400 cursor-pointer" for="remember">
                        Remember me for 30 days
                    </label>
                </div>

                <!-- Login CTA -->
                <button class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-[#1089c8] transition-colors shadow-sm" type="submit">
                    <span class="truncate">Login</span>
                </button>

                <!-- Divider -->
                <div class="relative flex items-center py-2">
                    <div class="flex-grow border-t border-[#dbe2e6] dark:border-[#24353d]"></div>
                    <span class="flex-shrink mx-4 text-xs text-[#617c89] uppercase tracking-widest font-medium">Or continue with</span>
                    <div class="flex-grow border-t border-[#dbe2e6] dark:border-[#24353d]"></div>
                </div>

                <!-- Social Buttons (وهمية فقط UI) -->
                <div class="grid grid-cols-2 gap-4">
                    <button class="flex items-center justify-center gap-2 rounded-lg border border-[#dbe2e6] dark:border-[#24353d] h-11 px-4 text-sm font-medium text-[#111618] dark:text-white hover:bg-gray-50 dark:hover:bg-[#24353d] transition-colors" type="button">
                        <div class="size-5" data-alt="Google company logo icon">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"></path>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.34-4.53z" fill="#EA4335"></path>
                            </svg>
                        </div>
                        Google
                    </button>

                    <button class="flex items-center justify-center gap-2 rounded-lg border border-[#dbe2e6] dark:border-[#24353d] h-11 px-4 text-sm font-medium text-[#111618] dark:text-white hover:bg-gray-50 dark:hover:bg-[#24353d] transition-colors" type="button">
                        <span class="material-symbols-outlined text-xl text-[#1877F2]">social_leaderboard</span>
                        Facebook
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer Link -->
        <div class="mt-8 text-center">
            <p class="text-[#617c89] dark:text-gray-400 text-sm font-normal">
                Don't have an account?
                <a class="text-primary font-bold hover:underline transition-all" href="{{ route('register') }}">Register</a>
            </p>
        </div>

        <!-- Bottom Footer Info -->
        <div class="mt-10 flex items-center justify-center gap-2 text-[#617c89] dark:text-gray-500 text-xs">
            <span class="material-symbols-outlined text-sm">lock</span>
            Secure, encrypted login process
        </div>

    </div>
</main>
@endsection
