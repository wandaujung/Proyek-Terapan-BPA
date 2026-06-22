<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Planner U – Manager Overview</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800&family=Barlow+Condensed:wght@700;800&display=swap"
        rel="stylesheet" />
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['DM Sans', 'sans-serif'],
                        condensed: ['Barlow Condensed', 'sans-serif'],
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

        <!-- ======= SIDEBAR ======= -->
        @include('partials.sidebar')

        <!-- ======= MAIN ======= -->
        <main class="flex-1 flex flex-col min-h-screen">
            <!-- Top Bar -->
            <header
                class="flex items-center gap-4 px-8 pt-6 pb-2 border-b border-brand-border bg-brand-bg sticky top-0 z-10 flex-shrink-0 shadow">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-xbpa.png') }}" alt="Planner U" class="h-14">
                </div>
                <div class="ml-auto flex items-center gap-3">
                    <button
                        class="w-9 h-9 rounded-full bg-white flex items-center justify-center hover:bg-brand-border transition-colors">
                        <svg class="w-5 h-5 text-brand-muted text-red-500" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    <!-- Avatar Link to Profile -->
                    <a href="{{ route('profile') }}" class="avatar hover:ring-2 hover:ring-brand-red transition"
                        style="background:#C5BFB9; text-decoration:none;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </a>
                </div>
            </header>

            <!-- Content -->
            <div class="flex-1 overflow-y-auto">
                @yield('content')
            </div>
        </main>
    </div>
    @yield('scripts')
</body>

</html>
