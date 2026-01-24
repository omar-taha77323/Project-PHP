@extends('user.layouts.app')

@section('content')
    <main class="min-h-screen bg-[#f6f7f8] py-10 px-4">
        <div class="max-w-4xl mx-auto">

            {{-- Breadcrumb --}}
            <div class="text-sm text-gray-500 mb-4">
                <a href="{{ route('user.home') }}" class="hover:underline">Home</a>
                <span class="mx-1">/</span>
                <span>Account</span>
                <span class="mx-1">/</span>
                <span class="text-primary font-medium">Profile</span>
            </div>

            {{-- Page Title --}}
            <h1 class="text-3xl font-bold text-gray-900">Account Settings</h1>
            <p class="text-gray-500 mt-1">Manage your personal information and security settings.</p>

            {{-- Alerts --}}
            @if (session('success'))
                <div class="mt-6 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mt-6 rounded-lg border border-red-200 bg-red-50 text-red-800 px-4 py-3">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Main Card --}}
            <div class="mt-8 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                {{-- Top section (avatar + name) --}}
                <div class="px-6 py-8 text-center border-b border-gray-100">
                    <div
                        class="mx-auto w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                        {{-- لو عندك صورة مستخدم مستقبلاً حطها هنا --}}
                        <span class="text-3xl text-gray-500">👤</span>
                    </div>

                    <h2 class="mt-4 text-xl font-semibold text-gray-900">
                        {{ auth()->user()->name }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Member since {{ optional(auth()->user()->created_at)->format('F Y') }}
                    </p>
                </div>

                {{-- Form --}}
                <div class="px-6 py-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Personal Information</h3>

                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Full Name --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">👤</span>
                                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                                    class="w-full rounded-lg border border-gray-200 px-10 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30"
                                    required>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">✉️</span>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                    class="w-full rounded-lg border border-gray-200 px-10 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30"
                                    required>
                            </div>

                            <p class="text-xs text-gray-400 mt-2">
                                This email address will be used for order notifications and account recovery.
                            </p>
                        </div>

                        {{-- Actions --}}
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-4">
                            <a href="{{ url()->previous() }}" class="text-sm text-gray-500 hover:text-gray-700">
                                Cancel Changes
                            </a>

                            <div class="flex items-center gap-3">
                                <button type="submit"
                                    class="inline-flex items-center justify-center rounded-lg bg-primary px-5 py-3 text-white font-semibold hover:opacity-90 transition">
                                    Save Changes
                                </button>

                                {{-- Logout button داخل نفس الصفحة --}}
                    </form>

                    {{-- فورم Logout مستقل تماماً --}}
                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="px-6 py-2 rounded-lg border">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            </div>

        </div>
        </div>

        {{-- Short footer --}}
        <div class="mt-10 text-center text-xs text-gray-400">
            © {{ date('Y') }} E-Commerce Store. All rights reserved.
        </div>

        </div>
    </main>
@endsection
