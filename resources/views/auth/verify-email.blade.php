<x-app
    :title="'Verify Email'"
    :des="'Please verify your email address before continuing.'"
    :key="'verify-email'" />

<div class="min-h-[50vh] bg-white dark:bg-slate-900 text-gray-100 flex flex-col items-center justify-center px-4 py-10">
    <div class="w-full max-w-sm sm:max-w-md">
        <div class=" bg-gray-200  dark:bg-slate-800 shadow-xl rounded-2xl p-6 sm:p-8 text-center border border-slate-700">
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white mb-3 sm:mb-4">
                {{ __('Verify Your Email Address') }}
            </h2>

            @if (session('status'))
            <div class="mb-3 sm:mb-4 text-green-400 bg-green-900/30 border border-green-800 rounded-lg px-3 sm:px-4 py-2">
                {{ session('status') }}
            </div>
            @endif

            <p class="dark:text-gray-100 text-slate-300 mb-2 sm:mb-3 text-sm sm:text-base">
                {{ __('Before proceeding, please check your email for a verification link.') }}
            </p>
            <p class="dark:text-gray-100 text-slate-400 mb-5 sm:mb-6 text-sm sm:text-base">
                {{ __('If you did not receive the email, click below to resend it.') }}
            </p>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-medium py-2 sm:py-2.5 px-4 rounded-lg transition-all duration-200">
                    {{ __('Resend Verification Email') }}
                </button>
            </form>
        </div>

        <div class="text-center mt-4 sm:mt-6">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="text-xs sm:text-sm text-slate-700 dark:text-slate-400 hover:text-indigo-400 transition-all duration-200">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="get" class="hidden">
                @csrf
            </form>
        </div>
    </div>
</div>

<x-appfooter />