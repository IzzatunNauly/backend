<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <!-- Tambahkan link font-awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- ... CSS lainnya ... -->

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .lingkaran {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #2E395D;
            display: inline-block;
            margin-right: 9px;
            transform: rotate(90deg); /* Memutar lingkaran 90 derajat */
        }
        .lingkaran1{
			width: 20px;
			height: 20px;
			background: #FF0000;
			border-radius: 100%;
		}
 
		.lingkaran2{
			width: 20px;
			height: 20px;
			background: #FF8B5A;
			border-radius: 100%;
		}
        .lingkaran3{
			width: 20px;
			height: 20px;
			background: #00FF47;
			border-radius: 100%;
		}
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #2E395D;
            padding-top: 20px;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .sidebar ul li {
            padding: 10px 20px;
            color: #ffffff;
            cursor: pointer;
            font-size: 17px; /* Menyesuaikan ukuran tulisan */
        }
        .sidebar ul li:hover {
            background-color: #2A3045;
            margin-right: 10px; /* Menambahkan ruang antara ikon dan teks */
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
    <div class=" lingkaran lingkaran1"></div>
    <div class="lingkaran lingkaran2"></div>
    <div class="lingkaran lingkaran3"></div>
        <ul>
    </br>
    </br>
            <li id="home"><i class="fas fa-home" ></i> Home</li>
    </br>
            <li id="employee"><i class="fas fa-users"></i> Users</li>
    </br>
            <li id="category"><i class="fas fa-folder"></i> Category</li>
    </br>
            <li id="attendance-list"><i class="fas fa-list-alt"></i> Attendance List</li>
    </br>
            <li id="attendance-permit"><i class="fas fa-calendar-check"></i> Attendance Permit</li>
        </ul>
    </div>
    <script>
        // Tambahkan event listener untuk setiap elemen dalam daftar
        document.getElementById('home').addEventListener('click', function() {
            window.location.href = '/home'; // Ganti dengan URL yang sesuai
        });

        document.getElementById('employee').addEventListener('click', function() {
            window.location.href = '/karyawan'; // Ganti dengan URL yang sesuai
        });

        document.getElementById('category').addEventListener('click', function() {
            window.location.href = '/kategori'; // Ganti dengan URL yang sesuai
        });

        document.getElementById('attendance-list').addEventListener('click', function() {
            window.location.href = '/attendance-list'; // Ganti dengan URL yang sesuai
        });

        document.getElementById('attendance-permit').addEventListener('click', function() {
            window.location.href = '/attendance-permit'; // Ganti dengan URL yang sesuai
        });
    </script>
</body>
</html>
