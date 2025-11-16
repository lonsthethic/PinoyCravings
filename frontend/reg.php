<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PinoysCravings - Login</title>
    <script type="module" src="reg.js" defer></script>
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
    

    <!-- Navigation -->
    <nav class="bg-red-700 text-white shadow-lg">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
      <div class="flex items-center space-x-2">
        <i data-feather="clock" class="w-6 h-6"></i>
        <span class="text-xl font-bold"><a href="index.html" class="hover:text-red-200">Pinoys Cravings</a></span>
      </div>
      <div class="hidden md:flex space-x-6 gap-20">
        <a href="index.html" class="hover:text-red-200">Home</a>
        <a href="categories.html" class="hover:text-red-200">Categories</a>
        <a href="#" class="hover:text-red-200">Favorites</a>
        <a href="#" class="hover:text-red-200">Collections</a>
      </div>
      <div class="flex items-center space-x-4">
        <a href="login.html" class="px-4 py-2 rounded-md bg-red-600 hover:bg-red-500">Login</a>
      </div>
    </div>
  </nav>

    <!-- Login Form -->
   <section class="py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden login-container">
        <div class="bg-primary text-white p-6">
            <h2 class="text-2xl font-bold">Welcome to PinoysCravings!</h2>
            <p class="text-gray-200">Create an account to get started</p>
        </div>

        <div class="p-8">
            <form id="registerForm">

            <!-- NAME
            <div class="mb-6">
                <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                <div class="relative">
                    <i data-feather="user" class="absolute left-3 top-3 text-gray-400"></i>
                    <input type="text" id="name" 
                        class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" 
                        placeholder="Your name" required>
                </div>
            </div> -->

                <!-- EMAIL -->
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                    <div class="relative">
                        <i data-feather="mail" class="absolute left-3 top-3 text-gray-400"></i>
                        <input type="email" id="Email" 
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" 
                            placeholder="your@email.com" required>
                    </div>
                </div>

                <!-- PASSWORD -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <div class="relative">
                        <i data-feather="lock" class="absolute left-3 top-3 text-gray-400"></i>
                        <input type="password" id="Password" 
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" 
                            placeholder="••••••••" required>
                    </div>
                </div>

                <!-- ROLE -->
                <div class="mb-6">
                    <label for="role" class="block text-gray-700 font-medium mb-2">Select Role</label>
                    <select id="role" name="role" required
                        class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">--Select Role--</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <!-- BUTTON -->
                <button id = "submit" type="submit" 
                        class="w-full bg-primary hover:bg-red-700 text-white font-medium py-3 px-4 rounded-lg transition duration-300 mb-4">
                    Register
                </button>

                <div class="text-center">
                    <p class="text-gray-600">Already have an account? 
                        <a href="login.html" class="text-primary hover:underline">Log in</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>


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
                        <li><a href="index.html" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="categories.html" class="text-gray-400 hover:text-white">Categories</a></li>
                        <li><a href="favorites.html" class="text-gray-400 hover:text-white">Favorites</a></li>
                        <li><a href="collections.html" class="text-gray-400 hover:text-white">Collections</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-4">Categories</h4>
                    <ul class="space-y-2">
                        <li><a href="categories.html#main-dishes" class="text-gray-400 hover:text-white">Main Dishes</a></li>
                        <li><a href="categories.html#desserts" class="text-gray-400 hover:text-white">Desserts</a></li>
                        <li><a href="categories.html#street-food" class="text-gray-400 hover:text-white">Street Food</a></li>
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
        // Initialize Feather Icons
        feather.replace();
    </script>

    <style>
select{
    width: 100%;
    padding: 12px;
    background: white;
    border-radius: 6px;
    border: none;
    outline: none;
    font-size: 16px;
    color: #333;
    margin-bottom: 10px;
}

    </style>
</body>
    <script>
      feather.replace(); // render icons

    </script>


</html>
