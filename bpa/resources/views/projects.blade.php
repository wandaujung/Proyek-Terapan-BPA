<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Planner U × BPA – Projects</title>

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
    ::-webkit-scrollbar-thumb { background: #C0282D55; border-radius: 99px; }
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
    <button class="flex items-center gap-2 bg-red hover:bg-red-dark transition text-white rounded-2xl px-4 py-3 text-sm font-semibold">
      <i class="ti ti-plus text-base"></i>
      New Project
    </button>

    <!-- Nav -->
    <nav class="flex flex-col gap-1">
      <a href="dashboard.html" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-500 hover:bg-white/40 font-medium text-sm transition">
        <i class="ti ti-layout-dashboard text-base"></i>
        Dashboard
      </a>
      <!-- Active -->
      <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-white/50 text-red font-semibold text-sm">
        <i class="ti ti-folder text-base"></i>
        Projects
      </a>
      <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-gray-500 hover:bg-white/40 font-medium text-sm transition">
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
    <header class="flex items-center justify-between px-8 py-4 bg-[#FCF9F4] sticky top-0 z-10 flex-shrink-0">
      <div class="flex items-center gap-2">
        <span class="brand text-2xl text-red">PLANNER U</span>
        <span class="text-gray-300 font-light text-xl">×</span>
        <span class="brand text-2xl text-red">BPA</span>
      </div>

      <div class="flex items-center gap-3">
        <!-- Search -->
        <div class="flex items-center gap-2 bg-white border border-black/10 rounded-full px-4 py-2 w-52 shadow-sm">
          <i class="ti ti-search text-gray-400 text-sm"></i>
          <input
            type="text"
            placeholder="Search projects..."
            class="bg-transparent outline-none text-sm text-gray-500 placeholder-gray-400 w-full"
          />
        </div>
        <!-- Bell -->
        <button class="w-9 h-9 rounded-full bg-red hover:bg-red-dark transition text-white flex items-center justify-center">
          <i class="ti ti-bell text-base"></i>
        </button>
        <!-- Avatar -->
        <div class="w-9 h-9 rounded-full bg-gray-300 border-2 border-white shadow flex items-center justify-center text-xs font-bold text-gray-600 select-none">
          AD
        </div>
      </div>
    </header>

    <!-- ── SCROLLABLE CONTENT ── -->
    <div class="flex-1 overflow-y-auto px-8 pb-10 flex flex-col gap-5">

      <!-- Page Heading -->
      <div>
        <h1 class="brand text-4xl tracking-widest">PROJECTS</h1>
        <p class="text-[10px] font-semibold tracking-[.18em] text-gray-400 mt-0.5 uppercase">
          Manage and monitor all projects in the Curriculum Division Workspace.
        </p>
      </div>

      <!-- ─── PROJECT GRID ─── -->
      <div class="grid grid-cols-3 gap-4">

        <!-- ── Card: Initiate New Entry ── -->
        <div class="bg-white border-2 border-dashed border-black/15 rounded-3xl flex flex-col items-center justify-center gap-3 p-8 min-h-[220px] cursor-pointer hover:border-red/40 hover:bg-red/5 transition group">
          <div class="w-12 h-12 rounded-full border-2 border-black/20 group-hover:border-red/40 flex items-center justify-center transition">
            <i class="ti ti-plus text-xl text-gray-400 group-hover:text-red transition"></i>
          </div>
          <div class="text-center">
            <p class="font-semibold text-sm text-gray-700 group-hover:text-red transition">Initiate New Entry</p>
            <p class="text-xs text-gray-400 mt-0.5">Start a fresh editorial project</p>
          </div>
        </div>

        <!-- ── Project Card Template ──
             Duplikat blok ini untuk menambah kartu proyek baru -->

        <!-- Card 1 -->
        <div class="bg-white border border-black/10 rounded-3xl p-6 shadow-sm flex flex-col justify-between min-h-[220px] hover:shadow-md transition cursor-pointer">
          <div class="flex flex-col gap-2">
            <span class="bg-red text-white text-[9px] font-bold px-2.5 py-1 rounded-full w-fit tracking-widest">TEAM MEMBER</span>
            <h3 class="brand text-2xl tracking-wider mt-1">PROYEK TERAPAN</h3>
            <p class="text-xs text-gray-400 font-medium">28 Sub-tasks</p>
          </div>

          <div class="flex flex-col gap-3 mt-4">
            <!-- PIC -->
            <div class="flex items-center gap-2.5">
              <div class="w-8 h-8 rounded-full bg-[#D3CEC6] overflow-hidden flex-shrink-0">
                <img src="https://i.pravatar.cc/32?img=47" alt="PIC" class="w-full h-full object-cover" />
              </div>
              <div>
                <p class="text-[10px] font-bold tracking-wide text-[#1A1A1A]">MUTHIA LUTHFI N</p>
                <p class="text-[9px] text-gray-400 tracking-wide">PERSON IN CHARGE</p>
              </div>
            </div>
            <!-- Date -->
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-1.5 text-xs text-gray-500">
                <i class="ti ti-calendar text-gray-400 text-sm"></i>
                Jan 12 - Mar 20, 2024
              </div>
              <div class="w-6 h-6 rounded-full bg-[#F0EDE8] flex items-center justify-center">
                <i class="ti ti-chevron-right text-xs text-gray-500"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white border border-black/10 rounded-3xl p-6 shadow-sm flex flex-col justify-between min-h-[220px] hover:shadow-md transition cursor-pointer">
          <div class="flex flex-col gap-2">
            <span class="bg-red text-white text-[9px] font-bold px-2.5 py-1 rounded-full w-fit tracking-widest">TEAM MEMBER</span>
            <h3 class="brand text-2xl tracking-wider mt-1">PROYEK TERAPAN</h3>
            <p class="text-xs text-gray-400 font-medium">28 Sub-tasks</p>
          </div>
          <div class="flex flex-col gap-3 mt-4">
            <div class="flex items-center gap-2.5">
              <div class="w-8 h-8 rounded-full bg-[#D3CEC6] overflow-hidden flex-shrink-0">
                <img src="https://i.pravatar.cc/32?img=48" alt="PIC" class="w-full h-full object-cover" />
              </div>
              <div>
                <p class="text-[10px] font-bold tracking-wide text-[#1A1A1A]">MUTHIA LUTHFI N</p>
                <p class="text-[9px] text-gray-400 tracking-wide">PERSON IN CHARGE</p>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-1.5 text-xs text-gray-500">
                <i class="ti ti-calendar text-gray-400 text-sm"></i>
                Apr 05 - Jul 15, 2024
              </div>
              <div class="w-6 h-6 rounded-full bg-[#F0EDE8] flex items-center justify-center">
                <i class="ti ti-chevron-right text-xs text-gray-500"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white border border-black/10 rounded-3xl p-6 shadow-sm flex flex-col justify-between min-h-[220px] hover:shadow-md transition cursor-pointer">
          <div class="flex flex-col gap-2">
            <span class="bg-red text-white text-[9px] font-bold px-2.5 py-1 rounded-full w-fit tracking-widest">TEAM MEMBER</span>
            <h3 class="brand text-2xl tracking-wider mt-1">PROYEK TERAPAN</h3>
            <p class="text-xs text-gray-400 font-medium">28 Sub-tasks</p>
          </div>
          <div class="flex flex-col gap-3 mt-4">
            <div class="flex items-center gap-2.5">
              <div class="w-8 h-8 rounded-full bg-[#D3CEC6] overflow-hidden flex-shrink-0">
                <img src="https://i.pravatar.cc/32?img=49" alt="PIC" class="w-full h-full object-cover" />
              </div>
              <div>
                <p class="text-[10px] font-bold tracking-wide text-[#1A1A1A]">MUTHIA LUTHFI N</p>
                <p class="text-[9px] text-gray-400 tracking-wide">PERSON IN CHARGE</p>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-1.5 text-xs text-gray-500">
                <i class="ti ti-calendar text-gray-400 text-sm"></i>
                Nov 20 - Feb 10, 2024
              </div>
              <div class="w-6 h-6 rounded-full bg-[#F0EDE8] flex items-center justify-center">
                <i class="ti ti-chevron-right text-xs text-gray-500"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white border border-black/10 rounded-3xl p-6 shadow-sm flex flex-col justify-between min-h-[220px] hover:shadow-md transition cursor-pointer">
          <div class="flex flex-col gap-2">
            <span class="bg-red text-white text-[9px] font-bold px-2.5 py-1 rounded-full w-fit tracking-widest">TEAM MEMBER</span>
            <h3 class="brand text-2xl tracking-wider mt-1">PROYEK TERAPAN</h3>
            <p class="text-xs text-gray-400 font-medium">28 Sub-tasks</p>
          </div>
          <div class="flex flex-col gap-3 mt-4">
            <div class="flex items-center gap-2.5">
              <div class="w-8 h-8 rounded-full bg-[#D3CEC6] overflow-hidden flex-shrink-0">
                <img src="https://i.pravatar.cc/32?img=50" alt="PIC" class="w-full h-full object-cover" />
              </div>
              <div>
                <p class="text-[10px] font-bold tracking-wide text-[#1A1A1A]">MUTHIA LUTHFI N</p>
                <p class="text-[9px] text-gray-400 tracking-wide">PERSON IN CHARGE</p>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-1.5 text-xs text-gray-500">
                <i class="ti ti-calendar text-gray-400 text-sm"></i>
                Mar 01 - Dec 15, 2024
              </div>
              <div class="w-6 h-6 rounded-full bg-[#F0EDE8] flex items-center justify-center">
                <i class="ti ti-chevron-right text-xs text-gray-500"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Card 5 -->
        <div class="bg-white border border-black/10 rounded-3xl p-6 shadow-sm flex flex-col justify-between min-h-[220px] hover:shadow-md transition cursor-pointer">
          <div class="flex flex-col gap-2">
            <span class="bg-red text-white text-[9px] font-bold px-2.5 py-1 rounded-full w-fit tracking-widest">TEAM MEMBER</span>
            <h3 class="brand text-2xl tracking-wider mt-1">PROYEK TERAPAN</h3>
            <p class="text-xs text-gray-400 font-medium">28 Sub-tasks</p>
          </div>
          <div class="flex flex-col gap-3 mt-4">
            <div class="flex items-center gap-2.5">
              <div class="w-8 h-8 rounded-full bg-[#D3CEC6] overflow-hidden flex-shrink-0">
                <img src="https://i.pravatar.cc/32?img=51" alt="PIC" class="w-full h-full object-cover" />
              </div>
              <div>
                <p class="text-[10px] font-bold tracking-wide text-[#1A1A1A]">MUTHIA LUTHFI N</p>
                <p class="text-[9px] text-gray-400 tracking-wide">PERSON IN CHARGE</p>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-1.5 text-xs text-gray-500">
                <i class="ti ti-calendar text-gray-400 text-sm"></i>
                May 10 - Aug 30, 2024
              </div>
              <div class="w-6 h-6 rounded-full bg-[#F0EDE8] flex items-center justify-center">
                <i class="ti ti-chevron-right text-xs text-gray-500"></i>
              </div>
            </div>
          </div>
        </div>

      </div><!-- /grid -->
    </div><!-- /scrollable content -->
  </main>

</body>
</html>
