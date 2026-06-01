<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Planner U × BPA – Projects</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --red: #c0182a;
      --red-light: #e8192c;
      --bg: #f0ede8;
      --sidebar-bg: #f7f4f0;
      --card-bg: #ffffff;
      --border: #e0dbd4;
      --text-muted: #9a9080;
      --text-dark: #1a1612;
    }
    * { box-sizing: border-box; }
    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text-dark);
      margin: 0;
    }
    .logo-text {
      font-family: 'Barlow Condensed', sans-serif;
      font-weight: 800;
      letter-spacing: -0.5px;
    }
    .section-heading {
      font-family: 'Barlow Condensed', sans-serif;
      font-weight: 800;
      font-size: 1.5rem;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }
    .page-title {
      font-family: 'Barlow Condensed', sans-serif;
      font-weight: 800;
      font-size: 2.2rem;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }
    .sidebar-nav a {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 9px 14px;
      border-radius: 8px;
      font-size: 0.875rem;
      font-weight: 500;
      color: #5a5248;
      text-decoration: none;
      transition: background 0.15s, color 0.15s;
    }
    .sidebar-nav a:hover { background: #ede9e2; color: var(--red); }
    .sidebar-nav a.active { background: #fbe8ea; color: var(--red); }
    .sidebar-nav a.active svg { color: var(--red); }
    .badge {
      display: inline-block;
      background: var(--red);
      color: #fff;
      font-size: 0.65rem;
      font-weight: 700;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      border-radius: 999px;
      padding: 3px 10px;
      margin-bottom: 8px;
    }
    .project-card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 18px 20px 16px;
      transition: box-shadow 0.18s, transform 0.18s;
      cursor: pointer;
    }
    .project-card:hover {
      box-shadow: 0 6px 24px rgba(192,24,42,0.10);
      transform: translateY(-2px);
    }
    .add-card {
      background: #fff;
      border: 2px dashed var(--border);
      border-radius: 14px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 10px;
      min-height: 170px;
      cursor: pointer;
      transition: border-color 0.15s, background 0.15s;
    }
    .add-card:hover { border-color: var(--red); background: #fdf5f5; }
    .add-btn {
      width: 44px; height: 44px;
      background: #f0ede8;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.4rem;
      color: #a09880;
      transition: background 0.15s, color 0.15s;
    }
    .add-card:hover .add-btn { background: #fbe8ea; color: var(--red); }
    .avatar {
      width: 32px; height: 32px;
      border-radius: 50%;
      background: linear-gradient(135deg, #d4a5a5 0%, #8b4545 100%);
      display: flex; align-items: center; justify-content: center;
      font-size: 0.65rem;
      font-weight: 700;
      color: #fff;
      flex-shrink: 0;
      overflow: hidden;
    }
    .card-divider { border: none; border-top: 1px solid var(--border); margin: 14px 0; }
    .section-block { margin-bottom: 40px; }
    .grid-3 {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
    }
    @media (max-width: 900px) {
      .grid-3 { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 600px) {
      .grid-3 { grid-template-columns: 1fr; }
      .sidebar { display: none; }
    }
    .chevron-btn {
      width: 28px; height: 28px;
      background: #f0ede8;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
  </style>
</head>
<body>
<div class="flex min-h-screen">

  <!-- SIDEBAR -->
  <aside class="sidebar w-52 flex-shrink-0 flex flex-col py-6 px-4 gap-2 border-r border-[var(--border)]" style="background:var(--sidebar-bg); min-height:100vh;">
    <!-- Logo -->
    <div class="mb-8 px-2">
      <span class="logo-text text-[var(--red)] text-2xl tracking-tight">PLANNER U</span>
    </div>
    <!-- Nav -->
    <nav class="sidebar-nav flex flex-col gap-1">
      <a href="#">
        <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        Dashboard
      </a>
      <a href="#" class="active">
        <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 7a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/><path d="M3 7l9 6 9-6"/></svg>
        Projects
      </a>
      <a href="#">
        <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
        Reviews
      </a>
    </nav>
  </aside>

  <!-- MAIN -->
  <main class="flex-1 overflow-y-auto">

    <!-- TOP BAR -->
    <header class="flex items-center justify-between px-8 py-4 border-b border-[var(--border)] bg-[var(--bg)] sticky top-0 z-10">
      <div class="flex items-center gap-3">
        <span class="logo-text text-[var(--red)] text-xl">PLANNER U</span>
        <span class="text-[var(--text-muted)] text-base font-light">×</span>
        <span class="logo-text text-[var(--red)] text-xl">BPA</span>
      </div>
      <div class="flex items-center gap-3">
        <!-- Bell -->
        <button class="w-9 h-9 rounded-full flex items-center justify-center bg-white border border-[var(--border)] hover:border-[var(--red)] transition-colors">
          <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        </button>
        <!-- Avatar -->
        <div class="avatar w-9 h-9 text-xs">ML</div>
      </div>
    </header>

    <!-- CONTENT -->
    <div class="px-8 py-8 max-w-4xl">

      <!-- Page title -->
      <div class="mb-2">
        <h1 class="page-title">Projects</h1>
        <p class="text-xs font-semibold text-[var(--text-muted)] uppercase tracking-widest mt-1">
          Manage and monitor projects across Curriculum, MKLT, MKWK, and Academic Partnership divisions in one workspace.
        </p>
      </div>

      <div class="mt-8 flex flex-col gap-10">

        <!-- CURRICULUM -->
        <section class="section-block">
          <h2 class="section-heading mb-4">Curriculum</h2>
          <div class="grid-3">
            <!-- Add card -->
            <div class="add-card">
              <div class="add-btn">+</div>
              <div class="text-center">
                <p class="font-semibold text-sm text-[#5a5248]">Initiate New Entry</p>
                <p class="text-xs text-[var(--text-muted)]">Start a fresh editorial project</p>
              </div>
            </div>
            <!-- Project Card 1 -->
            <div class="project-card">
              <span class="badge">Team Member</span>
              <h3 class="font-bold text-base leading-tight mb-1">PROYEK TERAPAN</h3>
              <p class="text-xs text-[var(--text-muted)] mb-3">28 Sub-tasks</p>
              <hr class="card-divider"/>
              <div class="flex items-center gap-2 mb-3">
                <div class="avatar">ML</div>
                <div>
                  <p class="text-xs font-bold leading-tight">MUTHIA LUTHFI N</p>
                  <p class="text-[10px] text-[var(--text-muted)] uppercase tracking-wide">Person in Charge</p>
                </div>
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-1.5 text-[var(--text-muted)]">
                  <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  <span class="text-[11px]">Jan 12 – Mar 20, 2024</span>
                </div>
                <div class="chevron-btn">
                  <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
                </div>
              </div>
            </div>
            <!-- Project Card 2 -->
            <div class="project-card">
              <span class="badge">Team Member</span>
              <h3 class="font-bold text-base leading-tight mb-1">PROYEK TERAPAN</h3>
              <p class="text-xs text-[var(--text-muted)] mb-3">28 Sub-tasks</p>
              <hr class="card-divider"/>
              <div class="flex items-center gap-2 mb-3">
                <div class="avatar">ML</div>
                <div>
                  <p class="text-xs font-bold leading-tight">MUTHIA LUTHFI N</p>
                  <p class="text-[10px] text-[var(--text-muted)] uppercase tracking-wide">Person in Charge</p>
                </div>
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-1.5 text-[var(--text-muted)]">
                  <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  <span class="text-[11px]">Apr 05 – Jul 15, 2024</span>
                </div>
                <div class="chevron-btn">
                  <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- MKLT -->
        <section class="section-block">
          <h2 class="section-heading mb-4">MKLT</h2>
          <div class="grid-3">
            <div class="add-card">
              <div class="add-btn">+</div>
              <div class="text-center">
                <p class="font-semibold text-sm text-[#5a5248]">Initiate New Entry</p>
                <p class="text-xs text-[var(--text-muted)]">Start a fresh editorial project</p>
              </div>
            </div>
            <div class="project-card">
              <span class="badge">Team Member</span>
              <h3 class="font-bold text-base leading-tight mb-1">PROYEK TERAPAN</h3>
              <p class="text-xs text-[var(--text-muted)] mb-3">28 Sub-tasks</p>
              <hr class="card-divider"/>
              <div class="flex items-center gap-2 mb-3">
                <div class="avatar">ML</div>
                <div>
                  <p class="text-xs font-bold leading-tight">MUTHIA LUTHFI N</p>
                  <p class="text-[10px] text-[var(--text-muted)] uppercase tracking-wide">Person in Charge</p>
                </div>
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-1.5 text-[var(--text-muted)]">
                  <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  <span class="text-[11px]">Jan 12 – Mar 20, 2024</span>
                </div>
                <div class="chevron-btn">
                  <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
                </div>
              </div>
            </div>
            <div class="project-card">
              <span class="badge">Team Member</span>
              <h3 class="font-bold text-base leading-tight mb-1">PROYEK TERAPAN</h3>
              <p class="text-xs text-[var(--text-muted)] mb-3">28 Sub-tasks</p>
              <hr class="card-divider"/>
              <div class="flex items-center gap-2 mb-3">
                <div class="avatar">ML</div>
                <div>
                  <p class="text-xs font-bold leading-tight">MUTHIA LUTHFI N</p>
                  <p class="text-[10px] text-[var(--text-muted)] uppercase tracking-wide">Person in Charge</p>
                </div>
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-1.5 text-[var(--text-muted)]">
                  <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  <span class="text-[11px]">Apr 05 – Jul 15, 2024</span>
                </div>
                <div class="chevron-btn">
                  <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- MKWK -->
        <section class="section-block">
          <h2 class="section-heading mb-4">MKWK</h2>
          <div class="grid-3">
            <div class="add-card">
              <div class="add-btn">+</div>
              <div class="text-center">
                <p class="font-semibold text-sm text-[#5a5248]">Initiate New Entry</p>
                <p class="text-xs text-[var(--text-muted)]">Start a fresh editorial project</p>
              </div>
            </div>
            <div class="project-card">
              <span class="badge">Team Member</span>
              <h3 class="font-bold text-base leading-tight mb-1">PROYEK TERAPAN</h3>
              <p class="text-xs text-[var(--text-muted)] mb-3">28 Sub-tasks</p>
              <hr class="card-divider"/>
              <div class="flex items-center gap-2 mb-3">
                <div class="avatar">ML</div>
                <div>
                  <p class="text-xs font-bold leading-tight">MUTHIA LUTHFI N</p>
                  <p class="text-[10px] text-[var(--text-muted)] uppercase tracking-wide">Person in Charge</p>
                </div>
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-1.5 text-[var(--text-muted)]">
                  <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  <span class="text-[11px]">Jan 12 – Mar 20, 2024</span>
                </div>
                <div class="chevron-btn">
                  <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
                </div>
              </div>
            </div>
            <div class="project-card">
              <span class="badge">Team Member</span>
              <h3 class="font-bold text-base leading-tight mb-1">PROYEK TERAPAN</h3>
              <p class="text-xs text-[var(--text-muted)] mb-3">28 Sub-tasks</p>
              <hr class="card-divider"/>
              <div class="flex items-center gap-2 mb-3">
                <div class="avatar">ML</div>
                <div>
                  <p class="text-xs font-bold leading-tight">MUTHIA LUTHFI N</p>
                  <p class="text-[10px] text-[var(--text-muted)] uppercase tracking-wide">Person in Charge</p>
                </div>
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-1.5 text-[var(--text-muted)]">
                  <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  <span class="text-[11px]">Apr 05 – Jul 15, 2024</span>
                </div>
                <div class="chevron-btn">
                  <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- ACADEMIC PARTNERSHIP -->
        <section class="section-block">
          <h2 class="section-heading mb-4">Academic Partnership</h2>
          <div class="grid-3">
            <div class="add-card">
              <div class="add-btn">+</div>
              <div class="text-center">
                <p class="font-semibold text-sm text-[#5a5248]">Initiate New Entry</p>
                <p class="text-xs text-[var(--text-muted)]">Start a fresh editorial project</p>
              </div>
            </div>
            <div class="project-card">
              <span class="badge">Team Member</span>
              <h3 class="font-bold text-base leading-tight mb-1">PROYEK TERAPAN</h3>
              <p class="text-xs text-[var(--text-muted)] mb-3">28 Sub-tasks</p>
              <hr class="card-divider"/>
              <div class="flex items-center gap-2 mb-3">
                <div class="avatar">ML</div>
                <div>
                  <p class="text-xs font-bold leading-tight">MUTHIA LUTHFI N</p>
                  <p class="text-[10px] text-[var(--text-muted)] uppercase tracking-wide">Person in Charge</p>
                </div>
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-1.5 text-[var(--text-muted)]">
                  <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  <span class="text-[11px]">Jan 12 – Mar 20, 2024</span>
                </div>
                <div class="chevron-btn">
                  <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
                </div>
              </div>
            </div>
            <div class="project-card">
              <span class="badge">Team Member</span>
              <h3 class="font-bold text-base leading-tight mb-1">PROYEK TERAPAN</h3>
              <p class="text-xs text-[var(--text-muted)] mb-3">28 Sub-tasks</p>
              <hr class="card-divider"/>
              <div class="flex items-center gap-2 mb-3">
                <div class="avatar">ML</div>
                <div>
                  <p class="text-xs font-bold leading-tight">MUTHIA LUTHFI N</p>
                  <p class="text-[10px] text-[var(--text-muted)] uppercase tracking-wide">Person in Charge</p>
                </div>
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-1.5 text-[var(--text-muted)]">
                  <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  <span class="text-[11px]">Apr 05 – Jul 15, 2024</span>
                </div>
                <div class="chevron-btn">
                  <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
                </div>
              </div>
            </div>
          </div>
        </section>

      </div>
    </div>
  </main>
</div>
</body>
</html>
