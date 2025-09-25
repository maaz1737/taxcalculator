<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
        <!-- Title -->
        <h2 class="text-2xl font-bold text-center text-gray-800">Welcome Back 👋</h2>
        <p class="text-gray-500 text-center mt-2">Login to your account</p>

        <!-- Google Button -->
        <a href="/auth/google"
            class="mt-6 flex items-center justify-center gap-2 w-full px-4 py-2 border rounded-lg bg-white text-gray-700 font-medium shadow-sm hover:bg-gray-50 transition">
            <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5" alt="Google" />
            Continue with Google
        </a>

        <!-- Divider -->
        <div class="flex items-center my-6">
            <hr class="flex-grow border-gray-300" />
            <span class="mx-3 text-gray-400 text-sm">OR</span>
            <hr class="flex-grow border-gray-300" />
        </div>

        <!-- Login Form -->
        <form action="/login" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded-lg font-semibold shadow-md hover:bg-indigo-700 transition">
                Login
            </button>
        </form>

        <!-- Footer Links -->
        <p class="text-center text-gray-500 text-sm mt-6">
            Don’t have an account? <a href="/register" class="text-indigo-600 hover:underline">Sign up</a>
        </p>
    </div>

</body>

</html>