<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>@yield('title', 'Dashboard Absen')</title>
  </head>
  <body class="bg-gray-100">
    <div class="flex h-screen">

      <!-- Sidebar -->
      <aside class="w-64 bg-blue-700 text-white flex flex-col">
        <div class="p-4 text-2xl font-bold border-b border-blue-500">
          Dashboard
        </div>
        <nav class="flex-1 p-4 space-y-2">
          <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-blue-600 transition">Dashboard</a>
          <a href="{{ route('kelolaasisten') }}" class="block px-4 py-2 rounded hover:bg-blue-600 transition">Kelola Asisten</a>
          <a href="{{ route('keloladosen') }}" class="block px-4 py-2 rounded hover:bg-blue-600 transition">Kelola Dosen</a>
          <a href="{{ route('kelolamatkul') }}" class="block px-4 py-2 rounded hover:bg-blue-600 transition">Kelola Matkul</a>
          <a href="{{ route('matkulkelas.index') }}" class="block px-4 py-2 rounded hover:bg-blue-600 transition">Kelola Matkul Kelas</a>
          <a href="{{ route('absen.index') }}" class="block px-4 py-2 rounded hover:bg-blue-600 transition">Kelola Absen</a>
        </nav>
        <div class="p-4 border-t border-blue-500 text-sm">
          © 2025 Sistem Absen
        </div>
      </aside>

      <!-- Konten utama -->
      <main class="flex-1 p-8 overflow-y-auto">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">@yield('page-title')</h1>
        @yield('content')
      </main>
    </div>
  </body>
</html>
