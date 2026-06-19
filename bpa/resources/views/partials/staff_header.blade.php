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
            <span id="notif-badge" class="absolute top-0 right-0 w-2.5 h-2.5 bg-yellow-400 rounded-full border-2 border-red {{ $unreadCount > 0 ? '' : 'hidden' }}"></span>
          </div>
        </button>

        <!-- Dropdown Menu -->
        <div id="notifDropdownMenu" class="hidden absolute right-0 mt-3 w-[360px] bg-[#EBE9E4] rounded-3xl shadow-xl border border-black/5 overflow-hidden z-50 flex flex-col">
          <!-- Header -->
          <div class="flex items-center justify-between px-6 py-5">
            <span class="font-bold text-[#1A1A1A] text-base">Notifications</span>
            <button type="button" id="markAllReadBtn" class="text-sm font-semibold text-[#8C3A27] hover:underline bg-transparent border-none cursor-pointer">Mark all as read</button>
          </div>

          <!-- Body -->
          <div class="flex flex-col gap-3 px-4 pb-4 max-h-[360px] overflow-y-auto">
            @php
              $headerNotifs = Auth::user() ? Auth::user()->notifications()->limit(4)->get() : collect();
            @endphp
            @forelse($headerNotifs as $notif)
              <div class="rounded-2xl p-4 flex gap-4 notif-card-item transition-all duration-200 {{ $notif->read_at ? 'bg-[#EDEBE6] opacity-70' : 'bg-white cursor-pointer hover:bg-black/[0.02]' }}"
                   data-id="{{ $notif->id }}"
                   data-read="{{ $notif->read_at ? 'true' : 'false' }}">
                <!-- Icon -->
                @if($notif->data['action'] == 'approved')
                  <div class="w-10 h-10 rounded-full bg-[#EBF5EE] text-[#2F6B43] flex items-center justify-center flex-shrink-0">
                    <i class="ti ti-circle-check-filled text-xl"></i>
                  </div>
                @elseif($notif->data['action'] == 'revision')
                  <div class="w-10 h-10 rounded-full bg-[#EEDDDA] text-[#D21C1C] flex items-center justify-center flex-shrink-0">
                    <i class="ti ti-file-description text-xl"></i>
                  </div>
                @elseif($notif->data['action'] == 'removed')
                  <div class="w-10 h-10 rounded-full bg-[#EEDDDA] text-[#D21C1C] flex items-center justify-center flex-shrink-0">
                    <i class="ti ti-trash text-xl"></i>
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
                      @if($notif->data['action'] == 'approved') Manager Approval @elseif($notif->data['action'] == 'revision') Revision Request @elseif($notif->data['action'] == 'removed') Project Removed @else New Project Added @endif
                    </p>
                    <span class="text-[11px] font-medium text-gray-400 whitespace-nowrap">{{ $notif->created_at->diffForHumans(null, true, true) }} ago</span>
                  </div>
                  <p class="text-[13px] text-gray-600 leading-snug">
                    @if($notif->data['action'] == 'approved')
                      '{{ $notif->data['title'] }}' approved.
                    @elseif($notif->data['action'] == 'revision')
                      '{{ $notif->data['title'] }}' needs attention.
                    @elseif($notif->data['action'] == 'removed')
                      '{{ $notif->data['title'] }}' removed from workspace.
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
  window.Laravel = {
    csrfToken: '{{ csrf_token() }}'
  };

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

    // Function to mark a single notification as read
    function markAsRead(notifId, cardElements) {
      fetch(`/notifications/${notifId}/read`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': window.Laravel.csrfToken,
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => response.json())
      .then(data => {
        if (!data.success) {
          console.error('Failed to mark notification as read');
        }
      })
      .catch(err => {
        console.error(err);
      });

      // Optimistically update styling on all card instances with this ID
      cardElements.forEach(card => {
        card.dataset.read = 'true';
        
        // Handle dropdown card styling
        if (card.classList.contains('notif-card-item') && !card.classList.contains('notif-card')) {
          card.classList.remove('bg-white', 'cursor-pointer', 'hover:bg-black/[0.02]');
          card.classList.add('bg-[#EDEBE6]', 'opacity-70');
        } 
        // Handle main page card styling (.notif-card)
        else {
          card.classList.remove('cursor-pointer', 'hover:bg-black/[0.01]');
          card.classList.add('read');
          
          // Remove mark-as-read form if present on the page
          const form = card.querySelector('form');
          if (form) {
            form.remove();
          }
        }
      });

      updateBadge();
    }

    // Function to update the bell notification badge
    function updateBadge() {
      const badge = document.getElementById('notif-badge');
      if (!badge) return;
      
      // Select dropdown unread items
      const dropdownUnread = document.querySelectorAll('.notif-card-item[data-read="false"]');
      if (dropdownUnread.length === 0) {
        badge.classList.add('hidden');
      } else {
        badge.classList.remove('hidden');
      }
    }

    // Add global click listener for .notif-card-item clicks (using event delegation)
    document.addEventListener('click', function(e) {
      const card = e.target.closest('.notif-card-item');
      if (!card) return;

      // Do nothing if already read
      if (card.dataset.read === 'true') return;

      // If clicked inside an interactive element, check if it's the "Mark as read" form/button
      const interactive = e.target.closest('a, button, form');
      if (interactive) {
        if (interactive.tagName === 'FORM' || interactive.closest('form')) {
          const form = interactive.tagName === 'FORM' ? interactive : interactive.closest('form');
          if (form.action && (form.action.includes('/read') && !form.action.includes('/read-all'))) {
            e.preventDefault();
            const notifId = card.dataset.id;
            const relatedCards = document.querySelectorAll(`.notif-card-item[data-id="${notifId}"]`);
            markAsRead(notifId, relatedCards);
          }
        }
        return; // Don't trigger card click handler if we clicked another link/button
      }

      // Card clicked directly
      const notifId = card.dataset.id;
      const relatedCards = document.querySelectorAll(`.notif-card-item[data-id="${notifId}"]`);
      markAsRead(notifId, relatedCards);
    });

    // Handle Mark all as read button
    const markAllReadBtn = document.getElementById('markAllReadBtn');
    if (markAllReadBtn) {
      markAllReadBtn.addEventListener('click', function(e) {
        e.preventDefault();

        // Select all unread items
        const unreadCards = document.querySelectorAll('.notif-card-item[data-read="false"]');
        
        // Optimistically update all cards in dropdown and page
        unreadCards.forEach(card => {
          card.dataset.read = 'true';
          if (!card.classList.contains('notif-card')) {
            card.classList.remove('bg-white', 'cursor-pointer', 'hover:bg-black/[0.02]');
            card.classList.add('bg-[#EDEBE6]', 'opacity-70');
          } else {
            card.classList.remove('cursor-pointer', 'hover:bg-black/[0.01]');
            card.classList.add('read');
            const form = card.querySelector('form');
            if (form) {
              form.remove();
            }
          }
        });

        // Hide badge
        const badge = document.getElementById('notif-badge');
        if (badge) {
          badge.classList.add('hidden');
        }

        // Call API
        fetch('/notifications/read-all', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': window.Laravel.csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(response => response.json())
        .then(data => {
          if (!data.success) {
            console.error('Failed to mark all as read');
          }
        })
        .catch(err => {
          console.error(err);
        });
      });
    }
  });
</script>
