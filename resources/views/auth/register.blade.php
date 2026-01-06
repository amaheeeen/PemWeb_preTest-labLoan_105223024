<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - LabLoan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-indigo-50 h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="bg-indigo-900 p-6 text-center">
            <h1 class="text-2xl font-bold text-white tracking-wide">Bergabunglah</h1>
            <p class="text-indigo-200 text-sm mt-1">Buat akun untuk meminjam alat lab</p>
        </div>
        
        <div class="p-8">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-slate-700 text-sm font-bold mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-lg bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition outline-none" placeholder="Nama Anda" required>
                    @error('name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-slate-700 text-sm font-bold mb-2">Email Kampus</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-lg bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition outline-none" placeholder="nama@mahasiswa.ac.id" required>
                    @error('email') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-slate-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-3 rounded-lg bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition outline-none" placeholder="Minimal 6 karakter" required>
                    @error('password') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-8">
                    <label class="block text-slate-700 text-sm font-bold mb-2">Ulangi Password</label>
                    <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-lg bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition outline-none" placeholder="Ketik ulang password" required>
                </div>
                
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg shadow-lg shadow-indigo-200 transition duration-300 transform hover:-translate-y-0.5">
                    Daftar Sekarang
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Sudah punya akun? Login</a>
            </div>
        </div>
    </div>

</body>
</html>