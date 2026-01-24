@extends('layouts.app')

@section('content')
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Deteksi Dini Stunting</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Masukkan data pertumbuhan anak Anda di bawah ini. Sistem AI kami akan menganalisis indikasi stunting berdasarkan parameter medis.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <form id="detectionForm" class="space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin Anak</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <label class="cursor-pointer border-2 border-gray-100 rounded-xl p-3 flex items-center justify-center gap-2 hover:bg-blue-50 transition peer-checked:border-blue-600 has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50">
                                        <input type="radio" name="gender" value="1" class="w-4 h-4 text-blue-600" required>
                                        <span class="font-medium text-gray-700">Laki-laki</span>
                                    </label>
                                    <label class="cursor-pointer border-2 border-gray-100 rounded-xl p-3 flex items-center justify-center gap-2 hover:bg-pink-50 transition has-[:checked]:border-pink-600 has-[:checked]:bg-pink-50">
                                        <input type="radio" name="gender" value="0" class="w-4 h-4 text-pink-600">
                                        <span class="font-medium text-gray-700">Perempuan</span>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Usia (Bulan)</label>
                                <input type="number" name="age" placeholder="Contoh: 17" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-blue-500 outline-none transition" required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">ASI Eksklusif?</label>
                                <select name="breastfeeding" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-blue-500 outline-none transition" required>
                                    <option value="1">Ya, Diberikan</option>
                                    <option value="0">Tidak/Berhenti</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Berat Lahir (kg)</label>
                                <input type="number" step="0.1" name="birth_weight" placeholder="Contoh: 3.1" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-blue-500 outline-none transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Panjang Lahir (cm)</label>
                                <input type="number" step="0.1" name="birth_length" placeholder="Contoh: 49.0" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-blue-500 outline-none transition" required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Berat Sekarang (kg)</label>
                                <input type="number" step="0.1" name="body_weight" placeholder="Contoh: 10.2" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-blue-500 outline-none transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tinggi Sekarang (cm)</label>
                                <input type="number" step="0.1" name="body_length" placeholder="Contoh: 75.5" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-blue-500 outline-none transition" required>
                            </div>
                        </div>

                        <button type="submit" id="btnSubmit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-200 hover:bg-blue-700 active:scale-[0.98] transition flex items-center justify-center gap-3">
                            <span id="btnText">Analisis Sekarang</span>
                            <div id="btnLoading" class="hidden w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                        </button>
                    </form>
                </div>
            </div>

            <div class="md:col-span-1">
                <div id="resultPlaceholder" class="bg-blue-50 border-2 border-dashed border-blue-200 rounded-3xl p-8 text-center flex flex-col items-center justify-center h-full min-h-[300px]">
                    <div class="text-4xl mb-4">📊</div>
                    <p class="text-blue-800 font-medium">Hasil analisis akan muncul di sini setelah Anda menekan tombol.</p>
                </div>

                <div id="resultCard" class="hidden bg-white rounded-3xl shadow-xl border overflow-hidden transition-all duration-500 scale-95 opacity-0">
                    <div id="resultHeader" class="p-6 text-center text-white">
                        <h3 class="text-lg font-medium opacity-90">Hasil Deteksi</h3>
                        <div id="statusLabel" class="text-3xl font-black mt-1 uppercase tracking-wider">NORMAL</div>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-center border-b pb-3 text-sm">
                            <span class="text-gray-500">Probabilitas AI</span>
                            <span id="probLabel" class="font-bold text-gray-800">0.0%</span>
                        </div>
                        <p id="adviceLabel" class="text-gray-600 text-sm leading-relaxed italic text-center">
                            -
                        </p>
                        <button onclick="resetForm()" class="w-full py-2 text-blue-600 font-semibold text-sm hover:underline">Ulangi Tes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const form = document.getElementById('detectionForm');
    const btnSubmit = document.getElementById('btnSubmit');
    const btnText = document.getElementById('btnText');
    const btnLoading = document.getElementById('btnLoading');
    const resultPlaceholder = document.getElementById('resultPlaceholder');
    const resultCard = document.getElementById('resultCard');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        // UI Loading State
        btnSubmit.disabled = true;
        btnText.innerText = "Menganalisis...";
        btnLoading.classList.remove('hidden');

        // Ambil Data Form
        const formData = new FormData(form);
        const payload = {
            gender: parseInt(formData.get('gender')),
            age: parseInt(formData.get('age')),
            birth_weight: parseFloat(formData.get('birth_weight')),
            birth_length: parseFloat(formData.get('birth_length')),
            body_weight: parseFloat(formData.get('body_weight')),
            body_length: parseFloat(formData.get('body_length')),
            breastfeeding: parseInt(formData.get('breastfeeding'))
        };

        try {
            const response = await fetch('{{ config('services.fastapi.url') }}/api/detect', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            const data = await response.json();
            showResult(data);
        } catch (error) {
            alert('Gagal terhubung ke server AI. Pastikan backend Python aktif.');
        } finally {
            btnSubmit.disabled = false;
            btnText.innerText = "Analisis Sekarang";
            btnLoading.classList.add('hidden');
        }
    });

    function showResult(data) {
        const isStunting = data.status === 'Stunting';
        const header = document.getElementById('resultHeader');
        const statusLabel = document.getElementById('statusLabel');
        const probLabel = document.getElementById('probLabel');
        const adviceLabel = document.getElementById('adviceLabel');

        // Update Warna Berdasarkan Hasil
        if (isStunting) {
            header.className = "p-6 text-center text-white bg-red-500";
            resultCard.className = "bg-white rounded-3xl shadow-xl border-2 border-red-500 overflow-hidden transition-all duration-500";
        } else {
            header.className = "p-6 text-center text-white bg-green-500";
            resultCard.className = "bg-white rounded-3xl shadow-xl border-2 border-green-500 overflow-hidden transition-all duration-500";
        }

        statusLabel.innerText = data.status;
        probLabel.innerText = (data.probability * 100).toFixed(1) + "%";
        adviceLabel.innerText = data.message;

        // Animasi Muncul
        resultPlaceholder.classList.add('hidden');
        resultCard.classList.remove('hidden', 'scale-95', 'opacity-0');
    }

    function resetForm() {
        form.reset();
        resultPlaceholder.classList.remove('hidden');
        resultCard.classList.add('hidden', 'scale-95', 'opacity-0');
    }
</script>
@endsection