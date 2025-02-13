<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark DataTable</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="/Public/Assets/Css/Style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

</head>

<body>
    <div class="container">
        <h1>Dark DataTable</h1>

        <div class="column-toggle">
            <button class="toggle-button" id="toggleButton">
                Toggle Columns
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 9l6 6 6-6" />
                </svg>
            </button>
            <div class="toggle-menu" id="toggleMenu">
                <label><input type="checkbox" class="column-checkbox" data-column="0" checked> ID</label>
                <label><input type="checkbox" class="column-checkbox" data-column="1" checked> Name</label>
                <label><input type="checkbox" class="column-checkbox" data-column="2" checked> Email</label>
                <label><input type="checkbox" class="column-checkbox" data-column="3" checked> Phone</label>
                <label><input type="checkbox" class="column-checkbox" data-column="4" checked> City</label>
                <label><input type="checkbox" class="column-checkbox" data-column="5" checked> Age</label>
            </div>
        </div>

        <table id="dataTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Age</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="/Public/Assets/Js/script.js"></script>
</body>

</html>