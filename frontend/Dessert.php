<?php
require_once "../backend/auth_session.php";
require_once "../backend/connection.php";

$user = getCurrentUser();
$isLoggedIn = isUserLoggedIn();

$getDish = "SELECT DISTINCT dish.dishID, title AS dishName, img, description,
            GROUP_CONCAT(ingredients.ingredients SEPARATOR ', ') as all_ingredients
            FROM dish 
            INNER JOIN ingredients ON dish.dishID = ingredients.dishID AND dish.category = 'Dessert'
            GROUP BY dish.dishID, title, img";

$dishData = $conn->query($getDish);

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
    <title>Desserts - Pinoys Cravings</title>
    
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
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <i data-feather="coffee" class="mr-3 text-red-600"></i>
                Desserts
            </h1>
            <a class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded transition duration-300 flex items-center" href="categories.php">
                <i data-feather="arrow-left" class="mr-2"></i>
                Back
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 drop-shadow-md">
            <?php if ($dishData && $dishData->num_rows > 0): ?>
                <?php 
                $cardIndex = 0;
                while ($row = $dishData->fetch_assoc()): 
                    $delay = ($cardIndex * 100) % 400;
                    $cardIndex++;
                    $isFavorited = in_array($row['dishID'], $userFavorites);
                ?>
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
                        <div class="relative">
                            <img src="<?= htmlspecialchars($row['img']) ?>"
                                alt="<?= htmlspecialchars($row['dishName']) ?>"
                                class="w-full h-48 object-cover"
                                loading="lazy"
                                decoding="async">

                            <div class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                <i data-feather="utensils" class="inline w-3 h-3 mr-1"></i> <?= htmlspecialchars($row['dishID']) ?>
                            </div>
                        </div>

                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-xl">
                                    <?= htmlspecialchars($row['dishName']) ?>
                                </h3>

                                <div class="flex items-center">
                                    <?php if ($isLoggedIn): ?>
                                        <i data-feather="heart" 
                                           class="w-5 h-5 cursor-pointer transition-colors favorite-heart <?= $isFavorited ? 'heart-filled' : 'heart-outline' ?>"
                                           data-dish-id="<?= htmlspecialchars($row['dishID']) ?>"
                                           onclick="toggleFavorite(this)"></i>
                                    <?php else: ?>
                                        <i data-feather="heart" 
                                           class="w-5 h-5 cursor-pointer transition-colors heart-outline"
                                           onclick="alert('Please login to add favorites'); window.location.href='login.php'"></i>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <p class="text-gray-600 mb-3 text-sm line-clamp-2">
                                <?= htmlspecialchars($row['description']) ?>
                            </p>

                            <div class="flex justify-between items-center">
                                <a href="recipe.php?id=<?= urlencode($row['dishID']) ?>"
                                   class="text-red-600 hover:text-red-700 font-medium">
                                    View Recipe
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

            <?php else: ?>
                <div class="col-span-full bg-white rounded-lg shadow-md p-8 text-center">
                    <i data-feather="alert-circle" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">No Recipes Found</h2>
                    <p class="text-gray-600">There are no dessert recipes in the database yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

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

    <script>
        AOS.init({
            duration: 800,
            once: true,
            disable: 'mobile'
        });

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
                    alert(data.message || 'Failed to update favorite');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
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