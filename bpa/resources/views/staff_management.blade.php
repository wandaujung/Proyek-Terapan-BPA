@extends('layouts.manager')

@section('content')
      <!-- Content -->
      <div class="px-8 py-8">

        <!-- Session Success Confirmation Modal -->
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

        <!-- Session Error Alert -->
        @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-2xl p-4 text-xs font-semibold flex items-center gap-2">
          <i class="ti ti-alert-circle text-base"></i>
          <span>{{ session('error') }}</span>
        </div>
        @endif

        <!-- Session Import Errors Alert -->
        @if(session('import_errors') && count(session('import_errors')) > 0)
        <div class="mb-6 bg-[#CC1D1D]/5 border border-[#CC1D1D]/20 rounded-2xl p-5 shadow-sm">
          <h4 class="text-[#CC1D1D] font-condensed font-extrabold text-sm tracking-wide uppercase mb-3 flex items-center gap-2">
            <i class="ti ti-alert-triangle text-base"></i> Some rows failed to import:
          </h4>
          <ul class="list-disc pl-5 space-y-1.5">
            @foreach(session('import_errors') as $err)
              <li class="text-[#6B6560] text-xs font-medium">{{ $err }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <!-- Page Heading & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
          <div>
            <h1 class="font-condensed font-extrabold text-3xl tracking-wide text-brand-text mb-1">STAFF DIRECTORY</h1>
            <p class="text-xs font-semibold tracking-widest text-brand-muted uppercase">
              Manage and organize Telkom University project staff members, roles, and divisions.
            </p>
          </div>
          
          <div class="flex items-center gap-3">
            <!-- Add new staff button -->
            <button onclick="openAddStaffModal()" class="bg-brand-red hover:bg-brand-redDark text-white text-xs font-bold px-5 py-3 rounded-xl transition-colors shadow-sm flex items-center gap-2">
              <i class="ti ti-user-plus text-sm"></i>
              Add New Staff
            </button>

            <!-- Import CSV button -->
            <button onclick="openImportStaffModal()" class="bg-white hover:bg-brand-bg text-brand-text border border-brand-border text-xs font-bold px-5 py-3 rounded-xl transition-colors shadow-sm flex items-center gap-2">
              <i class="ti ti-upload text-sm"></i>
              Import Staff (CSV)
            </button>

            <!-- Export CSV button -->
            <a href="{{ route('manager.staff_management.export') }}" class="bg-white hover:bg-brand-bg text-brand-text border border-brand-border text-xs font-bold px-5 py-3 rounded-xl transition-colors shadow-sm flex items-center gap-2">
              <i class="ti ti-download text-sm"></i>
              Export Data (CSV)
            </a>
          </div>
        </div>

        <!-- Section title -->
        <h2 class="font-condensed font-bold text-base tracking-widest text-brand-text uppercase mb-4">Active Staff ({{ $staff->count() }})</h2>

        @if($staff->isEmpty())
          <!-- Empty State -->
          <div class="bg-white rounded-2xl border border-brand-border p-12 flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16 rounded-full bg-brand-sidebar flex items-center justify-center mb-4 text-brand-muted">
              <i class="ti ti-users text-2xl"></i>
            </div>
            <h3 class="font-condensed font-extrabold text-lg text-brand-text mb-1 uppercase tracking-wide">No Staff Members</h3>
            <p class="text-xs text-brand-muted max-w-xs">You haven't registered any staff members yet. Click the "Add New Staff" button to register one.</p>
          </div>
        @else
          <!-- Staff Table -->
          <div class="bg-white rounded-2xl border border-brand-border overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
              <table class="w-full text-left border-collapse">
                <thead>
                  <tr class="bg-brand-sidebar/30 border-b border-brand-border">
                    <th class="py-4 px-6 text-[10px] font-bold uppercase tracking-widest text-brand-muted w-16">No.</th>
                    <th class="py-4 px-6 text-[10px] font-bold uppercase tracking-widest text-brand-muted">Staff Member</th>
                    <th class="py-4 px-6 text-[10px] font-bold uppercase tracking-widest text-brand-muted">Division</th>
                    <th class="py-4 px-6 text-[10px] font-bold uppercase tracking-widest text-brand-muted">Registered At</th>
                    <th class="py-4 px-6 text-[10px] font-bold uppercase tracking-widest text-brand-muted text-right w-24">Actions</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-brand-border">
                  @foreach($staff as $index => $user)
                  <tr class="hover:bg-brand-sidebar/10 transition-colors">
                    <!-- Index -->
                    <td class="py-4 px-6 text-xs font-semibold text-brand-muted">
                      {{ $index + 1 }}
                    </td>
                    <!-- Staff Details -->
                    <td class="py-4 px-6">
                      <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-brand-sidebar flex items-center justify-center font-extrabold text-brand-muted text-xs flex-shrink-0">
                          {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <div>
                          <h3 class="font-condensed font-extrabold text-sm text-brand-text uppercase leading-tight">{{ $user->name }}</h3>
                          <p class="text-xs text-brand-muted mt-0.5">{{ $user->email }}</p>
                        </div>
                      </div>
                    </td>
                    <!-- Division -->
                    <td class="py-4 px-6">
                      @if($user->division)
                        <span class="bg-[#ba1a1a]/10 text-[#ba1a1a] text-[10px] font-bold tracking-widest uppercase px-2.5 py-1 rounded-full">
                          {{ $user->division->name }}
                        </span>
                      @else
                        <span class="bg-brand-sidebar text-brand-muted text-[10px] font-bold tracking-widest uppercase px-2.5 py-1 rounded-full">
                          Unassigned
                        </span>
                      @endif
                    </td>
                    <!-- Registered At -->
                    <td class="py-4 px-6 text-xs text-brand-muted font-medium">
                      {{ $user->created_at ? $user->created_at->format('d M Y, H:i') : '-' }}
                    </td>
                    <!-- Actions -->
                    <td class="py-4 px-6 text-right">
                      <form action="{{ route('manager.staff_management.delete', $user->id) }}" method="POST" onsubmit="return confirm('Delete staff account for {{ $user->name }}?')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-8 h-8 rounded-full hover:bg-red-50 text-brand-muted hover:text-brand-red flex items-center justify-center transition-colors" title="Delete Account">
                          <i class="ti ti-trash text-sm"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        @endif

      </div><!-- /Content -->

      <!-- ======= ADD STAFF MODAL ======= -->
      <div id="addStaffModal" class="modal-overlay fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4" onclick="if(event.target===this)closeAddStaffModal()">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden">
          <div class="px-8 pt-8 pb-4">
            <h2 class="font-condensed font-extrabold text-2xl tracking-wide text-brand-text">ADD NEW STAFF</h2>
            <p class="text-xs mt-1 text-brand-muted">Register a new staff member and assign them to a division.</p>
          </div>

          <form action="{{ route('manager.staff_management.store') }}" method="POST" class="px-8 pb-8">
            @csrf
            <div class="flex flex-col gap-5">
              <!-- Name -->
              <div>
                <label class="text-[10px] font-bold uppercase tracking-widest mb-1.5 block text-brand-muted">Full Name</label>
                <input type="text" name="name" required placeholder="e.g. John Doe" class="w-full bg-[#F5F3F0] border border-brand-border rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-brand-red/20 focus:border-brand-red transition" />
              </div>

              <!-- Email -->
              <div>
                <label class="text-[10px] font-bold uppercase tracking-widest mb-1.5 block text-brand-muted">Email Address</label>
                <input type="email" name="email" required placeholder="e.g. john@bpa.com" class="w-full bg-[#F5F3F0] border border-brand-border rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-brand-red/20 focus:border-brand-red transition" />
              </div>

              <!-- Password -->
              <div>
                <label class="text-[10px] font-bold uppercase tracking-widest mb-1.5 block text-brand-muted">Password</label>
                <input type="password" name="password" required placeholder="Min 6 characters" class="w-full bg-[#F5F3F0] border border-brand-border rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-brand-red/20 focus:border-brand-red transition" />
              </div>

              <!-- Division -->
              <div>
                <label class="text-[10px] font-bold uppercase tracking-widest mb-1.5 block text-brand-muted">Division</label>
                <select name="division_id" required class="w-full bg-[#F5F3F0] border border-brand-border rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-brand-red/20 focus:border-brand-red transition">
                  <option value="">Select Division</option>
                  @foreach($divisions as $div)
                    <option value="{{ $div->id }}">{{ $div->name }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Buttons -->
              <div class="flex items-center gap-4 pt-2">
                <button type="submit" class="flex-1 text-white font-bold py-3.5 rounded-xl flex items-center justify-center gap-2 transition-colors shadow-sm bg-brand-red hover:bg-brand-redDark">
                  Create Account
                </button>
                <button type="button" onclick="closeAddStaffModal()" class="text-sm font-semibold px-4 transition-colors hover:text-black text-brand-muted">Cancel</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- ======= IMPORT STAFF MODAL ======= -->
      <div id="importStaffModal" class="modal-overlay fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4" onclick="if(event.target===this)closeImportStaffModal()">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden">
          <div class="px-8 pt-8 pb-4">
            <h2 class="font-condensed font-extrabold text-2xl tracking-wide text-brand-text">IMPORT STAFF FROM CSV</h2>
            <p class="text-xs mt-1 text-brand-muted">Upload a CSV file containing staff accounts to register them in bulk.</p>
          </div>

          <form action="{{ route('manager.staff_management.import') }}" method="POST" enctype="multipart/form-data" class="px-8 pb-8">
            @csrf
            <div class="flex flex-col gap-5">
              <!-- File Upload -->
              <div>
                <label class="text-[10px] font-bold uppercase tracking-widest mb-1.5 block text-brand-muted">Choose CSV File</label>
                <input type="file" name="csv_file" accept=".csv" required class="w-full bg-[#F5F3F0] border border-brand-border rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-brand-red/20 focus:border-brand-red transition" />
              </div>

              <!-- Info & Format Guide -->
              <div class="bg-brand-sidebar/40 p-4 rounded-xl border border-brand-border/60">
                <h4 class="text-[10px] font-bold uppercase tracking-widest text-brand-text mb-2 flex items-center gap-1.5">
                  <i class="ti ti-info-circle text-xs text-brand-red"></i> CSV Format Guide
                </h4>
                <p class="text-[11px] text-brand-muted leading-relaxed mb-3">
                  The CSV file must contain a header row with columns: <code class="bg-[#F5F3F0] px-1 py-0.5 rounded font-mono text-[10px]">name</code>, <code class="bg-[#F5F3F0] px-1 py-0.5 rounded font-mono text-[10px]">email</code>, <code class="bg-[#F5F3F0] px-1 py-0.5 rounded font-mono text-[10px]">password</code>, and <code class="bg-[#F5F3F0] px-1 py-0.5 rounded font-mono text-[10px]">division</code>.
                </p>
                <div class="flex items-center justify-between">
                  <span class="text-[10px] font-semibold text-brand-muted">Download template:</span>
                  <a href="{{ route('manager.staff_management.template') }}" class="text-brand-red hover:text-brand-redDark text-[10px] font-bold flex items-center gap-1">
                    <i class="ti ti-download text-xs"></i> template.csv
                  </a>
                </div>
              </div>

              <!-- Buttons -->
              <div class="flex items-center gap-4 pt-2">
                <button type="submit" class="flex-1 text-white font-bold py-3.5 rounded-xl flex items-center justify-center gap-2 transition-colors shadow-sm bg-brand-red hover:bg-brand-redDark">
                  Upload & Import
                </button>
                <button type="button" onclick="closeImportStaffModal()" class="text-sm font-semibold px-4 transition-colors hover:text-black text-brand-muted">Cancel</button>
              </div>
            </div>
          </form>
        </div>
      </div>

@endsection

@section('scripts')
<script>
  function openAddStaffModal() {
    document.getElementById('addStaffModal').classList.add('open');
  }
  function closeAddStaffModal() {
    document.getElementById('addStaffModal').classList.remove('open');
  }
  function openImportStaffModal() {
    document.getElementById('importStaffModal').classList.add('open');
  }
  function closeImportStaffModal() {
    document.getElementById('importStaffModal').classList.remove('open');
  }
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeAddStaffModal();
      closeImportStaffModal();
    }
  });
</script>
@endsection
