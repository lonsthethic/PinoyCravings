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
    <title>About Us - Pinoys Cravings</title>
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

    <main class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Hero Section with improved design -->
        <div class="relative bg-gradient-to-r from-red-700 to-red-600 rounded-2xl shadow-2xl overflow-hidden mb-8" data-aos="fade-up">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative text-center py-12 px-6">
                <div class="inline-block bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4 mb-4">
                    <i data-feather="book-open" class="w-16 h-16 text-white"></i>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-3">
                    About Pinoys Cravings
                </h1>
                <div class="w-24 h-1 bg-white mx-auto mb-4 rounded-full"></div>
                <p class="text-lg text-white text-opacity-95 max-w-2xl mx-auto">
                    Your digital cookbook celebrating the rich flavors and traditions of Filipino cuisine
                </p>
            </div>
        </div>

        <!-- Our Story Section -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center mb-4">
                <i data-feather="heart" class="w-6 h-6 text-red-600 mr-2"></i>
                <h2 class="text-2xl font-bold text-gray-800">Our Story</h2>
            </div>
            <div class="text-gray-700 space-y-3 text-sm leading-relaxed">
                <p>
                    Pinoys Cravings was born from a deep love for Filipino cuisine and a desire to preserve and share our culinary heritage with the world. We believe that food is more than just sustenance—it's a celebration of culture, family, and tradition.
                </p>
                <p>
                    Our cookbook brings together authentic Filipino recipes that have been passed down through generations, carefully curated to help you recreate the flavors of home, no matter where you are in the world.
                </p>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow-md p-6" data-aos="fade-right" data-aos-delay="200">
                <div class="flex items-center mb-4">
                    <div class="bg-red-100 rounded-lg p-2 mr-3">
                        <i data-feather="target" class="w-5 h-5 text-red-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Our Mission</h2>
                </div>
                <p class="text-gray-700 text-sm leading-relaxed">
                    To make authentic Filipino recipes accessible to everyone, preserving our culinary traditions while inspiring new generations to explore and celebrate the diverse flavors of the Philippines.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6" data-aos="fade-left" data-aos-delay="300">
                <div class="flex items-center mb-4">
                    <div class="bg-red-100 rounded-lg p-2 mr-3">
                        <i data-feather="eye" class="w-5 h-5 text-red-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Our Vision</h2>
                </div>
                <p class="text-gray-700 text-sm leading-relaxed">
                    To become the go-to resource for Filipino cuisine, connecting Filipinos worldwide through the universal language of food and keeping our culinary heritage alive for future generations.
                </p>
            </div>
        </div>

        <!-- What We Offer -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6" data-aos="fade-up" data-aos-delay="400">
            <div class="flex items-center mb-5">
                <i data-feather="star" class="w-6 h-6 text-red-600 mr-2"></i>
                <h2 class="text-2xl font-bold text-gray-800">What We Offer</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-4">
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <i data-feather="coffee" class="w-10 h-10 text-red-600 mx-auto mb-3"></i>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Breakfast Delights</h3>
                    <p class="text-gray-600 text-xs">Traditional Filipino breakfast favorites</p>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <i data-feather="package" class="w-10 h-10 text-red-600 mx-auto mb-3"></i>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Appetizers</h3>
                    <p class="text-gray-600 text-xs">Delicious starters for any occasion</p>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <i data-feather="award" class="w-10 h-10 text-red-600 mx-auto mb-3"></i>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Sweet Desserts</h3>
                    <p class="text-gray-600 text-xs">Classic Filipino sweets and treats</p>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="bg-red-700 text-white rounded-xl shadow-md p-6 mb-6" data-aos="fade-up" data-aos-delay="500">
            <h2 class="text-2xl font-bold mb-5 text-center">Why Choose Pinoys Cravings?</h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="flex items-start">
                    <i data-feather="check-circle" class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <h3 class="font-bold mb-1">Authentic Recipes</h3>
                        <p class="text-red-100 text-xs">Traditional recipes passed down through generations</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i data-feather="check-circle" class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <h3 class="font-bold mb-1">Step-by-Step Instructions</h3>
                        <p class="text-red-100 text-xs">Easy-to-follow guides for all skill levels</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i data-feather="check-circle" class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <h3 class="font-bold mb-1">Save Your Favorites</h3>
                        <p class="text-red-100 text-xs">Create your personal recipe collection</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i data-feather="check-circle" class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <h3 class="font-bold mb-1">Organized Categories</h3>
                        <p class="text-red-100 text-xs">Browse recipes by meal type</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="bg-white rounded-xl shadow-md p-6 text-center" data-aos="fade-up" data-aos-delay="600">
            <h2 class="text-2xl font-bold text-gray-800 mb-3">Start Your Culinary Journey</h2>
            <p class="text-gray-600 text-sm mb-5 max-w-xl mx-auto">
                Join us in celebrating Filipino cuisine. Explore our recipes, save your favorites, and bring the authentic taste of the Philippines to your kitchen.
            </p>
            <div class="flex justify-center gap-3 flex-wrap">
                <a href="categories.php" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300 flex items-center text-sm">
                    <i data-feather="book" class="mr-2 w-4 h-4"></i>
                    Browse Recipes
                </a>
                <?php if (!$isLoggedIn): ?>
                <a href="login.php" class="bg-gray-800 hover:bg-gray-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300 flex items-center text-sm">
                    <i data-feather="user" class="mr-2 w-4 h-4"></i>
                    Create Account
                </a>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 mt-12">
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
        AOS.init({
            duration: 800,
            once: true,
            disable: 'mobile'
        });

        feather.replace();
    </script>
</body>
</html>