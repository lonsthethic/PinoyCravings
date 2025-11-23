<?php
require_once "../backend/auth_session.php";
require_once "../backend/connection.php";

$user = getCurrentUser();
$isLoggedIn = isUserLoggedIn();

// Get user's favorites if logged in
$userFavorites = [];
if ($isLoggedIn) {
  $favStmt = $conn->prepare("SELECT dishID FROM favorites WHERE id = ?");
  $favStmt->bind_param("i", $user['id']);
  $favStmt->execute();
  $favResult = $favStmt->get_result();
  while ($favRow = $favResult->fetch_assoc()) {
    $userFavorites[] = $favRow['dishID'];
  }
}

// Fetch featured recipes (you can customize this query)
$featuredRecipes = $conn->query("
  SELECT dishID, title AS dishName, img, description 
  FROM dish 
  LIMIT 3
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pinoys Cravings - Filipino Cookbook</title>
  <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <style>
    /* Heart icon styles */
    .heart-filled {
      fill: #E63946;
      stroke: #E63946;
    }

    .heart-outline {
      fill: none;
      stroke: #9CA3AF;
    }

    .heart-outline:hover {
      stroke: #E63946;
    }
  </style>
</head>

<body class="bg-gray-50 font-sans">

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
        <a href="about.php" class="hover:text-red-200">About Us</a>
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
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="relative bg-gradient-to-r from-red-500 to-red-600 text-white py-16">
    <div class="container mx-auto px-4 text-center">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">Discover Authentic Filipino Recipes</h1>
      <p class="text-xl mb-8 max-w-2xl mx-auto text-red-100">From classic adobo to sweet halo-halo, explore the rich flavors of Philippine cuisine</p>
    </div>
  </section>

  <!-- Categories -->
  <section class="py-12 bg-white">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold mb-8 text-center text-red-700">Recipe Categories</h2>
      <div class="grid grid-cols-2 md:grid-cols-3 gap-10 justify-center">
        <a href="MainDishes.php" class="category-card bg-red-50 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
          <div class="h-40 bg-cover bg-center" style="background-image: url('https://www.unileverfoodsolutions.com.ph/chef-inspiration/food-delivery/10-crowd-favorite-filipino-dishes/jcr:content/parsys/set1/row2/span12/columncontrol_copy/columnctrl_parsys_2/textimage_copy/image.transform/jpeg-optimized/image.1697454873707.jpg');"></div>
          <div class="p-4">
            <h3 class="font-semibold text-lg">Main Dishes</h3>
            <p class="text-gray-600 text-sm">24 recipes</p>
          </div>
        </a>
        <a href="Dessert.php" class="category-card bg-red-50 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
          <div class="h-40 bg-cover bg-center" style="background-image: url('https://images.yummy.ph/yummy/uploads/2022/12/Eden-Yummy-Image-Insert-Cheesy-Leche-Flan.jpg');"></div>
          <div class="p-4">
            <h3 class="font-semibold text-lg">Desserts</h3>
            <p class="text-gray-600 text-sm">18 recipes</p>
          </div>
        </a>
        <a href="Breakfast.php" class="category-card bg-red-50 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
          <div class="h-40 bg-cover bg-center" style="background-image: url('https://cdn.tatlerasia.com/asiatatler/i/ph/2021/05/07105034-gettyimages-1257260385_cover_1280x764.jpg');"></div>
          <div class="p-4">
            <h3 class="font-semibold text-lg">Breakfast</h3>
            <p class="text-gray-600 text-sm">15 recipes</p>
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- Popular Recipes -->
  <section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold mb-8 text-center text-red-700">Popular Filipino Recipes</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <?php if ($featuredRecipes && $featuredRecipes->num_rows > 0): ?>
          <?php 
          $delay = 0;
          while ($recipe = $featuredRecipes->fetch_assoc()): 
            $isFavorited = in_array($recipe['dishID'], $userFavorites);
          ?>
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
              <div class="relative">
                <img src="<?= htmlspecialchars($recipe['img']) ?>" alt="<?= htmlspecialchars($recipe['dishName']) ?>" class="w-full h-48 object-cover">
                <div class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded-full text-xs font-semibold">
                  <i data-feather="clock" class="inline w-3 h-3 mr-1"></i> 45 mins
                </div>
              </div>
              <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                  <h3 class="font-bold text-xl"><?= htmlspecialchars($recipe['dishName']) ?></h3>
                  <div class="flex items-center">
                    <?php if ($isLoggedIn): ?>
                      <i data-feather="heart" 
                         class="w-5 h-5 cursor-pointer transition-colors <?= $isFavorited ? 'heart-filled' : 'heart-outline' ?>"
                         data-dish-id="<?= htmlspecialchars($recipe['dishID']) ?>"
                         onclick="toggleFavorite(this)"></i>
                    <?php else: ?>
                      <i data-feather="heart" 
                         class="w-5 h-5 cursor-pointer transition-colors heart-outline"
                         onclick="showToast('Please login to add favorites'); setTimeout(() => { window.location.href='login.php'; }, 1500);"></i>
                    <?php endif; ?>
                  </div>
                </div>
                <p class="text-gray-600 mb-3"><?= htmlspecialchars($recipe['description']) ?></p>
                <div class="flex justify-between items-center">
                  <a href="recipe.php?id=<?= urlencode($recipe['dishID']) ?>" class="text-red-600 hover:text-red-700 font-medium">View Recipe</a>
                </div>
              </div>
            </div>
          <?php 
            $delay += 100;
          endwhile; 
          ?>
        <?php else: ?>
          <!-- Fallback static recipes if database is empty -->
          <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow" data-aos="fade-up">
            <div class="relative">
              <img src="https://howtofeedaloon.com/wp-content/uploads/2025/07/filipino-chicken-adobo-overhead.jpg" alt="Adobo" class="w-full h-48 object-cover">
              <div class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded-full text-xs font-semibold">
                <i data-feather="clock" class="inline w-3 h-3 mr-1"></i> 45 mins
              </div>
            </div>
            <div class="p-4">
              <div class="flex justify-between items-start mb-2">
                <h3 class="font-bold text-xl">Chicken Adobo</h3>
                <div class="flex items-center">
                  <i data-feather="heart" class="w-5 h-5 text-gray-400 hover:text-red-500 cursor-pointer"></i>
                </div>
              </div>
              <p class="text-gray-600 mb-3">The Philippines' national dish featuring chicken braised in vinegar, soy sauce, and garlic.</p>
              <div class="flex justify-between items-center">
                <a href="categories.php" class="text-red-600 hover:text-red-700 font-medium">View Recipe</a>
              </div>
            </div>
          </div>
        <?php endif; ?>

      </div>
      <div class="text-center mt-8">
        <a href="categories.php" class="inline-block px-6 py-3 bg-red-600 text-white rounded-md hover:bg-red-700">View All Recipes</a>
      </div>
    </div>
  </section>

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
            <li><a href="categories.php" class="text-gray-400 hover:text-white">Recipes</a></li>
            <li><a href="categories.php" class="text-gray-400 hover:text-white">Categories</a></li>
            <li><a href="Favorites.php" class="text-gray-400 hover:text-white">Favorites</a></li>
          </ul>
        </div>
        <div>
          <h3 class="font-bold text-lg mb-4">Company</h3>
          <ul class="space-y-2">
            <li><a href="about.php" class="text-gray-400 hover:text-white">About Us</a></li>
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

  <script>
    AOS.init();
    feather.replace();

    // Toggle favorite function
    function toggleFavorite(element) {
      const dishID = element.getAttribute('data-dish-id');
      
      fetch('../backend/favorites_handler.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=toggle&dishID=${encodeURIComponent(dishID)}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          if (data.isFavorite) {
            element.classList.remove('heart-outline');
            element.classList.add('heart-filled');
            showToast('Added to favorites!');
          } else {
            element.classList.remove('heart-filled');
            element.classList.add('heart-outline');
            showToast('Removed from favorites!');
          }
          feather.replace();
        } else {
          showToast(data.message || 'Failed to update favorite');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred. Please try again.');
      });
    }

    // Toast notification
    function showToast(message) {
      const toast = document.createElement('div');
      toast.className = 'fixed bottom-4 right-4 bg-gray-800 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-300';
      toast.textContent = message;
      document.body.appendChild(toast);
      
      setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
      }, 3000);
    }
  </script>
</body>

</html>