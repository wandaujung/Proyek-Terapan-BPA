@extends('layouts.manager')

@section('content')
    <div class="px-8 py-8">

      <!-- Page title -->
      <h1 class="font-condensed font-extrabold text-3xl tracking-wide text-brand-text mb-1">PROJECTS</h1>
      <p class="text-xs font-semibold tracking-widest text-brand-muted uppercase mb-8">
        Manage and monitor projects across Curriculum, MKLT, MKWK, and Academic Partnership divisions in one workspace.
      </p>

      <div class="flex flex-col gap-10">
        @foreach($divisions as $division)
        <!-- DIVISION SECTION -->
        <section>
          <div class="flex items-center justify-between mb-4">
            <h2 class="font-condensed font-bold text-xl tracking-widest text-brand-text uppercase">{{ $division->name }}</h2>
            <span class="text-xs text-brand-muted font-semibold">{{ $division->projects->count() }} Projects</span>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            
            <!-- Add card -->
            <div class="add-card bg-white rounded-2xl flex flex-col items-center justify-center gap-2 border-2 border-dashed border-brand-border hover:border-brand-red transition-colors cursor-pointer" style="min-height:200px;" onclick="openNewProjectModal({{ $division->id }})">
              <div class="add-btn w-11 h-11 bg-brand-sidebar rounded-full flex items-center justify-center text-xl text-brand-muted transition-colors">+</div>
              <div class="text-center">
                <p class="font-semibold text-sm text-brand-text">Initiate New Entry</p>
                <p class="text-xs text-brand-muted">Start a fresh project</p>
              </div>
            </div>
            
            @forelse($division->projects as $project)
            <!-- Project Card -->
            <div class="project-card bg-white rounded-2xl p-5 flex flex-col gap-4 border border-brand-border cursor-pointer" onclick="window.location.href='{{ route('projects.tasks', $project->id) }}'">
              <div>
                <span class="inline-block bg-brand-red text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1 rounded-full mb-3">Project</span>
                <h3 class="font-condensed font-extrabold text-lg text-brand-text uppercase leading-tight">{{ $project->name }}</h3>
                <p class="text-xs text-brand-muted mt-0.5">{{ $project->tasks->count() }} Tasks</p>
              </div>
              <div class="flex-1"></div>
              
              @php
                $pic = $project->members->first() ?? null;
              @endphp

              @if($pic)
              <div class="flex items-center gap-2">
                <div class="avatar text-xs">{{ strtoupper(substr($pic->name, 0, 2)) }}</div>
                <div>
                  <p class="text-xs font-bold text-brand-text leading-none">{{ $pic->name }}</p>
                  <p class="text-[10px] text-brand-muted uppercase tracking-wider">Person in Charge</p>
                </div>
              </div>
              @else
              <div class="flex items-center gap-2">
                <div class="avatar text-xs">NA</div>
                <div>
                  <p class="text-xs font-bold text-brand-text leading-none">No Assignee</p>
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
            <!-- No Projects -->
            @endforelse
          </div>
        </section>
        @endforeach
      </div>
    </div>
@endsection

@section('scripts')

<!-- ======= NEW PROJECT MODAL ======= -->
<div id="newProjectModal" class="modal-overlay fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4" onclick="if(event.target===this)closeNewProjectModal()">
  <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden">
    <div class="px-8 pt-8 pb-4">
      <h2 class="font-condensed font-extrabold text-2xl tracking-wide text-brand-text">NEW PROJECT</h2>
      <p class="text-xs mt-1 text-brand-muted">Create a new project and assign it to a division.</p>
    </div>

    <form action="{{ route('manager.projects.store') }}" method="POST" class="px-8 pb-8">
      @csrf
      <div class="flex flex-col gap-5">
        <!-- Project Name -->
        <div>
          <label class="text-[10px] font-bold uppercase tracking-widest mb-1.5 block text-brand-muted">Project Name</label>
          <input type="text" name="name" required placeholder="e.g. PKKMB 2026" class="w-full bg-[#F5F3F0] border border-brand-border rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-brand-red/20 focus:border-brand-red transition" />
        </div>

        <!-- Division -->
        <div>
          <label class="text-[10px] font-bold uppercase tracking-widest mb-1.5 block text-brand-muted">Division</label>
          <select name="division_id" id="modalDivisionSelect" required class="w-full bg-[#F5F3F0] border border-brand-border rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-brand-red/20 focus:border-brand-red transition">
            <option value="">Select Division</option>
            @foreach($divisions as $div)
            <option value="{{ $div->id }}">{{ $div->name }}</option>
            @endforeach
          </select>
        </div>

        <!-- Dates -->
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="text-[10px] font-bold uppercase tracking-widest mb-1.5 block text-brand-muted">Start Date</label>
            <input type="date" name="start_project" required class="w-full bg-[#F5F3F0] border border-brand-border rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-brand-red/20 focus:border-brand-red transition" />
          </div>
          <div>
            <label class="text-[10px] font-bold uppercase tracking-widest mb-1.5 block text-brand-muted">End Date</label>
            <input type="date" name="end_project" required class="w-full bg-[#F5F3F0] border border-brand-border rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-brand-red/20 focus:border-brand-red transition" />
          </div>
        </div>

        <!-- Buttons -->
        <div class="flex items-center gap-4 pt-2">
          <button type="submit" class="flex-1 text-white font-bold py-3.5 rounded-xl flex items-center justify-center gap-2 transition-colors shadow-sm bg-brand-red">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Create Project
          </button>
          <button type="button" onclick="closeNewProjectModal()" class="text-sm font-semibold px-4 transition-colors hover:text-black text-brand-muted">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  function openNewProjectModal(divisionId = null) {
    if (divisionId) {
      document.getElementById('modalDivisionSelect').value = divisionId;
    }
    document.getElementById('newProjectModal').classList.add('open');
  }
  function closeNewProjectModal() {
    document.getElementById('newProjectModal').classList.remove('open');
  }
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeNewProjectModal();
  });
</script>
@endsection
