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
          href="#"
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
          href="{{ url('/projects') }}"
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
          <!-- Avatar -->
          <div class="avatar-ring">
            <div
              class="w-9 h-9 rounded-full bg-gray-300 border-2 border-white shadow flex items-center justify-center text-xs font-bold text-gray-600 select-none overflow-hidden"
            >
              <!-- Person silhouette SVG -->
              <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                <rect width="36" height="36" fill="#D1CFC9"/>
                <!-- body / suit -->
                <rect x="7" y="22" width="22" height="14" rx="4" fill="#3a3a4a"/>
                <!-- collar left -->
                <polygon points="14,22 18,28 18,22" fill="#f5f5f5"/>
                <!-- collar right -->
                <polygon points="22,22 18,28 18,22" fill="#e8e8e8"/>
                <!-- tie -->
                <polygon points="17,23 19,23 18.5,30 17.5,30" fill="#C0282D"/>
                <!-- head -->
                <circle cx="18" cy="14" r="6" fill="#e8c99a"/>
                <!-- hair -->
                <path d="M12 13 Q12 7 18 7 Q24 7 24 13 Q22 10 18 10 Q14 10 12 13Z" fill="#4a3728"/>
              </svg>
            </div>
          </div>
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
            Welcome to the Curriculum Division Dashboard
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
            <p class="text-6xl font-black leading-none">12</p>
            <p class="text-xs text-gray-500 mt-3 leading-relaxed">
              Total production boards currently in circulation across 3
              editorial teams.
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
            <p class="text-6xl font-black leading-none">84%</p>
            <p class="text-xs text-red font-semibold mt-3">
              ↗ aggregated from 5 tasks.
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
            <p class="text-6xl font-black leading-none">142</p>
            <p class="text-xs text-gray-500 mt-3 leading-relaxed">
              Tasks fully resolved across workspaces.
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
              <!-- Task 1 – Overdue -->
              <div class="flex items-start justify-between py-3">
                <div>
                  <p class="font-semibold text-sm">Finalize Theme</p>
                  <p class="text-xs text-gray-400 mt-0.5">
                    Proyek : PKKMB 2026
                  </p>
                </div>
                <div class="text-right flex-shrink-0 ml-4">
                  <p
                    class="text-[10px] font-bold text-red uppercase tracking-wide"
                  >
                    Overdue
                  </p>
                  <p
                    class="text-xs font-semibold text-red mt-0.5 cursor-pointer hover:underline"
                  >
                    Complete Now
                  </p>
                </div>
              </div>

              <!-- Task 2 -->
              <div class="flex items-start justify-between py-3">
                <div>
                  <p class="font-semibold text-sm">Review TAK</p>
                  <p class="text-xs text-gray-400 mt-0.5">
                    Proyek : Syarat TAK
                  </p>
                </div>
                <div class="text-right flex-shrink-0 ml-4">
                  <p
                    class="text-[10px] font-bold text-gray-400 uppercase tracking-wide"
                  >
                    Today
                  </p>
                  <p
                    class="text-xs font-semibold text-red mt-0.5 cursor-pointer hover:underline"
                  >
                    Complete Soon
                  </p>
                </div>
              </div>

              <!-- Task 3 -->
              <div class="flex items-start justify-between py-3">
                <div>
                  <p class="font-semibold text-sm">Review TAK</p>
                  <p class="text-xs text-gray-400 mt-0.5">
                    Proyek : Syarat TAK
                  </p>
                </div>
                <div class="text-right flex-shrink-0 ml-4">
                  <p
                    class="text-[10px] font-bold text-gray-400 uppercase tracking-wide"
                  >
                    Today
                  </p>
                  <p
                    class="text-xs font-semibold text-red mt-0.5 cursor-pointer hover:underline"
                  >
                    Complete Soon
                  </p>
                </div>
              </div>
            </div>

            <!-- See All -->
            <div class="text-right mt-3">
              <a href="#" class="text-xs font-semibold text-red hover:underline"
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

            <!-- Member 1 -->
            <div class="mb-5">
              <div class="flex items-center justify-between mb-1.5">
                <span class="text-sm font-semibold">Muthia Luthfi N.</span>
                <span
                  class="bg-red text-white text-[9px] font-bold px-2 py-0.5 rounded-full tracking-wide"
                  >5 TASKS</span
                >
              </div>
              <div class="h-1.5 bg-[#D3CEC6] rounded-full overflow-hidden">
                <div
                  class="h-full bg-red rounded-full"
                  style="width: 50%"
                ></div>
              </div>
            </div>

            <!-- Member 2 -->
            <div class="mb-5">
              <div class="flex items-center justify-between mb-1.5">
                <span class="text-sm font-semibold">Wanda Margareta</span>
                <span
                  class="bg-red text-white text-[9px] font-bold px-2 py-0.5 rounded-full tracking-wide"
                  >3 TASKS</span
                >
              </div>
              <div class="h-1.5 bg-[#D3CEC6] rounded-full overflow-hidden">
                <div
                  class="h-full bg-red rounded-full"
                  style="width: 30%"
                ></div>
              </div>
            </div>

            <!-- Member 3 -->
            <div>
              <div class="flex items-center justify-between mb-1.5">
                <span class="text-sm font-semibold">Dito Ramadhan</span>
                <span
                  class="bg-red text-white text-[9px] font-bold px-2 py-0.5 rounded-full tracking-wide"
                  >7 TASKS</span
                >
              </div>
              <div class="h-1.5 bg-[#D3CEC6] rounded-full overflow-hidden">
                <div
                  class="h-full bg-red rounded-full"
                  style="width: 70%"
                ></div>
              </div>
            </div>
          </div>
        </div>

        <!-- ─── RECENT ACTIVITY ─── -->
        <div class="bg-white border border-black/10 rounded-3xl p-6 shadow-sm">
          <h2 class="text-[11px] font-bold tracking-[.16em] uppercase mb-5">
            Recent Activity
          </h2>

          <div class="flex flex-col gap-5">
            <!-- Activity 1 -->
            <div class="flex items-start gap-4">
              <div
                class="w-9 h-9 rounded-full bg-[#D3CEC6] flex items-center justify-center flex-shrink-0 text-gray-500"
              >
                <i class="ti ti-message text-sm"></i>
              </div>
              <div>
                <p class="text-sm font-semibold">Dave Andrew</p>
                <p class="text-xs text-gray-500 leading-relaxed mt-0.5">
                  Revisi – Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been…
                </p>
              </div>
            </div>

            <!-- Activity 2 -->
            <div class="flex items-start gap-4">
              <div
                class="w-9 h-9 rounded-full bg-[#D3CEC6] flex items-center justify-center flex-shrink-0 text-gray-500"
              >
                <i class="ti ti-message text-sm"></i>
              </div>
              <div>
                <p class="text-sm font-semibold">Manager</p>
                <p class="text-xs text-gray-500 leading-relaxed mt-0.5">
                  Revisi – Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been…
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /scrollable content -->
    </main>
  </body>
</html>
