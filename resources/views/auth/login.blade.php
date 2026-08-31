<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ $globalSetting->website_name ?? config('app.name') }} Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    @if($globalSetting && $globalSetting->favicon)
    <link rel="icon" href="{{ Storage::url($globalSetting->favicon) }}">
    @elseif($globalSetting && $globalSetting->logo)
    <link rel="icon" href="{{ Storage::url($globalSetting->logo) }}">
    @else
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .login-card {
            position: relative;
            min-height: 400px;
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-radius: 20px;
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(201, 162, 39, 0.1);
        }
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 48px;
            right: 48px;
            height: 3px;
            background: linear-gradient(90deg, transparent, #C9A227 20%, #F5D76E 50%, #C9A227 80%, transparent);
            border-radius: 0 0 3px 3px;
        }
        .login-input {
            width: 100%;
            padding: 10px 14px 10px 40px;
            border-radius: 10px;
            border: 1.5px solid #e5e7eb;
            background: #f9fafb;
            font-size: 13px;
            color: #111827;
            outline: none;
            transition: all 0.2s ease;
        }
        .login-input:focus {
            border-color: #C9A227;
            background: white;
            box-shadow: 0 0 0 3px rgba(201, 162, 39, 0.08);
        }
        .login-input::placeholder {
            color: #9ca3af;
        }
    </style>
</head>
<body class="font-sans min-h-screen flex items-center justify-center relative overflow-hidden" style="background-image: url('{{ Storage::url('bg/bg-login.png') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-masjid/60"></div>

    <div class="fixed top-4 right-4 z-50 max-w-sm w-full space-y-2">
        <x-flash-message type="success" :message="session('success')" />
        <x-flash-message type="error" :message="$errors->first()" />
    </div>

    <div class="relative z-10 w-full max-w-[340px] mx-4">
        <div class="login-card p-5">
            <div class="text-center mb-6">
                @if($globalSetting && $globalSetting->logo)
                <div class="w-24 h-24 mx-auto mb-3 rounded-2xl bg-gradient-to-br from-gold/15 to-amber-500/15 p-2 flex items-center justify-center transition-all duration-300 hover:bg-gold/20">
                    <img src="{{ Storage::url($globalSetting->logo) }}" alt="{{ $globalSetting->website_name ?? 'Logo' }}" fetchpriority="high" width="80" height="80" class="w-full h-full object-contain transition-all duration-300 hover:scale-105 hover:drop-shadow-[0_0_10px_rgba(201,162,39,0.5)] hover:brightness-110">
                </div>
                @else
                <div class="w-14 h-14 mx-auto mb-3 rounded-2xl bg-gradient-to-br from-gold to-amber-500 flex items-center justify-center shadow-lg shadow-gold/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/><path d="M12 2v20" stroke="#F5D76E" stroke-width="2.5"/></svg>
                </div>
                @endif
                <h1 class="text-xl font-bold text-gray-900 font-serif tracking-wide">{{ $globalSetting->website_name ?? 'DUYUFUNA' }}</h1>
                <p class="text-gold text-[11px] font-bold tracking-[0.18em] uppercase mt-1.5">{{ $globalSetting->tagline ?? 'MELAYANI TAMU ALLAH, SEPENUH HATI' }}</p>
                <p class="text-xs text-gray-400 mt-2">Silakan masuk untuk mengelola website.</p>
            </div>

            <div class="relative my-5">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-100"></div></div>
            </div>

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <div class="mb-3">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Email atau Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        </div>
                        <input type="text" id="login_identifier" value="{{ old('email') }}"
                            class="login-input"
                            autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false"
                            required autofocus>
                        <input type="hidden" name="email" id="login_account" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="mb-3" x-data="{ show: false }">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </div>
                        <input :type="show ? 'text' : 'password'" name="password" id="password"
                            class="login-input pr-11"
                            required>
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" x-cloak><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-5">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-3.5 h-3.5 rounded border-gray-300 text-gold focus:ring-gold/30">
                        <span class="text-xs text-gray-500">Ingat saya</span>
                    </label>
                    <a href="#" class="text-xs text-gold hover:text-amber-500 font-medium transition">Lupa Password?</a>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-gold to-amber-500 hover:from-amber-500 hover:to-gold text-white font-semibold text-sm py-2 px-4 rounded-lg transition-all duration-300 shadow-lg shadow-gold/25 hover:shadow-gold/40 active:scale-[0.98]">
                    <span class="flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                        Login
                    </span>
                </button>
            </form>

            <p class="text-center text-[10px] text-gray-400 tracking-wide mt-5">&copy; 2026 DUYUFUNA. All rights reserved.</p>
        </div>

    <script>
        const loginEmail = document.getElementById('login_identifier');
        const loginEmailHidden = document.getElementById('login_account');
        loginEmail.addEventListener('input', function () {
            loginEmailHidden.value = this.value;
        });
        document.getElementById('loginForm').addEventListener('submit', function () {
            loginEmailHidden.value = loginEmail.value;
        });
    </script>

    <script>
        (function () {
            var sig = '0 0 84 134';
            function removeMarks(root) {
                if (!root || root.nodeType !== 1) return;
                var marks = root.querySelectorAll('svg[viewBox*="' + sig + '"]');
                for (var i = 0; i < marks.length; i++) {
                    var parent = marks[i].parentNode;
                    if (parent && parent.parentNode) {
                        parent.parentNode.removeChild(parent);
                    }
                }
            }
            function start() {
                removeMarks(document.body);
                new MutationObserver(function (mutations) {
                    mutations.forEach(function (mutation) {
                        mutation.addedNodes.forEach(removeMarks);
                    });
                }).observe(document.body, { childList: true, subtree: true });
                document.addEventListener('focusin', function () { removeMarks(document.body); });
                setInterval(function () { removeMarks(document.body); }, 800);
            }
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', start);
            } else {
                start();
            }
        })();
    </script>
</body>
</html>
