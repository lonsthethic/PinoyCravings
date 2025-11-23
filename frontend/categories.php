<?php
require_once "../backend/auth_session.php";
$user = getCurrentUser();
$isLoggedIn = isUserLoggedIn();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <title>Document</title>
</head>

<body>
  <!-- Navigation -->
  <nav class="bg-red-700 text-white shadow-lg">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
      <div class="flex items-center space-x-2">
        <i data-feather="clock" class="w-6 h-6"></i>
        <span class="text-xl font-bold"><a href="index.php" class="hover:text-red-200">Pinoys Cravings</a></span>
      </div>
      <div class="hidden md:flex space-x-6 gap-20 font-medium">
        <a href="index.php" class="hover:text-red-200">Home</a>
        <a href="categories.php" class="hover:text-red-200">Categories</a>
        <a href="Favorites.php" class="hover:text-red-200">Favorites</a>
        <a href="collection.php" class="hover:text-red-200">About Us</a>
      </div>
      <div class="flex items-center space-x-4">
        <?php if ($isLoggedIn): ?>
          <span class="text-sm">Welcome, <?= htmlspecialchars($user['email']) ?>!</span>
          <a href="../backend/logout.php" class="px-4 py-2 rounded-md bg-red-600 hover:bg-red-500 font-medium flex items-center">
            <i data-feather="log-out" class="w-4 h-4 mr-2"></i>
            Logout
          </a>
        <?php else: ?>
          <a href="login.php" class="px-4 py-2 rounded-md bg-red-600 hover:bg-red-500 font-medium">Login</a>
        <?php endif; ?>
    </div>
  </nav>

  <!-- Categories -->
  <div class="flex justify-between items-center  p-5">
    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
      <i data-feather="bookmark" class="mr-3 text-red-600"></i>
      Your Collections
    </h1>
  </div>



  <div class="grid grid-cols-1 md:grid-cols-4 gap-8 p-6 drop-shadow-lg">
    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
      <div class="relative">
        <img src="https://makeyourasia.com/templates/yootheme/cache/09/3-09a03ff0.jpeg" alt="Adobo" class="w-full h-48 object-cover">
        <div class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded-full text-xs font-semibold">
          <i data-feather="clock" class="inline w-3 h-3 mr-1"></i> 1
        </div>
      </div>
      <div class="p-4 ">
        <div class="flex justify-between items-start mb-2 ">
          <h3 class="font-bold text-xl">Main Dish</h3>
          <div class="flex items-center">
            <i data-feather="heart" class="w-5 h-5 text-gray-400 hover:text-red-500 cursor-pointer"></i>
          </div>
        </div>
        <p class="text-gray-600 mb-3">Enjoy a collection of savory main dishes crafted to be the highlight of your dining experience.</p>

        <a href="MainDish.php" class="text-red-600 hover:text-red-700 font-medium">View All</a>
      </div>
    </div>

    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
      <div class="relative">
        <img src="https://themayakitchen.com/wp-content/uploads/2021/11/Tocino-Longganisa-Rice-Champorado-5-1536x1024.jpg" alt="Adobo" class="w-full h-48 object-cover">
        <div class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded-full text-xs font-semibold">
          <i data-feather="clock" class="inline w-3 h-3 mr-1"></i> 2
        </div>
      </div>
      <div class="p-4 flex flex-col justify-between">
          <div class="flex flex-col gap-2">
            <div class="flex items-center justify-between w-full">
              <h3 class="font-bold text-xl">Breakfast</h3>
              <i data-feather="heart" class="w-5 h-5 text-gray-400 hover:text-red-500 cursor-pointer"></i>
            </div>
            <p class="text-gray-600 mb-3">Fuel your day with bright and satisfying breakfast meals designed to kickstart your energy.</p>
          </div>

        <a href="Breakfast.php" class="text-red-600 hover:text-red-700 font-medium">View All</a>
      </div>
    </div>

    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
      <div class="relative">
        <img src="https://i.pinimg.com/736x/45/15/3b/45153b3a44cf13fc5cd3e9a95fead568.jpg" alt="Adobo" class="w-full h-48 object-cover">
        <div class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded-full text-xs font-semibold">
          <i data-feather="clock" class="inline w-3 h-3 mr-1"></i> 3
        </div>
      </div>
      <div class="p-4 ">
        <div class="flex justify-between items-start mb-2 ">
          <h3 class="font-bold text-xl">Desserts</h3>
          <div class="flex items-center">
            <i data-feather="heart" class="w-5 h-5 text-gray-400 hover:text-red-500 cursor-pointer"></i>
          </div>
        </div>
        <p class="text-gray-600 mb-3">Treat yourself to delightful desserts crafted to satisfy every sweet craving.</p>

        <a href="Dessert.php" class="text-red-600 hover:text-red-700 font-medium">View All</a>
      </div>
    </div>

    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
      <div class="relative">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRQf06mZaQXaJ4zR4bu_klJu7czy__vdd_U_w&s" alt="Adobo" class="w-full h-48 object-cover">
        <div class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded-full text-xs font-semibold">
          <i data-feather="clock" class="inline w-3 h-3 mr-1"></i> 4
        </div>
      </div>
      <div class="p-4 ">
        <div class="flex justify-between items-start mb-2 ">
          <h3 class="font-bold text-xl">Appetizers</h3>
          <div class="flex items-center">
            <i data-feather="heart" class="w-5 h-5 text-gray-400 hover:text-red-500 cursor-pointer"></i>
          </div>
        </div>
        <p class="text-gray-600 mb-3">Experience tasty Pinoy appetizers bursting with flavor in every bite.</p>

        <a href="Appetizers.php" class="text-red-600 hover:text-red-700 font-medium">View All</a>
      </div>
    </div>
  </div>

  </div>





  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-12">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <div class="flex items-center space-x-2 mb-4">
            <i data-feather="book-open" class="w-6 h-6 text-red-500"></i>
            <span class="text-xl font-bold">Pinoys Cravings</span>
          </div>
          <p class="text-gray-400">Celebrating the rich and diverse flavors of Filipino cuisine.</p>
          <div class="flex space-x-4 mt-4">
            <a href="https://www.facebook.com/" class="text-gray-400 hover:text-white"><i data-feather="facebook" class="w-5 h-5"></i></a>
            <a href="https://www.instagram.com/" class="text-gray-400 hover:text-white"><i data-feather="instagram" class="w-5 h-5"></i></a>
            <a href="https://www.youtube.com/" class="text-gray-400 hover:text-white"><i data-feather="youtube" class="w-5 h-5"></i></a>
          </div>
        </div>
        <div>
          <h3 class="font-bold text-lg mb-4">Explore</h3>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-400 hover:text-white">Recipes</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Categories</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Collections</a></li>
          </ul>
        </div>
        <div>
          <h3 class="font-bold text-lg mb-4">Company</h3>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Terms of Service</a></li>
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
      <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
        <p>© 2023 Pinoys Cravings. All rights reserved.</p>
      </div>
    </div>
  </footer>

</body>
<script>
  feather.replace();
</script>

</html>