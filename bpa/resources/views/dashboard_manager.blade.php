<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Planner U – Manager Overview</title>
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
              redLight: '#E53E3E',
              bg: '#F0EDEA',
              card: '#FFFFFF',
              sidebar: '#E8E4E0',
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

    /* Sidebar active state */
    .nav-active {
      background-color: #FFFFFF;
      color: #CC1D1D;
      font-weight: 700;
    }
    .nav-item {
      transition: background 0.15s, color 0.15s;
    }
    .nav-item:hover:not(.nav-active) {
      background-color: #DDD9D5;
    }

    /* Tab active */
    .tab-active {
      background-color: #FFFFFF;
      color: #1A1A1A;
      box-shadow: 0 1px 4px rgba(0,0,0,0.10);
    }
    .tab-item {
      transition: background 0.15s, color 0.15s;
      cursor: pointer;
    }

    /* Card hover */
    .project-card {
      transition: transform 0.18s ease, box-shadow 0.18s ease;
      cursor: pointer;
    }
    .project-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 24px rgba(0,0,0,0.10);
    }

    /* Review card hover */
    .review-card {
      transition: transform 0.18s ease, box-shadow 0.18s ease;
      cursor: pointer;
    }
    .review-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    /* Scrollbar */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-thumb { background: #C5BFB9; border-radius: 3px; }

    /* Avatar placeholder */
    .avatar {
      width: 36px; height: 36px;
      border-radius: 50%;
      object-fit: cover;
      background: #C5BFB9;
      display: flex; align-items: center; justify-content: center;
      font-size: 13px; font-weight: 700; color: #6B6560;
      flex-shrink: 0;
    }
  </style>
</head>
<body class="min-h-screen">

  <div class="flex min-h-screen">

    <!-- ======= SIDEBAR ======= -->
    <aside class="w-[170px] min-h-screen flex-shrink-0 flex flex-col pt-0" style="background:#E8E4E0;">

      <!-- Logo -->
      <div class="px-5 pt-5 pb-6">
        <span class="font-condensed text-2xl font-extrabold tracking-wide" style="color:#CC1D1D;">PLANNER U</span>
      </div>

      <!-- Nav -->
      <nav class="flex flex-col gap-1 px-3">
        <a id="nav-dashboard" href="{{ route('manager.dashboard') }}" class="nav-item nav-active flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">
          <!-- Dashboard icon -->
          
          <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
            <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
          </svg>
          Dashboard
        </a>
        <a id="nav-projects" href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-brand-muted">
          <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M3 7h18M3 12h18M3 17h18"/>
          </svg>
          Projects
        </a>
        <a id="nav-reviews" href="{{ route('manager.reviews') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-brand-muted">
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
        <!-- Brand -->
        <div class="flex items-center gap-3">
          <span class="font-condensed text-2xl font-extrabold tracking-wide" style="color:#CC1D1D;">PLANNER U</span>
          <span class="text-brand-muted font-semibold text-sm">✕</span>
          <span class="font-condensed text-2xl font-extrabold tracking-wide" style="color:#CC1D1D;">BPA</span>
        </div>

        <div class="ml-auto flex items-center gap-3">
          <!-- Bell -->
          <button class="w-9 h-9 rounded-full flex items-center justify-center hover:bg-brand-border transition-colors">
            <svg class="w-5 h-5 text-brand-muted" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
          </button>
          <!-- Avatar -->
          <div class="avatar" style="background:#C5BFB9;">ML</div>
        </div>
      </header>

      <!-- Content -->
      <div id="page-dashboard" class="flex-1 px-8 py-8 overflow-y-auto">

        <!-- Page Heading -->
        <h1 class="font-condensed font-extrabold text-3xl tracking-wide text-brand-text mb-1">MANAGER OVERVIEW</h1>
        <p class="text-xs font-semibold tracking-widest text-brand-muted uppercase mb-6">
          Monitor project progress, track ongoing activities, and review project performance from your manager dashboard.
        </p>

        <!-- Tabs -->
        <div class="inline-flex items-center bg-brand-border rounded-full p-1 mb-8">
          <button id="tab-active-progress" class="tab-item tab-active text-sm font-semibold px-5 py-1.5 rounded-full" onclick="showTab('active')">Active Progress</button>
          <button id="tab-review-queue" class="tab-item text-sm font-medium px-5 py-1.5 rounded-full text-brand-muted" onclick="showTab('review')">Review Queue</button>
        </div>

        <!-- ======= ACTIVE PROGRESS SECTIONS ======= -->
        <div id="panel-active">

        @foreach($divisions as $division)
        @if($division->projects->count() > 0)
        <section class="mb-10">
          <h2 class="font-condensed font-bold text-xl tracking-widest text-brand-text uppercase mb-4">{{ $division->name }}</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            
            @foreach($division->projects as $project)
            <div class="project-card bg-white rounded-2xl p-5 flex flex-col gap-4 border border-brand-border" onclick="window.location.href='{{ route('projects.tasks', $project->id) }}'">
              <div>
                <span class="inline-block bg-brand-red text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1 rounded-full mb-3">Project</span>
                <h3 class="font-condensed font-extrabold text-lg text-brand-text uppercase leading-tight">{{ $project->name }}</h3>
                <p class="text-xs text-brand-muted mt-0.5">{{ $project->tasks->count() }} Tasks</p>
              </div>
              <div class="flex-1"></div>
              
              @php
                $pic = $project->tasks->first()->user ?? null;
              @endphp

              @if($pic)
              <div class="flex items-center gap-2">
                <div class="avatar text-xs">{{ strtoupper(substr($pic->name, 0, 2)) }}</div>
                <div>
                  <p class="text-xs font-bold text-brand-text leading-none">{{ $pic->name }}</p>
                  <p class="text-[10px] text-brand-muted uppercase tracking-wider">Person in Charge</p>
                </div>
              </div>
              @endif

              <div class="flex items-center justify-between border-t border-brand-border pt-3">
                <div class="flex items-center gap-1.5 text-xs text-brand-muted">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                  {{ \Carbon\Carbon::parse($project->start_project)->format('M d') }} - {{ \Carbon\Carbon::parse($project->end_project)->format('M d, Y') }}
                </div>
                <button class="w-6 h-6 rounded-full hover:bg-brand-border flex items-center justify-center transition-colors">
                  <svg class="w-4 h-4 text-brand-muted" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
                </button>
              </div>
            </div>
            @endforeach

          </div>
        </section>
        @endif
        @endforeach

        </div><!-- /panel-active -->

        <!-- ======= REVIEW QUEUE PANEL ======= -->
        <div id="panel-review" class="hidden">

          <!-- Pending Reviews badge -->
          <div class="mb-5">
            <span class="inline-block bg-brand-red text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1.5 rounded">Pending Reviews</span>
          </div>

          <!-- Review items list -->
          <div class="flex flex-col gap-4">

            @foreach($reviewTasks as $task)
            <div class="bg-white rounded-2xl border border-brand-border p-6 relative review-card">
              <div class="flex items-start justify-between gap-4">
                <div class="flex-1">
                  <h3 class="font-condensed font-extrabold text-xl text-brand-text mb-1">{{ $task->title }}</h3>
                  <p class="text-xs text-brand-muted mb-4">{{ $task->user->name ?? 'Staff' }} &nbsp;·&nbsp; {{ $task->updated_at->diffForHumans() }}</p>
                  <div class="bg-brand-bg rounded-lg border-l-4 px-4 py-3" style="border-color:#CC1D1D;">
                    <p class="text-[10px] font-bold tracking-widest uppercase text-brand-red mb-1">Project</p>
                    <p class="text-sm text-brand-muted italic">"{{ $task->project->name ?? 'No Project' }}"</p>
                  </div>
                </div>
                <a href="{{ route('manager.review_detail', $task->id) }}" class="flex-shrink-0 flex items-center gap-1 text-[11px] font-bold tracking-widest uppercase text-brand-text hover:text-brand-red transition-colors mt-1">
                  Review Details
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6m0 0v6m0-6L10 14"/></svg>
                </a>
              </div>
            </div>
            @endforeach

          </div>
        </div><!-- /panel-review -->

      </div><!-- /Content Dashboard -->

    </main>
  </div>

  <script>
    function showTab(tab) {
      const activeBtn   = document.getElementById('tab-active-progress');
      const reviewBtn   = document.getElementById('tab-review-queue');
      const activePanel = document.getElementById('panel-active');
      const reviewPanel = document.getElementById('panel-review');

      if (tab === 'active') {
        activeBtn.classList.add('tab-active');
        activeBtn.classList.remove('text-brand-muted');
        reviewBtn.classList.remove('tab-active');
        reviewBtn.classList.add('text-brand-muted');
        activePanel.classList.remove('hidden');
        reviewPanel.classList.add('hidden');
      } else {
        reviewBtn.classList.add('tab-active');
        reviewBtn.classList.remove('text-brand-muted');
        activeBtn.classList.remove('tab-active');
        activeBtn.classList.add('text-brand-muted');
        reviewPanel.classList.remove('hidden');
        activePanel.classList.add('hidden');
      }
    }
  </script>
</body>
</html>
