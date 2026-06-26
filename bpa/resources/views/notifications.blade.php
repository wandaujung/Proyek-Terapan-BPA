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
      transition: box-shadow 0.18s, background-color 0.2s, opacity 0.2s;
    }
    .notif-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.07); }
    .notif-card.read {
      background: #EDEBE6;
      opacity: 0.7;
      box-shadow: none !important;
    }
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
  @include('partials.sidebar')

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
            $task = isset($notification->data['task_id']) ? \App\Models\Task::find($notification->data['task_id']) : null;
            $projectId = $notification->data['project_id'] ?? ($task ? $task->project_id : null);
          @endphp
          
          <div class="notif-card notif-card-item {{ $notification->read_at ? 'read' : 'cursor-pointer hover:bg-black/[0.01]' }}"
               data-id="{{ $notification->id }}"
               data-read="{{ $notification->read_at ? 'true' : 'false' }}">
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
            @elseif($notification->data['action'] == 'removed')
              <!-- Removed Icon -->
              <div class="notif-icon" style="background:#fde8ea;">
                <i class="ti ti-trash text-red"></i>
              </div>
            @else
              <!-- Added Icon -->
              <div class="notif-icon" style="background:#e5efff;">
                <i class="ti ti-circle-plus text-[#0066ff]"></i>
              </div>
            @endif

            <div class="flex-1 min-w-0">
              <div class="flex items-start justify-between gap-4">
                <span class="notif-label {{ $notification->data['action'] == 'approved' ? 'text-[#1a7a45]' : ($notification->data['action'] == 'removed' ? 'text-red' : ($notification->data['action'] == 'revision' ? 'text-red' : ($notification->data['action'] == 'updated' ? 'text-[#0066ff]' : 'text-[#0066ff]'))) }}">
                  @if($notification->data['action'] == 'approved') Manager Approval @elseif($notification->data['action'] == 'revision') Revision Request @elseif($notification->data['action'] == 'removed') Project Removed @elseif($notification->data['action'] == 'updated') Project Updated @else New Project Added @endif
                </span>
                <span class="notif-time">{{ $notification->created_at->diffForHumans() }}</span>
              </div>
              <p class="notif-body">
                @if($notification->data['action'] == 'approved')
                  Task "<strong>{{ $notification->data['title'] }}</strong>" has been approved by the Manager and moved to Archives.
                @elseif($notification->data['action'] == 'revision')
                  Manager requested revisions for "<strong>{{ $notification->data['title'] }}</strong>". Please check the revision notes.
                @elseif($notification->data['action'] == 'removed')
                  Project "<strong>{{ $notification->data['title'] }}</strong>" has been removed from the workspace.
                @elseif($notification->data['action'] == 'updated')
                  Project "<strong>{{ $notification->data['title'] }}</strong>" has been updated in your workspace.
                @else
                  Project "<strong>{{ $notification->data['title'] }}</strong>" has been added to your workspace.
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
                @elseif(($notification->data['action'] == 'added' || $notification->data['action'] == 'updated' || $notification->data['action'] == 'project_added' || !in_array($notification->data['action'], ['approved', 'revision', 'removed'])) && $projectId)
                  <a href="{{ route('projects.tasks', $projectId) }}" class="action-btn btn-green" style="background:#d6e4ff; color:#0066ff;">
                    <i class="ti ti-folder"></i>
                    View Project
                  </a>
                @endif

                @if(is_null($notification->read_at))
                  <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="m-0">
                    @csrf
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
