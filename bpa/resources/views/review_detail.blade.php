<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Planner U – Review Detail</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800&family=Barlow+Condensed:wght@700;800&display=swap" rel="stylesheet"/>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Barlow', 'sans-serif'],
            condensed: ['Barlow Condensed', 'sans-serif'],
          },
          colors: {
            brand: {
              red: '#CC1D1D',
              redDark: '#A81515',
              bg: '#F0EDEA',
              text: '#1A1A1A',
              muted: '#6B6560',
              border: '#D6D0CA',
            }
          }
        }
      }
    }
  </script>
  <style>
    body { background-color: #F0EDEA; font-family: 'Barlow', sans-serif; }

    .nav-active {
      background-color: #FFFFFF;
      color: #CC1D1D;
      font-weight: 700;
    }
    .nav-item { transition: background 0.15s, color 0.15s; }
    .nav-item:hover:not(.nav-active) { background-color: #DDD9D5; }

    .file-card {
      transition: transform 0.15s ease, box-shadow 0.15s ease;
      cursor: pointer;
    }
    .file-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    }

    .btn-approve {
      transition: background 0.18s, transform 0.12s;
    }
    .btn-approve:hover {
      background: #1A5C45 !important;
      transform: translateY(-1px);
    }
    .btn-approve:active { transform: translateY(0); }

    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-thumb { background: #C5BFB9; border-radius: 3px; }
  </style>
</head>
<body class="min-h-screen">

  <div class="flex min-h-screen">

    <!-- ======= SIDEBAR ======= -->
    <aside class="w-[170px] min-h-screen flex-shrink-0 flex flex-col" style="background:#E8E4E0;">
      <div class="px-5 pt-5 pb-6">
        <span class="font-condensed text-2xl font-extrabold tracking-wide" style="color:#CC1D1D;">PLANNER U</span>
      </div>
      <nav class="flex flex-col gap-1 px-3">
        <a href="{{ route('manager.dashboard') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-brand-muted">
          <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
            <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
          </svg>
          Dashboard
        </a>
        <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-brand-muted">
          <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M3 7h18M3 12h18M3 17h18"/>
          </svg>
          Projects
        </a>
        <a href="{{ route('manager.reviews') }}" class="nav-item nav-active flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">
          <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M9 17H7A5 5 0 017 7h2M15 7h2a5 5 0 010 10h-2M9 12h6"/>
          </svg>
          Reviews
        </a>
      </nav>
    </aside>

    <!-- ======= MAIN ======= -->
    <main class="flex-1 flex flex-col min-h-screen">

      <!-- Top Bar -->
      <header class="flex items-center gap-4 px-8 py-4 border-b border-brand-border bg-brand-bg sticky top-0 z-10">
        <div class="flex items-center gap-3">
          <span class="font-condensed text-2xl font-extrabold tracking-wide" style="color:#CC1D1D;">PLANNER U</span>
          <span class="text-brand-muted font-semibold text-sm">✕</span>
          <span class="font-condensed text-2xl font-extrabold tracking-wide" style="color:#CC1D1D;">BPA</span>
        </div>
        <div class="ml-auto flex items-center gap-3">
          <button class="w-9 h-9 rounded-full flex items-center justify-center hover:bg-brand-border transition-colors">
            <svg class="w-5 h-5 text-brand-muted" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
          </button>
          <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-bold" style="background:#C5BFB9; color:#6B6560;">ML</div>
        </div>
      </header>

      <!-- Content -->
      <div class="flex-1 px-8 py-8 overflow-y-auto">

        <!-- Back -->
        <a href="reviews.html" class="inline-flex items-center gap-2 text-xs font-bold tracking-widest uppercase text-brand-muted hover:text-brand-text transition-colors mb-6">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path d="M15 19l-7-7 7-7"/>
          </svg>
          Back to Queue
        </a>

        <!-- Badge + Title -->
        <div class="mb-4">
          <span class="inline-block bg-brand-red text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1.5 rounded mb-3">Editorial Review</span>
          <h1 class="font-condensed font-extrabold text-4xl text-brand-text leading-tight">{{ $task->title }}</h1>
        </div>

        <!-- Submitter meta -->
        <div class="flex items-center gap-6 mb-8">
          <div class="flex items-center gap-3">
            <!-- Avatar placeholder -->
            <div class="w-10 h-10 rounded-full flex items-center justify-center text-xs font-bold overflow-hidden" style="background:#C5BFB9; color:#6B6560; flex-shrink:0;">{{ strtoupper(substr($task->user->name ?? 'U', 0, 2)) }}</div>
            <div>
              <p class="text-[10px] font-bold tracking-widest uppercase text-brand-muted">Submitted By</p>
              <p class="text-sm font-bold text-brand-text">{{ $task->user->name ?? 'Staff' }}</p>
            </div>
          </div>
          <div>
            <p class="text-[10px] font-bold tracking-widest uppercase text-brand-muted">Date Submitted</p>
            <p class="text-sm font-bold text-brand-text">{{ $task->updated_at->format('M d, Y') }}</p>
          </div>
        </div>

        <!-- Two-column layout -->
        <div class="flex flex-col lg:flex-row gap-6">

          <!-- Left column -->
          <div class="flex-1 flex flex-col gap-6">

            <!-- Task Description -->
            <div class="bg-white rounded-2xl border border-brand-border p-6">
              <div class="flex items-center gap-2 mb-4">
                <svg class="w-4 h-4 text-brand-text" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path d="M4 6h16M4 12h16M4 18h7"/>
                </svg>
                <h2 class="font-condensed font-extrabold text-lg text-brand-text">Description</h2>
              </div>
              <p class="text-sm text-brand-muted italic leading-relaxed">
                "{{ $task->description ?? 'No description provided.' }}"
              </p>
            </div>

            <!-- Evidence Link -->
            <div>
              <h2 class="font-condensed font-bold text-base tracking-widest uppercase text-brand-text mb-4">Evidence Link</h2>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                <!-- File 1 -->
                @if($task->submission_link)
                <a href="{{ $task->submission_link }}" target="_blank" class="file-card bg-white rounded-xl border border-brand-border p-4 flex items-center gap-3">
                  <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#FDE8E8;">
                    <svg class="w-5 h-5" fill="none" stroke="#CC1D1D" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/>
                    </svg>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-brand-text leading-tight truncate">Submission Link</p>
                    <p class="text-xs text-brand-muted mt-0.5">Click to view</p>
                  </div>
                  <div class="flex-shrink-0 w-7 h-7 flex items-center justify-center rounded-md hover:bg-brand-bg transition-colors">
                    <svg class="w-4 h-4 text-brand-muted" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                  </div>
                </a>
                @endif

              </div>
            </div>

          </div><!-- /left column -->

          <!-- Right column -->
          <div class="lg:w-72 flex flex-col gap-4">

            <!-- Review Decision card -->
            <div class="bg-white rounded-2xl border border-brand-border p-6">
              <h2 class="font-condensed font-extrabold text-lg text-brand-text mb-4">Review Decision</h2>
              <form action="{{ route('tasks.approve', $task->id) }}" method="POST">
                @csrf
                <button type="submit" id="btn-approve" class="btn-approve w-full flex items-center justify-center gap-2 text-white text-sm font-bold py-3 px-4 rounded-full mb-3" style="background:#1F6B50;">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                  Approve Task
                </button>
              </form>

              <hr class="my-4 border-brand-border" />

              <form action="{{ route('tasks.revision', $task->id) }}" method="POST">
                @csrf
                <label class="block text-xs font-bold tracking-widest uppercase text-brand-muted mb-2">Request Revision</label>
                <textarea name="revision_notes" rows="3" class="w-full bg-brand-bg rounded-xl border-none p-3 text-sm text-brand-text mb-3" placeholder="Add revision notes..." required></textarea>
                <button type="submit" class="w-full flex items-center justify-center gap-2 text-brand-red border-2 border-brand-red bg-white hover:bg-red-50 text-sm font-bold py-2.5 px-4 rounded-full transition-colors">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                  </svg>
                  Request Revision
                </button>
              </form>
            </div>

            <!-- Info notice -->
            <div class="rounded-2xl border border-brand-border p-5 flex items-start gap-3" style="background:#F5EFE8;">
              <div class="flex-shrink-0 mt-0.5">
                <svg class="w-4 h-4" fill="none" stroke="#A86B2A" stroke-width="2" viewBox="0 0 24 24">
                  <circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/>
                </svg>
              </div>
              <p class="text-xs text-brand-muted leading-relaxed">
                Approval will automatically notify the project or team and move this project to the Complete.
              </p>
            </div>

          </div><!-- /right column -->

        </div><!-- /two-column -->

      </div><!-- /Content -->
    </main>
  </div>

  <!-- Approve modal / toast -->
  <div id="toast" class="fixed bottom-8 left-1/2 -translate-x-1/2 bg-brand-text text-white text-sm font-semibold px-6 py-3 rounded-full shadow-lg opacity-0 pointer-events-none transition-opacity duration-300 flex items-center gap-2 z-50">
    <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
      <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    Project approved! Team has been notified.
  </div>

  <script>
    function handleApprove() {
      const btn = document.getElementById('btn-approve');
      btn.innerHTML = `
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
          <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Approved!
      `;
      btn.style.background = '#145c3e';
      btn.disabled = true;
      btn.style.opacity = '0.85';
      btn.style.cursor = 'default';

      const toast = document.getElementById('toast');
      toast.style.opacity = '1';
      toast.style.pointerEvents = 'auto';
      setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.pointerEvents = 'none';
      }, 3000);
    }
  </script>
</body>
</html>
