<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Planner U – Reviews</title>
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

    .review-card {
      transition: transform 0.18s ease, box-shadow 0.18s ease;
    }
    .review-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

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
        <a href="dashboard_manager.html" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-brand-muted">
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
        <a href="reviews.html" class="nav-item nav-active flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">
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

        <!-- Page Heading -->
        <h1 class="font-condensed font-extrabold text-3xl tracking-wide text-brand-text mb-1">REVIEWS</h1>
        <p class="text-xs font-semibold tracking-widest text-brand-muted uppercase mb-8">
          Review staff submissions, evaluate project progress, and provide feedback to support successful project completion.
        </p>

        <!-- Section title -->
        <h2 class="font-condensed font-bold text-base tracking-widest text-brand-text uppercase mb-4">Project Review Queue</h2>

        <!-- Pending badge -->
        <div class="mb-5">
          <span class="inline-block bg-brand-red text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1.5 rounded">Pending Reviews</span>
        </div>

        <!-- Review list -->
        <div class="flex flex-col gap-4">

          <!-- Item 1 -->
          <div class="bg-white rounded-2xl border border-brand-border p-6 review-card">
            <div class="flex items-start justify-between gap-6">
              <div class="flex-1">
                <h3 class="font-condensed font-extrabold text-xl text-brand-text mb-1">Heritage Collection Mockups</h3>
                <p class="text-xs text-brand-muted mb-4">Elena Dance &nbsp;·&nbsp; 2h ago</p>
                <div class="bg-brand-bg rounded-lg border-l-4 px-4 py-3" style="border-color:#CC1D1D;">
                  <p class="text-[10px] font-bold tracking-widest uppercase mb-1" style="color:#CC1D1D;">Staff Notes</p>
                  <p class="text-sm text-brand-muted italic">"Final materials selected for the residential wing. Awaiting feedback on the stone textures."</p>
                </div>
              </div>
              <div class="flex-shrink-0 flex flex-col items-center gap-2 mt-1">
                <button class="text-white text-sm font-bold px-6 py-2.5 rounded-full transition-colors w-full" style="background:#A81515;" onmouseover="this.style.background='#CC1D1D'" onmouseout="this.style.background='#A81515'" onclick="window.location.href='review_detail.html'">Review</button>
                <a href="review_detail.html" class="flex items-center gap-1 text-[10px] font-bold tracking-widest uppercase text-brand-text hover:text-brand-red transition-colors">
                  Project Details
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6m0 0v6m0-6L10 14"/></svg>
                </a>
              </div>
            </div>
          </div>

          <!-- Item 2 -->
          <div class="bg-white rounded-2xl border border-brand-border p-6 review-card">
            <div class="flex items-start justify-between gap-6">
              <div class="flex-1">
                <h3 class="font-condensed font-extrabold text-xl text-brand-text mb-1">Spring Editorial Copy Deck</h3>
                <p class="text-xs text-brand-muted mb-4">Julian Amari &nbsp;·&nbsp; 5h ago</p>
                <div class="bg-brand-bg rounded-lg border-l-4 px-4 py-3" style="border-color:#CC1D1D;">
                  <p class="text-[10px] font-bold tracking-widest uppercase mb-1" style="color:#CC1D1D;">Staff Notes</p>
                  <p class="text-sm text-brand-muted italic">"Revised headlines to align with the new sustainability manifesto."</p>
                </div>
              </div>
              <div class="flex-shrink-0 flex flex-col items-center gap-2 mt-1">
                <button class="text-white text-sm font-bold px-6 py-2.5 rounded-full transition-colors w-full" style="background:#A81515;" onmouseover="this.style.background='#CC1D1D'" onmouseout="this.style.background='#A81515'" onclick="window.location.href='review_detail.html'">Review</button>
                <a href="review_detail.html" class="flex items-center gap-1 text-[10px] font-bold tracking-widest uppercase text-brand-text hover:text-brand-red transition-colors">
                  Project Details
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6m0 0v6m0-6L10 14"/></svg>
                </a>
              </div>
            </div>
          </div>

          <!-- Item 3 -->
          <div class="bg-white rounded-2xl border border-brand-border p-6 review-card">
            <div class="flex items-start justify-between gap-6">
              <div class="flex-1">
                <h3 class="font-condensed font-extrabold text-xl text-brand-text mb-1">Terracotta Material Specs</h3>
                <p class="text-xs text-brand-muted mb-4">Marcus Chen &nbsp;·&nbsp; Yesterday</p>
                <div class="bg-brand-bg rounded-lg border-l-4 px-4 py-3" style="border-color:#CC1D1D;">
                  <p class="text-[10px] font-bold tracking-widest uppercase mb-1" style="color:#CC1D1D;">Staff Notes</p>
                  <p class="text-sm text-brand-muted italic">"Detailed specs for the glaze finish on the outdoor pavers."</p>
                </div>
              </div>
              <div class="flex-shrink-0 flex flex-col items-center gap-2 mt-1">
                <button class="text-white text-sm font-bold px-6 py-2.5 rounded-full transition-colors w-full" style="background:#A81515;" onmouseover="this.style.background='#CC1D1D'" onmouseout="this.style.background='#A81515'" onclick="window.location.href='review_detail.html'">Review</button>
                <a href="review_detail.html" class="flex items-center gap-1 text-[10px] font-bold tracking-widest uppercase text-brand-text hover:text-brand-red transition-colors">
                  Project Details
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6m0 0v6m0-6L10 14"/></svg>
                </a>
              </div>
            </div>
          </div>

          <!-- Item 4 -->
          <div class="bg-white rounded-2xl border border-brand-border p-6 review-card">
            <div class="flex items-start justify-between gap-6">
              <div class="flex-1">
                <h3 class="font-condensed font-extrabold text-xl text-brand-text mb-1">Terracotta Material Specs</h3>
                <p class="text-xs text-brand-muted mb-4">Marcus Chen &nbsp;·&nbsp; Yesterday</p>
                <div class="bg-brand-bg rounded-lg border-l-4 px-4 py-3" style="border-color:#CC1D1D;">
                  <p class="text-[10px] font-bold tracking-widest uppercase mb-1" style="color:#CC1D1D;">Staff Notes</p>
                  <p class="text-sm text-brand-muted italic">"Detailed specs for the glaze finish on the outdoor pavers."</p>
                </div>
              </div>
              <div class="flex-shrink-0 flex flex-col items-center gap-2 mt-1">
                <button class="text-white text-sm font-bold px-6 py-2.5 rounded-full transition-colors w-full" style="background:#A81515;" onmouseover="this.style.background='#CC1D1D'" onmouseout="this.style.background='#A81515'" onclick="window.location.href='review_detail.html'">Review</button>
                <a href="review_detail.html" class="flex items-center gap-1 text-[10px] font-bold tracking-widest uppercase text-brand-text hover:text-brand-red transition-colors">
                  Project Details
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6m0 0v6m0-6L10 14"/></svg>
                </a>
              </div>
            </div>
          </div>

        </div>
      </div><!-- /Content -->
    </main>
  </div>

</body>
</html>
