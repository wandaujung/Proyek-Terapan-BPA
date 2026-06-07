@extends('layouts.manager')

@section('content')
  <!-- Main Content Panel -->
  <div class="flex-1 bg-white p-12">

    <!-- Back Navigation -->
    <a href="{{ route('manager.reviews') }}" class="flex items-center gap-2 text-gray-500 font-bold hover:text-gray-800 transition mb-6 text-sm tracking-wide">
      <svg class="w-5 h-5 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
      </svg>
      BACK TO QUEUE
    </a>

    <!-- Editorial Tag -->
    <div class="mb-4">
      <span class="bg-[#A30F22] text-white font-extrabold text-[10px] uppercase px-3 py-1.5 rounded-full tracking-wider">
        EDITORIAL REVIEW
      </span>
    </div>

    <!-- Page Title - Dynamic -->
    <h1 class="text-4xl lg:text-5xl font-black text-gray-900 leading-tight tracking-tight max-w-3xl mb-6">
      {{ $task->title }}
    </h1>

    <!-- Authorship metadata - Dynamic -->
    <div class="flex items-center gap-6 mb-10">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-[#C5BFB9] flex items-center justify-center text-xs font-bold text-gray-600 border border-gray-100 shadow-sm">
          {{ strtoupper(substr($task->user->name ?? 'ST', 0, 2)) }}
        </div>
        <div>
          <div class="text-[10px] text-gray-400 font-extrabold uppercase tracking-widest leading-none">Submitted By</div>
          <div class="text-sm font-bold text-gray-800 mt-1">{{ $task->user->name ?? 'Staff' }}</div>
        </div>
      </div>
      
      <div class="h-8 w-px bg-gray-200"></div>
      
      <div>
        <div class="text-[10px] text-gray-400 font-extrabold uppercase tracking-widest leading-none">Date Submitted</div>
        <div class="text-sm font-bold text-gray-800 mt-1">{{ $task->updated_at->format('M d, Y') }}</div>
      </div>

      <div class="h-8 w-px bg-gray-200"></div>

      <div>
        <div class="text-[10px] text-gray-400 font-extrabold uppercase tracking-widest leading-none">Project</div>
        <div class="text-sm font-bold text-gray-800 mt-1">{{ $task->project->name ?? '-' }}</div>
      </div>
    </div>

    <!-- Review Grid Panels -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
      
      <!-- Left Column -->
      <div class="lg:col-span-2 space-y-8">
        
        <!-- Description -->
        <div class="bg-[#F8F6F2] rounded-3xl p-8 border border-[#EDEAE6]">
          <div class="flex items-center gap-3 mb-4">
            <div class="text-[#A30F22]">
              <svg class="w-6 h-6 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </div>
            <h2 class="font-extrabold text-gray-900 text-lg">Submition Notes</h2>
          </div>
          
          <blockquote class="text-gray-700 italic text-[15px] font-medium leading-relaxed">
            "{{ $task->submission_notes ?? 'No notes provided.' }}"
          </blockquote>
        </div>

        <!-- Evidence Links -->
        <div>
          <h3 class="font-extrabold text-gray-900 text-lg mb-4">Evidence Links</h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            
            @if($task->brief_link)
            <a href="{{ $task->brief_link }}" target="_blank" class="border border-gray-100 bg-[#FAF9F7] shadow-sm rounded-2xl p-4 flex items-center justify-between hover:shadow-md transition-shadow">
              <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-[#FEE2E2] rounded-xl flex items-center justify-center text-[#EF4444] shadow-inner">
                  <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                  </svg>
                </div>
                <div>
                  <div class="font-extrabold text-gray-900 text-sm">Brief Link</div>
                  <div class="text-[10px] text-gray-400 font-bold mt-0.5 truncate max-w-[160px]">{{ $task->brief_link }}</div>
                </div>
              </div>
              <svg class="w-5 h-5 text-gray-400 stroke-[2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
              </svg>
            </a>
            @endif

            @if($task->submission_link)
            <a href="{{ $task->submission_link }}" target="_blank" class="border border-gray-100 bg-[#FAF9F7] shadow-sm rounded-2xl p-4 flex items-center justify-between hover:shadow-md transition-shadow">
              <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-[#DBEAFE] rounded-xl flex items-center justify-center text-[#3B82F6] shadow-inner">
                  <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                  </svg>
                </div>
                <div>
                  <div class="font-extrabold text-gray-900 text-sm">Submission Link</div>
                  <div class="text-[10px] text-gray-400 font-bold mt-0.5 truncate max-w-[160px]">{{ $task->submission_link }}</div>
                </div>
              </div>
              <svg class="w-5 h-5 text-gray-400 stroke-[2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
              </svg>
            </a>
            @endif

            @if(!$task->brief_link && !$task->submission_link)
            <div class="col-span-2 text-center py-6 text-sm text-gray-400">No evidence links provided.</div>
            @endif

          </div>
        </div>

        <!-- Sub-tasks -->
        @if($task->subTasks->count() > 0)
        <div>
          <h3 class="font-extrabold text-gray-900 text-lg mb-4">Sub-Tasks ({{ $task->subTasks->count() }})</h3>
          <div class="space-y-2">
            @foreach($task->subTasks as $sub)
            <div class="flex items-center gap-3 px-4 py-3 bg-[#FAF9F7] rounded-xl border border-gray-100">
              <div class="w-5 h-5 rounded-full flex items-center justify-center {{ $sub->is_completed ? 'bg-green-500' : 'bg-gray-200' }}">
                @if($sub->is_completed)
                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                @endif
              </div>
              <span class="text-sm font-semibold {{ $sub->is_completed ? 'text-gray-400 line-through' : 'text-gray-800' }}">{{ $sub->title }}</span>
            </div>
            @endforeach
          </div>
        </div>
        @endif

      </div>

      <!-- Right Column - Action Panel -->
      <div class="space-y-6">
        
        <!-- Decision Card -->
        <div class="bg-white border border-gray-100 shadow-xl shadow-gray-100/50 rounded-3xl p-6">
          <h3 class="font-extrabold text-gray-900 text-[18px] mb-6">Review Decision</h3>
          
          <!-- Approve Button -->
          <form id="approveForm" action="{{ route('tasks.approve', $task->id) }}" method="POST">
            @csrf
            <button type="button" onclick="openApproveModal()" class="w-full flex items-center justify-center gap-2.5 bg-[#3B5A4F] text-white py-4 px-6 rounded-full font-bold hover:bg-[#2F473D] hover:-translate-y-0.5 active:translate-y-0 active:shadow-inner transition shadow-lg shadow-[#3B5A4F]/20">
              <svg class="w-5 h-5 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              Approve Project
            </button>
          </form>
          
          <!-- Separator -->
          <div class="flex items-center my-6">
            <div class="flex-grow h-px bg-gray-100"></div>
            <span class="mx-3 text-[10px] text-gray-300 font-extrabold tracking-widest">OR</span>
            <div class="flex-grow h-px bg-gray-100"></div>
          </div>
          
          <!-- Revision Form -->
          <form id="revisionForm" action="{{ route('tasks.revision', $task->id) }}" method="POST">
            @csrf
            <div class="text-[10px] text-gray-400 font-extrabold uppercase tracking-widest mb-2.5 leading-none">
              REVISION NOTES (REQUIRED FOR CHANGES)
            </div>
            <textarea 
              id="revisionNotes"
              name="revision_notes"
              class="w-full bg-[#F3F4F6] border border-transparent rounded-2xl p-4 text-xs font-semibold text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#A30F22]/20 focus:border-[#A30F22] focus:bg-white transition mb-6" 
              rows="5"
              placeholder="Describe the required changes..."></textarea>
            
            <button type="button" onclick="openRevisionModal()" class="w-full flex items-center justify-center gap-2.5 border-2 border-gray-900 text-gray-900 py-3.5 px-6 rounded-full font-bold hover:bg-gray-50 hover:-translate-y-0.5 active:translate-y-0 active:shadow-inner transition">
              <svg class="w-5 h-5 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
              Request Revision
            </button>
          </form>
        </div>

        <!-- Info Notice -->
        <div class="bg-[#FAF3EB] border border-[#F1E4D3] rounded-3xl p-6 flex gap-4 shadow-sm shadow-orange-50/20">
          <div class="text-[#7A5420] mt-0.5 flex-shrink-0">
            <svg class="w-6 h-6 stroke-[2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <p class="text-xs font-semibold text-[#7A5420] leading-relaxed select-none">
            Approval will automatically notify the project team and move this task to Done. Revision will send notes back to the staff.
          </p>
        </div>

      </div>

    </div>
  </main>

  <!-- Approve Modal -->
  <div id="approveModal" class="fixed inset-0 z-50 hidden flex-col items-center justify-center bg-black/40 backdrop-blur-sm p-4">
    <div class="w-full max-w-lg rounded-[32px] bg-white p-10 md:p-12 shadow-[0_24px_50px_-12px_rgba(0,0,0,0.08)] transform transition-all duration-300 ease-out relative">
      <button onclick="closeApproveModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-600 transition">
        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M6 18L18 6M6 6l12 12"/></svg>
      </button>

      <!-- Green Success Icon -->
      <div class="flex justify-center mb-8 mt-2">
        <div class="flex h-28 w-28 items-center justify-center rounded-full bg-[#E6F4EA] border border-[#CEEAD6]">
          <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#A3E2B9]">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-[#137333] shadow-inner">
              <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
              </svg>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center space-y-4">
        <h3 class="text-[28px] font-bold text-gray-900 leading-tight tracking-tight">Approve this project?</h3>
        <p class="text-[15px] text-gray-500 leading-relaxed max-w-[380px] mx-auto">
          The project team will be notified and the task will be marked as completed.
        </p>
      </div>

      <div class="flex flex-col sm:flex-row items-center justify-center gap-6 mt-8">
        <button onclick="submitApprove()" class="w-full sm:w-auto px-8 py-4 bg-[#137333] hover:bg-[#0F5C28] text-white text-base font-bold rounded-full shadow-[0_8px_20px_-4px_rgba(19,115,51,0.35)] transition-all duration-200 active:scale-95">
          Yes, Approve
        </button>
        <button onclick="closeApproveModal()" class="flex items-center gap-1.5 text-sm font-semibold text-gray-500 hover:text-gray-900 transition-colors">
          Cancel
        </button>
      </div>

      <hr class="border-gray-100 my-8" />
      <div class="flex items-center gap-4 bg-gray-50/50 p-3 rounded-2xl border border-gray-100/50">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-400">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
          </svg>
        </div>
        <div>
          <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Project</p>
          <p class="text-[15px] font-bold text-gray-900 leading-none">{{ $task->project->name ?? '-' }}</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Revision Modal -->
  <div id="revisionModal" class="fixed inset-0 z-50 hidden flex-col items-center justify-center bg-black/40 backdrop-blur-sm p-4">
    <div class="w-full max-w-lg rounded-[32px] bg-white p-10 md:p-12 shadow-[0_24px_50px_-12px_rgba(0,0,0,0.08)] transform transition-all duration-300 ease-out relative">
      <button onclick="closeRevisionModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-600 transition">
        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M6 18L18 6M6 6l12 12"/></svg>
      </button>

      <!-- Warning Icon -->
      <div class="flex justify-center mb-8 mt-2">
        <div class="flex h-28 w-28 items-center justify-center rounded-full bg-[#FFF4E5] border border-[#FFE0B2]">
          <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#FFCC80]">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-[#F57C00] shadow-inner">
              <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
              </svg>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center space-y-4">
        <h3 class="text-[28px] font-bold text-gray-900 leading-tight tracking-tight">Send Revision Request?</h3>
        <p class="text-[15px] text-gray-500 leading-relaxed max-w-[380px] mx-auto">
          The project team will be notified with your revision notes and the task will be moved back for changes.
        </p>
      </div>

      <div class="flex flex-col sm:flex-row items-center justify-center gap-6 mt-8">
        <button onclick="submitRevision()" class="w-full sm:w-auto px-8 py-4 bg-[#F57C00] hover:bg-[#E65100] text-white text-base font-bold rounded-full shadow-[0_8px_20px_-4px_rgba(245,124,0,0.35)] transition-all duration-200 active:scale-95">
          Yes, Request Revision
        </button>
        <button onclick="closeRevisionModal()" class="flex items-center gap-1.5 text-sm font-semibold text-gray-500 hover:text-gray-900 transition-colors">
          Cancel
        </button>
      </div>

      <hr class="border-gray-100 my-8" />
      <div class="flex items-center gap-4 bg-gray-50/50 p-3 rounded-2xl border border-gray-100/50">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-400">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
          </svg>
        </div>
        <div>
          <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Project</p>
          <p class="text-[15px] font-bold text-gray-900 leading-none">{{ $task->project->name ?? '-' }}</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Profile dropdown
    function toggleProfileDropdown() {
      document.getElementById('profileDropdown').classList.toggle('hidden');
    }
    document.addEventListener('click', function(e) {
      const dropdown = document.getElementById('profileDropdown');
      if (!e.target.closest('.relative') && dropdown) {
        dropdown.classList.add('hidden');
      }
    });

    // Approve modal
    function openApproveModal() {
      const modal = document.getElementById('approveModal');
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }
    function closeApproveModal() {
      const modal = document.getElementById('approveModal');
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
    function submitApprove() {
      document.getElementById('approveForm').submit();
    }

    // Revision modal
    function openRevisionModal() {
      const notes = document.getElementById('revisionNotes').value.trim();
      if (!notes) {
        alert('Please enter revision notes before requesting a revision.');
        return;
      }
      const modal = document.getElementById('revisionModal');
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }
    function closeRevisionModal() {
      const modal = document.getElementById('revisionModal');
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
    function submitRevision() {
      document.getElementById('revisionForm').submit();
    }
  </script>
  </div>
@endsection
