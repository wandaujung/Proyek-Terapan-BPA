<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Planner U × BPA – Projects</title>

 
  <script src="https://cdn.tailwindcss.com"></script>


  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet" />


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            brand: ['"Bebas Neue"', 'sans-serif'],
            body:  ['"DM Sans"', 'sans-serif'],
          },
          colors: {
            cream:      '#EDE8E0',
            sidebar:    '#D9D4CB',
            'main-bg':  '#FCF9F4',
            red:        '#C0282D',
            'red-dark': '#A82025',
          },
        },
      },
    }
  </script>

  <style>
    body { font-family: 'DM Sans', sans-serif; }
    .brand { font-family: 'Bebas Neue', sans-serif; letter-spacing: .06em; }

    ::-webkit-scrollbar { width: 4px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #C0282D55; border-radius: 99px; }

    
    input[type="date"]::-webkit-calendar-picker-indicator { opacity: 0; position: absolute; right: 0; width: 100%; cursor: pointer; }
    .date-wrapper { position: relative; }
    .date-wrapper .cal-icon { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #aaa; font-size: 16px; }
  </style>
</head>

<body class="flex h-screen overflow-hidden bg-[#FCF9F4] text-[#1A1A1A]">


  @if(session('success'))
  <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black/40 backdrop-blur-sm px-4 z-50" onclick="closeSuccessModal()">
    <div class="bg-[#FAF8F5] rounded-[32px] shadow-2xl w-full max-w-sm px-8 py-10 flex flex-col items-center text-center transform transition-all duration-300" onclick="event.stopPropagation()">

  
      <div class="w-16 h-16 rounded-full flex items-center justify-center mb-6" style="background-color: #b2d8cc;">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="#3a8c72" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
      </div>

     
      <h2 class="brand text-2xl font-bold text-gray-900 leading-snug mb-4 uppercase tracking-wide">
        Action Successful
      </h2>

   
      <p class="text-gray-500 text-sm leading-relaxed mb-8">
        {{ session('success') }}
      </p>

   
      <button onclick="closeSuccessModal()" class="w-full py-4 rounded-full text-white font-semibold text-sm tracking-wide bg-[#c0272d] hover:bg-[#a82025] transition-colors shadow-md shadow-[#c0272d]/25">
        Close
      </button>

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


  @include('partials.sidebar')


  <main class="flex-1 flex flex-col overflow-hidden">


    @include('partials.staff_header')

    
    <div class="flex-1 overflow-y-auto px-8 pb-10 flex flex-col gap-5">

    
      <div>
        <h1 class="brand text-4xl tracking-widest">PROJECTS</h1>
        <p class="text-[10px] font-semibold tracking-[.18em] text-gray-400 mt-0.5 uppercase">
          Manage and monitor all projects in the Curriculum Division Workspace.
        </p>
      </div>


      <div class="grid grid-cols-3 gap-4">

      
        <div
          id="openModalCard"
          class="bg-white border-2 border-dashed border-black/15 rounded-3xl flex flex-col items-center justify-center gap-3 p-8 min-h-[220px] cursor-pointer hover:border-red/40 hover:bg-red/5 transition group"
        >
          <div class="w-12 h-12 rounded-full border-2 border-black/20 group-hover:border-red/40 flex items-center justify-center transition">
            <i class="ti ti-plus text-xl text-gray-400 group-hover:text-red transition"></i>
          </div>
          <div class="text-center">
            <p class="font-semibold text-sm text-gray-700 group-hover:text-red transition">
              Initiate New Entry
            </p>
            <p class="text-xs text-gray-400 mt-0.5">
              Start a fresh editorial project
            </p>
          </div>
        </div>

 
@foreach($projects as $project)

<div
  onclick="window.location='{{ route('projects.tasks', $project->id) }}'"
  class="bg-white border border-black/10 rounded-3xl p-6 shadow-sm flex flex-col justify-between min-h-[220px] hover:shadow-md transition cursor-pointer"
>

  <div class="flex items-start justify-between">

    <div class="flex flex-col gap-2">

      <span class="bg-red text-white text-[9px] font-bold px-2.5 py-1 rounded-full w-fit tracking-widest">
        PROJECT
      </span>

      <h3 class="brand text-2xl tracking-wider mt-1 uppercase">
        {{ $project->name }}
      </h3>

      <p class="text-xs text-gray-400 font-medium">
        Planner U Workspace
      </p>

    </div>

    <div class="flex items-center gap-2">

      <button
        data-id="{{ $project->id }}"
        data-name="{{ $project->name }}"
        data-start="{{ $project->start_project }}"
        data-end="{{ $project->end_project }}"
        data-members="{{ json_encode($project->members->map(function($m) { return ['id' => $m->id, 'name' => $m->name, 'email' => $m->email]; })) }}"
        onclick="event.stopPropagation(); openEditModal(this)"
        class="w-9 h-9 rounded-full bg-blue-50 hover:bg-blue-100 flex items-center justify-center transition"
        title="Edit Project"
      >
        <i class="ti ti-edit text-blue-500 text-sm"></i>
      </button>

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
          class="w-9 h-9 rounded-full bg-red-50 hover:bg-red-100 flex items-center justify-center transition"
        >
          <i class="ti ti-trash text-red text-sm"></i>
        </button>
      </form>

    </div>

  </div>


  <div class="flex flex-col gap-3 mt-4">

 
    <div class="flex items-center gap-2.5">

      <div class="w-8 h-8 rounded-full bg-[#D3CEC6] flex items-center justify-center text-[10px] font-bold">
        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
      </div>

      <div>
        <p class="text-[10px] font-bold tracking-wide text-[#1A1A1A] uppercase">
          {{ Auth::user()->name }}
        </p>

        <p class="text-[9px] text-gray-400 tracking-wide">
          PERSON IN CHARGE
        </p>
      </div>

    </div>

    <div class="flex items-center justify-between">

      <div class="flex items-center gap-1.5 text-xs text-gray-500">
        <i class="ti ti-calendar text-gray-400 text-sm"></i>

        {{ $project->start_project }}
        -
        {{ $project->end_project }}
      </div>

      <div class="w-6 h-6 rounded-full bg-[#F0EDE8] flex items-center justify-center">
        <i class="ti ti-chevron-right text-xs text-gray-500"></i>
      </div>

    </div>

  </div>

</div>

@endforeach

      </div>
    </div>
  </main>


  <div
    id="projectModal"
    class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50"
  >
    <div class="bg-[#FAF8F5] rounded-3xl p-7 w-[480px] max-h-[90vh] overflow-y-auto shadow-2xl">

      <div class="flex items-start justify-between mb-6">
        <div>
          <p class="text-[10px] font-bold tracking-[.15em] text-red uppercase mb-1">New Entry</p>
          <h2 class="brand text-3xl tracking-wide">Initiate New Project</h2>
        </div>
        <button id="closeModal" class="text-gray-400 hover:text-gray-700 transition text-xl mt-1">
          <i class="ti ti-x"></i>
        </button>
      </div>

      <form action="{{ route('projects.store') }}" method="POST">
        @csrf

  
        <div class="mb-4">
          <label class="block text-[10px] font-bold tracking-[.15em] text-red uppercase mb-2">
            Project Name
          </label>
          <input
            type="text"
            name="name"
            placeholder="Enter Project Name..."
            class="w-full border border-black/10 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-red/20 placeholder-gray-300"
            required
          >
        </div>


        <div class="grid grid-cols-2 gap-3 mb-4">
          <div>
            <label class="block text-[10px] font-bold tracking-[.15em] text-red uppercase mb-2">
              Start Date
            </label>
            <div class="date-wrapper">
              <input
                type="date"
                name="start_project"
                class="w-full border border-black/10 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-red/20"
                required
              >
              <i class="ti ti-calendar cal-icon"></i>
            </div>
          </div>
          <div>
            <label class="block text-[10px] font-bold tracking-[.15em] text-red uppercase mb-2">
              End Date
            </label>
            <div class="date-wrapper">
              <input
                type="date"
                name="end_project"
                class="w-full border border-black/10 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-red/20"
                required
              >
              <i class="ti ti-calendar cal-icon"></i>
            </div>
          </div>
        </div>

        

    
        <div class="bg-[#F0EDE8] rounded-2xl p-4 mb-6">
          <p class="text-sm font-bold text-red mb-0.5">Collaborative Team</p>
          <p class="text-xs text-gray-400 mb-3">Add members by email.</p>

        
          <div class="flex gap-2 mb-2">
            <div class="flex-1 flex items-center gap-2 bg-white border border-black/10 rounded-xl px-3 py-2.5">
              <i class="ti ti-at text-gray-300 text-base"></i>
              <input
  type="text"
  id="memberSearch"
  placeholder="Search email..."
  class="flex-1 text-sm bg-transparent focus:outline-none text-gray-700 placeholder-gray-300"
>
            </div>
            <div
  id="searchResults"
  class="bg-white rounded-xl mt-2 border border-black/10 hidden overflow-hidden"
></div>
            <button
              type="button"
              id="addMemberBtn"
              class="bg-red hover:bg-red-dark transition text-white rounded-xl px-4 text-sm font-semibold flex items-center gap-1.5 whitespace-nowrap"
            >
              <i class="ti ti-user-plus text-sm"></i>
              Add
            </button>
          </div>

    
          <div id="memberList" class="flex flex-col gap-2"></div>

         
          <div id="memberInputs"></div>
        </div>

    
        <div class="flex items-center justify-end gap-3">
          <button
            type="button"
            id="closeModal2"
            class="text-sm font-semibold text-gray-500 hover:text-gray-800 transition px-4 py-2.5"
          >
            Discard
          </button>
          <button
            type="submit"
            class="bg-red hover:bg-red-dark transition text-white rounded-full px-7 py-2.5 text-sm font-bold"
          >
            Create Project
          </button>
        </div>

      </form>
    </div>
  </div>
 
<div
  id="editModal"
  class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50"
>
  <div class="bg-[#FAF8F5] rounded-3xl p-7 w-[480px] shadow-2xl">

    <div class="flex items-start justify-between mb-6">

      <div>
        <p class="text-[10px] font-bold tracking-[.15em] text-blue-500 uppercase mb-1">
          Edit Entry
        </p>

        <h2 class="brand text-3xl tracking-wide">
          Edit Project
        </h2>
      </div>

      <button id="closeEditModal" class="text-gray-400 hover:text-gray-700 transition text-xl mt-1">
        <i class="ti ti-x"></i>
      </button>

    </div>

    <form id="editForm" method="POST">

      @csrf
      @method('PUT')

     
      <div class="mb-4">

        <label class="block text-[10px] font-bold tracking-[.15em] text-red uppercase mb-2">
          Project Name
        </label>

        <input
          type="text"
          name="name"
          id="edit_name"
          class="w-full border border-black/10 rounded-xl px-4 py-3 text-sm bg-white"
          required
        >

      </div>

    
      <div class="grid grid-cols-2 gap-3 mb-4">

        <div>

          <label class="block text-[10px] font-bold tracking-[.15em] text-red uppercase mb-2">
            Start Date
          </label>

          <input
            type="date"
            name="start_project"
            id="edit_start"
            class="w-full border border-black/10 rounded-xl px-4 py-3 text-sm bg-white"
            required
          >

        </div>

        <div>

          <label class="block text-[10px] font-bold tracking-[.15em] text-red uppercase mb-2">
            End Date
          </label>

          <input
            type="date"
            name="end_project"
            id="edit_end"
            class="w-full border border-black/10 rounded-xl px-4 py-3 text-sm bg-white"
            required
          >

        </div>

      </div>

      
      <div class="bg-[#F0EDE8] rounded-2xl p-4 mb-6 relative">
        <p class="text-sm font-bold text-red mb-0.5">Collaborative Team</p>
        <p class="text-xs text-gray-400 mb-3">Add members by email.</p>

       
        <div class="flex gap-2 mb-2">
          <div class="flex-1 flex items-center gap-2 bg-white border border-black/10 rounded-xl px-3 py-2.5">
            <i class="ti ti-at text-gray-300 text-base"></i>
            <input
              type="text"
              id="editMemberSearch"
              placeholder="Search email..."
              class="flex-1 text-sm bg-transparent focus:outline-none text-gray-700 placeholder-gray-300"
            />
          </div>
          <button
            type="button"
            class="bg-red hover:bg-red-dark transition text-white rounded-xl px-4 text-sm font-semibold flex items-center gap-1.5 whitespace-nowrap"
            onclick="event.stopPropagation();"
          >
            <i class="ti ti-user-plus text-sm"></i>
            Add
          </button>
        </div>

        <div class="relative">
          <div id="editSearchResults" class="absolute left-0 right-0 bg-white border border-black/10 rounded-xl mt-1 max-h-40 overflow-y-auto hidden z-50 shadow-lg"></div>
        </div>

      
        <div id="editMemberList" class="flex flex-col gap-2 mt-3"></div>

      
        <div id="editMemberInputs" class="hidden"></div>
      </div>


      <div class="flex items-center justify-end gap-3">

        <button
          type="button"
          id="closeEditModal2"
          class="text-sm font-semibold text-gray-500 hover:text-gray-800 transition px-4 py-2.5"
        >
          Cancel
        </button>

        <button
          type="submit"
          class="bg-blue-500 hover:bg-blue-600 transition text-white rounded-full px-7 py-2.5 text-sm font-bold"
        >
          Update Project
        </button>

      </div>

    </form>

  </div>
</div>


<script>

  
  const modal     = document.getElementById('projectModal');
  const openBtn   = document.getElementById('openModal');
  const openCard  = document.getElementById('openModalCard');
  const closeBtn  = document.getElementById('closeModal');
  const closeBtn2 = document.getElementById('closeModal2');

  const openModal = () => {
    modal.classList.remove('hidden');
  }

  const closeModal = () => {
    modal.classList.add('hidden');
  }

  openBtn.addEventListener('click', openModal);
  openCard.addEventListener('click', openModal);

  closeBtn.addEventListener('click', closeModal);
  closeBtn2.addEventListener('click', closeModal);

  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      closeModal();
    }
  });

  
const users = @json($users);

const memberSearch = document.getElementById('memberSearch');
const searchResults = document.getElementById('searchResults');

const memberList = document.getElementById('memberList');
const memberInputs = document.getElementById('memberInputs');

memberSearch.addEventListener('input', function () {

  const keyword = this.value.toLowerCase();

  searchResults.innerHTML = '';

  if (keyword.length < 1) {
    searchResults.classList.add('hidden');
    return;
  }

  const filtered = users.filter(user =>
    user.email.toLowerCase().includes(keyword)
  );

  filtered.forEach(user => {

    const item = document.createElement('button');

    item.type = 'button';

    item.className =
      'w-full text-left px-4 py-3 hover:bg-red/5 border-b border-black/5 text-sm';

    item.innerHTML = `
      <div class="font-semibold">${user.name}</div>
      <div class="text-xs text-gray-400">${user.email}</div>
    `;

    item.onclick = () => addMember(user);

    searchResults.appendChild(item);
  });

  searchResults.classList.remove('hidden');
});

function addMember(user)
{

  if (
    memberInputs.querySelector(`[value="${user.id}"]`)
  ) return;

  const row = document.createElement('div');

  row.className =
    'flex items-center gap-3 bg-white border border-black/10 rounded-xl px-3 py-2.5';

  row.innerHTML = `
    <div class="w-7 h-7 rounded-full bg-red flex items-center justify-center text-[10px] font-bold text-white">
      ${user.name.charAt(0).toUpperCase()}
    </div>

    <div class="flex-1">
      <p class="text-sm font-semibold">${user.name}</p>
      <p class="text-xs text-gray-400">${user.email}</p>
    </div>

    <button
      type="button"
      class="remove-member text-gray-400 hover:text-red"
    >
      <i class="ti ti-x"></i>
    </button>
  `;

  memberList.appendChild(row);


  const hidden = document.createElement('input');

  hidden.type = 'hidden';
  hidden.name = 'members[]';
  hidden.value = user.id;

  memberInputs.appendChild(hidden);

 
  row.querySelector('.remove-member')
    .addEventListener('click', () => {
      row.remove();
      hidden.remove();
    });

  memberSearch.value = '';
  searchResults.innerHTML = '';
  searchResults.classList.add('hidden');
}

 
  const editModal = document.getElementById('editModal');

  const closeEditModalBtn =
    document.getElementById('closeEditModal');

  const closeEditModalBtn2 =
    document.getElementById('closeEditModal2');

  
  function addEditMember(user) {
    const editMemberInputs = document.getElementById('editMemberInputs');
    const editMemberList = document.getElementById('editMemberList');

    
    if (editMemberInputs.querySelector(`[value="${user.id}"]`)) return;

    const row = document.createElement('div');
    row.className = 'flex items-center gap-3 bg-white border border-black/10 rounded-xl px-3 py-2.5';
    row.innerHTML = `
      <div class="w-7 h-7 rounded-full bg-red flex items-center justify-center text-[10px] font-bold text-white shrink-0">
        ${user.name.charAt(0).toUpperCase()}
      </div>
      <div class="flex-grow min-w-0">
        <p class="text-sm font-semibold text-gray-800 truncate">${user.name}</p>
        <p class="text-xs text-gray-400 truncate">${user.email}</p>
      </div>
      <button type="button" class="remove-edit-member text-gray-400 hover:text-red transition">
        <i class="ti ti-x text-sm"></i>
      </button>
    `;

    editMemberList.appendChild(row);

    const hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'members[]';
    hidden.value = user.id;
    editMemberInputs.appendChild(hidden);

    row.querySelector('.remove-edit-member').addEventListener('click', () => {
      row.remove();
      hidden.remove();
    });
  }

  function openEditModal(btn) {
    const id = btn.getAttribute('data-id');
    const name = btn.getAttribute('data-name');
    const start = btn.getAttribute('data-start');
    const end = btn.getAttribute('data-end');
    const members = JSON.parse(btn.getAttribute('data-members') || '[]');

    editModal.classList.remove('hidden');

    document.getElementById('edit_name').value = name;
    document.getElementById('edit_start').value = start;
    document.getElementById('edit_end').value = end;
    document.getElementById('editForm').action = `/projects/update/${id}`;


    const editMemberList = document.getElementById('editMemberList');
    const editMemberInputs = document.getElementById('editMemberInputs');
    editMemberList.innerHTML = '';
    editMemberInputs.innerHTML = '';

  
    members.forEach(member => addEditMember(member));
  }

  document.addEventListener('DOMContentLoaded', function () {
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
          item.className = 'w-full text-left px-4 py-3 hover:bg-red/5 border-b border-black/5 text-sm block';
          item.innerHTML = `
            <div class="font-semibold text-gray-800 text-sm">${user.name}</div>
            <div class="text-xs text-gray-400">${user.email}</div>
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

    
      document.addEventListener('click', function (e) {
        if (e.target !== editMemberSearch && e.target !== editSearchResults) {
          editSearchResults.innerHTML = '';
          editSearchResults.classList.add('hidden');
        }
      });
    }
  });

  function closeEditModal() {
    editModal.classList.add('hidden');
  }

  closeEditModalBtn.addEventListener(
    'click',
    closeEditModal
  );

  closeEditModalBtn2.addEventListener(
    'click',
    closeEditModal
  );


  editModal.addEventListener('click', (e) => {
    if (e.target === editModal) {
      closeEditModal();
    }
  });



  document.addEventListener("DOMContentLoaded", () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('new_project') === 'true') {
      const createModal = document.getElementById('projectModal');
      if (createModal) {
        createModal.classList.remove('hidden');
       
        window.history.replaceState({}, document.title, window.location.pathname);
      }
    }
  });

</script>
  


</body>
</html>
