<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Planner U × BPA – Notifications</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet" />

  <!-- Tabler Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />

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
    body { font-family: 'DM Sans', sans-serif; }
    .brand { font-family: 'Bebas Neue', sans-serif; letter-spacing: .06em; }

    ::-webkit-scrollbar { width: 4px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: transparent; border-radius: 99px; }

    .notif-card {
      background: #ffffff;
      border: 1px solid #e0dbd4;
      border-radius: 14px;
      padding: 22px 24px;
      display: flex;
      gap: 18px;
      align-items: flex-start;
      transition: box-shadow 0.18s;
    }
    .notif-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.07); }
    .notif-icon {
      width: 42px; height: 42px;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      font-size: 1.2rem;
    }
    .notif-label {
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.8px;
      text-transform: uppercase;
      margin-bottom: 5px;
    }
    .notif-body {
      font-size: 0.9rem;
      line-height: 1.5;
      color: #1a1612;
      margin-bottom: 14px;
    }
    .notif-time {
      font-size: 0.78rem;
      color: #9a9080;
      white-space: nowrap;
      padding-top: 2px;
    }
    .action-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 0.8rem;
      font-weight: 600;
      padding: 7px 16px;
      border-radius: 999px;
      border: none;
      cursor: pointer;
      transition: opacity 0.15s, transform 0.15s;
      text-decoration: none;
    }
    .action-btn:hover { opacity: 0.88; transform: translateY(-1px); }
    .btn-green { background: #d1f0e0; color: #1a7a45; }
    .btn-red { background: #C0282D; color: #fff; }

    .modal-overlay {
      opacity: 0; pointer-events: none; transition: opacity 0.2s ease;
    }
    .modal-overlay.open {
      opacity: 1; pointer-events: auto;
    }
  </style>
</head>

<body class="flex h-screen overflow-hidden bg-[#FCF9F4] text-[#1A1A1A]">

  <!-- SIDEBAR -->
  <aside class="w-52 flex-shrink-0 bg-sidebar flex flex-col py-6 px-4 gap-5">
    <div class="brand text-3xl text-red px-1">
      <img src="{{ asset('images/logo-planneru.png') }}" alt="Planner U">
    </div>

    <!-- New Project -->
    <button onclick="window.location.href='{{ route('projects') }}?new_project=true'"
        class="flex items-center gap-2 bg-red hover:bg-red-dark transition text-white rounded-2xl px-4 py-3 text-sm font-semibold">
        <i class="ti ti-plus text-base"></i>
        New Project
    </button>

    <!-- NAV -->
    <nav class="flex flex-col gap-1">
      <a href="{{ Auth::user()->division ? '/dashboard/' . strtolower(Auth::user()->division->name) : route('manager.dashboard') }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-500 hover:bg-white/40 font-medium text-sm transition">
        <i class="ti ti-layout-dashboard text-base"></i>
        Dashboard
      </a>

      <a href="{{ Auth::user()->division ? route('projects') : route('manager.projects.index') }}"
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

  <!-- MAIN -->
  <main class="flex-1 flex flex-col overflow-hidden">

    <!-- TOPBAR -->
    @include('partials.staff_header')

    <!-- CONTENT -->
    <div class="flex-1 overflow-y-auto px-8 pb-10 flex flex-col gap-5 max-w-4xl">
      
      <!-- HEADING -->
      <div class="mt-4 mb-2">
        <h1 class="brand text-4xl tracking-widest">NOTIFICATIONS</h1>
        <p class="text-[10px] font-semibold tracking-[.18em] text-gray-400 mt-0.5 uppercase">
          Curated updates from your workspace.
        </p>
      </div>

      <div class="flex flex-col gap-4">
        @forelse($notifications as $notification)
          @php
            $task = \App\Models\Task::find($notification->data['task_id']);
            $projectId = $notification->data['project_id'] ?? ($task ? $task->project_id : null);
          @endphp
          
          <div class="notif-card {{ $notification->read_at ? 'opacity-75' : '' }}">
            @if($notification->data['action'] == 'approved')
              <!-- Approved Icon -->
              <div class="notif-icon" style="background:#d1f0e0;">
                <i class="ti ti-check text-[#1a7a45]"></i>
              </div>
            @elseif($notification->data['action'] == 'revision')
              <!-- Revision Icon -->
              <div class="notif-icon" style="background:#fde8ea;">
                <i class="ti ti-alert-triangle text-red"></i>
              </div>
            @endif

            <div class="flex-1 min-w-0">
              <div class="flex items-start justify-between gap-4">
                <span class="notif-label {{ $notification->data['action'] == 'approved' ? 'text-[#1a7a45]' : 'text-red' }}">
                  Manager {{ ucfirst($notification->data['action']) }}
                </span>
                <span class="notif-time">{{ $notification->created_at->diffForHumans() }}</span>
              </div>
              <p class="notif-body">
                @if($notification->data['action'] == 'approved')
                  Task "<strong>{{ $notification->data['title'] }}</strong>" has been approved by the Manager and moved to Archives.
                @elseif($notification->data['action'] == 'revision')
                  Manager requested revisions for "<strong>{{ $notification->data['title'] }}</strong>". Please check the revision notes.
                @endif
              </p>

              <div class="flex gap-3">
                @if($notification->data['action'] == 'approved' && $projectId)
                  <a href="{{ route('projects.tasks', $projectId) }}" class="action-btn btn-green">
                    <i class="ti ti-archive"></i>
                    View Archives
                  </a>
                @elseif($notification->data['action'] == 'revision')
                  <button onclick="openNotesModal('{{ addslashes($notification->data['notes'] ?? 'No notes provided.') }}')" class="action-btn btn-red">
                    <i class="ti ti-file-description"></i>
                    See Notes
                  </button>
                @endif

                @if(is_null($notification->read_at))
                  <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="text-xs font-semibold text-gray-400 hover:text-gray-600 underline mt-2 inline-block">
                      Mark as read
                    </button>
                  </form>
                @endif
              </div>
            </div>
          </div>
        @empty
          <p class="text-gray-500 font-medium">You have no new notifications.</p>
        @endforelse
      </div>

    </div>
  </main>
</div>

<!-- NOTES MODAL -->
<div id="notesModal" class="modal-overlay fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4" onclick="if(event.target===this)closeNotesModal()">
  <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden">
    <div class="px-8 pt-8 pb-4 border-b border-gray-100">
      <h2 class="font-brand text-2xl tracking-wide text-red">REVISION NOTES</h2>
    </div>
    <div class="px-8 py-6">
      <p id="modalNotesText" class="text-gray-700 leading-relaxed text-sm"></p>
    </div>
    <div class="px-8 pb-8 flex justify-end">
      <button type="button" onclick="closeNotesModal()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-6 rounded-xl transition-colors">
        Close
      </button>
    </div>
  </div>
</div>

<script>
  function openNotesModal(notes) {
    document.getElementById('modalNotesText').textContent = notes;
    document.getElementById('notesModal').classList.add('open');
  }

  function closeNotesModal() {
    document.getElementById('notesModal').classList.remove('open');
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeNotesModal();
  });
</script>

</body>
</html>
