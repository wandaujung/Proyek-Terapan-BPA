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
      <!-- Bell Dropdown -->
      <div class="relative" id="notifDropdownContainer">
        <button
          type="button"
          id="notifDropdownBtn"
          class="rounded-full bg-white p-1 shadow-sm flex items-center justify-center cursor-pointer border-none"
        >
          <div class="w-9 h-9 rounded-full bg-red hover:bg-red-dark transition text-white flex items-center justify-center relative">
            <i class="ti ti-bell text-base"></i>
            @php
               $unreadCount = Auth::user() ? Auth::user()->unreadNotifications->count() : 0;
            @endphp
            @if($unreadCount > 0)
              <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-yellow-400 rounded-full border-2 border-red"></span>
            @endif
          </div>
        </button>

        <!-- Dropdown Menu -->
        <div id="notifDropdownMenu" class="hidden absolute right-0 mt-3 w-[360px] bg-[#EBE9E4] rounded-3xl shadow-xl border border-black/5 overflow-hidden z-50 flex flex-col">
          <!-- Header -->
          <div class="flex items-center justify-between px-6 py-5">
            <span class="font-bold text-[#1A1A1A] text-base">Notifications</span>
            <form action="{{ route('notifications.readAll') }}" method="POST" class="m-0">
              @csrf
              <button type="submit" class="text-sm font-semibold text-[#8C3A27] hover:underline bg-transparent border-none cursor-pointer">Mark all as read</button>
            </form>
          </div>

          <!-- Body -->
          <div class="flex flex-col gap-3 px-4 pb-4 max-h-[360px] overflow-y-auto">
            @php
              $headerNotifs = Auth::user() ? Auth::user()->notifications()->limit(4)->get() : collect();
            @endphp
            @forelse($headerNotifs as $notif)
              <div class="bg-white rounded-2xl p-4 flex gap-4 {{ $notif->read_at ? 'opacity-70' : '' }}">
                <!-- Icon -->
                @if($notif->data['action'] == 'approved')
                  <div class="w-10 h-10 rounded-full bg-[#EBF5EE] text-[#2F6B43] flex items-center justify-center flex-shrink-0">
                    <i class="ti ti-circle-check-filled text-xl"></i>
                  </div>
                @elseif($notif->data['action'] == 'revision')
                  <div class="w-10 h-10 rounded-full bg-[#EEDDDA] text-[#D21C1C] flex items-center justify-center flex-shrink-0">
                    <i class="ti ti-file-description text-xl"></i>
                  </div>
                @else
                  <div class="w-10 h-10 rounded-full bg-[#E5EFFF] text-[#0066FF] flex items-center justify-center flex-shrink-0">
                    <i class="ti ti-circle-plus-filled text-xl"></i>
                  </div>
                @endif
                
                <!-- Content -->
                <div class="flex-1 min-w-0">
                  <div class="flex items-center justify-between mb-1">
                    <p class="text-sm font-bold text-[#1A1A1A] truncate">
                      @if($notif->data['action'] == 'approved') Manager Approval @elseif($notif->data['action'] == 'revision') Revision Request @else New Project Added @endif
                    </p>
                    <span class="text-[11px] font-medium text-gray-400 whitespace-nowrap">{{ $notif->created_at->diffForHumans(null, true, true) }} ago</span>
                  </div>
                  <p class="text-[13px] text-gray-600 leading-snug">
                    @if($notif->data['action'] == 'approved')
                      '{{ $notif->data['title'] }}' approved.
                    @elseif($notif->data['action'] == 'revision')
                      '{{ $notif->data['title'] }}' needs attention.
                    @else
                      '{{ $notif->data['title'] }}' added to workspace.
                    @endif
                  </p>
                </div>
              </div>
            @empty
              <p class="text-center text-sm text-gray-400 py-4">No recent notifications</p>
            @endforelse
          </div>

          <!-- Footer -->
          <div class="border-t border-black/5 bg-[#E6E4DF] p-4 text-center">
            <a href="{{ route('notifications.index') }}" class="text-sm font-bold text-[#4A453F] hover:text-[#1A1A1A] transition block w-full">View all activity</a>
          </div>
        </div>
      </div>
    @endif
    
    <!-- Avatar Link to Profile -->
    <a href="{{ route('profile') }}" class="rounded-full bg-white p-1 shadow-sm flex items-center justify-center cursor-pointer hover:ring-2 hover:ring-red transition" style="display: block;">
      <div class="w-9 h-9 rounded-full bg-gray-300 border-2 border-white shadow flex items-center justify-center text-xs font-bold text-gray-600 select-none">
        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
      </div>
    </a>
  </div>
</header>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('notifDropdownBtn');
    const menu = document.getElementById('notifDropdownMenu');
    
    if (btn && menu) {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        menu.classList.toggle('hidden');
      });

      document.addEventListener('click', (e) => {
        if (!menu.contains(e.target) && !btn.contains(e.target)) {
          menu.classList.add('hidden');
        }
      });
    }
  });
</script>
