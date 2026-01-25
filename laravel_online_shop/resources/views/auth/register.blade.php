@extends('user.layouts.app')

@section('title', 'User Registration - E-Commerce Store')

@section('content')
<main class="flex-grow flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-[480px] flex flex-col items-center">

        {{-- Errors --}}
        @if ($errors->any())
            <div class="w-full mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Headline Text Section -->
        <div class="text-center mb-8">
            <h1 class="text-[#111618] dark:text-white tracking-tight text-[32px] font-bold leading-tight pb-2">
                Create an account
            </h1>
            <p class="text-[#617c89] dark:text-gray-400 text-base font-normal leading-normal">
                Join our community today and start shopping.
            </p>
        </div>

        <!-- Registration Card -->
        <div class="bg-white dark:bg-background-dark/50 border border-[#dbe2e6] dark:border-white/10 rounded-xl p-8 shadow-sm w-full">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Full Name Field -->
                <div class="flex flex-col gap-2">
                    <label class="text-[#111618] dark:text-gray-200 text-sm font-medium leading-normal">Full Name</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#617c89] text-xl">person</span>
                        <input
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autocomplete="name"
                            class="flex w-full min-w-0 resize-none overflow-hidden rounded-lg text-[#111618] dark:text-white dark:bg-transparent focus:outline-0 focus:ring-2 focus:ring-primary/20 border border-[#dbe2e6] dark:border-white/20 h-14 placeholder:text-[#617c89] pl-12 pr-4 text-base font-normal leading-normal transition-all"
                            placeholder="Enter your name"
                            type="text"
                        />
                    </div>
                </div>

                <!-- Email Address Field -->
                <div class="flex flex-col gap-2">
                    <label class="text-[#111618] dark:text-gray-200 text-sm font-medium leading-normal">Email Address</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#617c89] text-xl">mail</span>
                        <input
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            class="flex w-full min-w-0 resize-none overflow-hidden rounded-lg text-[#111618] dark:text-white dark:bg-transparent focus:outline-0 focus:ring-2 focus:ring-primary/20 border border-[#dbe2e6] dark:border-white/20 h-14 placeholder:text-[#617c89] pl-12 pr-4 text-base font-normal leading-normal transition-all"
                            placeholder="email@example.com"
                            type="email"
                        />
                    </div>
                </div>

                <!-- Password Field -->
                <div class="flex flex-col gap-2">
                    <label class="text-[#111618] dark:text-gray-200 text-sm font-medium leading-normal">Password</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#617c89] text-xl">lock</span>
                        <input
                            name="password"
                            required
                            autocomplete="new-password"
                            class="flex w-full min-w-0 resize-none overflow-hidden rounded-lg text-[#111618] dark:text-white dark:bg-transparent focus:outline-0 focus:ring-2 focus:ring-primary/20 border border-[#dbe2e6] dark:border-white/20 h-14 placeholder:text-[#617c89] pl-12 pr-12 text-base font-normal leading-normal transition-all"
                            placeholder="Create a password"
                            type="password"
                        />
                        <button class="absolute right-4 top-1/2 -translate-y-1/2 text-[#617c89] hover:text-[#111618] dark:hover:text-white" type="button">
                            <span class="material-symbols-outlined text-xl">visibility</span>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div class="flex flex-col gap-2">
                    <label class="text-[#111618] dark:text-gray-200 text-sm font-medium leading-normal">Confirm Password</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#617c89] text-xl">lock_clock</span>
                        <input
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            class="flex w-full min-w-0 resize-none overflow-hidden rounded-lg text-[#111618] dark:text-white dark:bg-transparent focus:outline-0 focus:ring-2 focus:ring-primary/20 border border-[#dbe2e6] dark:border-white/20 h-14 placeholder:text-[#617c89] pl-12 pr-4 text-base font-normal leading-normal transition-all"
                            placeholder="Repeat your password"
                            type="password"
                        />
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button class="w-full flex cursor-pointer items-center justify-center overflow-hidden rounded-lg h-14 px-4 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-all shadow-md active:scale-[0.98]" type="submit">
                        Register
                    </button>
                </div>

                <!-- Divider -->
                <div class="flex items-center gap-4 py-2">
                    <div class="flex-grow h-px bg-[#dbe2e6] dark:bg-white/10"></div>
                    <span class="text-xs text-[#617c89] uppercase font-bold tracking-wider">or</span>
                    <div class="flex-grow h-px bg-[#dbe2e6] dark:bg-white/10"></div>
                </div>

                <!-- Social Option (UI فقط) -->
                <button class="w-full flex items-center justify-center gap-3 border border-[#dbe2e6] dark:border-white/10 rounded-lg h-12 bg-white dark:bg-transparent text-[#111618] dark:text-white text-sm font-medium hover:bg-gray-50 dark:hover:bg-white/5 transition-colors" type="button">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"></path>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.66l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
                    </svg>
                    Sign up with Google
                </button>

                <!-- Footer Links -->
                <div class="mt-8 text-center border-t border-[#f0f3f4] dark:border-white/10 pt-6">
                    <p class="text-sm text-[#617c89] dark:text-gray-400">
                        Already have an account?
                        <a class="text-primary font-bold hover:underline" href="{{ route('login') }}">Sign In</a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Legal Footer -->
        <div class="mt-8 px-8 text-center">
            <p class="text-xs text-[#617c89] dark:text-gray-500 leading-relaxed">
                By clicking "Register", you agree to our
                <a class="underline hover:text-primary" href="#">Terms of Service</a> and
                <a class="underline hover:text-primary" href="#">Privacy Policy</a>.
            </p>
        </div>
    </div>
</main>
@endsection
