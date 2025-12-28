@extends('layouts.app')

@section('title', 'Environmental Department Dashboard')

@section('content')
<div class="flex min-h-screen">
    {{-- Sidebar ASLI Anda --}}
    <aside class="w-64 bg-background p-6 shadow-soft hidden lg:flex flex-col justify-between fixed top-0 h-screen"> 
        <div>
            <h1 class="text-2xl font-bold text-primary mb-8 font-montserrat">Dinas Lingkungan Hidup</h1>
            <nav class="flex flex-col space-y-2">
                <a class="flex items-center gap-3 px-4 py-2 rounded-xl bg-secondary text-text-primary font-bold" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Dashboard</span>
                </a>
                <!--
                <a class="flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-secondary/50" href="#">
                    <span class="material-symbols-outlined">groups</span>
                    <span>Manage Divisions</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-secondary/50" href="{{ route('news.index') }}">
                    <span class="material-symbols-outlined">article</span>
                    <span>Manage Articles</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-secondary/50" href="{{ route('feedback.index') }}">
                    <span class="material-symbols-outlined">campaign</span>
                    <span>Manage Feedback</span>
                </a>
                -->
            </nav>
        </div>
        {{-- Tombol Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 rounded-xl hover:bg-secondary/50 text-left">
                <span class="material-symbols-outlined">logout</span>
                <span>Logout</span>
            </button>
        </form>
    </aside>
    
    {{-- Main Content ASLI Anda --}}
    <main class="flex-1 p-6 lg:p-10 lg:ml-64"> 
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-bold text-text-primary font-montserrat">Dashboard</h1>
                <button class="lg:hidden text-text-primary">
                    <span class="material-symbols-outlined text-3xl">menu</span>
                </button>
            </div>
            
            @if (session('success'))
                <div class="bg-primary/20 text-primary p-3 rounded-xl mb-4 text-center font-bold">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl p-6 shadow-soft border border-secondary/50">
                    <h2 class="text-text-secondary text-lg font-medium mb-2">Total Articles</h2>
                    <p class="text-4xl font-bold text-primary">{{ $articles->count() }}</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-soft border border-secondary/50">
                    <h2 class="text-text-secondary text-lg font-medium mb-2">Feedback Count</h2>
                    <p class="text-4xl font-bold text-primary">{{ $feedbacks->count() }}</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-soft border border-secondary/50">
                    <h2 class="text-text-secondary text-lg font-medium mb-2">Unread Feedback</h2>
                    <p class="text-4xl font-bold text-primary">{{ $unreadFeedbackCount }}</p>
                </div>
            </div>

            {{-- Manage Articles Table --}}
            <div class="bg-white rounded-xl shadow-soft overflow-hidden mb-8">
                <div class="p-6 flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-text-primary">Manage Articles</h2>
                    <button onclick="openAddModal()" class="bg-primary text-white font-bold py-2 px-4 rounded-xl flex items-center gap-2 hover:bg-opacity-90">
                        <span class="material-symbols-outlined">add</span>
                        <span>Add Article</span>
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-background border-b border-secondary/50">
                                <th class="p-4 font-bold">Image</th>
                                <th class="p-4 font-bold">Title</th>
                                <th class="p-4 font-bold">Author</th>
                                <th class="p-4 font-bold">Date</th>
                                <th class="p-4 font-bold">Status</th>
                                <th class="p-4 font-bold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr class="border-b border-secondary/30">
                                    <td class="p-4">
                                        {{-- PERBAIKAN: Mengambil URL dari S3 Supabase --}}
                                        <img src="{{ $article->image ? Storage::disk('s3')->url($article->image) : asset('truckSampah.png') }}" 
                                             alt="{{ $article->title }}" 
                                             class="w-12 h-12 object-cover rounded-md">
                                    </td>
                                    <td class="p-4">{{ Str::limit($article->title, 40) }}</td>
                                    <td class="p-4 text-text-secondary">{{ $article->author }}</td>
                                    <td class="p-4 text-text-secondary">{{ $article->created_at->format('Y-m-d') }}</td>
                                    <td class="p-4">
                                        <span class="{{ $article->status === 'Published' ? 'bg-accent/50 text-text-primary' : 'bg-gray-200 text-gray-700' }} px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $article->status }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-right">
                                        <button onclick="openEditModal({{ $article }})" class="text-primary hover:text-opacity-80 font-bold">Edit</button>
                                        <form method="POST" action="{{ route('news.destroy', $article->id) }}" class="inline ml-4" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 font-bold">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Manage Feedback Table --}}
            <div class="bg-white rounded-xl shadow-soft overflow-hidden">
                <div class="p-6 flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-text-primary">Manage Feedback</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-background border-b border-secondary/50">
                                <th class="p-4 font-bold">User</th>
                                <th class="p-4 font-bold">Feedback</th>
                                <th class="p-4 font-bold">Date</th>
                                <th class="p-4 font-bold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                                <tr class="border-b border-secondary/30 @if(!$feedback->is_read) bg-secondary/20 @endif">
                                    <td class="p-4 @if(!$feedback->is_read) font-bold @endif">{{ $feedback->sender_name ?? 'Anonim' }}</td>
                                    <td class="p-4 text-text-secondary @if(!$feedback->is_read) font-semibold @endif">{{ Str::limit($feedback->message, 50) }}</td>
                                    <td class="p-4 text-text-secondary">{{ $feedback->created_at->format('Y-m-d') }}</td>
                                    <td class="p-4 text-right">
                                        <button onclick="showFeedbackModal('{{ $feedback->id }}', '{{ addslashes($feedback->sender_name ?? 'Anonim') }}', '{{ addslashes($feedback->sender_email ?? '-') }}', '{{ addslashes($feedback->message) }}', {{ $feedback->is_read ? 'true' : 'false' }})" class="text-primary hover:text-opacity-80 font-bold">View</button>
                                        <form method="POST" action="{{ route('feedback.destroy', $feedback->id) }}" class="inline ml-4">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 font-bold">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

@include('partials.modals.add_news')
@include('partials.modals.edit_news')
@include('partials.modals.show_feedback')

<script>
    function openAddModal() { document.getElementById('addNewsModal').classList.remove('hidden'); }
    
    function openEditModal(article) {
        document.getElementById('edit_id').value = article.id;
        document.getElementById('edit_title').value = article.title;
        document.getElementById('edit_excerpt').value = article.excerpt;
        document.getElementById('edit_content').value = article.content;
        document.getElementById('edit_status').value = article.status;
        document.getElementById('editNewsForm').action = "{{ url('admin/news') }}" + "/" + article.id;
        
        const imagePreview = document.getElementById('current_image_preview');
        if (article.image) {
            // PERBAIKAN: Preview gambar edit menggunakan URL S3 jika tersedia
            // (Note: Di JS, kita perlu cara dinamis untuk mendapatkan URL S3)
            imagePreview.src = `https://rbzaqlizausvrvogihux.storage.supabase.co/storage/v1/object/public/news/${article.image}`;
            imagePreview.classList.remove('hidden');
        } else {
            imagePreview.classList.add('hidden');
        }
        document.getElementById('editNewsModal').classList.remove('hidden');
    }

    function showFeedbackModal(id, sender, email, message, isRead) {
        document.getElementById('feedback-sender').innerText = sender;
        document.getElementById('feedback-email').innerText = email;
        document.getElementById('feedback-message').innerText = message; 
        if (!isRead) {
             const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
             fetch(`{{ url('admin/feedback') }}/${id}`, {
                method: 'PUT',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' },
                body: JSON.stringify({ is_read: true })
            }).then(() => window.location.reload());
        }
        document.getElementById('showFeedbackModal').classList.remove('hidden');
    }
</script>
@endsection
