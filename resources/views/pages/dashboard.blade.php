@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="flex min-h-screen">
    {{-- Sidebar --}}
    <aside class="w-64 bg-background p-6 shadow-soft hidden lg:flex flex-col justify-between fixed top-0 h-screen"> 
        <div>
            <h1 class="text-2xl font-bold text-primary mb-8 font-montserrat">Dinas Lingkungan Hidup dan Kehutanan</h1>
            <nav class="flex flex-col space-y-2">
                <a class="flex items-center gap-3 px-4 py-2 rounded-xl bg-secondary text-text-primary font-bold" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Dashboard</span>
                </a>
            </nav>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 rounded-xl hover:bg-secondary/50 text-left">
                <span class="material-symbols-outlined">logout</span>
                <span>Logout</span>
            </button>
        </form>
    </aside>
    
    <main class="flex-1 p-6 lg:p-10 lg:ml-64"> 
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl font-bold text-text-primary mb-8 font-montserrat">Dashboard</h1>
            
            @if (session('success'))
                <div class="bg-primary/20 text-primary p-3 rounded-xl mb-4 text-center font-bold">{{ session('success') }}</div>
            @endif

            {{-- Manage Feedback Table --}}
            <div class="bg-white rounded-xl shadow-soft overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-text-primary">Manage Feedback</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-background border-b border-secondary/50">
                                <th class="p-4 font-bold">User</th>
                                <th class="p-4 font-bold">Feedback</th>
                                <th class="p-4 font-bold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                                <tr class="border-b border-secondary/30 @if(!$feedback->is_read) bg-secondary/20 @endif">
                                    <td class="p-4">{{ $feedback->sender_name ?? 'Anonim' }}</td>
                                    <td class="p-4 text-text-secondary">{{ Str::limit($feedback->message, 50) }}</td>
                                    <td class="p-4 text-right">
                                        @php
                                            // Dapatkan URL absolut dari Supabase
                                            $url = $feedback->image ? Storage::disk('s3')->url($feedback->image) : '';
                                        @endphp
                                        <button onclick="showFeedbackModal('{{ $feedback->id }}', '{{ addslashes($feedback->sender_name ?? 'Anonim') }}', '{{ addslashes($feedback->sender_email ?? '-') }}', '{{ addslashes($feedback->message) }}', {{ $feedback->is_read ? 'true' : 'false' }}, '{{ $url }}')" class="text-primary hover:text-opacity-80 font-bold">View</button>
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

@include('partials.modals.show_feedback')

<script>
    function showFeedbackModal(id, sender, email, message, isRead, imageUrl) {
        document.getElementById('feedback-sender').innerText = sender;
        document.getElementById('feedback-email').innerText = email;
        document.getElementById('feedback-message').innerText = message; 

        const imgContainer = document.getElementById('feedback-image-container');
        const imgPreview = document.getElementById('feedback-image-preview');
        
        // Bersihkan src lama agar tidak berkedip gambar sebelumnya
        imgPreview.src = '';

        if (imageUrl && imageUrl !== '') {
            imgPreview.src = imageUrl;
            imgContainer.classList.remove('hidden');
        } else {
            imgContainer.classList.add('hidden');
        }

        if (!isRead) {
             const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
             fetch(`{{ url('admin/feedback') }}/${id}`, {
                method: 'PUT',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' },
                body: JSON.stringify({ is_read: true })
            }).then(() => {
                // Jangan reload agar modal tidak tertutup otomatis, cukup tandai UI jika perlu
                console.log('Feedback marked as read');
            });
        }
        document.getElementById('showFeedbackModal').classList.remove('hidden');
    }
</script>
@endsection
