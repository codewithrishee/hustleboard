<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | HustleBoard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Unbounded:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
        <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    <style>
      

        :root {

            --bg: #080e0b;

            --panel: #101a14;

            --panel2: #142219;

            --border: #26382d;

            --green: #55df80;

            --muted: #98a99e;

            --white: #f2f7f3;

        }



        \* {

            box-sizing: border-box;

        }



        .brand-name,

        .page-title {

            font-family: 'Sora', sans-serif;

            font-weight: 800;

        }

        html{

            min-height: 100%;

        }

        body {

            min-height: 100%;

            margin: 0;

            background: var(--bg);

            color: var(--white);

            font-family: 'DM Sans', sans-serif;

            font-size: 14px;

            display: flex;

            flex-direction: column;

        }



        a {

            text-decoration: none;

        }



        /* SIDEBAR */

        .sidebar {

            width: 265px;

            height: 100vh;

            position: fixed;

            inset: 0 auto 0 0;

            z-index: 1000;

            display: flex;

            flex-direction: column;

            overflow: hidden;

            padding: 18px 14px;

            background: #0b130e;

            border-right: 1px solid #1d2b22;

        }



        .brand {

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

            gap: 3px;

            padding: 0 8px 18px;

            text-align: center;

        }



        .brand-logo {

            display: block;

            width: 100%;

            max-width: 145px;

            height: 65px;

            object-fit: contain;

        }



        .brand-name {

            font-size: 21px;

            font-weight: 800;

            letter-spacing: -1px;

            line-height: 1.3;

        }



        .brand-sub {

            color: var(--muted);

            font-size: 10px;

            margin-top: 2px;

        }



        /* Only this area scrolls. Brand and quote stay in place. */

        .sidebar-nav {

            flex: 1 1 auto;

            min-height: 0;

            overflow-y: auto;

            overflow-x: hidden;

            padding-bottom: 12px;

            scrollbar-width: thin;

            scrollbar-color: #304638 transparent;

        }



        .sidebar-nav::-webkit-scrollbar {

            width: 4px;

        }



        .sidebar-nav::-webkit-scrollbar-thumb {

            background: #304638;

            border-radius: 10px;

        }



        .nav-label {

            color: #65776b;

            font-size: 10px;

            font-weight: 700;

            letter-spacing: 1.4px;

            padding: 12px 14px 8px;

        }



        .side-link {

            display: flex;

            align-items: center;

            gap: 14px;

            color: #b4c0b8;

            padding: 13px 15px;

            border-radius: 10px;

            margin-bottom: 5px;

            transition: background .2s ease, color .2s ease;

            font-weight: 500;

        }



        .side-link i {

            width: 19px;

            flex: 0 0 19px;

            font-size: 16px;

            text-align: center;

        }



        .side-link:hover,

        .side-link.active {

            background: #193b27;

            color: #8df0a8;

        }



        .sidebar-bottom {

            flex: 0 0 auto;

            margin-top: 10px;

            padding: 15px 17px;

            border: 1px solid var(--border);

            border-radius: 13px;

            background: linear-gradient(145deg, #11291c, #0e1913);

            color: #a8b8ad;

            line-height: 1.6;

        }



        /* MAIN CONTENT */

        .main-content {

            min-height: 100vh;

            margin-left: 265px;

            padding: 25px 27px;

        }



        /* FIXED / STICKY PAGE HEADER */

        .topbar {

            position: sticky;

            top: 0;

            z-index: 950;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            min-height: 76px;

            padding: 12px 0;

            margin: -25px 0 25px;

            background: rgba(8, 14, 11, .97);

            border-bottom: 1px solid rgba(38, 56, 45, .75);

            backdrop-filter: blur(14px);

            -webkit-backdrop-filter: blur(14px);

        }



        .topbar-heading {

            min-width: 0;

            flex: 1 1 auto;

        }



        .page-title {

            max-width: 100%;

            font-size: clamp(20px, 2vw, 29px);

            font-weight: 800;

            letter-spacing: -1px;

            line-height: 1.2;

            overflow-wrap: anywhere;

        }



        .topbar-subtitle {

            max-width: 100%;

            margin-top: 4px;

            color: var(--muted);

            font-size: 12px;

            line-height: 1.4;

            overflow-wrap: anywhere;

        }



        .muted {

            color: var(--muted);

        }



        .panel {

            background: linear-gradient(145deg, #121e17, #0f1813);

            border: 1px solid var(--border);

            border-radius: 16px;

        }



        .hero {

            min-height: 148px;

            padding: 27px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            background:

                linear-gradient(90deg, rgba(8, 35, 20, .98), rgba(9, 42, 23, .75), rgba(8, 18, 13, .95)),

                radial-gradient(ellipse at 65% 20%, #387c4b 0%, transparent 55%);

            border: 1px solid #28543a;

            border-radius: 20px;

            margin-bottom: 20px;

        }



        .hero h2 {

            font-size: 30px;

            font-weight: 800;

            margin-bottom: 7px;

        }



        .hero-focus {

            min-width: 240px;

            border-left: 1px solid #64836b;

            padding-left: 25px;

        }



        .hero-focus label {

            display: block;

            margin: 8px 0;

            color: #e2ece5;

        }



        .stat-card {

            height: 100%;

            padding: 17px;

            display: flex;

            align-items: center;

            gap: 14px;

        }



        .stat-icon {

            width: 56px;

            height: 56px;

            flex-shrink: 0;

            display: grid;

            place-items: center;

            background: #1b3826;

            border-radius: 13px;

            color: #6ee991;

            font-size: 23px;

        }



        .stat-label {

            color: #d4ded7;

            font-size: 13px;

        }



        .stat-number {

            font-size: 26px;

            font-weight: 800;

            margin: 5px 0;

        }



        .stat-note {

            color: var(--green);

            font-size: 12px;

        }



        .section-title {

            font-size: 17px;

            font-weight: 700;

            margin-bottom: 20px;

        }



        .section-title i {

            color: var(--green);

            margin-right: 9px;

        }



        .task-row {

            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 10px;

            padding: 10px 0;

            border-bottom: 1px solid #25342b;

        }



        .task-row:last-child {

            border: 0;

        }



        .task-row input {

            accent-color: var(--green);

            width: 17px;

            height: 17px;

        }



        .progress {

            height: 9px;

            background: #29362e;

            border-radius: 20px;

        }



        .progress-bar {

            background: linear-gradient(90deg, #28c76f, #8ce99a);

            border-radius: 20px;

        }



        .stage-row {

            display: flex;

            justify-content: space-between;

            padding: 9px 0;

            border-bottom: 1px solid #26352c;

        }



        .stage-row:last-child {

            border: 0;

        }



        .stage-dot {

            display: inline-block;

            width: 10px;

            height: 10px;

            border-radius: 50%;

            margin-right: 9px;

        }



        .quick-link {

            color: var(--green);

            font-size: 12px;

            font-weight: 600;

        }



        .chart-wrap {

            position: relative;

            height: 220px;

        }



        .skill-row {

            margin-bottom: 22px;

        }



        .skill-row:last-child {

            margin-bottom: 0;

        }



        .mobile-toggle {

            display: none;

            border: 1px solid var(--border);

            background: var(--panel);

            color: white;

            border-radius: 9px;

            padding: 9px 12px;

            cursor: pointer;

        }



        /* PROFILE HEADER */

        .profile-dropdown {

            position: relative;

            flex-shrink: 0;

        }



        .profile-trigger {

            display: flex;

            align-items: center;

            gap: 10px;

            padding: 6px 10px;

            background: #101a14;

            border: 1px solid #26382d;

            border-radius: 12px;

            color: #f2f7f3;

            cursor: pointer;

            transition: .2s;

            white-space: nowrap;

        }



        .profile-trigger:hover,

        .profile-dropdown.show .profile-trigger {

            background: #193b27;

            border-color: #477c57;

        }



        .profile-avatar {

            width: 39px;

            height: 39px;

            flex: 0 0 39px;

            border-radius: 50%;

            object-fit: cover;

            border: 2px solid #55df80;

        }



        .profile-initial {

            display: grid;

            place-items: center;

            background: #193b27;

            color: #8df0a8;

            font-size: 17px;

            font-weight: 800;

        }



        .profile-user-info {

            display: flex;

            flex-direction: column;

            align-items: flex-start;

            line-height: 1.4;

            min-width: 0;

        }



        .profile-user-info strong {

            font-size: 12px;

            font-weight: 700;

        }



        .profile-user-info small {

            color: #98a99e;

            font-size: 10px;

        }



        .profile-chevron {

            color: #98a99e;

            font-size: 10px;

            margin-left: 5px;

            transition: transform .2s;

        }



        .profile-dropdown.show .profile-chevron {

            transform: rotate(180deg);

        }



        .profile-dropdown .profile-menu {

            position: absolute !important;

            top: calc(100% + 10px) !important;

            right: 0 !important;

            left: auto !important;

            inset-inline-end: 0 !important;

            transform: none !important;

            width: 235px;

            min-width: 0;

            max-width: calc(100vw - 24px);

            padding: 9px;

            margin: 0 !important;

            background: #101a14;

            border: 1px solid #304237;

            border-radius: 13px;

            box-shadow: 0 15px 35px #0008;

        }



        .profile-menu-heading {

            display: flex;

            flex-direction: column;

            padding: 11px 12px;

            border-bottom: 1px solid #26382d;

            margin-bottom: 7px;

        }



        .profile-menu-heading strong {

            color: #f2f7f3;

            font-size: 13px;

        }



        .profile-menu-heading small {

            color: #98a99e;

            font-size: 11px;

            margin-top: 4px;

            overflow-wrap: anywhere;

        }



        .profile-menu .dropdown-item {

            display: flex;

            align-items: center;

            gap: 11px;

            padding: 11px 12px;

            border-radius: 8px;

            color: #c7d4cb;

            font-size: 12px;

        }



        .profile-menu .dropdown-item i {

            width: 17px;

            color: #72e995;

        }



        .profile-menu .dropdown-item:hover {

            background: #193b27;

            color: #8df0a8;

        }



        .profile-menu .dropdown-divider {

            border-color: #26382d;

        }



        .profile-menu .logout-item,

        .profile-menu .logout-item i {

            color: #ff8585;

        }



        .profile-menu .logout-item:hover {

            background: #3b2020;

            color: #ff9a9a;

        }



        /* TABLET */

        @media (max-width: 1100px) {

            .sidebar {

                width: 225px;

            }



            .main-content {

                margin-left: 225px;

                padding: 22px;

            }



            .topbar {

                margin-top: -22px;

            }



            .hero h2 {

                font-size: 25px;

            }

        }



        /* MOBILE */

        @media (max-width: 767px) {

            .sidebar {

                width: 265px;

                transform: translateX(-100%);

                transition: transform .25s ease;

                box-shadow: 15px 0 35px #0008;

            }



            .sidebar.show {

                transform: translateX(0);

            }



            .main-content {

                margin-left: 0;

                padding: 16px;

            }



            .mobile-toggle {

                display: inline-block;

            }



            .topbar {

                top: 0;

                min-height: 66px;

                align-items: center;

                gap: 8px;

                margin-top: -16px;

                margin-bottom: 18px;

                padding: 10px 0;

            }



            .topbar>div:first-child {

                min-width: 0;

                flex: 1 1 auto;

                gap: 9px !important;

            }



            .topbar-heading {

                min-width: 0;

                overflow: hidden;

            }



            .page-title {

                font-size: clamp(16px, 4.5vw, 20px);

                line-height: 1.2;

                white-space: normal;

                display: -webkit-box;

                -webkit-box-orient: vertical;

                -webkit-line-clamp: 2;

                overflow: hidden;

                overflow-wrap: anywhere;

            }



            .topbar-subtitle {

                font-size: 10px;

                line-height: 1.25;

                display: -webkit-box;

                -webkit-box-orient: vertical;

                -webkit-line-clamp: 2;

                overflow: hidden;

            }



            .topbar .muted {

                font-size: 10px;

            }



            .hero {

                display: block;

                padding: 22px;

            }



            .hero h2 {

                font-size: 23px;

            }



            .hero-focus {

                border-left: 0;

                border-top: 1px solid #64836b;

                margin-top: 20px;

                padding: 15px 0 0;

                min-width: 0;

            }



            .stat-card {

                padding: 13px;

                gap: 10px;

            }



            .stat-icon {

                width: 43px;

                height: 43px;

                font-size: 18px;

            }



            .stat-number {

                font-size: 21px;

            }



            .stat-label {

                font-size: 11px;

            }



            .stat-note {

                font-size: 10px;

            }



            .chart-wrap {

                height: 190px;

            }



            .profile-trigger {

                gap: 7px;

                padding: 5px 7px;

            }



            .profile-avatar {

                width: 35px;

                height: 35px;

                flex-basis: 35px;

            }



            .profile-user-info strong {

                font-size: 11px;

                max-width: 75px;

                overflow: hidden;

                text-overflow: ellipsis;

                white-space: nowrap;

            }



            .profile-user-info small {

                font-size: 9px;

            }



            .profile-chevron {

                font-size: 9px;

                margin-left: 0;

            }

        }



        @media (max-width: 420px) {

            .topbar {

                gap: 6px;

            }



            .topbar>div:first-child {

                gap: 7px !important;

            }



            .mobile-toggle {

                padding: 8px 10px;

                flex: 0 0 auto;

            }



            .profile-trigger {

                padding: 5px;

            }

        }



        @media (max-width: 380px) {

            .profile-user-info {

                display: none;

            }



            .profile-trigger {

                gap: 3px;

            }



            .topbar-subtitle {

                font-size: 9px;

            }

        }







/* ================= HUSTLEBOARD FOOTER ================= */



.app-footer {

    margin-top: 45px;

    padding: 24px 5px 12px;



    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 25px;



    border-top: 1px solid #26382d;

    background: transparent;

}



.footer-left {

    display: flex;

    flex-direction: column;

    gap: 9px;

}



.footer-brand {

    display: flex;

    align-items: center;

    gap: 9px;



    color: #f2f7f3;

    font-size: 17px;

    font-weight: 800;

    letter-spacing: -.5px;

}



.footer-logo {

    width: 31px;

    height: 31px;



    display: grid;

    place-items: center;



    border-radius: 9px;

    background: #193b27;

    border: 1px solid #386c48;



    color: #55df80;

    font-size: 12px;

    font-weight: 800;

}



.footer-green {

    color: #55df80;

}



.footer-left p {

    margin: 0;

    color: #84958a;

    font-size: 12px;

}



.footer-right {

    display: flex;

    flex-direction: column;

    align-items: flex-end;

    gap: 10px;

}



.footer-links {

    display: flex;

    align-items: center;

    gap: 20px;

}



.footer-links a {

    color: #98a99e;

    font-size: 12px;

    transition: .2s ease;

}



.footer-links a:hover {

    color: #55df80;

}



.footer-copy {

    color: #65776b;

    font-size: 11px;

}



/* Mobile Footer */



@media (max-width: 767px) {

    .app-footer {

        flex-direction: column;

        align-items:center;

        gap: 20px;

        margin-top: 30px;

        padding-top: 22px;

    }



    .footer-right {

        width: 100%;

        align-items: center;

    }



    .footer-links {

        flex-wrap: wrap;

        gap: 16px;

    }





}

/* =====================================================
   HUSTLEBOARD - LAYOUT, SPACING & RESPONSIVE OVERRIDES
   ===================================================== */

/* Keep the app at least as tall as the viewport */
html,
body {
    min-height: 100%;
}

body {
    min-height: 100vh;
    width: 100%;
    overflow-x: hidden;
}

/* Main area: page content grows, footer stays at the bottom */
.main-content {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    min-width: 0;
    flex: 1 0 auto;
}

/* Keep the footer separated from the dashboard content */
.main-content > .app-footer {
    width: 100%;
    flex: 0 0 auto;
    margin-top: auto !important;
    padding: 28px 5px 14px;
}

/* Prevent dashboard panels and grids from touching/overflowing */
.main-content > .topbar {
    flex: 0 0 auto;
}

.main-content > * {
    min-width: 0;
}

.main-content .row {
    --bs-gutter-y: 1rem;
}

.main-content .panel,
.main-content .hero {
    max-width: 100%;
}

/* Tables scroll inside their own wrapper */
.main-content .table-responsive {
    max-width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

/* Tablet */
@media (max-width: 1100px) {
    .main-content {
        padding: 22px;
    }

    .main-content > .app-footer {
        padding-top: 26px;
    }
}

/* Mobile */
@media (max-width: 767px) {
    .main-content {
        min-height: 100vh;
        margin-left: 0;
        padding: 16px;
    }

    .main-content > .topbar {
        margin-top: -16px;
        margin-bottom: 22px;
    }

    .main-content > .app-footer {
        margin-top: auto !important;
        padding: 24px 4px 12px;
        gap: 16px;
    }

    .footer-left,
    .footer-right {
        width: 100%;
        align-items: center;
        text-align: center;
    }

    .footer-links {
        justify-content: center;
        flex-wrap: wrap;
        row-gap: 12px;
    }

    .hero {
        padding: 20px;
        gap: 16px;
    }

    .hero h2 {
        font-size: clamp(20px, 5vw, 24px);
        line-height: 1.25;
    }

    .hero-focus {
        min-width: 0;
    }

    .stat-card {
        min-width: 0;
    }

    .stat-card > div:last-child {
        min-width: 0;
    }

    .stat-number {
        overflow-wrap: anywhere;
    }

    .section-title {
        line-height: 1.35;
    }

    .chart-wrap {
        max-width: 100%;
    }
}

/* Small phones */
@media (max-width: 480px) {
    .main-content {
        padding: 13px;
    }

    .main-content > .topbar {
        margin-top: -13px;
        margin-bottom: 18px;
    }

    .main-content > .app-footer {
        padding-top: 22px;
    }

    .panel {
        border-radius: 14px;
    }

    .hero {
        padding: 17px;
        border-radius: 16px;
    }

    .stat-card {
        padding: 11px;
        gap: 8px;
    }

    .stat-icon {
        width: 38px;
        height: 38px;
        font-size: 16px;
    }

    .stat-number {
        font-size: 19px;
    }

    .footer-links {
        gap: 12px 16px;
    }
}

@media (max-width: 360px) {
    .main-content {
        padding: 10px;
    }

    .stat-card {
        flex-direction: column;
        align-items: flex-start;
    }

    .stat-number {
        font-size: 18px;
    }
}


    </style>
    @stack('styles')
</head>

<body>


    <aside class="sidebar" id="sidebar">

        <!-- BRAND LOGO -->
        <div class="brand">
            <img src="{{ asset('assets/images/3.png') }}" alt="HustleBoard Logo" class="brand-logo">

            <!-- <div class="brand-name">HustleBoard</div> -->
            <div class="brand-sub">My Work · Growth · Income</div>
        </div>

        <!-- SCROLLABLE NAVIGATION -->
        <div class="sidebar-nav">

            <div class="nav-label">WORKSPACE</div>

            <a href="{{ route('dashboard') }}" class="side-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('leads.index') }}" class="side-link {{ request()->routeIs('leads.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i>
                <span>Client Leads</span>
            </a>

            <a href="{{ route('outreach.index') }}"
                class="side-link {{ request()->routeIs('outreach.*') ? 'active' : '' }}">
                <i class="fa-solid fa-phone"></i>
                <span>Outreach Log</span>
            </a>

            <a href="{{ route('jobs.index') }}" class="side-link {{ request()->routeIs('jobs.*') ? 'active' : '' }}">
                <i class="fa-solid fa-briefcase"></i>
                <span>Job Tracker</span>
            </a>

            <a href="{{ route('activities.index') }}"
                class="side-link {{ request()->routeIs('activities.*') ? 'active' : '' }}">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Daily Activity</span>
            </a>

            <a href="{{ route('skills.index') }}"
                class="side-link {{ request()->routeIs('skills.*') ? 'active' : '' }}">
                <i class="fa-solid fa-graduation-cap"></i>
                <span>Skill Tracker</span>
            </a>

            <a href="{{ route('transactions.index') }}"
                class="side-link {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                <i class="fa-solid fa-wallet"></i>
                <span>Income & Expense</span>
            </a>

            <div class="nav-label mt-3">INSIGHTS</div>

            <a href="{{ route('reports.index') }}"
                class="side-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-simple"></i>
                <span>Reports</span>
            </a>

        </div>

        <!-- BOTTOM QUOTE -->
        <div class="sidebar-bottom">
            <i class="fa-solid fa-quote-left text-success mb-2"></i>
            <div>Consistency converts effort into income.</div>
        </div>

    </aside>


    <main class="main-content">
        <div class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="mobile-toggle" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="topbar-heading">
                    <div class="page-title">@yield('page-heading', 'Dashboard')</div>
                    <div class="topbar-subtitle">@yield('page-subtitle', 'Your work, progress and goals at one place.')
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3 ms-auto">

                <span class="muted d-none d-lg-inline">
                    <i class="fa-regular fa-calendar me-2"></i>
                    {{ now()->format('D, d M Y') }}
                </span>

                <div class="dropdown profile-dropdown">
                    <button class="profile-trigger" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                        @if(auth()->user()->profile_photo)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" class="profile-avatar"
                                alt="Profile">
                        @else
                            <span class="profile-avatar profile-initial">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                        @endif

                        <span class="profile-user-info">
                            <strong>{{ auth()->user()->name }}</strong>
                            <small>Personal Account</small>
                        </span>

                        <i class="fa-solid fa-chevron-down profile-chevron"></i>
                    </button>

                    <div class="dropdown-menu dropdown-menu-end profile-menu">
                        <div class="profile-menu-heading">
                            <strong>{{ auth()->user()->name }}</strong>
                            <small>{{ auth()->user()->email }}</small>
                        </div>

                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fa-regular fa-user"></i>
                            Profile Settings
                        </a>

                        <div class="dropdown-divider"></div>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item logout-item">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                Please check the form. {{ $errors->first() }}
            </div>
        @endif

        @yield('content')

<footer class="app-footer">

    <div class="footer-left">
        <div class="footer-brand">
            <span class="footer-logo">HB</span>
            <span>Hustle<span class="footer-green">Board</span></span>
        </div>

        <p>Build your goals. Track your progress. Create your future.</p>
    </div>

    <div class="footer-right">
        <div class="footer-links">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('reports.index') }}">Reports</a>
            <a href="{{ route('profile.edit') }}">Profile</a>
        </div>

        <div class="footer-copy">
            © {{ date('Y') }} HustleBoard. All rights reserved.
        </div>
    </div>

</footer>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>

</html>