<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Planner U × BPA – Dashboard</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600&display=swap"
      rel="stylesheet"
    />

    <!-- Tabler Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css"
    />

    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              brand: ['"Bebas Neue"', "sans-serif"],
              body: ['"DM Sans"', "sans-serif"],
            },
            colors: {
              cream: "#EDE8E0",
              sidebar: "#D9D4CB",
              red: "#C0282D",
              "red-dark": "#A82025",
            },
            borderRadius: {
              "2xl": "1rem",
              "3xl": "1.25rem",
            },
          },
        },
      };
    </script>

    <style>
      body {
        font-family: "DM Sans", sans-serif;
      }
      .brand {
        font-family: "Bebas Neue", sans-serif;
        letter-spacing: 0.06em;
      }
      /* thin scrollbar */
      ::-webkit-scrollbar {
        width: 4px;
      }
      ::-webkit-scrollbar-track {
        background: transparent;
      }
      ::-webkit-scrollbar-thumb {
        background: #c0282d55;
        border-radius: 99px;
      }

      /* Search bar styles */
      .search-wrapper {
        position: relative;
        display: flex;
        align-items: center;
      }
      .search-input {
        background: #ffffff;
        border: 1.5px solid #E8E3DC;
        border-radius: 999px;
        padding: 0.5rem 1.1rem 0.5rem 2.6rem;
        font-size: 0.85rem;
        color: #1A1A1A;
        width: 260px;
        outline: none;
        font-family: "DM Sans", sans-serif;
        transition: border-color 0.2s, box-shadow 0.2s, width 0.3s;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
      }
      .search-input::placeholder {
        color: #b0aaa4;
      }
      .search-input:focus {
        border-color: #C0282D55;
        box-shadow: 0 0 0 3px #C0282D18;
        width: 300px;
      }
      .search-icon {
        position: absolute;
        left: 0.85rem;
        color: #b0aaa4;
        font-size: 1rem;
        pointer-events: none;
        transition: color 0.2s;
      }
      .search-wrapper:focus-within .search-icon {
        color: #C0282D;
      }

      /* Avatar ring */
      .avatar-ring {
        background: #EDE8E0;
        border-radius: 999px;
        padding: 3px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.10);
        display: flex;
        align-items: center;
        justify-content: center;
      }
    </style>
  </head>

  <body class="flex h-screen overflow-hidden bg-[#FCF9F4] text-[#1A1A1A]">
    <!-- ══════════════════════════════════════════
       SIDEBAR
  ══════════════════════════════════════════ -->
    <aside class="w-52 flex-shrink-0 bg-sidebar flex flex-col py-6 px-4 gap-5">
      <!-- Logo -->
      <div class="brand text-3xl text-red px-1">PLANNER U</div>

      <!-- New Project -->
      <button
        class="flex items-center gap-2 bg-red hover:bg-red-dark transition text-white rounded-2xl px-4 py-3 text-sm font-semibold"
      >
        <i class="ti ti-plus text-base"></i>
        New Project
      </button>

      <!-- Nav -->
      <nav class="flex flex-col gap-1">
        <!-- Active -->
        <a
          href="/dashboard/{{ strtolower(Auth::user()->division->name ?? 'ac') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-white/50 text-red font-semibold text-sm"
        >
          <i class="ti ti-layout-dashboard text-base"></i>
          Dashboard
        </a>
        <a
          href="{{ route('projects') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-500 hover:bg-white/40 font-medium text-sm transition"
        >
          <i class="ti ti-folder text-base"></i>
          Projects
        </a>
        <a
          href="{{ route('notifications.index') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-500 hover:bg-white/40 font-medium text-sm transition"
        >
          <i class="ti ti-bell text-base"></i>
          Notification
        </a>
      </nav>
    </aside>

    <!-- ══════════════════════════════════════════
       MAIN
  ══════════════════════════════════════════ -->
    <main class="flex-1 flex flex-col overflow-hidden">
      <!-- ── TOPBAR ── -->
      <header
        class="flex items-center justify-between px-8 py-4 bg-[#FCF9F4] sticky top-0 z-10 flex-shrink-0"
      >
        <!-- Left: Logo -->
        <div class="flex items-center gap-2">
          <span class="brand text-2xl text-red">PLANNER U</span>
          <span class="text-gray-300 font-light text-xl">×</span>
          <span class="brand text-2xl text-red">BPA</span>
        </div>

        <!-- Right: Search Bar + Bell + Avatar -->
        <div class="flex items-center gap-3">
          <div class="search-wrapper">
            <i class="ti ti-search search-icon"></i>
            <input
              type="text"
              class="search-input"
              placeholder="Search projects..."
            />
          </div>
          <!-- Bell -->
          <div class="avatar-ring">
            <button
              class="w-9 h-9 rounded-full bg-red hover:bg-red-dark transition text-white flex items-center justify-center"
            >
              <i class="ti ti-bell text-base"></i>
            </button>
          </div>
          <!-- Avatar Link to Profile -->
          <a href="{{ route('profile') }}" class="avatar-ring cursor-pointer hover:ring-2 hover:ring-red transition" style="display: block;">
            <div class="w-9 h-9 rounded-full bg-gray-300 border-2 border-white shadow flex items-center justify-center text-xs font-bold text-gray-600 select-none">
              {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
          </a>
        </div>
      </header>

      <!-- ── SCROLLABLE CONTENT ── -->
      <div class="flex-1 overflow-y-auto px-8 pb-10 flex flex-col gap-5">
        <!-- Page Heading -->
        <div>
          <h1 class="brand text-4xl tracking-widest">DASHBOARD</h1>
          <p
            class="text-[10px] font-semibold tracking-[.2em] text-gray-400 mt-0.5 uppercase"
          >
            Welcome to the Accademic Cooperation Division Dashboard
          </p>
        </div>

        <!-- ─── STAT CARDS ─── -->
        <div class="grid grid-cols-3 gap-4">
          <!-- Active Projects -->
          <div
            class="relative bg-white border border-black/10 rounded-3xl p-6 overflow-hidden shadow-sm"
          >
            <p
              class="text-[10px] font-bold tracking-[.16em] uppercase text-red mb-2"
            >
              Active Projects
            </p>
            <p class="text-6xl font-black leading-none">{{ $activeProjects }}</p>
            <p class="text-xs text-gray-500 mt-3 leading-relaxed">
              Total production boards currently in progress within this division.
            </p>
            <!-- Decorative grid -->
            <div
              class="absolute bottom-4 right-4 grid grid-cols-2 gap-1 opacity-[.12]"
            >
              <div class="w-7 h-7 border-2 border-gray-500 rounded-sm"></div>
              <div class="w-7 h-7 border-2 border-gray-500 rounded-sm"></div>
              <div class="w-7 h-7 border-2 border-gray-500 rounded-sm"></div>
              <div class="w-7 h-7 border-2 border-gray-500 rounded-sm"></div>
            </div>
          </div>

          <!-- Overall Task Success -->
          <div class="bg-[#F5B8B8] rounded-3xl p-6 shadow-sm">
            <p
              class="text-[10px] font-bold tracking-[.16em] uppercase text-red mb-2"
            >
              Overall Task Success
            </p>
            <p class="text-6xl font-black leading-none">{{ $taskSuccessPercent }}%</p>
            <p class="text-xs text-red font-semibold mt-3">
              ↗ {{ $doneTasks }} of {{ $totalTasks }} tasks completed.
            </p>
          </div>

          <!-- Completed Projects -->
          <div
            class="bg-[#E4DFD7] border border-black/10 rounded-3xl p-6 shadow-sm"
          >
            <p
              class="text-[10px] font-bold tracking-[.16em] uppercase text-gray-400 mb-2"
            >
              Completed Projects
            </p>
            <p class="text-6xl font-black leading-none">{{ $completedProjects }}</p>
            <p class="text-xs text-gray-500 mt-3 leading-relaxed">
              Projects where all tasks are fully resolved.
            </p>
          </div>
        </div>


        <!-- ─── URGENT TASKS + TEAM PERFORMANCE ─── -->
        <div class="grid grid-cols-3 gap-4">
          <!-- Urgent Tasks (2 cols) -->
          <div
            class="col-span-2 bg-white border border-black/10 rounded-3xl p-6 shadow-sm"
          >
            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
              <h2
                class="text-[11px] font-bold tracking-[.16em] uppercase flex items-center gap-1"
              >
                <span class="text-red font-black text-base">!</span> Urgent
                Tasks
              </h2>
              <span
                class="bg-red text-white text-[10px] font-bold px-3 py-1 rounded-full tracking-wide"
              >
                Action Required
              </span>
            </div>

            <!-- Task List -->
            <div class="divide-y divide-black/[.07]">
              @forelse($urgentTasks as $task)
              <div class="flex items-start justify-between py-3">
                <div>
                  <p class="font-semibold text-sm">{{ $task->title }}</p>
                  <p class="text-xs text-gray-400 mt-0.5">
                    Proyek : {{ $task->project->name ?? '-' }}
                  </p>
                </div>
                <div class="text-right flex-shrink-0 ml-4">
                  <p
                    class="text-[10px] font-bold {{ $task->urgency_label === 'Overdue' ? 'text-red' : 'text-gray-400' }} uppercase tracking-wide"
                  >
                    {{ $task->urgency_label }}
                  </p>
                  <p
                    class="text-xs font-semibold text-red mt-0.5 cursor-pointer hover:underline"
                  >
                    {{ $task->urgency_label === 'Overdue' ? 'Complete Now' : 'Complete Soon' }}
                  </p>
                </div>
              </div>
              @empty
              <div class="py-4 text-center text-xs text-gray-400">
                No urgent tasks — great job! 🎉
              </div>
              @endforelse
            </div>

            <!-- See All -->
            <div class="text-right mt-3">
              <a href="{{ route('projects') }}" class="text-xs font-semibold text-red hover:underline"
                >Lihat Semua</a
              >
            </div>
          </div>

          <!-- Team Performance -->
          <div
            class="bg-white border border-black/10 rounded-3xl p-6 shadow-sm"
          >
            <h2 class="text-[11px] font-bold tracking-[.16em] uppercase mb-5">
              Team Performance
            </h2>

            @forelse($teamPerformance as $member)
            <div class="{{ !$loop->last ? 'mb-5' : '' }}">
              <div class="flex items-center justify-between mb-1.5">
                <span class="text-sm font-semibold">{{ $member->name }}</span>
                <span
                  class="bg-red text-white text-[9px] font-bold px-2 py-0.5 rounded-full tracking-wide"
                  >{{ $member->completed_tasks }} TASKS</span
                >
              </div>
              <div class="h-1.5 bg-[#D3CEC6] rounded-full overflow-hidden">
                <div
                  class="h-full bg-red rounded-full"
                  style="width: {{ $maxDone > 0 ? round(($member->completed_tasks / $maxDone) * 100) : 0 }}%"
                ></div>
              </div>
            </div>
            @empty
            <p class="text-xs text-gray-400">No team members yet.</p>
            @endforelse
          </div>
        </div>

        <!-- ─── RECENT ACTIVITY ─── -->
        <div class="bg-white border border-black/10 rounded-3xl p-6 shadow-sm">
          <h2 class="text-[11px] font-bold tracking-[.16em] uppercase mb-5">
            Recent Activity
          </h2>

          <div class="flex flex-col gap-5">
            @forelse($recentActivity as $activity)
            <div class="flex items-start gap-4">
              <div
                class="w-9 h-9 rounded-full bg-[#D3CEC6] flex items-center justify-center flex-shrink-0 text-gray-500"
              >
                <i class="ti {{ $activity->icon }} text-sm"></i>
              </div>
              <div>
                <p class="text-sm font-semibold">{{ $activity->title }}</p>
                <p class="text-xs text-gray-500 leading-relaxed mt-0.5">
                  {{ Str::limit($activity->message, 120) }}
                </p>
                <p class="text-[10px] text-gray-400 mt-1">{{ $activity->time }}</p>
              </div>
            </div>
            @empty
            <p class="text-xs text-gray-400">No recent activity yet.</p>
            @endforelse
          </div>
        </div>

      </div>
      <!-- /scrollable content -->
    </main>


  </body>
</html>
