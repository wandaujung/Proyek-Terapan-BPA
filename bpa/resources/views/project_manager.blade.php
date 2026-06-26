@extends('layouts.manager')

@section('content')
    @if(session('success'))
    <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black/40 backdrop-blur-sm px-4 z-50" onclick="closeSuccessModal()">
      <div class="bg-[#FAF8F5] rounded-[32px] shadow-2xl w-full max-w-sm px-8 py-10 flex flex-col items-center text-center transform transition-all duration-300" onclick="event.stopPropagation()">

        <!-- Icon -->
        <div class="w-16 h-16 rounded-full flex items-center justify-center mb-6" style="background-color: #b2d8cc;">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="#3a8c72" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </div>

        <!-- Title -->
        <h2 class="font-condensed text-2xl font-bold text-gray-900 leading-snug mb-4 uppercase tracking-wide">
          Action Successful
        </h2>

        <!-- Description -->
        <p class="text-gray-500 text-sm leading-relaxed mb-8">
          {{ session('success') }}
        </p>

        <!-- Button -->
        <button onclick="closeSuccessModal()" class="w-full py-4 rounded-full text-white font-semibold text-sm tracking-wide bg-[#c0272d] hover:bg-[#a82025] transition-colors shadow-md shadow-[#c0272d]/25">
          Close
        </button>

        <!-- Encrypted Label -->
        <div class="flex items-center gap-2 mt-8 text-gray-400 text-xs font-medium tracking-widest uppercase">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
          Encrypted
        </div>

      </div>
    </div>
    <script>
      function closeSuccessModal() {
        const modal = document.getElementById('successModal');
        if (modal) modal.remove();
      }
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeSuccessModal();
      });
    </script>
    @endif

    <div class="px-8 py-8">

      <!-- Page title -->
      <h1 class="brand text-4xl tracking-widest text-brand-text mb-1">PROJECTS</h1>
      <p class="text-[10px] font-semibold tracking-[.18em] text-brand-muted mt-0.5 uppercase mb-8">
        Manage and monitor projects across Curriculum, MKLT, MKWK, and Academic Partnership divisions in one workspace.
      </p>

      <div class="flex flex-col gap-10">
        @foreach($divisions as $division)
        <!-- DIVISION SECTION -->
        <section>
          <div class="flex items-center justify-between mb-4">
            <h2 class="brand text-2xl tracking-wider text-brand-text uppercase">{{ $division->name }}</h2>
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
              <div class="flex justify-between items-start">
                <div>
                  <span class="inline-block bg-brand-red text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1 rounded-full mb-3">Project</span>
                  <h3 class="brand text-2xl tracking-wider text-brand-text uppercase leading-tight">{{ $project->name }}</h3>
                  <p class="text-xs text-brand-muted mt-0.5">{{ $project->tasks->count() }} Tasks</p>
                </div>
                <!-- Action Controls -->
                <div class="flex items-center gap-1.5">
                  <!-- Edit Project -->
                  <button
                    data-id="{{ $project->id }}"
                    data-name="{{ $project->name }}"
                    data-start="{{ $project->start_project }}"
                    data-end="{{ $project->end_project }}"
                    data-division-id="{{ $project->division_id }}"
                    data-members="{{ json_encode($project->members->map(function($m) { return ['id' => $m->id, 'name' => $m->name, 'email' => $m->email]; })) }}"
                    onclick="event.stopPropagation(); openEditProjectModal(this)"
                    class="w-8 h-8 rounded-full bg-blue-50 hover:bg-blue-100 flex items-center justify-center transition"
                    title="Edit Project"
                  >
                    <i class="ti ti-edit text-blue-500 text-sm"></i>
                  </button>

                  <!-- Delete Project -->
                  <form
                    onclick="event.stopPropagation()"
                    action="{{ route('projects.destroy', $project->id) }}"
                    method="POST"
                    onsubmit="return confirm('Delete this project?')"
                  >
                    @csrf
                    @method('DELETE')

                    <button
                      type="submit"
                      class="w-8 h-8 rounded-full bg-red-50 hover:bg-red-100 flex items-center justify-center transition"
                      title="Delete Project"
                    >
                      <i class="ti ti-trash text-brand-red text-sm"></i>
                    </button>
                  </form>
                </div>
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
  <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl max-h-[90vh] overflow-y-auto">
    <div class="px-8 pt-8 pb-4">
      <h2 class="brand text-2xl tracking-widest text-brand-text">NEW PROJECT</h2>
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

        <!-- MEMBER SELECTION -->
        <div class="mb-4">
          <label class="text-[10px] font-bold uppercase tracking-widest mb-1.5 block text-brand-muted">
            Collaborators (Optional)
          </label>
          <p class="text-[10px] text-brand-muted mb-2">Add members by email.</p>
          <div class="flex items-center gap-3">
            <div class="flex-grow flex items-center gap-2 bg-[#F5F3F0] border border-brand-border rounded-xl px-4 py-3 focus-within:border-brand-red transition-colors">
              <span class="text-gray-400 font-semibold text-sm">@</span>
              <input
                type="text"
                id="newMemberSearch"
                placeholder="Search staff email..."
                class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-semibold text-brand-text placeholder-gray-300 outline-none"
              />
            </div>
          </div>

          <div class="relative">
            <div id="newSearchResults" class="absolute left-0 right-0 bg-white border border-brand-border rounded-xl mt-1 max-h-40 overflow-y-auto hidden z-50 shadow-lg"></div>
          </div>

          <!-- MEMBER LIST -->
          <div id="newMemberList" class="flex flex-col gap-2 mt-3 max-h-40 overflow-y-auto"></div>

          <!-- hidden inputs container -->
          <div id="newMemberInputs" class="hidden"></div>
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

<!-- ======= EDIT PROJECT MODAL ======= -->
<div id="editProjectModal" class="modal-overlay fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4" onclick="if(event.target===this)closeEditProjectModal()">
  <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl max-h-[90vh] overflow-y-auto">
    <div class="px-8 pt-8 pb-4">
      <h2 class="brand text-2xl tracking-widest text-brand-text">EDIT PROJECT</h2>
      <p class="text-xs mt-1 text-brand-muted">Modify project details and division assignment.</p>
    </div>

    <form id="editProjectForm" method="POST" class="px-8 pb-8">
      @csrf
      @method('PUT')
      <div class="flex flex-col gap-5">
        <!-- Project Name -->
        <div>
          <label class="text-[10px] font-bold uppercase tracking-widest mb-1.5 block text-brand-muted">Project Name</label>
          <input type="text" name="name" id="edit_project_name" required placeholder="e.g. PKKMB 2026" class="w-full bg-[#F5F3F0] border border-brand-border rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-brand-red/20 focus:border-brand-red transition" />
        </div>

        <!-- Division -->
        <div>
          <label class="text-[10px] font-bold uppercase tracking-widest mb-1.5 block text-brand-muted">Division</label>
          <select name="division_id" id="edit_project_division" required class="w-full bg-[#F5F3F0] border border-brand-border rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-brand-red/20 focus:border-brand-red transition">
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
            <input type="date" name="start_project" id="edit_project_start" required class="w-full bg-[#F5F3F0] border border-brand-border rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-brand-red/20 focus:border-brand-red transition" />
          </div>
          <div>
            <label class="text-[10px] font-bold uppercase tracking-widest mb-1.5 block text-brand-muted">End Date</label>
            <input type="date" name="end_project" id="edit_project_end" required class="w-full bg-[#F5F3F0] border border-brand-border rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-brand-red/20 focus:border-brand-red transition" />
          </div>
        </div>

        <!-- MEMBER SELECTION -->
        <div class="mb-4">
          <label class="text-[10px] font-bold uppercase tracking-widest mb-1.5 block text-brand-muted">
            Collaborators (Optional)
          </label>
          <p class="text-[10px] text-brand-muted mb-2">Add members by email.</p>
          <div class="flex items-center gap-3">
            <div class="flex-grow flex items-center gap-2 bg-[#F5F3F0] border border-brand-border rounded-xl px-4 py-3 focus-within:border-brand-red transition-colors">
              <span class="text-gray-400 font-semibold text-sm">@</span>
              <input
                type="text"
                id="editMemberSearch"
                placeholder="Search staff email..."
                class="w-full bg-transparent border-none p-0 focus:ring-0 text-sm font-semibold text-brand-text placeholder-gray-300 outline-none"
              />
            </div>
          </div>

          <div class="relative">
            <div id="editSearchResults" class="absolute left-0 right-0 bg-white border border-brand-border rounded-xl mt-1 max-h-40 overflow-y-auto hidden z-50 shadow-lg"></div>
          </div>

          <!-- MEMBER LIST -->
          <div id="editMemberList" class="flex flex-col gap-2 mt-3 max-h-40 overflow-y-auto"></div>

          <!-- hidden inputs container -->
          <div id="editMemberInputs" class="hidden"></div>
        </div>

        <!-- Buttons -->
        <div class="flex items-center gap-4 pt-2">
          <button type="submit" class="flex-1 text-white font-bold py-3.5 rounded-xl flex items-center justify-center gap-2 transition-colors shadow-sm bg-brand-red hover:bg-brand-redDark">
            Save Changes
          </button>
          <button type="button" onclick="closeEditProjectModal()" class="text-sm font-semibold px-4 transition-colors hover:text-black text-brand-muted">Cancel</button>
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
    // Reset fields in the creation form
    document.getElementById('newMemberList').innerHTML = '';
    document.getElementById('newMemberInputs').innerHTML = '';
    document.getElementById('newMemberSearch').value = '';
    document.getElementById('newProjectModal').classList.add('open');
  }
  function closeNewProjectModal() {
    document.getElementById('newProjectModal').classList.remove('open');
  }

  const users = @json($users ?? []);

  function addNewMember(user) {
    const memberInputs = document.getElementById('newMemberInputs');
    const memberList = document.getElementById('newMemberList');

    // prevent duplicate
    if (memberInputs.querySelector(`[value="${user.id}"]`)) return;

    const row = document.createElement('div');
    row.className = 'flex items-center gap-3 bg-[#F5F3F0] border border-brand-border rounded-xl px-3 py-2 mt-1';
    row.innerHTML = `
      <div class="w-6 h-6 rounded-full bg-brand-red flex items-center justify-center text-[10px] font-bold text-white shrink-0">
        ${user.name.charAt(0).toUpperCase()}
      </div>
      <div class="flex-grow min-w-0">
        <p class="text-xs font-semibold text-brand-text truncate">${user.name}</p>
        <p class="text-[10px] text-brand-muted truncate">${user.email}</p>
      </div>
      <button type="button" class="remove-member text-brand-muted hover:text-brand-red transition">
        <i class="ti ti-x text-xs"></i>
      </button>
    `;

    memberList.appendChild(row);

    const hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'members[]';
    hidden.value = user.id;
    memberInputs.appendChild(hidden);

    row.querySelector('.remove-member').addEventListener('click', () => {
      row.remove();
      hidden.remove();
    });
  }

  function addEditMember(user) {
    const memberInputs = document.getElementById('editMemberInputs');
    const memberList = document.getElementById('editMemberList');

    // prevent duplicate
    if (memberInputs.querySelector(`[value="${user.id}"]`)) return;

    const row = document.createElement('div');
    row.className = 'flex items-center gap-3 bg-[#F5F3F0] border border-brand-border rounded-xl px-3 py-2 mt-1';
    row.innerHTML = `
      <div class="w-6 h-6 rounded-full bg-brand-red flex items-center justify-center text-[10px] font-bold text-white shrink-0">
        ${user.name.charAt(0).toUpperCase()}
      </div>
      <div class="flex-grow min-w-0">
        <p class="text-xs font-semibold text-brand-text truncate">${user.name}</p>
        <p class="text-[10px] text-brand-muted truncate">${user.email}</p>
      </div>
      <button type="button" class="remove-member text-brand-muted hover:text-brand-red transition">
        <i class="ti ti-x text-xs"></i>
      </button>
    `;

    memberList.appendChild(row);

    const hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'members[]';
    hidden.value = user.id;
    memberInputs.appendChild(hidden);

    row.querySelector('.remove-member').addEventListener('click', () => {
      row.remove();
      hidden.remove();
    });
  }

  function openEditProjectModal(btn) {
    const id = btn.getAttribute('data-id');
    const name = btn.getAttribute('data-name');
    const start = btn.getAttribute('data-start');
    const end = btn.getAttribute('data-end');
    const divisionId = btn.getAttribute('data-division-id');
    const members = JSON.parse(btn.getAttribute('data-members') || '[]');

    document.getElementById('editProjectForm').action = `/projects/update/${id}`;
    document.getElementById('edit_project_name').value = name;
    document.getElementById('edit_project_start').value = start;
    document.getElementById('edit_project_end').value = end;
    document.getElementById('edit_project_division').value = divisionId;

    // Reset members list
    const memberList = document.getElementById('editMemberList');
    const memberInputs = document.getElementById('editMemberInputs');
    memberList.innerHTML = '';
    memberInputs.innerHTML = '';

    // Load existing members
    members.forEach(member => addEditMember(member));

    document.getElementById('editProjectModal').classList.add('open');
  }

  document.addEventListener('DOMContentLoaded', function () {
    // Edit Modal Autocomplete
    const editMemberSearch = document.getElementById('editMemberSearch');
    const editSearchResults = document.getElementById('editSearchResults');

    if (editMemberSearch && editSearchResults) {
      editMemberSearch.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        editSearchResults.innerHTML = '';

        if (keyword.length < 1) {
          editSearchResults.classList.add('hidden');
          return;
        }

        const filtered = users.filter(user =>
          user.email.toLowerCase().includes(keyword) ||
          user.name.toLowerCase().includes(keyword)
        );

        if (filtered.length === 0) {
          editSearchResults.classList.add('hidden');
          return;
        }

        filtered.forEach(user => {
          const item = document.createElement('button');
          item.type = 'button';
          item.className = 'w-full text-left px-4 py-2.5 hover:bg-[#CC1D1D]/5 border-b border-brand-border text-xs block';
          item.innerHTML = `
            <div class="font-semibold text-brand-text text-xs">${user.name}</div>
            <div class="text-[10px] text-brand-muted">${user.email}</div>
          `;
          item.onclick = function () {
            addEditMember(user);
            editMemberSearch.value = '';
            editSearchResults.innerHTML = '';
            editSearchResults.classList.add('hidden');
          };
          editSearchResults.appendChild(item);
        });

        editSearchResults.classList.remove('hidden');
      });
    }

    // New Modal Autocomplete
    const newMemberSearch = document.getElementById('newMemberSearch');
    const newSearchResults = document.getElementById('newSearchResults');

    if (newMemberSearch && newSearchResults) {
      newMemberSearch.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        newSearchResults.innerHTML = '';

        if (keyword.length < 1) {
          newSearchResults.classList.add('hidden');
          return;
        }

        const filtered = users.filter(user =>
          user.email.toLowerCase().includes(keyword) ||
          user.name.toLowerCase().includes(keyword)
        );

        if (filtered.length === 0) {
          newSearchResults.classList.add('hidden');
          return;
        }

        filtered.forEach(user => {
          const item = document.createElement('button');
          item.type = 'button';
          item.className = 'w-full text-left px-4 py-2.5 hover:bg-[#CC1D1D]/5 border-b border-brand-border text-xs block';
          item.innerHTML = `
            <div class="font-semibold text-brand-text text-xs">${user.name}</div>
            <div class="text-[10px] text-brand-muted">${user.email}</div>
          `;
          item.onclick = function () {
            addNewMember(user);
            newMemberSearch.value = '';
            newSearchResults.innerHTML = '';
            newSearchResults.classList.add('hidden');
          };
          newSearchResults.appendChild(item);
        });

        newSearchResults.classList.remove('hidden');
      });
    }

    // Close search dropdowns when clicking outside
    document.addEventListener('click', function (e) {
      if (editMemberSearch && editSearchResults && e.target !== editMemberSearch && e.target !== editSearchResults) {
        editSearchResults.innerHTML = '';
        editSearchResults.classList.add('hidden');
      }
      if (newMemberSearch && newSearchResults && e.target !== newMemberSearch && e.target !== newSearchResults) {
        newSearchResults.innerHTML = '';
        newSearchResults.classList.add('hidden');
      }
    });
  });
  function closeEditProjectModal() {
    document.getElementById('editProjectModal').classList.remove('open');
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeNewProjectModal();
      closeEditProjectModal();
    }
  });
</script>
@endsection
