@php
  $user = Auth::user();
  $isManager = ($user->division && strtolower($user->division->name) === 'manager') 
               || request()->is('dashboard/manager*') 
               || request()->routeIs('manager.*');
  $divisionName = $user->division ? strtolower($user->division->name) : 'ac';
@endphp

<aside class="w-52 flex-shrink-0 flex flex-col py-6 px-4 gap-5 relative z-20 h-screen" style="background:#E8E4E0;">
  <!-- Logo -->
  <div class="brand text-3xl text-[#CC1D1D] px-1 pt-2">
    <img src="{{ asset('images/logo-planneru.png') }}" alt="Planner U">
  </div>

  @if(!$isManager)
    <!-- New Project Button (Staff only) -->
    <button
      @if(request()->routeIs('projects'))
        id="openModal"
      @else
        onclick="window.location.href='{{ route('projects') }}?new_project=true'"
      @endif
      class="flex items-center gap-2 bg-[#C0282D] hover:bg-[#A82025] transition text-white rounded-2xl px-4 py-3 text-sm font-semibold"
    >
      <i class="ti ti-plus text-base"></i>
      New Project
    </button>
  @endif

  <!-- NAV -->
  <nav class="flex flex-col gap-1">
    @if($isManager)
      <!-- MANAGER NAV -->
      <a href="{{ route('manager.dashboard') }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('manager.dashboard') ? 'bg-white text-[#CC1D1D] font-bold shadow-sm' : 'text-[#6B6560] hover:bg-[#DDD9D5]' }}"
         style="{{ request()->routeIs('manager.dashboard') ? 'background-color: #FFFFFF; color: #CC1D1D; font-weight: 700; box-shadow: 0 1px 3px rgba(0,0,0,0.05);' : '' }}">
        <i class="ti ti-layout-dashboard text-base"></i>
        Dashboard
      </a>
      
      <a href="{{ route('manager.projects.index') }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('manager.projects.index') || request()->routeIs('projects.tasks') ? 'bg-white text-[#CC1D1D] font-bold shadow-sm' : 'text-[#6B6560] hover:bg-[#DDD9D5]' }}"
         style="{{ request()->routeIs('manager.projects.index') || request()->routeIs('projects.tasks') ? 'background-color: #FFFFFF; color: #CC1D1D; font-weight: 700; box-shadow: 0 1px 3px rgba(0,0,0,0.05);' : '' }}">
        <i class="ti ti-folder text-base"></i>
        Projects
      </a>

      <a href="{{ route('manager.reviews') }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('manager.reviews') || request()->routeIs('manager.review_detail') ? 'bg-white text-[#CC1D1D] font-bold shadow-sm' : 'text-[#6B6560] hover:bg-[#DDD9D5]' }}"
         style="{{ request()->routeIs('manager.reviews') || request()->routeIs('manager.review_detail') ? 'background-color: #FFFFFF; color: #CC1D1D; font-weight: 700; box-shadow: 0 1px 3px rgba(0,0,0,0.05);' : '' }}">
        <i class="ti ti-folder-check text-base"></i>
        Reviews
      </a>

      <a href="{{ route('manager.staff_management') }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('manager.staff_management') ? 'bg-white text-[#CC1D1D] font-bold shadow-sm' : 'text-[#6B6560] hover:bg-[#DDD9D5]' }}"
         style="{{ request()->routeIs('manager.staff_management') ? 'background-color: #FFFFFF; color: #CC1D1D; font-weight: 700; box-shadow: 0 1px 3px rgba(0,0,0,0.05);' : '' }}">
        <i class="ti ti-users text-base"></i>
        Staff Management
      </a>

      <a href="{{ route('notifications.index') }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('notifications.index') ? 'bg-white text-[#CC1D1D] font-bold shadow-sm' : 'text-[#6B6560] hover:bg-[#DDD9D5]' }}"
         style="{{ request()->routeIs('notifications.index') ? 'background-color: #FFFFFF; color: #CC1D1D; font-weight: 700; box-shadow: 0 1px 3px rgba(0,0,0,0.05);' : '' }}">
        <i class="ti ti-bell text-base"></i>
        Notification
      </a>
    @else
      <!-- STAFF NAV -->
      <a href="/dashboard/{{ $divisionName }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition {{ request()->is('dashboard/*') ? 'bg-white text-[#C0282D] font-bold shadow-sm' : 'text-[#6B6560] hover:bg-[#DDD9D5]' }}"
         style="{{ request()->is('dashboard/*') ? 'background-color: #FFFFFF; color: #C0282D; font-weight: 700; box-shadow: 0 1px 3px rgba(0,0,0,0.05);' : '' }}">
        <i class="ti ti-layout-dashboard text-base"></i>
        Dashboard
      </a>

      <a href="{{ route('projects') }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('projects') || request()->routeIs('projects.tasks') ? 'bg-white text-[#C0282D] font-bold shadow-sm' : 'text-[#6B6560] hover:bg-[#DDD9D5]' }}"
         style="{{ request()->routeIs('projects') || request()->routeIs('projects.tasks') ? 'background-color: #FFFFFF; color: #C0282D; font-weight: 700; box-shadow: 0 1px 3px rgba(0,0,0,0.05);' : '' }}">
        <i class="ti ti-folder text-base"></i>
        Projects
      </a>

      <a href="{{ route('notifications.index') }}"
         class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('notifications.index') ? 'bg-white text-[#C0282D] font-bold shadow-sm' : 'text-[#6B6560] hover:bg-[#DDD9D5]' }}"
         style="{{ request()->routeIs('notifications.index') ? 'background-color: #FFFFFF; color: #C0282D; font-weight: 700; box-shadow: 0 1px 3px rgba(0,0,0,0.05);' : '' }}">
        <i class="ti ti-bell text-base"></i>
        Notification
      </a>
    @endif
  </nav>
</aside>
