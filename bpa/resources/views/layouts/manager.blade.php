<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Planner U – Manager Overview</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"DM Sans"', 'sans-serif'],
                        condensed: ['"Bebas Neue"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            red: '#CC1D1D',
                            redDark: '#A81515',
                            redLight: '#E53E3E',
                            bg: '#F0EDEA',
                            card: '#FFFFFF',
                            sidebar: '#E8E4E0',
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
        body {
            background-color: #F0EDEA;
            font-family: 'DM Sans', sans-serif;
        }

        .brand {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 0.06em;
        }

        .nav-active {
            background-color: #FFFFFF;
            color: #CC1D1D;
            font-weight: 700;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .nav-item {
            transition: background 0.15s, color 0.15s;
        }

        .nav-item:hover:not(.nav-active) {
            background-color: #DDD9D5;
        }

        .tab-active {
            background-color: #FFFFFF;
            color: #1A1A1A;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.10);
        }

        .tab-item {
            transition: background 0.15s, color 0.15s;
            cursor: pointer;
        }

        .project-card {
            transition: transform 0.18s ease, box-shadow 0.18s ease;
            cursor: pointer;
        }

        .project-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.10);
        }

        .review-card {
            transition: transform 0.18s ease, box-shadow 0.18s ease;
            cursor: pointer;
        }

        .review-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        /* Project manager specific */
        .add-card {
            border: 2px dashed #D6D0CA;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .add-card:hover {
            border-color: #CC1D1D;
            background: rgba(204, 29, 29, 0.05);
        }

        .add-btn {
            width: 44px;
            height: 44px;
            background: #E8E4E0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: #6B6560;
            transition: all 0.15s;
        }

        .add-card:hover .add-btn {
            background: #FFFFFF;
            color: #CC1D1D;
            box-shadow: 0 2px 8px rgba(204, 29, 29, 0.2);
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: #C5BFB9;
            border-radius: 3px;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            background: #C5BFB9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: #6B6560;
            flex-shrink: 0;
        }

        .modal-overlay {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }

        .modal-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }
    </style>
    @yield('head')
</head>

<body class="min-h-screen">
    <div class="flex min-h-screen">

        @include('partials.sidebar')

        <main class="flex-1 flex flex-col min-h-screen">
          
            <header
                class="flex items-center gap-4 px-8 pt-6 pb-2 border-b border-brand-border bg-brand-bg sticky top-0 z-10 flex-shrink-0 shadow">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-xbpa.png') }}" alt="Planner U" class="h-14">
                </div>
                <div class="ml-auto flex items-center gap-3">
                    
                    <div class="relative" id="notifDropdownContainer">
                        <button
                          type="button"
                          id="notifDropdownBtn"
                          class="rounded-full bg-white p-1 shadow-sm flex items-center justify-center cursor-pointer border-none"
                        >
                          <div class="w-9 h-9 rounded-full bg-[#C0282D] hover:bg-[#A82025] transition text-white flex items-center justify-center relative">
                            <i class="ti ti-bell text-base"></i>
                            @php
                               $unreadCount = Auth::user() ? Auth::user()->unreadNotifications->count() : 0;
                            @endphp
                            <span id="notif-badge" class="absolute top-0 right-0 w-2.5 h-2.5 bg-yellow-400 rounded-full border-2 border-[#C0282D] {{ $unreadCount > 0 ? '' : 'hidden' }}"></span>
                          </div>
                        </button>

                      
                        <div id="notifDropdownMenu" class="hidden absolute right-0 mt-3 w-[360px] bg-[#EBE9E4] rounded-3xl shadow-xl border border-black/5 overflow-hidden z-50 flex flex-col text-left">
                        
                          <div class="flex items-center justify-between px-6 py-5">
                            <span class="font-bold text-[#1A1A1A] text-base">Notifications</span>
                            <button type="button" id="markAllReadBtn" class="text-sm font-semibold text-[#8C3A27] hover:underline bg-transparent border-none cursor-pointer">Mark all as read</button>
                          </div>

                     
                          <div class="flex flex-col gap-3 px-4 pb-4 max-h-[360px] overflow-y-auto">
                            @php
                              $headerNotifs = Auth::user() ? Auth::user()->notifications()->limit(4)->get() : collect();
                            @endphp
                            @forelse($headerNotifs as $notif)
                              <div class="rounded-2xl p-4 flex gap-4 notif-card-item transition-all duration-200 {{ $notif->read_at ? 'bg-[#EDEBE6] opacity-70' : 'bg-white cursor-pointer hover:bg-black/[0.02]' }}"
                                   data-id="{{ $notif->id }}"
                                   data-read="{{ $notif->read_at ? 'true' : 'false' }}">
                              
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
                                
                             
                                <div class="flex-1 min-w-0">
                                  <div class="flex items-center justify-between mb-1">
                                    <p class="text-sm font-bold text-[#1A1A1A] truncate">
                                      @if($notif->data['action'] == 'approved') Manager Approval @elseif($notif->data['action'] == 'revision') Revision Request @elseif($notif->data['action'] == 'removed') Project Removed @elseif($notif->data['action'] == 'updated') Project Updated @else New Project Added @endif
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
                                    @elseif($notif->data['action'] == 'updated')
                                      '{{ $notif->data['title'] }}' updated in workspace.
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

                        
                          <div class="border-t border-black/5 bg-[#E6E4DF] p-4 text-center">
                            <a href="{{ route('notifications.index') }}" class="text-sm font-bold text-[#4A453F] hover:text-[#1A1A1A] transition block w-full">View all activity</a>
                          </div>
                        </div>
                    </div>
                   
                    <a href="{{ route('profile') }}" class="avatar hover:ring-2 hover:ring-brand-red transition"
                        style="background:#C5BFB9; text-decoration:none;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </a>
                </div>
            </header>

         
            <div class="flex-1 overflow-y-auto">
                @yield('content')
            </div>
        </main>
    </div>
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

          cardElements.forEach(card => {
            card.dataset.read = 'true';
            
           
            if (card.classList.contains('notif-card-item') && !card.classList.contains('notif-card')) {
              card.classList.remove('bg-white', 'cursor-pointer', 'hover:bg-black/[0.02]');
              card.classList.add('bg-[#EDEBE6]', 'opacity-70');
            } 
        
            else {
              card.classList.remove('cursor-pointer', 'hover:bg-black/[0.01]');
              card.classList.add('read');
              
              
              const form = card.querySelector('form');
              if (form) {
                form.remove();
              }
            }
          });

          updateBadge();
        }

       
        function updateBadge() {
          const badge = document.getElementById('notif-badge');
          if (!badge) return;
          
         
          const dropdownUnread = document.querySelectorAll('.notif-card-item[data-read="false"]');
          if (dropdownUnread.length === 0) {
            badge.classList.add('hidden');
          } else {
            badge.classList.remove('hidden');
          }
        }

        
        document.addEventListener('click', function(e) {
          const card = e.target.closest('.notif-card-item');
          if (!card) return;

          if (card.dataset.read === 'true') return;
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
            return; 
          }

          const notifId = card.dataset.id;
          const relatedCards = document.querySelectorAll(`.notif-card-item[data-id="${notifId}"]`);
          markAsRead(notifId, relatedCards);
        });

        const markAllReadBtn = document.getElementById('markAllReadBtn');
        if (markAllReadBtn) {
          markAllReadBtn.addEventListener('click', function(e) {
            e.preventDefault();

            const unreadCards = document.querySelectorAll('.notif-card-item[data-read="false"]');
            
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

            const badge = document.getElementById('notif-badge');
            if (badge) {
              badge.classList.add('hidden');
            }

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
    @yield('scripts')
</body>

</html>
