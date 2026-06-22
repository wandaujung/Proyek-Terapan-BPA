<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Planner U × BPA – Projects</title>
    <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet" />

  <!-- Tabler Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />

  <!-- SortableJS -->
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

   <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            brand: ['"Bebas Neue"', 'sans-serif'],
            body:  ['"DM Sans"', 'sans-serif'],
          },
          colors: {
            cream:      '#EDE8E0',
            sidebar:    '#D9D4CB',
            'main-bg':  '#FCF9F4',
            red:        '#C0282D',
            'red-dark': '#A82025',
          },
        },
      },
    }
  </script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #ede9e3;
    }

    .brand-font {
      font-family: 'Black Han Sans', sans-serif;
    }

    /* Custom scrollbar for kanban area */
    .kanban-scroll::-webkit-scrollbar {
      height: 6px;
    }

    .kanban-scroll::-webkit-scrollbar-track {
      background: transparent;
    }

    .kanban-scroll::-webkit-scrollbar-thumb {
      background: #c8b9a8;
      border-radius: 99px;
    }

    /* Modal */
    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.4);
      z-index: 50;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.2s ease;
    }

    .modal-overlay.open {
      opacity: 1;
      pointer-events: all;
    }

    .modal-box {
      background: #faf8f5;
      border-radius: 16px;
      width: 100%;
      max-width: 780px;
      max-height: 90vh;
      overflow-y: auto;
      transform: translateY(20px);
      transition: transform 0.2s ease;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18);
    }

    .modal-overlay.open .modal-box {
      transform: translateY(0);
    }

    .modal-box::-webkit-scrollbar {
      width: 4px;
    }

    .modal-box::-webkit-scrollbar-thumb {
      background: #c8b9a8;
      border-radius: 99px;
    }

    .modal-input {
      width: 100%;
      background: #f0ece6;
      border: none;
      border-radius: 10px;
      padding: 12px 14px;
      font-size: 13px;
      color: #374151;
      outline: none;
      font-family: 'Inter', sans-serif;
      transition: box-shadow 0.15s;
    }

    .modal-input:focus {
      box-shadow: 0 0 0 2px #b91c1c44;
    }

    /* Sub-task checklist toggle */
    .subtask-check {
      width: 1rem;
      height: 1rem;
      border-radius: 50%;
      border: 2px solid #d1d5db;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      flex-shrink: 0;
      transition: background 0.15s, border-color 0.15s;
    }

    .subtask-check:hover {
      border-color: #b91c1c;
    }

    .subtask-check.checked {
      background: #16a34a;
      border-color: #16a34a;
    }

    .subtask-check.checked svg {
      display: block;
    }

    .subtask-check svg {
      display: none;
      width: 10px;
      height: 10px;
      color: white;
    }

    .subtask-text.checked {
      text-decoration: line-through;
      color: #9ca3af;
    }

    /* Drag ghost style */
    .sortable-ghost {
      opacity: 0.35;
      background: #f0ece6 !important;
      border: 2px dashed #b91c1c !important;
      box-shadow: none !important;
    }

    .sortable-drag {
      opacity: 1;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15) !important;
      cursor: grabbing !important;
    }

    /* make task cards show grab cursor */
    .task-card {
      cursor: grab;
    }

    .task-card:active {
      cursor: grabbing;
    }

    .modal-label {
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: #9ca3af;
      margin-bottom: 6px;
      display: block;
    }
  </style>
</head>

  <style>
    body { font-family: 'DM Sans', sans-serif; }
    .brand { font-family: 'Bebas Neue', sans-serif; letter-spacing: .06em; }

    ::-webkit-scrollbar { width: 4px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #C0282D55; border-radius: 99px; }

    /* Hide default date picker icon on webkit */
    input[type="date"]::-webkit-calendar-picker-indicator { opacity: 0; position: absolute; right: 0; width: 100%; cursor: pointer; }
    .date-wrapper { position: relative; }
    .date-wrapper .cal-icon { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #aaa; font-size: 16px; }
  </style>
</head>

<body class="flex h-screen overflow-hidden bg-[#FCF9F4] text-[#1A1A1A]">

  <!-- Success Confirmation Modal -->
  @if(session('success'))
  <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black/40 backdrop-blur-sm px-4 z-50" onclick="closeSuccessModal()">
    <div class="bg-[#FAF8F5] rounded-[32px] shadow-2xl w-full max-w-sm px-8 py-10 flex flex-col items-center text-center transform transition-all duration-300" onclick="event.stopPropagation()">

      <!-- Icon -->
      <div class="w-16 h-16 rounded-full flex items-center justify-center mb-6" style="background-color: #b2d8cc;">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="#3a8c72" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
      </div>

      <!-- Title -->
      <h2 class="brand text-2xl font-bold text-gray-900 leading-snug mb-4 uppercase tracking-wide">
        Submitted<br>Successfully
      </h2>

      <!-- Description -->
      <p class="text-gray-500 text-sm leading-relaxed mb-8">
        {{ session('success') }}
      </p>

      <!-- Button -->
      <button onclick="window.location.href='{{ route('projects') }}'" class="w-full py-4 rounded-full text-white font-semibold text-sm tracking-wide bg-[#c0272d] hover:bg-[#a82025] transition-colors shadow-md shadow-[#c0272d]/25">
        Back to Projects
      </button>

      <!-- Encrypted Label -->
      <div class="flex items-center gap-2 mt-8 text-gray-400 text-xs font-medium tracking-widest uppercase">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
          <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
        </svg>
        Encrypted
      </div>

    </div>
  </div>
  <script>
    function closeSuccessModal() {
      const modal = document.getElementById('successModal');
      if (modal) modal.remove();
    }
  </script>
  @endif

  <!-- SIDEBAR -->
  @include('partials.sidebar')


 <!-- MAIN WRAPPER -->
<div class="flex-1 flex flex-col overflow-hidden">

  <!-- HEADER -->
  <header class="flex items-center justify-between px-8 py-4 bg-[#FCF9F4] sticky top-0 z-10 flex-shrink-0">

    <div class="flex items-center gap-2">
      <span class="brand text-2xl text-red">PLANNER U</span>
      <span class="text-gray-300 font-light text-xl">×</span>
      <span class="brand text-2xl text-red">BPA</span>
    </div>

    <a href="{{ route('profile') }}" class="w-9 h-9 rounded-full bg-gray-300 border-2 border-white shadow flex items-center justify-center text-xs font-bold text-gray-600 select-none hover:ring-2 hover:ring-red transition cursor-pointer">
      {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
    </a>

  </header>

  <!-- CONTENT -->
  <div class="flex-1 overflow-y-auto px-8 pb-10 flex flex-col gap-5">

    <!-- HEADING -->
    <div>
      <h1 class="brand text-4xl tracking-widest">TASK</h1>

      <p class="text-[10px] font-semibold tracking-[.18em] text-gray-400 mt-0.5 uppercase">
        Manage and monitor all task in the Curriculum Division Workspace.
      </p>
    </div>

    <!-- PAGE CONTENT -->
    <main class="flex-1">

      <!-- Kanban Board – horizontal scroll -->
      <div class="kanban-scroll flex gap-5 overflow-x-auto pb-4 flex-1">

        <!-- Column: TO DO -->
        <div class="bg-[#f0ece6] rounded-2xl p-4 flex flex-col gap-3 min-w-[280px] w-[280px] shrink-0">
          <!-- Column Header -->
          <div class="flex items-center gap-2 mb-1">
            <span class="w-2.5 h-2.5 rounded-full bg-gray-400 inline-block"></span>
            <span class="text-xs font-semibold text-gray-500 tracking-widest uppercase">To Do</span>
            <span id="count-todo"
              class="ml-auto text-xs bg-gray-200 text-gray-500 rounded-full px-2 py-0.5 font-medium">{{ $todoTasks->count() }}</span>
          </div>

          <!-- Sortable card area -->
          <div id="col-todo" class="flex flex-col gap-3">
            @foreach($todoTasks as $task)
            <div data-task-id="{{ $task->id }}"
              onclick="openDetailModal({{ $task }})"
              class="task-card bg-white rounded-xl p-4 shadow-sm border-l-4 hover:shadow-md transition-shadow">
              <p class="font-semibold text-sm text-gray-800">{{ $task->title }}</p>
              <div class="flex items-center gap-1.5 mt-2 text-xs text-gray-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2" />
                  <path stroke-linecap="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                {{ $task->start_date }} – {{ $task->end_date }}
              </div>
            </div>
            @endforeach
          </div><!-- end col-todo -->

          <!-- Add Task Button -->
          <button onclick="openModal()"
            class="border-2 border-dashed border-gray-400 hover:border-[#b91c1c] text-gray-400 hover:text-[#b91c1c] text-xs font-semibold rounded-xl py-3 flex items-center justify-center gap-1 transition-colors hover:bg-red-50">
            + ADD TASK
          </button>
        </div>

        <!-- Column: IN PROGRESS -->
        <div class="bg-[#f0ece6] rounded-2xl p-4 flex flex-col gap-3 min-w-[280px] w-[280px] shrink-0">
          <!-- Column Header -->
          <div class="flex items-center gap-2 mb-1">
            <span class="w-2.5 h-2.5 rounded-full bg-[#DA8289] inline-block"></span>
            <span class="text-xs font-semibold text-gray-500 tracking-widest uppercase">In Progress</span>
            <span id="count-progress"
              class="ml-auto text-xs bg-gray-200 text-gray-500 rounded-full px-2 py-0.5 font-medium">{{ $progressTasks->count() }}</span>
          </div>

          <!-- Sortable card area -->
          <div id="col-progress" class="flex flex-col gap-3">
            @foreach($progressTasks as $task)
            <div data-task-id="{{ $task->id }}"
              onclick="openDetailModal({{ $task }})"
              class="task-card bg-white rounded-xl p-4 shadow-sm border-l-4 hover:shadow-md transition-shadow">
              <p class="font-semibold text-sm text-gray-800">{{ $task->title }}</p>
              <div class="flex items-center gap-1.5 mt-2 text-xs text-gray-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2" />
                  <path stroke-linecap="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                {{ $task->start_date }} – {{ $task->end_date }}
              </div>
            </div>
            @endforeach
          </div><!-- end col-progress -->

        </div><!-- end IN PROGRESS column -->

        <!-- Column: UNDER REVIEW -->
        <div class="bg-[#f0ece6] rounded-2xl p-4 flex flex-col gap-3 min-w-[280px] w-[280px] shrink-0">
          <!-- Column Header -->
          <div class="flex items-center gap-2 mb-1">
            <span class="w-2.5 h-2.5 rounded-full bg-[#b91c1c] inline-block"></span>
            <span class="text-xs font-semibold text-gray-500 tracking-widest uppercase">Under Review</span>
            <span id="count-review"
              class="ml-auto text-xs bg-gray-200 text-gray-500 rounded-full px-2 py-0.5 font-medium">{{ $reviewTasks->count() }}</span>
          </div>

          <!-- Sortable card area -->
          <div id="col-review" class="flex flex-col gap-3">
            @foreach($reviewTasks as $task)
            <div data-task-id="{{ $task->id }}"
              onclick="openDetailModal({{ $task }})"
              class="task-card bg-white rounded-xl p-4 shadow-sm border-l-4 hover:shadow-md transition-shadow relative">
              <p class="font-semibold text-sm text-gray-800">{{ $task->title }}</p>
              
              @if($task->review_status === 'revision' && $task->revision_notes)
              <div class="mt-2 p-2 bg-red-50 border border-red-200 rounded text-xs text-red-800">
                <strong>Revision:</strong> {{ $task->revision_notes }}
              </div>
              @endif

                <div class="flex items-center gap-1.5 text-xs text-gray-400">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2" />
                    <path stroke-linecap="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18" />
                  </svg>
                  {{ $task->start_date }} – {{ $task->end_date }}
                </div>
            </div>
            @endforeach
          </div><!-- end col-review -->

          <!-- Submit Button -->
          <button onclick="openSubmitModal('{{ $project->id }}', '{{ $project->name }}')"
            class="border border-[#b91c1c] text-[#b91c1c] text-xs font-semibold rounded-xl py-3 flex items-center justify-center gap-2 hover:bg-red-50 transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
            SUBMIT ALL
          </button>

        </div>

        <!-- Column: DONE -->
        <div class="bg-[#f0ece6] rounded-2xl p-4 flex flex-col gap-3 min-w-[280px] w-[280px] shrink-0">
          <!-- Column Header -->
          <div class="flex items-center gap-2 mb-1">
            <span class="w-2.5 h-2.5 rounded-full bg-green-500 inline-block"></span>
            <span class="text-xs font-semibold text-gray-500 tracking-widest uppercase">Done</span>
            <span id="count-done"
              class="ml-auto text-xs bg-gray-200 text-gray-500 rounded-full px-2 py-0.5 font-medium">{{ $doneTasks->count() }}</span>
          </div>

          <!-- Sortable card area -->
          <div id="col-done" class="flex flex-col gap-3">
            @foreach($doneTasks as $task)
            <div data-task-id="{{ $task->id }}"
              onclick="openDetailModal({{ $task }})"
              class="task-card bg-white rounded-xl p-4 shadow-sm border-l-4 flex items-start justify-between hover:shadow-md transition-shadow">
              <div>
                <p class="font-semibold text-sm text-gray-400 line-through">{{ $task->title }}</p>
                <div class="flex items-center gap-1.5 mt-2 text-xs text-gray-400">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2" />
                    <path stroke-linecap="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18" />
                  </svg>
                  <span class="line-through">{{ $task->start_date }} – {{ $task->end_date }}</span>
                </div>
              </div>
              <div class="bg-green-100 p-2 rounded-full">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
              </div>
            </div>
            @endforeach
          </div><!-- end col-done -->

        </div>

      </div><!-- end kanban-scroll -->
    </main>
  </div><!-- end main -->

  <div id="detailModal" class="modal-overlay" onclick="handleDetailOverlayClick(event)">
    <form id="detailForm" method="POST" action="" class="modal-box" onclick="event.stopPropagation()">
      @csrf
      @method('PUT')

      <!-- Modal Header -->
      <div class="px-8 pt-8 pb-6 border-b border-gray-200">
        <div class="flex items-start justify-between">
          <div>
            <p class="text-xs font-semibold text-[#b91c1c] uppercase tracking-widest mb-1">New Entry</p>
            <h2 id="detailModalTitle" class="brand-font text-2xl text-gray-800 tracking-wide">Task</h2>
          </div>
          <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600 transition-colors mt-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Modal Body -->
      <div class="px-8 py-6 flex flex-col gap-5">

        <!-- Task Title -->
        <div>
          <label class="modal-label">Task Title</label>
          <input id="detailTaskTitle" name="title" type="text" placeholder="What needs to be done?" class="modal-input" />
        </div>

        <!-- Description -->
        <div>
          <label class="modal-label">Description</label>
          <textarea id="detailTaskDesc" name="description" rows="4" placeholder="Briefly describe the objectives and constraints..."
            class="modal-input resize-none"></textarea>
        </div>

        <!-- PIC + Links -->
        <div class="grid grid-cols-3 gap-4">
          <!-- Primary PIC -->
          <div>
            <label class="modal-label">Primary PIC</label>
            <select id="detailTaskUserId" name="user_id" class="modal-input bg-[#f0ece6] rounded-xl px-3 py-2 w-full text-xs font-semibold text-gray-700">
              <option value="">Select Assignee</option>
              @foreach($availableUsers as $u)
                <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->division->name ?? 'Manager' }})</option>
              @endforeach
            </select>
            <!-- Start Date -->
            <div>
              <label class="modal-label">Start Date</label>
              <div class="relative">
                <input id="detailTaskStart" type="date" name="start_date" class="modal-input pr-9" />
              </div>
            </div>
            <!-- End Date -->
            <div>
              <label class="modal-label">End Date</label>
              <div class="relative">
                <input id="detailTaskEnd" type="date" name="end_date" class="modal-input pr-9" />
              </div>
            </div>
          </div>
          <!-- Brief Link -->
          <div>
            <label class="modal-label">Brief Link</label>
            <div class="flex items-center gap-2 bg-[#f0ece6] rounded-xl px-3 py-3">
              <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
              </svg>
              <input id="detailTaskBrief" name="brief_link" type="url" placeholder="Paste Google Drive or OneDrive link here..."
                class="bg-transparent border-none outline-none text-xs text-gray-600 placeholder-gray-400 flex-1 font-['Inter']" />
            </div>
          </div>
          <!-- Submission Link -->
          <div>
            <label class="modal-label">Submission Link</label>
            <div class="flex items-center gap-2 bg-[#f0ece6] rounded-xl px-3 py-3">
              <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
              </svg>
              <input id="detailTaskSubmission" name="submission_link" type="url" placeholder="Paste Google Drive or OneDrive link here..."
                class="bg-transparent border-none outline-none text-xs text-gray-600 placeholder-gray-400 flex-1 font-['Inter']" />
            </div>
          </div>
        </div>

        <!-- Sub-Tasks -->
        <div>
          <div class="flex items-center justify-between mb-3">
            <label class="modal-label mb-0">Sub-Tasks</label>
            <button type="button" onclick="toggleDetailSubTaskForm()"
              class="flex items-center gap-1 text-xs font-semibold text-[#b91c1c] hover:text-[#991b1b] transition-colors">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
              Add Sub-task
            </button>
          </div>

          <!-- Sub-task Form -->
          <div id="detailSubTaskForm" class="hidden bg-[#f0ece6] rounded-xl p-4 mb-3">
            <label class="modal-label">Sub-Task Title</label>
            <input id="detailSubTaskInput" type="text" placeholder="e.g., Finalize character sketches"
              class="modal-input mb-4" />
            <div class="flex justify-end gap-2">
              <button type="button" onclick="toggleDetailSubTaskForm()"
                class="text-xs text-gray-500 hover:text-gray-700 font-semibold px-4 py-2 rounded-lg transition-colors">Cancel</button>
              <button type="button" onclick="addDetailSubTask()"
                class="text-xs bg-[#b91c1c] hover:bg-[#991b1b] text-white font-semibold px-4 py-2 rounded-lg transition-colors">Add
                Sub-task</button>
            </div>
          </div>

          <!-- Sub-task List -->
          <div id="detailSubTaskList" class="flex flex-col gap-2">
            <!-- Populated via JS -->
          </div>
        </div>

      </div>

      <!-- Modal Footer -->
      <div class="px-8 py-5 border-t border-gray-200 flex items-center justify-end gap-3">
        <button type="button" onclick="closeDetailModal()"
          class="text-sm text-gray-500 hover:text-gray-700 font-semibold px-5 py-2.5 rounded-xl transition-colors">Cancel</button>
        <button type="button" id="detailSubmitBtn" onclick="submitTaskFromDetail()"
          class="text-sm bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm hidden">Submit for Review</button>
        <button type="submit"
          class="text-sm bg-[#b91c1c] hover:bg-[#991b1b] text-white font-semibold px-6 py-2.5 rounded-xl transition-colors shadow-sm">Save</button>
      </div>

    </form>
  </div>

  <!-- Submit Modal -->
  <div id="submitModal" class="modal-overlay" onclick="handleSubmitOverlayClick(event)">
    <form id="submitForm" method="POST" action="" onsubmit="dragRevertFn = null;" class="modal-box !max-w-[480px]" onclick="event.stopPropagation()">
      @csrf
      <div class="px-8 pt-8 pb-6 border-b border-gray-200">
        <h2 id="submitModalTitle" class="brand-font text-2xl text-gray-800 tracking-wide mb-1">Submit Project for Review</h2>
        <p class="text-xs text-gray-500 leading-relaxed">Ensure all assets are finalized and linked before submission. Your manager will receive a notification to begin the editorial review process.</p>
      </div>

      <div class="px-8 py-6 flex flex-col gap-6">
        <!-- Project Board -->
        <div>
          <label id="submitModalBoardLabel" class="modal-label">Project Board</label>
          <div class="flex items-center gap-3 bg-[#FAF9F7] border border-gray-100 rounded-xl px-4 py-3 cursor-not-allowed opacity-80">
            <div class="w-8 h-8 rounded-lg bg-[#EAE5DF] flex items-center justify-center text-[#b91c1c]">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
            </div>
            <span id="submitModalProjectName" class="text-sm font-semibold text-gray-800 flex-1">Proyek PM</span>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
          </div>
        </div>

        <!-- Manager Email -->
        <div>
          <label class="modal-label">Manager / Reviewer</label>
          <div class="flex items-center gap-3">
            <div class="flex-1 flex items-center gap-2 bg-[#FAF9F7] border border-gray-100 rounded-xl px-4 py-3 focus-within:border-[#b91c1c] transition-colors">
              <span class="text-gray-400 font-semibold text-sm">@</span>
              <input type="email" name="manager_email" required placeholder="Email..." class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-semibold text-gray-800 placeholder-gray-400 outline-none" />
            </div>
            <button type="button" class="bg-[#b91c1c] hover:bg-[#991b1b] text-white text-sm font-semibold px-5 py-3 rounded-xl flex items-center gap-1.5 transition-colors shadow-sm shrink-0">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
              Add
            </button>
          </div>
        </div>

        <!-- Notes for Reviewer -->
        <div>
          <label class="modal-label">Notes for Reviewer</label>
          <textarea name="submission_notes" placeholder="Describe any specific areas that need attention or context regarding the assets..." class="w-full bg-[#FAF9F7] border border-gray-100 rounded-xl px-4 py-3 focus:border-[#b91c1c] transition-colors resize-none h-24 outline-none text-sm font-semibold text-gray-800 placeholder-gray-400"></textarea>
        </div>

      </div>

      <div class="px-8 py-6 flex items-center gap-4">
        <button type="submit" class="flex-1 bg-[#b91c1c] hover:bg-[#991b1b] text-white font-semibold py-3.5 rounded-xl flex items-center justify-center gap-2 transition-colors shadow-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
          Submit for Review
        </button>
        <button type="button" onclick="closeSubmitModal()" class="text-sm font-semibold text-gray-600 hover:text-gray-800 px-6 transition-colors">Cancel</button>
      </div>
    </form>
  </div>

  <!-- Create New Task Modal -->
  <div id="taskModal" class="modal-overlay" onclick="handleOverlayClick(event)">
    <div class="modal-box" onclick="event.stopPropagation()">

<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <input type="hidden" name="project_id" value="{{ $project->id }}" />
      <!-- Modal Header -->
      <div class="px-8 pt-8 pb-6 border-b border-gray-200">
        <div class="flex items-start justify-between">
          <div>
            <p class="text-xs font-semibold text-[#b91c1c] uppercase tracking-widest mb-1">New Entry</p>
            <h2 class="brand-font text-2xl text-gray-800 tracking-wide">Create New Task</h2>
          </div>
          <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors mt-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Modal Body -->
      <div class="px-8 py-6 flex flex-col gap-5">

        <!-- Task Title -->
        <div>
          <label class="modal-label">Task Title</label>
          <input type="text"  name="title" placeholder="What needs to be done?" class="modal-input" />
        </div>

        <!-- Description -->
        <div>
          <label class="modal-label">Description</label>
          <textarea rows="4"  name="description" placeholder="Briefly describe the objectives and constraints..."
            class="modal-input resize-none"></textarea>
        </div>

        <!-- PIC + Dates -->
        <div class="grid grid-cols-3 gap-4">
          <!-- Primary PIC -->
          <div>
            <label class="modal-label">Primary PIC</label>
            <select id="editTaskUserId" name="user_id" class="modal-input bg-[#f0ece6] rounded-xl px-3 py-2 w-full text-xs font-semibold text-gray-700">
              <option value="">Select Assignee</option>
              @foreach($availableUsers as $u)
                <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->division->name ?? 'Manager' }})</option>
              @endforeach
            </select>
          </div>
          <!-- Start Date -->
          <div>
            <label class="modal-label">Start Date</label>
            <div class="relative">
              <input type="date"  name="start_date" class="modal-input pr-9" />
            </div>
          </div>
          <!-- End Date -->
          <div>
            <label class="modal-label">End Date</label>
            <div class="relative">
              <input type="date" name="end_date" class="modal-input pr-9" />
            </div>
          </div>
        </div>

        <!-- Brief Link -->
        <div>
          <label class="modal-label">Brief Link</label>
          <div class="flex items-center gap-2 bg-[#f0ece6] rounded-xl px-4 py-3">
            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
            </svg>
            <input type="url"  name="brief_link" placeholder="Paste Google Drive or OneDrive link here..."
              class="bg-transparent border-none outline-none text-sm text-gray-600 placeholder-gray-400 flex-1 font-['Inter']" />
          </div>
        </div>

        <!-- Sub-Tasks -->
        <div>
          <div class="flex items-center justify-between mb-3">
            <label class="modal-label mb-0">Sub-Tasks</label>
            <button type="button" onclick="toggleSubTaskForm()"
              class="flex items-center gap-1 text-xs font-semibold text-[#b91c1c] hover:text-[#991b1b] transition-colors">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
              Add Sub-task
            </button>
          </div>

          <!-- Sub-task Form (hidden by default) -->
          <div id="subTaskForm" class="hidden bg-[#f0ece6] rounded-xl p-4 mb-3">
            <label class="modal-label">Sub-Task Title</label>
            <input id="subTaskInput" type="text" placeholder="e.g., Finalize character sketches"
              class="modal-input mb-4" />
            <div class="flex justify-end gap-2">
              <button type="button" onclick="toggleSubTaskForm()"
                class="text-xs text-gray-500 hover:text-gray-700 font-semibold px-4 py-2 rounded-lg transition-colors">Cancel</button>
              <button type="button" onclick="addSubTask()"
                class="text-xs bg-[#b91c1c] hover:bg-[#991b1b] text-white font-semibold px-4 py-2 rounded-lg transition-colors">Add
                Sub-task</button>
            </div>
          </div>

          <!-- Sub-task List -->
          <div id="subTaskList" class="flex flex-col gap-2"></div>
        </div>

      </div>

      <div class="px-8 py-5 border-t border-gray-200 flex items-center justify-end gap-3">
        <button type="button" onclick="closeModal()"
          class="text-sm text-gray-500 hover:text-gray-700 font-semibold px-5 py-2.5 rounded-xl transition-colors">Cancel</button>
        <button
          type="submit"
          class="text-sm bg-[#b91c1c] hover:bg-[#991b1b] text-white font-semibold px-6 py-2.5 rounded-xl transition-colors shadow-sm">Create
          Task</button>
           </form>
      </div>
    </div>
  </div>

  <script>
    function openModal() {
      document.getElementById('taskModal').classList.add('open');
      document.body.style.overflow = 'hidden';
    }
    function closeModal() {
      document.getElementById('taskModal').classList.remove('open');
      document.body.style.overflow = '';
    }
    function handleOverlayClick(e) {
      if (e.target === document.getElementById('taskModal')) closeModal();
    }
    function toggleSubTaskForm() {
      const form = document.getElementById('subTaskForm');
      form.classList.toggle('hidden');
      if (!form.classList.contains('hidden')) {
        document.getElementById('subTaskInput').focus();
      }
    }
    function addSubTask() {
      const input = document.getElementById('subTaskInput');
      const title = input.value.trim();
      if (!title) return;
      const list = document.getElementById('subTaskList');
      const item = document.createElement('div');
      item.className = 'flex items-center gap-3 py-2.5 px-1 border-b border-gray-100 last:border-0';
      const uniqueId = 'subtask_' + Date.now() + Math.floor(Math.random() * 1000);
      item.innerHTML = `
        <svg class="w-4 h-4 text-gray-300 shrink-0 cursor-grab" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
        </svg>
        <div class="w-4 h-4 rounded-full border-2 border-gray-300 shrink-0"></div>
        <span class="text-sm text-gray-700 flex-1">${title}</span>
        <input type="hidden" name="subtasks[${uniqueId}][title]" value="${title}">
        <input type="hidden" name="subtasks[${uniqueId}][is_completed]" value="0">
        <button type="button" onclick="this.closest('div').remove()" class="text-gray-300 hover:text-red-400 transition-colors">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      `;
      list.appendChild(item);
      input.value = '';
      toggleSubTaskForm();
    }
    let currentDetailTask = null;
    let dragRevertFn = null;

    function openDetailModal(task) {
      currentDetailTask = task;
      document.getElementById('detailForm').action = `/tasks/update/${task.id}`;
      document.getElementById('detailModalTitle').textContent = task.title;
      document.getElementById('detailTaskTitle').value = task.title;
      document.getElementById('detailTaskDesc').value = task.description || '';
      document.getElementById('detailTaskStart').value = task.start_date || '';
      document.getElementById('detailTaskEnd').value = task.end_date || '';
      document.getElementById('detailTaskUserId').value = task.user_id || '';
      document.getElementById('detailTaskBrief').value = task.brief_link || '';
      document.getElementById('detailTaskSubmission').value = task.submission_link || '';

      const subtaskList = document.getElementById('detailSubTaskList');
      subtaskList.innerHTML = '';
      if (task.sub_tasks) {
          task.sub_tasks.forEach(sub => {
              addDetailSubTaskDOM(sub.title, sub.is_completed);
          });
      }

      const detailSubmitBtn = document.getElementById('detailSubmitBtn');
      if (detailSubmitBtn) {
        if (task.status !== 'review' && task.status !== 'done') {
          detailSubmitBtn.classList.remove('hidden');
        } else {
          detailSubmitBtn.classList.add('hidden');
        }
      }

      document.getElementById('detailModal').classList.add('open');
      document.body.style.overflow = 'hidden';
    }
    function closeDetailModal() {
      currentDetailTask = null;
      document.getElementById('detailModal').classList.remove('open');
      document.body.style.overflow = '';
    }
    function handleDetailOverlayClick(e) {
      if (e.target === document.getElementById('detailModal')) closeDetailModal();
    }
    function toggleDetailSubTaskForm() {
      const form = document.getElementById('detailSubTaskForm');
      form.classList.toggle('hidden');
      if (!form.classList.contains('hidden')) {
        document.getElementById('detailSubTaskInput').focus();
      }
    }
    function toggleCheck(el, uniqueId) {
      el.classList.toggle('checked');
      const label = el.nextElementSibling;
      if (label && label.classList.contains('subtask-text')) {
        label.classList.toggle('checked');
      }
      if (uniqueId) {
        const input = document.getElementById(uniqueId + '_completed');
        if (input) {
          input.value = el.classList.contains('checked') ? 1 : 0;
        }
      }
    }

    function addDetailSubTaskDOM(title, isCompleted = false) {
      const list = document.getElementById('detailSubTaskList');
      const item = document.createElement('div');
      item.className = 'flex items-center gap-3 py-2.5 px-1 border-b border-gray-100';
      const checkedClass = isCompleted ? 'checked' : '';
      const uniqueId = 'subtask_' + Date.now() + Math.floor(Math.random() * 1000);
      item.innerHTML = `
        <svg class="w-4 h-4 text-gray-300 shrink-0 cursor-grab" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
        </svg>
        <div class="subtask-check ${checkedClass}" onclick="toggleCheck(this, '${uniqueId}')">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
        </div>
        <span class="subtask-text text-sm text-gray-700 flex-1 ${checkedClass}">${title}</span>
        <input type="hidden" name="subtasks[${uniqueId}][title]" value="${title}">
        <input type="hidden" id="${uniqueId}_completed" name="subtasks[${uniqueId}][is_completed]" value="${isCompleted ? 1 : 0}">
        <button type="button" onclick="this.closest('div').remove()" class="text-gray-300 hover:text-red-400 transition-colors">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      `;
      list.appendChild(item);
    }

    function addDetailSubTask() {
      const input = document.getElementById('detailSubTaskInput');
      const title = input.value.trim();
      if (!title) return;
      addDetailSubTaskDOM(title);
      input.value = '';
      toggleDetailSubTaskForm();
    }
    
    function submitTaskFromDetail() {
      if (!currentDetailTask) return;
      const taskId = currentDetailTask.id;
      const taskTitle = currentDetailTask.title;
      closeDetailModal();
      openSubmitModal('{{ $project->id }}', '{{ $project->name }}', taskId, taskTitle);
    }

    // Submit Modal
    function openSubmitModal(projectId, projectName, taskId = null, taskTitle = null) {
      document.getElementById('submitModal').classList.add('open');
      document.body.style.overflow = 'hidden';
      
      const titleEl = document.getElementById('submitModalTitle');
      const labelEl = document.getElementById('submitModalBoardLabel');
      const nameEl = document.getElementById('submitModalProjectName');
      const formEl = document.getElementById('submitForm');
      
      formEl.reset();

      if (taskId) {
        if (titleEl) titleEl.innerText = "Submit Task for Review";
        if (labelEl) labelEl.innerText = "Task Title";
        if (nameEl) nameEl.innerText = taskTitle;
        formEl.action = '/tasks/submit/' + taskId;
      } else {
        if (titleEl) titleEl.innerText = "Submit Project for Review";
        if (labelEl) labelEl.innerText = "Project Board";
        if (nameEl) nameEl.innerText = projectName;
        if (projectId) {
          formEl.action = '/projects/' + projectId + '/submit-reviews';
        }
      }
    }
    function closeSubmitModal() {
      document.getElementById('submitModal').classList.remove('open');
      document.body.style.overflow = '';
      if (dragRevertFn) {
        dragRevertFn();
        dragRevertFn = null;
      }
    }
    function handleSubmitOverlayClick(e) {
      if (e.target === document.getElementById('submitModal')) closeSubmitModal();
    }

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') { 
        closeModal(); 
        closeDetailModal(); 
        closeSubmitModal(); 
        if (typeof closeSuccessModal === 'function') closeSuccessModal();
      }
    });

    // Toast Notification helper
    function showToast(message, type = 'success') {
      const existing = document.getElementById('dynamicToast');
      if (existing) existing.remove();

      const bgClass = type === 'error' ? 'bg-[#b91c1c]' : 'bg-[#137333]';
      const title = type === 'error' ? 'Error' : 'Success';
      const icon = type === 'error' 
        ? `<svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>`
        : `<svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>`;

      const toast = document.createElement('div');
      toast.id = 'dynamicToast';
      toast.className = `fixed top-6 right-6 ${bgClass} text-white px-6 py-4 rounded-2xl shadow-xl flex items-center gap-3 z-50 transition-all duration-500 transform translate-y-[-20px] opacity-0`;
      toast.innerHTML = `
        <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
          ${icon}
        </div>
        <div>
          <p class="font-bold text-sm">${title}</p>
          <p class="text-xs opacity-90">${message}</p>
        </div>
        <button onclick="document.getElementById('dynamicToast').remove()" class="text-white/70 hover:text-white ml-2 bg-transparent border-none cursor-pointer">
          <i class="ti ti-x"></i>
        </button>
      `;

      document.body.appendChild(toast);
      
      setTimeout(() => {
        toast.classList.remove('translate-y-[-20px]', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');
      }, 50);

      setTimeout(() => {
        const el = document.getElementById('dynamicToast');
        if (el) {
          el.style.opacity = '0';
          el.style.transform = 'translateY(-20px)';
          setTimeout(() => el.remove(), 500);
        }
      }, 4000);
    }

    // Drag & Drop — SortableJS
    const statusMap = {
      'col-todo': 'todo',
      'col-progress': 'progress',
      'col-review': 'review',
      'col-done': 'done',
    };
    const colIds = [
      { id: 'col-todo', counter: 'count-todo' },
      { id: 'col-progress', counter: 'count-progress' },
      { id: 'col-review', counter: 'count-review' },
      { id: 'col-done', counter: 'count-done' },
    ];
    function updateCounters() {
      colIds.forEach(({ id, counter }) => {
        const col = document.getElementById(id);
        const count = col ? col.querySelectorAll('.task-card').length : 0;
        const el = document.getElementById(counter);
        if (el) el.textContent = count;
      });
    }
    colIds.forEach(({ id }) => {
      const el = document.getElementById(id);
      if (!el) return;
      Sortable.create(el, {
        group: 'tasks',
        animation: 150,
        ghostClass: 'sortable-ghost',
        dragClass: 'sortable-drag',
        delay: 80,
        delayOnTouchOnly: true,
        onEnd(evt) {
          updateCounters();
          const taskId = evt.item.dataset.taskId;
          const newStatus = statusMap[evt.to.id];
          if (!taskId || !newStatus) return;
          
          if (newStatus === 'done') {
            // Revert drag immediately
            const originalParent = evt.from;
            const nextSibling = evt.nextSibling;
            if (nextSibling) {
              originalParent.insertBefore(evt.item, nextSibling);
            } else {
              originalParent.appendChild(evt.item);
            }
            updateCounters();
            
            showToast("Tasks can only be marked as Done via Manager approval.", "error");
            return;
          }
          
          fetch(`/tasks/status/${taskId}`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ status: newStatus }),
          });
        },
      });
    });
  </script>
</main>
</body>

</html>