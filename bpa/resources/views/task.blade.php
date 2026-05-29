<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Planner U – Projects</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Inter:wght@400;500;600&display=swap"
    rel="stylesheet" />
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
      background: rgba(0,0,0,0.4);
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
      max-width: 600px;
      max-height: 90vh;
      overflow-y: auto;
      transform: translateY(20px);
      transition: transform 0.2s ease;
      box-shadow: 0 20px 60px rgba(0,0,0,0.18);
    }
    .modal-overlay.open .modal-box {
      transform: translateY(0);
    }
    .modal-box::-webkit-scrollbar { width: 4px; }
    .modal-box::-webkit-scrollbar-thumb { background: #c8b9a8; border-radius: 99px; }
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
    .modal-label {
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: #9ca3af;
      margin-bottom: 6px;
      display: block;
    }
  </style>
</head>

<body class="min-h-screen flex">

  <!-- Sidebar -->
  <aside class="w-56 min-h-screen bg-[#e8e2da] flex flex-col py-6 px-4 shrink-0">
    <!-- Logo -->
    <div class="brand-font text-[#b91c1c] text-2xl tracking-wider mb-8 px-2">PLANNER U</div>

    <!-- New Project Button -->
    <button
      class="flex items-center justify-center gap-2 bg-[#b91c1c] hover:bg-[#991b1b] text-white text-sm font-semibold rounded-lg py-3 px-4 mb-6 transition-colors">
      <span class="text-lg leading-none">+</span>
      New Project
    </button>

    <!-- Nav Items -->
    <nav class="flex flex-col gap-1">
      <a href="#"
        class="flex items-center gap-3 text-sm text-gray-500 hover:text-gray-800 rounded-lg px-3 py-2 transition-colors">
        <!-- Dashboard icon -->
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <rect x="3" y="3" width="7" height="7" rx="1" stroke-width="2" />
          <rect x="14" y="3" width="7" height="7" rx="1" stroke-width="2" />
          <rect x="3" y="14" width="7" height="7" rx="1" stroke-width="2" />
          <rect x="14" y="14" width="7" height="7" rx="1" stroke-width="2" />
        </svg>
        Dashboard
      </a>
      <a href="#"
        class="flex items-center gap-3 text-sm text-[#b91c1c] font-semibold bg-white rounded-lg px-3 py-2 shadow-sm">
        <!-- Projects icon -->
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 7a2 2 0 012-2h3l2 2h9a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
        </svg>
        Projects
      </a>
      <a href="#"
        class="flex items-center gap-3 text-sm text-gray-500 hover:text-gray-800 rounded-lg px-3 py-2 transition-colors">
        <!-- Bell icon -->
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        Notification
      </a>
    </nav>
  </aside>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col min-w-0">

    <!-- Top Navbar -->
    <header class="bg-[#ede9e3] flex items-center justify-between px-8 py-4 shrink-0">
      <div class="flex items-center gap-3">
        <span class="brand-font text-[#b91c1c] text-xl tracking-wider">PLANNER U</span>
        <span class="text-gray-400 font-light text-lg">×</span>
        <span class="brand-font text-[#b91c1c] text-xl tracking-wider">BPA</span>
      </div>
      <div class="flex items-center gap-3">
        <!-- Search -->
        <div class="relative">
          <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="8" stroke-width="2" />
            <path stroke-linecap="round" stroke-width="2" d="M21 21l-4.35-4.35" />
          </svg>
          <input type="text" placeholder="Search projects..."
            class="pl-9 pr-4 py-2 bg-white rounded-full text-sm text-gray-600 placeholder-gray-400 outline-none border border-transparent focus:border-red-200 w-52 transition-all" />
        </div>
        <!-- Bell -->
        <button
          class="w-9 h-9 bg-white rounded-full flex items-center justify-center shadow-sm hover:shadow transition-shadow">
          <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>
        </button>
        <!-- Avatar -->
        <div
          class="w-9 h-9 rounded-full bg-[#b91c1c] flex items-center justify-center text-white text-xs font-bold shadow-sm">
          AU
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <main class="flex-1 px-8 pt-2 pb-8 flex flex-col min-w-0 overflow-hidden">
      <!-- Page Title -->
      <div class="mb-6">
        <h1 class="brand-font text-3xl text-gray-800 tracking-wide">PROJECTS</h1>
        <p class="text-xs text-gray-400 tracking-widest uppercase mt-1">Manage and monitor all projects in the
          Curriculum Division workspace.</p>
      </div>

      <!-- Kanban Board – horizontal scroll -->
      <div class="kanban-scroll flex gap-5 overflow-x-auto pb-4 flex-1">

        <!-- Column: TO DO -->
        <div class="bg-[#f0ece6] rounded-2xl p-4 flex flex-col gap-3 min-w-[280px] w-[280px] shrink-0">
          <!-- Column Header -->
          <div class="flex items-center gap-2 mb-1">
            <span class="w-2.5 h-2.5 rounded-full bg-gray-400 inline-block"></span>
            <span class="text-xs font-semibold text-gray-500 tracking-widest uppercase">To Do</span>
            <span class="ml-auto text-xs bg-gray-200 text-gray-500 rounded-full px-2 py-0.5 font-medium">1</span>
          </div>

          <!-- Task Card -->
          <div class="bg-white rounded-xl p-4 shadow-sm border-l-4 border-gray-400">
            <p class="font-semibold text-sm text-gray-800">Proyek PM</p>
            <div class="flex items-center gap-1.5 mt-2 text-xs text-gray-400">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2" />
                <path stroke-linecap="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18" />
              </svg>
              Oct 12 – Oct 22
            </div>
          </div>

          <!-- Add Task Button -->
          <button onclick="openModal()"
            class="border-2 border-dashed border-gray-400 hover:border-[#b91c1c] text-gray-400 hover:text-[#b91c1c] text-xs font-semibold rounded-xl py-3 flex items-center justify-center gap-1 transition-colors hover:bg-red-50">
            + ADD TASK
          </button>
        </div>

        <!-- Column: IN PROGRESS -->
        <div class="bg-[#f0ece6] rounded-2xl p-4 flex flex-col gap-3 min-w-[280px] w-[280px] shrink-0">
          <div class="flex items-center gap-2 mb-1">
            <span class="w-2.5 h-2.5 rounded-full bg-[#DA8289] inline-block"></span>
            <span class="text-xs font-semibold text-gray-500 tracking-widest uppercase">In Progress</span>
            <span class="ml-auto text-xs bg-gray-200 text-gray-500 rounded-full px-2 py-0.5 font-medium">2</span>
          </div>

          <!-- Task Card 1 -->
          <div class="bg-white rounded-xl p-4 shadow-sm border-l-4 border-[#DA8289]">
            <p class="font-semibold text-sm text-gray-800">Desain UI Dashboard</p>
            <div class="flex items-center gap-1.5 mt-2 text-xs text-gray-400">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2" />
                <path stroke-linecap="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18" />
              </svg>
              Oct 10 – Oct 25
            </div>
          </div>

          <!-- Task Card 2 -->
          <div class="bg-white rounded-xl p-4 shadow-sm border-l-4 border-[#DA8289]">
            <p class="font-semibold text-sm text-gray-800">Integrasi API Backend</p>
            <div class="flex items-center gap-1.5 mt-2 text-xs text-gray-400">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2" />
                <path stroke-linecap="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18" />
              </svg>
              Oct 14 – Oct 28
            </div>
          </div>


        </div>

        <!-- Column: UNDER REVIEW -->
        <div class="bg-[#f0ece6] rounded-2xl p-4 flex flex-col gap-3 min-w-[280px] w-[280px] shrink-0">
          <div class="flex items-center gap-2 mb-1">
            <span class="w-2.5 h-2.5 rounded-full bg-[#b91c1c] inline-block"></span>
            <span class="text-xs font-semibold text-gray-500 tracking-widest uppercase">Under Review</span>
            <span class="ml-auto text-xs bg-gray-200 text-gray-500 rounded-full px-2 py-0.5 font-medium">1</span>
          </div>



          <!-- Task Card -->
          <div class="bg-white rounded-xl p-4 shadow-sm border-l-4 border-[#b91c1c]">
            <p class="font-semibold text-sm text-gray-800">Laporan Akhir BPA</p>
            <div class="flex items-center gap-1.5 mt-2 text-xs text-gray-400">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2" />
                <path stroke-linecap="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18" />
              </svg>
              Oct 20 – Oct 30
            </div>
          </div>

          <!-- Submit Button -->
          <button
            class="border border-[#b91c1c] text-[#b91c1c] text-xs font-semibold rounded-xl py-3 flex items-center justify-center gap-2 hover:bg-red-50 transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
            SUBMIT
          </button>

        </div>

        <!-- Column: DONE -->
        <div class="bg-[#f0ece6] rounded-2xl p-4 flex flex-col gap-3 min-w-[280px] w-[280px] shrink-0">
          <div class="flex items-center gap-2 mb-1">
            <span class="w-2.5 h-2.5 rounded-full bg-green-500 inline-block"></span>
            <span class="text-xs font-semibold text-gray-500 tracking-widest uppercase">Done</span>
            <span class="ml-auto text-xs bg-gray-200 text-gray-500 rounded-full px-2 py-0.5 font-medium">0</span>
          </div>

          <!-- Task Card -->
          <div class="bg-white rounded-xl p-4 shadow-sm border-l-4 border-green-500 flex items-start justify-between">

            <!-- Left Content -->
            <div>
              <p class="font-semibold text-sm text-gray-400 line-through">
                Laporan Akhir BPA
              </p>

              <div class="flex items-center gap-1.5 mt-2 text-xs text-gray-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2" />
                  <path stroke-linecap="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18" />
                </svg>

                <span class="line-through">
                  Oct 20 – Oct 30
                </span>
              </div>
            </div>

            <!-- Checklist -->
            <div class="bg-green-100 p-2 rounded-full">
              <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
              </svg>
            </div>

          </div>

        </div>

      </div><!-- end kanban-scroll -->
    </main>
  </div><!-- end main -->

  <!-- Create New Task Modal -->
  <div id="taskModal" class="modal-overlay" onclick="handleOverlayClick(event)">
    <div class="modal-box" onclick="event.stopPropagation()">

      <!-- Modal Header -->
      <div class="px-8 pt-8 pb-6 border-b border-gray-200">
        <div class="flex items-start justify-between">
          <div>
            <p class="text-xs font-semibold text-[#b91c1c] uppercase tracking-widest mb-1">New Entry</p>
            <h2 class="brand-font text-2xl text-gray-800 tracking-wide">Create New Task</h2>
          </div>
          <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors mt-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
      </div>

      <!-- Modal Body -->
      <div class="px-8 py-6 flex flex-col gap-5">

        <!-- Task Title -->
        <div>
          <label class="modal-label">Task Title</label>
          <input type="text" placeholder="What needs to be done?" class="modal-input" />
        </div>

        <!-- Description -->
        <div>
          <label class="modal-label">Description</label>
          <textarea rows="4" placeholder="Briefly describe the objectives and constraints..." class="modal-input resize-none"></textarea>
        </div>

        <!-- PIC + Dates -->
        <div class="grid grid-cols-3 gap-4">
          <!-- Primary PIC -->
          <div>
            <label class="modal-label">Primary PIC</label>
            <div class="flex items-center gap-2 bg-[#f0ece6] rounded-xl px-3 py-2">
              <div class="w-7 h-7 rounded-full bg-[#b91c1c] flex items-center justify-center text-white text-[10px] font-bold shrink-0">MT</div>
              <div class="flex-1 min-w-0">
                <p class="text-xs font-semibold text-gray-700 truncate">Marcus Thorne</p>
                <p class="text-[10px] text-gray-400 truncate">Lead Editor</p>
              </div>
              <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </div>
          </div>
          <!-- Start Date -->
          <div>
            <label class="modal-label">Start Date</label>
            <div class="relative">
              <input type="date" class="modal-input pr-9" />
            </div>
          </div>
          <!-- End Date -->
          <div>
            <label class="modal-label">End Date</label>
            <div class="relative">
              <input type="date" class="modal-input pr-9" />
            </div>
          </div>
        </div>

        <!-- Brief Link -->
        <div>
          <label class="modal-label">Brief Link</label>
          <div class="flex items-center gap-2 bg-[#f0ece6] rounded-xl px-4 py-3">
            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
            </svg>
            <input type="url" placeholder="Paste Google Drive or OneDrive link here..." class="bg-transparent border-none outline-none text-sm text-gray-600 placeholder-gray-400 flex-1 font-['Inter']" />
          </div>
        </div>

        <!-- Sub-Tasks -->
        <div>
          <div class="flex items-center justify-between mb-3">
            <label class="modal-label mb-0">Sub-Tasks</label>
            <button onclick="toggleSubTaskForm()" class="flex items-center gap-1 text-xs font-semibold text-[#b91c1c] hover:text-[#991b1b] transition-colors">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
              </svg>
              Add Sub-task
            </button>
          </div>

          <!-- Sub-task Form (hidden by default) -->
          <div id="subTaskForm" class="hidden bg-[#f0ece6] rounded-xl p-4 mb-3">
            <label class="modal-label">Sub-Task Title</label>
            <input id="subTaskInput" type="text" placeholder="e.g., Finalize character sketches" class="modal-input mb-4" />
            <div class="flex justify-end gap-2">
              <button onclick="toggleSubTaskForm()" class="text-xs text-gray-500 hover:text-gray-700 font-semibold px-4 py-2 rounded-lg transition-colors">Cancel</button>
              <button onclick="addSubTask()" class="text-xs bg-[#b91c1c] hover:bg-[#991b1b] text-white font-semibold px-4 py-2 rounded-lg transition-colors">Add Sub-task</button>
            </div>
          </div>

          <!-- Sub-task List -->
          <div id="subTaskList" class="flex flex-col gap-2"></div>
        </div>

      </div>

      <!-- Modal Footer -->
      <div class="px-8 py-5 border-t border-gray-200 flex items-center justify-end gap-3">
        <button onclick="closeModal()" class="text-sm text-gray-500 hover:text-gray-700 font-semibold px-5 py-2.5 rounded-xl transition-colors">Cancel</button>
        <button class="text-sm bg-[#b91c1c] hover:bg-[#991b1b] text-white font-semibold px-6 py-2.5 rounded-xl transition-colors shadow-sm">Create Task</button>
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
      item.innerHTML = `
        <svg class="w-4 h-4 text-gray-300 shrink-0 cursor-grab" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
        </svg>
        <div class="w-4 h-4 rounded-full border-2 border-gray-300 shrink-0"></div>
        <span class="text-sm text-gray-700 flex-1">${title}</span>
        <button onclick="this.closest('div').remove()" class="text-gray-300 hover:text-red-400 transition-colors">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      `;
      list.appendChild(item);
      input.value = '';
      toggleSubTaskForm();
    }
    // Close on Escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeModal();
    });
  </script>

</body>

</html>