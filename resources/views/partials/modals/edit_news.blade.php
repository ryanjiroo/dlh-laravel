<div id="editNewsModal" class="fixed inset-0 backdrop-blur-sm bg-black/30 overflow-y-auto h-full w-full hidden z-[2000]">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 shadow-lg rounded-xl bg-white">
        <div class="flex justify-between items-center pb-3 border-b border-gray-200">
            <h3 class="text-2xl font-bold text-primary">Edit Berita</h3>
            <button onclick="document.getElementById('editNewsModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-3xl leading-none">&times;</button>
        </div>
        
        <form id="editNewsForm" method="POST" action="" enctype="multipart/form-data" class="mt-4 space-y-4">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_id" name="id">
            
            <div>
                <label for="edit_title" class="block text-sm font-medium text-text-primary">Judul Berita</label>
                <input type="text" id="edit_title" name="title" required class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:border-primary">
            </div>
            <div>
                <label for="edit_excerpt" class="block text-sm font-medium text-text-primary">Ringkasan (Excerpt)</label>
                <textarea id="edit_excerpt" name="excerpt" rows="2" required class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:border-primary"></textarea>
            </div>
            <div>
                <label for="edit_content" class="block text-sm font-medium text-text-primary">Konten Lengkap</label>
                <textarea id="edit_content" name="content" rows="6" required class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:border-primary"></textarea>
            </div>
            
            <div class="space-y-2">
                <label class="block text-sm font-medium text-text-primary">Gambar Saat Ini</label>
                <img id="current_image_preview" src="" alt="Gambar Lama" class="w-32 h-20 object-cover rounded-md border border-gray-300 hidden">
                <label for="edit_image" class="block text-sm font-medium text-text-primary">Ganti Gambar</label>
                <input type="file" id="edit_image" name="image" class="mt-1 block w-full text-text-primary">
            </div>
            
            <div>
                <label for="edit_status" class="block text-sm font-medium text-text-primary">Status</label>
                <select id="edit_status" name="status" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:border-primary">
                    <option value="Draft">Draft</option>
                    <option value="Published">Published</option>
                </select>
            </div>
            
            <div class="flex justify-end pt-4 border-t border-gray-200">
                <button type="submit" class="bg-primary text-white font-bold py-2 px-4 rounded-xl hover:bg-opacity-90">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>