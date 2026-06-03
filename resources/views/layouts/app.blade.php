<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title', 'Aplikasi Web 2')
    </title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #1f2937;
        }

        .navbar {
            background: #1f4e79;
            padding: 14px 28px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 16px;
            font-weight: bold;
        }

        .navbar a.active {
            text-decoration: underline;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 28px auto;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            background: #1f4e79;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        .btn-secondary {
            background: #6b7280;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th,
        td {
            border: 1px solid #d1d5db;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #eaf2f8;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            box-sizing: border-box;
        }

        .card {
            border-radius: 18px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .btn:hover {
            opacity: 0.9;
        }

        .error-text {
            color: #b91c1c;
            font-size: 13px;
            margin-top: 4px;
        }

        .btn-warning {
            background: #f59e0b;
        }

        .btn-danger {
            background: #dc2626;
        }

        .filter {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 10px;
            align-items: end;
        }

        .actions {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>

<body>
    @include('partials.navbar')
    <main class="container">
        @include('partials.alert')
        @yield('content')
    </main>
    <footer>
        Pemrograman Web 2 - Praktik Laravel MVC View
    </footer>
</body>

</html>