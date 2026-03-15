<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社員管理アプリ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <header class="bg-blue-600 text-white shadow">
        <div class="max-w-5xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">社員管理アプリ</h1>
<nav class="bg-blue-600 text-white p-4 mb-6">
    <div class="max-w-5xl mx-auto flex gap-6">

        <a href="{{ route('dashboard') }}"
           class="hover:underline">
            ダッシュボード
        </a>

        <a href="{{ route('employees.index') }}"
           class="hover:underline">
            社員一覧
        </a>

        <a href="{{ route('departments.index') }}"
           class="hover:underline">
            部署一覧
        </a>

    </div>
</nav>        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-8">
        @yield('content')
    </main>

</body>
</html>