@extends('layouts.manager')

@section('content')
      <!-- Content -->
      <div class="px-8 py-8">

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

          @foreach($reviewTasks as $task)
          <div class="bg-white rounded-2xl border border-brand-border p-6 review-card">
            <div class="flex items-start justify-between gap-6">
              <div class="flex-1">
                <h3 class="font-condensed font-extrabold text-xl text-brand-text mb-1">{{ $task->title }}</h3>
                <p class="text-xs text-brand-muted mb-4">{{ $task->user->name ?? 'Staff' }} &nbsp;·&nbsp; {{ $task->updated_at->diffForHumans() }}</p>
                <div class="bg-brand-bg rounded-lg border-l-4 px-4 py-3" style="border-color:#CC1D1D;">
                  <p class="text-[10px] font-bold tracking-widest uppercase mb-1" style="color:#CC1D1D;">Project</p>
                  <p class="text-sm text-brand-muted italic">"{{ $task->project->name ?? 'No Project' }}"</p>
                </div>
              </div>
              <div class="flex-shrink-0 flex flex-col items-center gap-2 mt-1">
                <button class="text-white text-sm font-bold px-6 py-2.5 rounded-full transition-colors w-full" style="background:#A81515;" onmouseover="this.style.background='#CC1D1D'" onmouseout="this.style.background='#A81515'" onclick="window.location.href='{{ route('manager.review_detail', $task->id) }}'">Review</button>
                <a href="{{ route('manager.review_detail', $task->id) }}" class="flex items-center gap-1 text-[10px] font-bold tracking-widest uppercase text-brand-text hover:text-brand-red transition-colors">
                  Project Details
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6m0 0v6m0-6L10 14"/></svg>
                </a>
              </div>
            </div>
          </div>
          @endforeach

        </div>
      </div><!-- /Content -->
@endsection
