<!-- ── TOPBAR ── -->
<header class="flex items-center justify-between px-8 pt-6 pb-2 border-b border-brand-border bg-brand-bg bg-[#FCF9F4] sticky top-0 z-10 flex-shrink-0 mb-2 shadow-md"
  <!-- Left: Logo -->
  <div class="flex items-center gap-2">
    <img src="{{ asset('images/logo-xbpa.png') }}" alt="Planner U" class="h-14">
  </div>

  <!-- Right: Search Bar + Bell + Avatar -->
  <div class="flex items-center gap-3">
    @if(!isset($hideSearchAndBell) || !$hideSearchAndBell)
      <form action="{{ route('projects') }}" method="GET" class="relative flex items-center m-0">
        <i class="ti ti-search absolute left-3.5 text-gray-400 pointer-events-none"></i>
        <input
          type="text"
          name="search"
          class="bg-[#f2efe9] border border-black/5 rounded-full py-2 pr-4 pl-10 text-sm w-[260px] focus:w-[300px] focus:bg-white focus:border-black/20 focus:shadow-sm transition-all outline-none"
          placeholder="Search projects..."
          value="{{ request('search') }}"
        />
      </form>
      <!-- Bell -->
      <a href="{{ route('notifications.index') }}" class="rounded-full bg-white p-1 shadow-sm flex items-center justify-center">
        <button
          class="w-9 h-9 rounded-full bg-red hover:bg-red-dark transition text-white flex items-center justify-center relative"
        >
          <i class="ti ti-bell text-base"></i>
        </button>
      </a>
    @endif
    
    <!-- Avatar Link to Profile -->
    <a href="{{ route('profile') }}" class="rounded-full bg-white p-1 shadow-sm flex items-center justify-center cursor-pointer hover:ring-2 hover:ring-red transition" style="display: block;">
      <div class="w-9 h-9 rounded-full bg-gray-300 border-2 border-white shadow flex items-center justify-center text-xs font-bold text-gray-600 select-none">
        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
      </div>
    </a>
  </div>
</header>
