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

  <!-- SIDEBAR -->
  <aside class="w-52 flex-shrink-0 bg-sidebar flex flex-col py-6 px-4 gap-5">

    <div class="brand text-3xl text-red px-1">
      PLANNER U
    </div>

    <!-- BUTTON OPEN MODAL -->
    <button
      id="openModal"
      class="flex items-center gap-2 bg-red hover:bg-red-dark transition text-white rounded-2xl px-4 py-3 text-sm font-semibold"
    >
      <i class="ti ti-plus text-base"></i>
      New Project
    </button>

    <!-- NAV -->
    <nav class="flex flex-col gap-1">

      <a href="/dashboard/{{ strtolower(Auth::user()->division->name) }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-500 hover:bg-white/40 font-medium text-sm transition">
        <i class="ti ti-layout-dashboard text-base"></i>
        Dashboard
      </a>

      <a href="{{ route('projects') }}"
   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-500 hover:bg-white/40 font-medium text-sm transition">
    <i class="ti ti-folder text-base"></i>
    Projects
</a>

<a href="{{ route('notifications.index') }}"
   class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-white/50 text-red font-semibold text-sm">
    <i class="ti ti-bell text-base"></i>
    Notification
</a>
    </nav>
  </aside>


 <!-- MAIN WRAPPER -->
<div class="flex-1 flex flex-col overflow-hidden">

  <!-- HEADER -->
  <header class="flex items-center justify-between px-8 py-4 bg-[#FCF9F4] sticky top-0 z-10 flex-shrink-0">

    <div class="flex items-center gap-2">
      <span class="brand text-2xl text-red">PLANNER U</span>
      <span class="text-gray-300 font-light text-xl">×</span>
      <span class="brand text-2xl text-red">BPA</span>
    </div>

    <div class="w-9 h-9 rounded-full bg-gray-300 border-2 border-white shadow flex items-center justify-center text-xs font-bold text-gray-600 select-none">
      AD
    </div>

  </header>

  <!-- CONTENT -->
  <div class="flex-1 overflow-y-auto px-8 pb-10 flex flex-col gap-5">

    <!-- HEADING -->
    <div>
      <h1 class="brand text-4xl tracking-widest">NOTIFICATIONS</h1>

      <p class="text-[10px] font-semibold tracking-[.18em] text-gray-400 mt-0.5 uppercase">
        Stay updated on task reviews and manager feedback.
      </p>
    </div>

    <!-- PAGE CONTENT -->
    <main class="flex-1 max-w-4xl">
      <div class="flex flex-col gap-4">
        @forelse($notifications as $notification)
        <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 {{ $notification->read_at ? 'border-gray-200 opacity-70' : 'border-[#b91c1c]' }}">
          <div class="flex justify-between items-start">
            <div>
              <h3 class="font-bold text-gray-800 text-lg mb-1">
                {{ $notification->data['title'] ?? 'Task Update' }}
              </h3>
              <p class="text-sm text-gray-600 mb-2">
                @if(($notification->data['action'] ?? '') == 'approved')
                  <span class="inline-block px-2 py-0.5 bg-green-100 text-green-800 text-xs rounded-full mr-2">Approved</span>
                  Manager has approved this task.
                @elseif(($notification->data['action'] ?? '') == 'revision')
                  <span class="inline-block px-2 py-0.5 bg-red-100 text-red-800 text-xs rounded-full mr-2">Revision Required</span>
                  Manager requested a revision.
                  <div class="mt-2 p-3 bg-red-50 text-red-800 text-sm rounded border border-red-100">
                    "{{ $notification->data['notes'] ?? 'No notes provided.' }}"
                  </div>
                @else
                  Action: {{ $notification->data['action'] ?? 'Unknown' }}
                @endif
              </p>
              <p class="text-xs text-gray-400">{{ $notification->created_at->diffForHumans() }}</p>
            </div>
            
            @if(is_null($notification->read_at))
            <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
              @csrf
              <button type="submit" class="text-xs font-semibold text-[#b91c1c] hover:text-[#991b1b] bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors">Mark as Read</button>
            </form>
            @endif
          </div>
        </div>
        @empty
        <div class="bg-white rounded-xl p-8 text-center text-gray-500 shadow-sm border border-gray-100">
          <p>No notifications yet.</p>
        </div>
        @endforelse
      </div>
    </main>

  </div><!-- end Content -->
</div><!-- end main wrapper -->

  <script>
    // Submit Modal
    function closeSubmitModal() {
      document.getElementById('submitModal').classList.remove('open');
      document.body.style.overflow = '';
    }
      if (e.target === document.getElementById('submitModal')) closeSubmitModal();
    }

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') { closeModal(); closeDetailModal(); closeSubmitModal(); }
    });

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