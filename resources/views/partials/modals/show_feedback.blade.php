<div id="showFeedbackModal" class="fixed inset-0 backdrop-blur-sm bg-black/30 overflow-y-auto h-full w-full hidden z-[2000]">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-xl bg-white">
        <div class="flex justify-between items-center pb-3 border-b border-gray-200">
            <h3 class="text-2xl font-bold text-primary">Detail Feedback</h3>
            <button onclick="document.getElementById('showFeedbackModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-3xl leading-none">&times;</button>
        </div>
        
        <div class="mt-4 space-y-3 text-text-primary">
            <p><strong class="w-24 inline-block">Pengirim:</strong> <span id="feedback-sender"></span></p>
            <p><strong class="w-24 inline-block">Email:</strong> <span id="feedback-email"></span></p>
            <div class="pt-3 border-t mt-4">
                <p class="font-bold mb-2">Pesan:</p>
                <div id="feedback-message" class="bg-background p-3 rounded-lg border border-gray-200 whitespace-pre-line text-sm"></div>
            </div>
            
        </div>
        
        <div class="flex justify-end pt-4 border-t border-gray-200 mt-6">
            <button onclick="document.getElementById('showFeedbackModal').classList.add('hidden')" class="bg-gray-300 text-text-primary font-bold py-2 px-4 rounded-xl hover:bg-gray-400">Tutup</button>
        </div>
    </div>
</div>