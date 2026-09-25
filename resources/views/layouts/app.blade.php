<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') &middot; {{ config('app.name', 'KasirKu') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #0f1117;
            --sidebar-hover: #1a1d26;
            --sidebar-active: #1e2230;
            --body-bg: #f4f6f9;
            --card-radius: 12px;
        }
        body {
            background: var(--body-bg);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            margin: 0;
        }
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            transition: transform .3s ease;
        }
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: .6rem;
            color: #fff;
            font-weight: 700;
            font-size: 1.2rem;
            text-decoration: none;
            padding: .5rem .75rem;
            margin-bottom: 2rem;
        }
        .sidebar-brand .brand-icon {
            width: 36px;
            height: 36px;
            background: #22c55e;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }
        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            flex: 1;
        }
        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: .75rem;
            color: #9ca3af;
            padding: .7rem .85rem;
            border-radius: 8px;
            font-size: .9rem;
            font-weight: 500;
            text-decoration: none;
            margin-bottom: .25rem;
            transition: all .2s;
        }
        .sidebar-nav .nav-link:hover {
            background: var(--sidebar-hover);
            color: #e5e7eb;
        }
        .sidebar-nav .nav-link.active {
            background: var(--sidebar-active);
            color: #fff;
        }
        .sidebar-nav .nav-link i {
            font-size: 1.1rem;
            width: 22px;
            text-align: center;
        }
        .sidebar-promo {
            background: linear-gradient(135deg, #14532d, #166534);
            border-radius: 12px;
            padding: 1rem;
            color: #fff;
            margin-bottom: 1rem;
        }
        .sidebar-promo .promo-title {
            font-weight: 700;
            font-size: .95rem;
            display: flex;
            align-items: center;
            gap: .4rem;
            margin-bottom: .5rem;
        }
        .sidebar-promo .promo-badge {
            background: #ffffff;
            color: #052e16;
            font-size: .65rem;
            font-weight: 700;
            padding: .15rem .45rem;
            border-radius: 999px;
        }
        .sidebar-promo ul {
            list-style: none;
            padding: 0;
            margin: 0 0 .75rem 0;
            font-size: .75rem;
            color: #bbf7d0;
            line-height: 1.8;
        }
        .sidebar-promo .btn-promo {
            background: #fff;
            color: #14532d;
            font-weight: 600;
            font-size: .8rem;
            border: none;
            border-radius: 8px;
            padding: .5rem;
            width: 100%;
            transition: opacity .2s;
        }
        .sidebar-promo .btn-promo:hover {
            opacity: .9;
        }
        .sidebar-footer {
            border-top: 1px solid #1f2937;
            padding-top: .75rem;
        }
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }
        .topbar {
            background: #fff;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        .topbar h4 {
            margin: 0;
            font-weight: 700;
            color: #111827;
        }
        .topbar .search-box {
            position: relative;
            max-width: 360px;
            width: 100%;
        }
        .topbar .search-box input {
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: .55rem .9rem .55rem 2.3rem;
            font-size: .875rem;
            width: 100%;
            outline: none;
        }
        .topbar .search-box i {
            position: absolute;
            left: .8rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        .topbar .user-area {
            display: flex;
            align-items: center;
            gap: .75rem;
        }
        .topbar .user-area .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #374151;
        }
        .topbar .user-area .user-info small {
            display: block;
            color: #6b7280;
            font-size: .75rem;
        }
        .topbar .user-area .user-info strong {
            font-size: .85rem;
            color: #111827;
        }
        .content-area {
            padding: 1.5rem 2rem 3rem;
        }
        .card {
            border: 0;
            border-radius: var(--card-radius);
            box-shadow: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
        }
        .table th {
            white-space: nowrap;
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .03em;
            color: #6b7280;
            font-weight: 600;
            border-bottom: 1px solid #e5e7eb;
        }
        .table td {
            font-size: .875rem;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
        }
        .harga {
            font-variant-numeric: tabular-nums;
        }
        .status-badge {
            font-size: .75rem;
            font-weight: 600;
            padding: .3rem .65rem;
            border-radius: 6px;
        }
        .status-success { background: #dcfce7; color: #166534; }
        .status-warning { background: #fef3c7; color: #92400e; }
        .status-danger  { background: #fee2e2; color: #991b1b; }
        .status-info    { background: #dbeafe; color: #1e40af; }
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .topbar {
                padding: 1rem;
            }
            .content-area {
                padding: 1rem;
            }
            .topbar .search-box {
                display: none;
            }
        }
    </style>
</head>
<body>

<aside class="sidebar" id="sidebar">
    <a class="sidebar-brand" href="{{ route('home') }}">
        <span class="brand-icon"><i class="bi bi-shop"></i></span>
        TokoKu
    </a>

    <ul class="sidebar-nav">
        <li>
            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                <i class="bi bi-grid-1x2"></i> Dashboard
            </a>
        </li>
        <li>
            <a class="nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}" href="{{ route('produk.index') }}">
                <i class="bi bi-box-seam"></i> Daftar Produk
            </a>
        </li>
        <li>
            <a class="nav-link {{ request()->routeIs('transaksi.create') ? 'active' : '' }}" href="{{ route('transaksi.create') }}">
                <i class="bi bi-cart-plus"></i> Transaksi Baru
            </a>
        </li>
        <li>
            <a class="nav-link {{ request()->routeIs('transaksi.index', 'transaksi.show') ? 'active' : '' }}" href="{{ route('transaksi.index') }}">
                <i class="bi bi-clock-history"></i> Riwayat Transaksi
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <ul class="sidebar-nav">
            <li>
                <a class="nav-link" href="#"><i class="bi bi-question-circle"></i> Help &amp; Support</a>
            </li>
            <li>
                <a class="nav-link" href="#"><i class="bi bi-gear"></i> Settings</a>
            </li>
            <li>
                <a class="nav-link" href="#"><i class="bi bi-box-arrow-right"></i> Log out</a>
            </li>
        </ul>
    </div>
</aside>

<div class="main-content">
    <header class="topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-sm btn-light d-lg-none" id="toggleSidebar">
                <i class="bi bi-list"></i>
            </button>
            <h4>@yield('title', 'Dashboard')</h4>
        </div>

        <div class="user-area">
            <button class="btn btn-sm btn-light position-relative">
                <i class="bi bi-bell"></i>
            </button>
            <div class="avatar">BS</div>
            <div class="user-info d-none d-md-block">
                <strong>b.shelton@gmail.com</strong>
                <small>Sales manager</small>
            </div>
        </div>
    </header>

    <main class="content-area">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('toggleSidebar')?.addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('show');
    });
</script>
@stack('scripts')
</body>
</html>
