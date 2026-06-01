<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Planner U × BPA – Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'DM Sans', sans-serif;
    }
    .logo-text {
      font-family: 'Barlow Condensed', sans-serif;
    }
  </style>
</head>
<body class="bg-[#FAF8F5] text-gray-900 m-0 overflow-hidden flex min-h-screen">
  
  <!-- SIDEBAR -->
  <aside class="w-64 h-screen bg-[#E6E4E2] flex flex-col py-6 border-r border-[#D9D7D5] flex-shrink-0 relative z-20">
    <div class="mb-8 px-6 text-2xl font-extrabold text-[#C21A23] tracking-widest logo-text">
      PLANNER U
    </div>

    <!-- New Project Button -->
    <a href="#" class="mx-4 bg-[#C21A23] hover:bg-red-800 text-white font-semibold py-3 px-4 rounded-xl flex items-center justify-center gap-2 shadow-md transition-all">
      <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
      New Project
    </a>

    <nav class="flex flex-col gap-2 px-4 mt-8">
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-[#D4D2CF] transition-colors font-medium">
        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        Dashboard
      </a>
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-[#D4D2CF] transition-colors font-medium">
        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 7a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/><path d="M16 3v4M8 3v4M3 9h18"/></svg>
        Projects
      </a>
      <a href="notification.html" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-[#D4D2CF] transition-colors font-medium">
        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        Notification
      </a>
    </nav>
  </aside>

  <!-- MAIN WORKSPACE -->
  <main class="flex-1 bg-[#FAF8F5] min-h-screen flex flex-col relative overflow-hidden z-10 w-full">
    
    <!-- TOP HEADER -->
    <header class="flex justify-between items-center px-12 py-6 w-full">
      <div class="font-extrabold text-2xl text-[#C21A23] flex items-center gap-2 logo-text uppercase tracking-wide">
        PLANNER U <span class="text-gray-400 font-light mx-2 text-xl">X</span> BPA
      </div>
      <div class="flex items-center gap-4">
        <button class="w-10 h-10 rounded-full bg-[#E6E4E2] flex items-center justify-center hover:bg-gray-300 transition relative">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#4A4A4A" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        </button>
        <div class="w-10 h-10 rounded-full overflow-hidden border border-gray-300 bg-gray-200 flex items-center justify-center">
            <!-- Simulated avatar -->
            <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
      </div>
    </header>

    <!-- CENTERED PROFILE CONTENT -->
    <div class="flex-1 flex flex-col items-center justify-center relative -mt-20 z-10">
      
      <!-- DECORATIVE BACKGROUND CARD -->
      <div class="absolute right-[-2rem] top-[15%] w-96 lg:w-[400px] h-[500px] bg-[#F2F0EC] rounded-[50px] -z-10 opacity-100 rotate-[-4deg]"></div>
      <!-- FAINT DECORATIVE CIRCLE -->
      <div class="absolute left-[15%] bottom-[15%] w-32 h-32 rounded-full border-2 border-gray-300/30 opacity-70 -z-10"></div>

      <!-- AVATAR -->
      <div class="relative">
        <div class="w-48 h-48 rounded-full bg-[#ECEDE9] flex items-center justify-center relative shadow-inner overflow-hidden border-4 border-white/40">
           <!-- Using placeholder icon -->
           <svg class="w-24 h-24 text-gray-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
        </div>
        <!-- Verification Badge -->
        <div class="absolute bottom-1 right-2 w-10 h-10 rounded-full bg-[#2E7D32] border-4 border-[#FAF8F5] flex items-center justify-center text-white shadow-md">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg>
        </div>
      </div>

      <!-- TEXT DETAILS -->
      <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mt-8 tracking-tight">staff.bpa@gmail.com</h1>
      <h2 class="text-xl md:text-2xl text-[#C21A23] mt-3 font-semibold">Curriculum Division</h2>
      
      <!-- DIVIDER -->
      <div class="w-72 md:w-96 h-[2px] bg-[#E6E4E2] my-10 rounded-full"></div>
      
      <!-- LOG OUT BUTTON -->
      <button onclick="openLogoutModal()" class="bg-[#C21A23] hover:bg-red-800 text-white font-bold px-10 py-4 rounded-full flex items-center gap-3 shadow-xl shadow-red-900/20 transition-all transform hover:scale-105 active:scale-95 text-lg">
        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
        Log Out
      </button>

    </div>
  </main>

  <!-- LOG OUT MODAL -->
  <div id="logoutModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 hidden flex-col items-center justify-center px-4">
    <div class="relative bg-white rounded-[32px] shadow-2xl p-8 pt-10 max-w-sm w-full overflow-hidden flex flex-col items-center">
      <!-- Top Accent Bar -->
      <div class="absolute top-0 left-0 right-0 h-[6px] bg-[#b21522]"></div>

      <!-- Icon Container -->
      <div class="w-16 h-16 bg-[#FEE2E2] rounded-full flex items-center justify-center mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#b21522" class="w-7 h-7">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
        </svg>
      </div>

      <!-- Title -->
      <h2 class="text-xl font-bold text-gray-900 mb-2 text-center">Confirm Log Out</h2>

      <!-- Description -->
      <p class="text-gray-500 text-sm text-center mb-8 max-w-[280px] leading-relaxed">
        Are you sure you want to log out of your Workspace session?
      </p>

      <!-- Buttons Group -->
      <div class="w-full flex flex-col gap-3">
        <button onclick="closeLogoutModal()" class="w-full py-4 bg-[#b21522] text-white font-semibold rounded-2xl shadow-lg shadow-red-700/20 hover:bg-[#99131c] transition duration-200 text-center">
          Log Out
        </button>
        <button onclick="closeLogoutModal()" class="w-full py-4 bg-[#EDEAE6] text-[#44403C] font-semibold rounded-2xl hover:bg-[#E2DDD7] transition duration-200 text-center">
          Stay Logged In
        </button>
      </div>
    </div>
  </div>

  <script>
    function openLogoutModal() {
      const modal = document.getElementById('logoutModal');
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }

    function closeLogoutModal() {
      const modal = document.getElementById('logoutModal');
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  </script>
</body>
</html>
