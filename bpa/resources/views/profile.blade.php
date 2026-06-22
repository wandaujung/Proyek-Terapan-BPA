<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Planner U × BPA – Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Bebas+Neue&family=DM+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        brand: ['"Bebas Neue"', "sans-serif"],
                        body: ['"DM Sans"', "sans-serif"],
                    },
                    colors: {
                        cream: "#EDE8E0",
                        sidebar: "#D9D4CB",
                        red: "#C0282D",
                        "red-dark": "#A82025",
                    },
                },
            },
        };
    </script>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        .brand {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 0.06em;
        }

        .logo-text {
            font-family: 'Barlow Condensed', sans-serif;
        }
    </style>
</head>

<body class="bg-[#FAF8F5] text-gray-900 m-0 overflow-hidden flex min-h-screen">

    <!-- SIDEBAR -->
    @include('partials.sidebar')

    <!-- MAIN WORKSPACE -->
    <main class="flex-1 bg-[#FAF8F5] min-h-screen flex flex-col relative overflow-hidden z-10 w-full">

        @include('partials.staff_header', ['hideSearchAndBell' => true])

        <!-- CENTERED PROFILE CONTENT -->
        <div class="flex-1 flex flex-col items-center justify-center relative -mt-20 z-10">

            <!-- DECORATIVE BACKGROUND CARD -->
            <div
                class="absolute right-[-2rem] top-[15%] w-96 lg:w-[400px] h-[500px] bg-[#F2F0EC] rounded-[50px] -z-10 opacity-100 rotate-[-4deg]">
            </div>
            <!-- FAINT DECORATIVE CIRCLE -->
            <div
                class="absolute left-[15%] bottom-[15%] w-32 h-32 rounded-full border-2 border-gray-300/30 opacity-70 -z-10">
            </div>

            <!-- AVATAR -->
            <div class="relative">
                <div
                    class="w-48 h-48 rounded-full bg-[#ECEDE9] flex items-center justify-center relative shadow-inner overflow-hidden border-4 border-white/40 text-gray-600 text-6xl font-black">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <!-- Verification Badge -->
                <div
                    class="absolute bottom-1 right-2 w-10 h-10 rounded-full bg-[#2E7D32] border-4 border-[#FAF8F5] flex items-center justify-center text-white shadow-md">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="3">
                        <path d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            <!-- TEXT DETAILS -->
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mt-8 tracking-tight">{{ Auth::user()->name }}
            </h1>
            <h2 class="text-xl md:text-2xl text-[#C21A23] mt-3 font-semibold">
                {{ Auth::user()->division->name ?? 'Manager' }}</h2>
            <p class="text-gray-500 mt-2 font-medium">{{ Auth::user()->email }}</p>

            <!-- DIVIDER -->
            <div class="w-72 md:w-96 h-[2px] bg-[#E6E4E2] my-10 rounded-full"></div>

            <!-- LOG OUT BUTTON -->
            <button onclick="openLogoutModal()"
                class="bg-[#C21A23] hover:bg-red-800 text-white font-bold px-10 py-4 rounded-full flex items-center gap-3 shadow-xl shadow-red-900/20 transition-all transform hover:scale-105 active:scale-95 text-lg">
                <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2.5">
                    <path
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Log Out
            </button>

        </div>
    </main>

    <!-- LOG OUT MODAL -->
    <div id="logoutModal"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 hidden flex-col items-center justify-center px-4">
        <div
            class="relative bg-white rounded-[32px] shadow-2xl p-8 pt-10 max-w-sm w-full overflow-hidden flex flex-col items-center">
            <!-- Top Accent Bar -->
            <div class="absolute top-0 left-0 right-0 h-[6px] bg-[#b21522]"></div>

            <!-- Icon Container -->
            <div class="w-16 h-16 bg-[#FEE2E2] rounded-full flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="#b21522" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
            </div>

            <!-- Title -->
            <h2 class="text-xl font-bold text-gray-900 mb-2 text-center">Confirm Log Out</h2>

            <!-- Description -->
            <p class="text-gray-500 text-sm text-center mb-8 max-w-[280px] leading-relaxed">
                Are you sure you want to log out of your Workspace session?
            </p>

            <!-- Buttons Group -->
            <div class="w-full flex flex-col gap-3">
                <form action="{{ route('logout') }}" method="POST" class="w-full m-0">
                    @csrf
                    <button type="submit"
                        class="w-full py-4 bg-[#b21522] text-white font-semibold rounded-2xl shadow-lg shadow-red-700/20 hover:bg-[#99131c] transition duration-200 text-center">
                        Log Out
                    </button>
                </form>
                <button onclick="closeLogoutModal()"
                    class="w-full py-4 bg-[#EDEAE6] text-[#44403C] font-semibold rounded-2xl hover:bg-[#E2DDD7] transition duration-200 text-center">
                    Stay Logged In
                </button>
            </div>
        </div>
    </div>

    <script>
        function openLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</body>

</html>
