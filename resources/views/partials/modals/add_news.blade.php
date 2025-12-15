<div id="addNewsModal" class="fixed inset-0 backdrop-blur-sm bg-black/30 overflow-y-auto h-full w-full hidden z-[2000]">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 shadow-lg rounded-xl bg-white">
        <div class="flex justify-between items-center pb-3 border-b border-gray-200">
            <h3 class="text-2xl font-bold text-primary">Tambah Berita Baru</h3>
            <button onclick="document.getElementById('addNewsModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-3xl leading-none">&times;</button>
        </div>
        
        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
            @csrf
            <div>
                <label for="title" class="block text-sm font-medium text-text-primary">Judul Berita</label>
                <input type="text" id="title" name="title" required class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:border-primary">
            </div>
            <div>
                <label for="excerpt" class="block text-sm font-medium text-text-primary">Ringkasan (Excerpt)</label>
                <textarea id="excerpt" name="excerpt" rows="2" required class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:border-primary"></textarea>
            </div>
            <div>
                <label for="content" class="block text-sm font-medium text-text-primary">Konten Lengkap</label>
                <textarea id="content" name="content" rows="6" required class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:border-primary"></textarea>
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-text-primary">Gambar Utama</label>
                <input type="file" id="image" name="image" class="mt-1 block w-full text-text-primary">
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-text-primary">Status</label>
                <select id="status" name="status" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:border-primary">
                    <option value="Draft">Draft</option>
                    <option value="Published">Published</option>
                </select>
            </div>
            
            <div class="flex justify-end pt-4 border-t border-gray-200">
                <button type="submit" class="bg-primary text-white font-bold py-2 px-4 rounded-xl hover:bg-opacity-90">Simpan Berita</button>
            </div>
        </form>
    </div>
</div>