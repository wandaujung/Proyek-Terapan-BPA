@extends('layouts.manager')

@section('content')
      <!-- Content -->
      <div id="page-dashboard" class="px-8 py-8">

        <!-- Page Heading -->
        <h1 class="font-condensed font-extrabold text-3xl tracking-wide text-brand-text mb-1">MANAGER OVERVIEW</h1>
        <p class="text-xs font-semibold tracking-widest text-brand-muted uppercase mb-6">
          Monitor project progress, track ongoing activities, and review project performance from your manager dashboard.
        </p>

        <!-- Tabs -->
        <div class="inline-flex items-center bg-brand-border rounded-full p-1 mb-8">
          <button id="tab-active-progress" class="tab-item tab-active text-sm font-semibold px-5 py-1.5 rounded-full" onclick="showTab('active')">Active Progress</button>
          <button id="tab-review-queue" class="tab-item text-sm font-medium px-5 py-1.5 rounded-full text-brand-muted" onclick="showTab('review')">Review Queue</button>
        </div>

        <!-- ======= ACTIVE PROGRESS SECTIONS ======= -->
        <div id="panel-active">

        @foreach($divisions as $division)
        <section class="mb-10">
          <div class="flex items-center justify-between mb-4">
            <h2 class="font-condensed font-bold text-xl tracking-widest text-brand-text uppercase">{{ $division->name }}</h2>
            <span class="text-xs text-brand-muted font-semibold">{{ $division->projects->count() }} Projects</span>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            
            @forelse($division->projects as $project)
            <div class="project-card bg-white rounded-2xl p-5 flex flex-col gap-4 border border-brand-border" onclick="window.location.href='{{ route('projects.tasks', $project->id) }}'">
              <div>
                <span class="inline-block bg-brand-red text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1 rounded-full mb-3">Project</span>
                <h3 class="font-condensed font-extrabold text-lg text-brand-text uppercase leading-tight">{{ $project->name }}</h3>
                <p class="text-xs text-brand-muted mt-0.5">{{ $project->tasks->count() }} Tasks</p>
              </div>
              <div class="flex-1"></div>
              
              @php
                $pic = $project->tasks->first()->user ?? null;
              @endphp

              @if($pic)
              <div class="flex items-center gap-2">
                <div class="avatar text-xs">{{ strtoupper(substr($pic->name, 0, 2)) }}</div>
                <div>
                  <p class="text-xs font-bold text-brand-text leading-none">{{ $pic->name }}</p>
                  <p class="text-[10px] text-brand-muted uppercase tracking-wider">Person in Charge</p>
                </div>
              </div>
              @endif

              <div class="flex items-center justify-between border-t border-brand-border pt-3">
                <div class="flex items-center gap-1.5 text-xs text-brand-muted">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                  {{ \Carbon\Carbon::parse($project->start_project)->format('M d') }} - {{ \Carbon\Carbon::parse($project->end_project)->format('M d, Y') }}
                </div>
                <button class="w-6 h-6 rounded-full hover:bg-brand-border flex items-center justify-center transition-colors">
                  <svg class="w-4 h-4 text-brand-muted" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
                </button>
              </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-8 text-sm text-brand-muted">No projects in this division yet.</div>
            @endforelse

          </div>
        </section>
        @endforeach

        </div><!-- /panel-active -->

        <!-- ======= REVIEW QUEUE PANEL ======= -->
        <div id="panel-review" class="hidden">

          <!-- Pending Reviews badge -->
          <div class="mb-5">
            <span class="inline-block bg-brand-red text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1.5 rounded">Pending Reviews</span>
          </div>

          <!-- Review items list -->
          <div class="flex flex-col gap-4">

            @forelse($reviewTasks as $task)
            <div class="bg-white rounded-2xl border border-brand-border p-6 relative review-card">
              <div class="flex items-start justify-between gap-4">
                <div class="flex-1">
                  <h3 class="font-condensed font-extrabold text-xl text-brand-text mb-1">{{ $task->title }}</h3>
                  <p class="text-xs text-brand-muted mb-4">{{ $task->user->name ?? 'Staff' }} &nbsp;·&nbsp; {{ $task->updated_at->diffForHumans() }}</p>
                  <div class="bg-brand-bg rounded-lg border-l-4 px-4 py-3" style="border-color:#CC1D1D;">
                    <p class="text-[10px] font-bold tracking-widest uppercase text-brand-red mb-1">Project</p>
                    <p class="text-sm text-brand-muted italic">"{{ $task->project->name ?? 'No Project' }}"</p>
                  </div>
                </div>
                <a href="{{ route('manager.review_detail', $task->id) }}" class="flex-shrink-0 flex items-center gap-1 text-[11px] font-bold tracking-widest uppercase text-brand-text hover:text-brand-red transition-colors mt-1">
                  Review Details
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6m0 0v6m0-6L10 14"/></svg>
                </a>
              </div>
            </div>
            @empty
            <div class="text-center py-8 text-sm text-brand-muted">No pending reviews at the moment.</div>
            @endforelse

          </div>
        </div><!-- /panel-review -->

      </div><!-- /Content Dashboard -->
@endsection

@section('scripts')
  <script>
    // Tab switching
    function showTab(tab) {
      const activeBtn   = document.getElementById('tab-active-progress');
      const reviewBtn   = document.getElementById('tab-review-queue');
      const activePanel = document.getElementById('panel-active');
      const reviewPanel = document.getElementById('panel-review');

      if (tab === 'active') {
        activeBtn.classList.add('tab-active');
        activeBtn.classList.remove('text-brand-muted');
        reviewBtn.classList.remove('tab-active');
        reviewBtn.classList.add('text-brand-muted');
        activePanel.classList.remove('hidden');
        reviewPanel.classList.add('hidden');
      } else {
        reviewBtn.classList.add('tab-active');
        reviewBtn.classList.remove('text-brand-muted');
        activeBtn.classList.remove('tab-active');
        activeBtn.classList.add('text-brand-muted');
        reviewPanel.classList.remove('hidden');
        activePanel.classList.add('hidden');
      }
    }
  </script>
@endsection
