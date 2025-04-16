<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center min-h-screen bg-green-50">
    <form method="POST" action="{{ route('login.process') }}" class="bg-white p-6 rounded shadow-md w-full max-w-md">
        @csrf
        <h2 class="text-2xl font-bold mb-6 text-center text-green-700">Login</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="mb-4">
            <label class="block text-green-800 mb-1">Nomor HP</label>
            <input type="text" name="phone" value="{{ old('phone') }}"
                   class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-green-400" required>
        </div>

        <div class="mb-6">
            <label class="block text-green-800 mb-1">Password</label>
            <input type="password" name="password"
                   class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-green-400" required>
        </div>

        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Login</button>
    </form>
</body>
</html>
