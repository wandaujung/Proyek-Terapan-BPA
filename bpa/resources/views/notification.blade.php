<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Planner U × BPA – Notification</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --red: #c0182a;
      --red-light: #e8192c;
      --bg: #f0ede8;
      --sidebar-bg: #ebe8e2;
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
    .sidebar-nav a:hover { background: #dedad3; color: var(--red); }
    .sidebar-nav a.active {
      background: #fbe8ea;
      color: var(--red);
      font-weight: 600;
    }
    .new-project-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      background: var(--red);
      color: #fff;
      font-weight: 600;
      font-size: 0.875rem;
      padding: 10px 18px;
      border-radius: 9px;
      border: none;
      cursor: pointer;
      transition: background 0.15s;
      text-decoration: none;
      width: 100%;
      justify-content: center;
    }
    .new-project-btn:hover { background: var(--red-light); }
    .notif-card {
      background: var(--card-bg);
      border: 1px solid var(--border);
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
      font-size: 1.1rem;
    }
    .notif-label {
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 0.8px;
      text-transform: uppercase;
      margin-bottom: 5px;
    }
    .notif-body {
      font-size: 0.9rem;
      line-height: 1.5;
      color: var(--text-dark);
      margin-bottom: 14px;
    }
    .notif-body.muted {
      color: var(--text-muted);
      font-style: italic;
      margin-bottom: 0;
    }
    .notif-time {
      font-size: 0.78rem;
      color: var(--text-muted);
      white-space: nowrap;
      padding-top: 2px;
    }
    .action-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 0.78rem;
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
    .btn-red { background: var(--red); color: #fff; }
    .btn-blue { background: #2563eb; color: #fff; }
    .avatar {
      width: 36px; height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, #d4a5a5 0%, #8b4545 100%);
      display: flex; align-items: center; justify-content: center;
      font-size: 0.65rem;
      font-weight: 700;
      color: #fff;
      flex-shrink: 0;
      overflow: hidden;
    }
  </style>
</head>
<body>
<div class="flex min-h-screen">

  <!-- SIDEBAR -->
  <aside class="w-52 flex-shrink-0 flex flex-col py-6 px-4 gap-2 border-r border-[var(--border)]" style="background:var(--sidebar-bg); min-height:100vh;">
    <div class="mb-6 px-2">
      <span class="logo-text text-[var(--red)] text-2xl">PLANNER U</span>
    </div>

    <!-- New Project Button -->
    <a href="#" class="new-project-btn mb-4">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
      New Project
    </a>

    <nav class="sidebar-nav flex flex-col gap-1">
      <a href="#">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        Dashboard
      </a>
      <a href="#">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 7a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/><path d="M16 3v4M8 3v4M3 9h18"/></svg>
        Projects
      </a>
      <a href="#" class="active">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        Notification
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
        <button class="w-9 h-9 rounded-full flex items-center justify-center bg-white border border-[var(--border)] hover:border-[var(--red)] transition-colors relative">
          <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
          <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-[var(--red)] rounded-full"></span>
        </button>
        <div class="avatar">ML</div>
      </div>
    </header>

    <!-- CONTENT -->
    <div class="px-8 py-8 max-w-4xl">

      <div class="mb-2">
        <h1 class="page-title">Notification</h1>
        <p class="text-xs font-semibold text-[var(--text-muted)] uppercase tracking-widest mt-1">
          Curated updates from your editorial workspace.
        </p>
      </div>

      <div class="mt-8 flex flex-col gap-4">

        <!-- 1. Manager Approval -->
        <div class="notif-card">
          <div class="notif-icon" style="background:#d1f0e0;">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#1a7a45" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
          </div>
          <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between gap-4">
              <span class="notif-label" style="color:#1a7a45;">Manager Approval</span>
              <span class="notif-time">2 minutes ago</span>
            </div>
            <p class="notif-body">Heritage Collection Mockups has been approved by the Manager and moved to Archives.</p>
            <a href="#" class="action-btn btn-green">
              <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 10h18M8 2v4M16 2v4"/></svg>
              View Archives
            </a>
          </div>
        </div>

        <!-- 2. Revision Request -->
        <div class="notif-card">
          <div class="notif-icon" style="background:#fde8ea;">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#c0182a" stroke-width="2.5"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </div>
          <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between gap-4">
              <span class="notif-label" style="color:var(--red);">Revision Request</span>
              <span class="notif-time">1 hour ago</span>
            </div>
            <p class="notif-body">Manager requested revisions for "Urban Oasis Project". Please check the revision notes.</p>
            <a href="#" class="action-btn btn-red" onclick="openNotesModal(event)">
              <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
              See Notes
            </a>
          </div>
        </div>

        <!-- 3. New Project Added -->
        <div class="notif-card">
          <div class="notif-icon" style="background:#dbeafe;">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
          </div>
          <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between gap-4">
              <span class="notif-label" style="color:#2563eb;">New Project Added</span>
              <span class="notif-time">4 hours ago</span>
            </div>
            <p class="notif-body">A new project "Coastal Retreat" has been added to your workspace by the PIC.</p>
            <a href="#" class="action-btn btn-blue">
              <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
              View Project
            </a>
          </div>
        </div>

        <!-- 4. Project Removed -->
        <div class="notif-card" style="opacity:0.75;">
          <div class="notif-icon" style="background:#eae7e2;">
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#9a9080" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
          </div>
          <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between gap-4">
              <span class="notif-label" style="color:var(--text-muted);">Project Removed</span>
              <span class="notif-time">Yesterday</span>
            </div>
            <p class="notif-body muted">The project "Old Warehouse Study" has been removed from the Active Projects queue.</p>
          </div>
        </div>

      </div>
    </div>
  </main>
</div>
  <!-- NOTES MODAL -->
  <div id="notesModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 hidden items-center justify-center">
    <div class="max-w-2xl bg-[#F0EDED] rounded-3xl p-8 flex flex-col gap-5 shadow-xl relative mx-4 w-full border border-white/40">
      <!-- Close button -->
      <button onclick="closeNotesModal()" class="absolute top-6 right-6 text-stone-400 hover:text-[#c0182a] transition bg-white/50 rounded-full p-2">
        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M6 18L18 6M6 6l12 12"/></svg>
      </button>

      <div class="mb-1">
        <div class="inline-block bg-[#c0182a] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-4">See Notes</div>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-stone-900 tracking-tight mb-6" style="font-family: 'Barlow Condensed', sans-serif;">Urban Oasis Project</h2>
        
        <div class="flex items-center gap-6 mb-2">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-stone-300 overflow-hidden flex-shrink-0">
               <div class="w-full h-full bg-gradient-to-br from-[#d4a5a5] to-[#8b4545] flex items-center justify-center text-[10px] font-bold text-white">MG</div>
            </div>
            <div>
              <div class="text-[9px] font-bold text-stone-400 tracking-widest uppercase">Revised By</div>
              <div class="text-sm font-bold text-stone-800">Manager</div>
            </div>
          </div>
          <div class="h-8 w-[1px] bg-stone-300"></div>
          <div>
            <div class="text-[9px] font-bold text-stone-400 tracking-widest uppercase">Date Submitted</div>
            <div class="text-sm font-bold text-stone-800">Oct 12, 2024</div>
          </div>
        </div>
      </div>

      <div class="bg-white/60 border border-white rounded-2xl p-6 shadow-sm">
        <div class="flex items-center gap-3 mb-4">
          <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#c0182a" stroke-width="2.5"><path d="M4 6h16M4 12h16M4 18h10"/></svg>
          <h3 class="text-lg font-bold text-stone-900">Revision Notes</h3>
        </div>
        <p class="text-stone-700 italic text-sm md:text-base leading-relaxed font-normal">
          "Final materials selected for the residential wing focus on organic textures and local sourcing. The mockup set includes the revised facade treatment and the interior lobby palette. We've prioritized durability without sacrificing the editorial warmth requested by the client. V3 addresses the previous concerns regarding the lighting fixtures in the gallery space."
        </p>
      </div>

      <button onclick="closeNotesModal()" class="flex items-center justify-center gap-2 bg-[#c0182a] text-white py-3 px-6 rounded-full font-bold shadow-lg shadow-red-900/20 hover:bg-[#a01423] transition w-max mt-2 text-sm">
        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
        View Project Revision Details
      </button>
    </div>
  </div>

  <script>
    function openNotesModal(e) {
      if(e) e.preventDefault();
      const modal = document.getElementById('notesModal');
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }

    function closeNotesModal() {
      const modal = document.getElementById('notesModal');
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  </script>
</body>
</html>
