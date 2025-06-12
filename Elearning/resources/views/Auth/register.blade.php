
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - EduLearn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="flex bg-white rounded-2xl shadow-2xl overflow-hidden max-w-4xl w-full">
        <!-- Left Side - Branding -->
        <div class="bg-gradient-to-br from-blue-600 to-purple-700 p-8 flex flex-col justify-center items-start text-white w-1/2">
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center mr-3">
                        <span class="text-blue-800 font-bold">📚</span>
                    </div>
                    <h1 class="text-2xl font-bold">EduLearn</h1>
                </div>
                <p class="text-blue-100">
                    Bergabunglah dengan ribuan pelajar lainnya dan mulai perjalanan pembelajaran digital Anda bersama kami. Akses ke ratusan kursus berkualitas tinggi menanti Anda.
                </p>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="p-8 w-1/2">
            <div class="max-w-md mx-auto">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Buat Akun Baru</h2>
                <p class="text-gray-600 mb-6">Daftar untuk memulai pembelajaran Anda</p>

                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    
                    <!-- Nama Depan & Belakang -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Depan</label>
                            <input 
                                type="text" 
                                name="nama_depan" 
                                value="{{ old('nama_depan') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_depan') border-red-500 @enderror"
                                placeholder="Nama depan"
                                required
                            >
                            @error('nama_depan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Belakang</label>
                            <input 
                                type="text" 
                                name="nama_belakang" 
                                value="{{ old('nama_belakang') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_belakang') border-red-500 @enderror"
                                placeholder="Nama belakang"
                                required
                            >
                            @error('nama_belakang')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                            placeholder="email@example.com"
                            required
                        >
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <input 
                            type="tel" 
                            name="nomor_telepon" 
                            value="{{ old('nomor_telepon') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nomor_telepon') border-red-500 @enderror"
                            placeholder="08123456789"
                            required
                        >
                        @error('nomor_telepon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kata Sandi & Konfirmasi -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                            <input 
                                type="password" 
                                name="kata_sandi"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kata_sandi') border-red-500 @enderror"
                                placeholder="Minimal 8 karakter"
                                required
                            >
                            @error('kata_sandi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                            <input 
                                type="password" 
                                name="kata_sandi_confirmation"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Ulangi kata sandi"
                                required
                            >
                        </div>
                    </div>

                    <!-- Daftar Sebagai -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Daftar Sebagai</label>
                        <select 
                            name="daftar_sebagai"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('daftar_sebagai') border-red-500 @enderror"
                            required
                        >
                            <option value="">Pilih Peran</option>
                            <option value="siswa" {{ old('daftar_sebagai') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                            <option value="guru" {{ old('daftar_sebagai') == 'guru' ? 'selected' : '' }}>Guru</option>
                            <option value="orang_tua" {{ old('daftar_sebagai') == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                        </select>
                        @error('daftar_sebagai')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Syarat & Ketentuan -->
                    <div class="flex items-start">
                        <input 
                            type="checkbox" 
                            name="syarat_ketentuan" 
                            id="syarat_ketentuan"
                            class="mt-1 mr-2 @error('syarat_ketentuan') border-red-500 @enderror"
                            {{ old('syarat_ketentuan') ? 'checked' : '' }}
                            required
                        >
                        <label for="syarat_ketentuan" class="text-sm text-gray-600">
                            Saya setuju dengan <a href="#" class="text-blue-600 hover:underline">Syarat & Ketentuan</a> dan 
                            <a href="#" class="text-blue-600 hover:underline">Kebijakan Privasi</a>
                        </label>
                    </div>
                    @error('syarat_ketentuan')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200 font-medium"
                    >
                        Daftar Sekarang
                    </button>
                </form>

                <!-- Login Link -->
                <p class="text-center text-sm text-gray-600 mt-4">
                    Sudah memiliki akun? 
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
