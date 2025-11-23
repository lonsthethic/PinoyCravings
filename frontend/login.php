<?php
// IMPORTANT: PHP code must be at the TOP before any HTML output
include "../backend/connection.php";
include "../backend/auth_session.php";

// Redirect if already logged in
if (isUserLoggedIn()) {
    header("Location: homepage.php");
    exit;
}

// Handle login form submission
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $Email = $_POST['emailLog'];
    $Pass = $_POST['passLog'];

    $stmt = $conn->prepare("SELECT * FROM accounts WHERE email = ?");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPass = $row['Passwords'];
        
        if ($Pass === $hashedPass) {
            // Create session with user data
            createUserSession([
                'id' => $row['id'],  // Make sure this matches your database column name
                'Email' => $row['Email'],
                'Passwords' => $row['Passwords']  // Or use username if you have it
            ]);
            
            echo "<script>
                 alert('Log in Successful');
                 window.location.href = 'homepage.php';
                </script>"; 
            exit;
        } else {
            $loginError = "Invalid password! Try Again!";
        }
    } else {
        $loginError = "Email not found! Try Again!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PinoysCravings - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#E63946',
                        secondary: '#F1FAEE',
                    }
                }
            }
        }
    </script>
    <style>
        .vanta-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.4;
        }
        .login-container {
            backdrop-filter: blur(8px);
        }
    </style>
</head>
<body class="bg-secondary min-h-screen">
    <div id="vanta-bg" class="vanta-bg"></div>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.waves.min.js"></script>
    <script>
        VANTA.WAVES({
            el: "#vanta-bg",
            color: 0xe63946,
            waveHeight: 20,
            shininess: 50,
            waveSpeed: 1.0,
            zoom: 0.8
        })
    </script>

    <!-- Navigation -->
    <nav class="bg-red-700 text-white shadow-lg">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
      <div class="flex items-center space-x-2">
        <i data-feather="clock" class="w-6 h-6"></i>
        <span class="text-xl font-bold"><a href="index.php" class="hover:text-red-200">Pinoys Cravings</a></span>
      </div>
      <div class="hidden md:flex space-x-6 gap-20">
        <a href="index.php" class="hover:text-red-200">Home</a>
        <a href="categories.php" class="hover:text-red-200">Categories</a>
        <a href="Favorites.php" class="hover:text-red-200">Favorites</a>
        <a href="collection.php" class="hover:text-red-200">About Us</a>
      </div>
      <div class="flex items-center space-x-4">
        <a href="login.php" class="px-4 py-2 rounded-md bg-red-600 hover:bg-red-500">Login</a>
      </div>
    </div>
  </nav>

    <!-- Login Form -->
    <form action="login.php" method="post" class="py-16 px-4 sm:px-6 lg:px-8" id="loginform">
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden login-container">
            <div class="bg-primary text-white p-6">
                <h2 class="text-2xl font-bold">Welcome to PinoysCravings!</h2>
                <p class="text-gray-200">Sign in to access your favorite recipes and collections</p>
            </div>
            <div class="p-8">
                <?php if (isset($loginError)): ?>
                    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                        <?= htmlspecialchars($loginError) ?>
                    </div>
                <?php endif; ?>
                
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                    <div class="relative">
                        <i data-feather="mail" class="absolute left-3 top-3 text-gray-400"></i>
                        <input type="email" name="emailLog" id="email" required class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="your@email.com">
                    </div>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <div class="relative">
                        <i data-feather="lock" class="absolute left-3 top-3 text-gray-400"></i>
                        <input type="password" name="passLog" id="password" required class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="••••••••">
                    </div>
                </div>
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center"></div>
                    <a href="#" class="text-primary hover:underline">Forgot password?</a>
                </div>
                <input type="submit" name="submit" value="Sign In" class="w-full bg-primary hover:bg-red-700 text-white font-medium py-3 px-4 rounded-lg transition duration-300 mb-4 cursor-pointer">
                <div class="text-center">
                    <p class="text-gray-600">Don't have an account? <a href="reg.php" class="text-primary hover:underline">Sign up</a></p>
                </div>
            </div>
        </div>
    </form>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">PinoysCravings</h3>
                    <p class="text-gray-400">Bringing authentic Filipino flavors to your kitchen.</p>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i data-feather="facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i data-feather="instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i data-feather="twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i data-feather="youtube"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="index.php" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="categories.php" class="text-gray-400 hover:text-white">Categories</a></li>
                        <li><a href="Favorites.php" class="text-gray-400 hover:text-white">Favorites</a></li>
                        <li><a href="collection.php" class="text-gray-400 hover:text-white">Collections</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-4">Categories</h4>
                    <ul class="space-y-2">
                        <li><a href="categories.php#main-dishes" class="text-gray-400 hover:text-white">Main Dishes</a></li>
                        <li><a href="categories.php#desserts" class="text-gray-400 hover:text-white">Desserts</a></li>
                        <li><a href="categories.php#street-food" class="text-gray-400 hover:text-white">Street Food</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-4">Contact Us</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-400"><i data-feather="mail" class="mr-2"></i> BSIT2.1B@pinoyscravings.com</li>
                        <li class="flex items-center text-gray-400"><i data-feather="phone" class="mr-2"></i> +64 0995658323</li>
                        <li class="flex items-center text-gray-400"><i data-feather="map-pin" class="mr-2"></i> Dasmarinas, Cavite, Philippines</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; 2023 PinoysCravings. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        feather.replace();
    </script>
</body>
</html>