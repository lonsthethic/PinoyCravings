<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PinoysCravings - Collections</title>
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
        .collection-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .collection-bg {
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-secondary min-h-screen">
    <!-- Navigation -->
    <nav class="bg-primary text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="index.html" class="flex items-center space-x-2">
                <i data-feather="heart" class="text-white"></i>
                <span class="font-bold text-xl">PinoysCravings</span>
            </a>
            <div class="hidden md:flex space-x-6">
                <a href="index.html" class="hover:text-gray-200">Home</a>
                <a href="categories.html" class="hover:text-gray-200">Categories</a>
                <a href="favorites.html" class="hover:text-gray-200">Favorites</a>
                <a href="collections.html" class="hover:text-gray-200 font-medium">Collections</a>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Search recipes..." class="px-4 py-2 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-white">
                    <i data-feather="search" class="absolute right-3 top-2.5 text-gray-500"></i>
                </div>
                <button onclick="location.href='login.html'" class="bg-white text-primary px-4 py-2 rounded-full font-medium hover:bg-gray-100 transition duration-300">Login</button>
                <button class="md:hidden" id="mobile-menu-button">
                    <i data-feather="menu"></i>
                </button>
            </div>
        </div>
        <!-- Mobile menu -->
        <div class="md:hidden hidden bg-primary-dark px-4 py-2" id="mobile-menu">
            <a href="index.html" class="block py-2 hover:text-gray-200">Home</a>
            <a href="categories.html" class="block py-2 hover:text-gray-200">Categories</a>
            <a href="favorites.html" class="block py-2 hover:text-gray-200">Favorites</a>
            <a href="collections.html" class="block py-2 hover:text-gray-200 font-medium">Collections</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <i data-feather="bookmark" class="mr-3 text-primary"></i>
                Your Collections
            </h1>
            <button class="bg-primary hover:bg-red-700 text-white font-medium py-2 px-4 rounded transition duration-300 flex items-center">
                <i data-feather="plus" class="mr-2"></i>
                Create Collection
            </button>
        </div>

        <!-- Login Prompt -->
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <i data-feather="lock" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Login to View Collections</h2>
            <p class="text-gray-600 mb-6">Sign in to access your recipe collections and create new ones.</p>
            <button onclick="location.href='login.html'" class="bg-primary hover:bg-red-700 text-white font-medium py-2 px-6 rounded-full transition duration-300">Sign In</button>
        </div>

        <!-- Sample Content (hidden when logged out) -->
        <div class="hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Collection 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md collection-card transition duration-300">
                    <div class="h-48 bg-gray-200 relative collection-bg" style="background-image: url('http://static.photos/food/640x360/20')">
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-end p-6">
                            <div>
                                <h2 class="text-2xl font-bold text-white">Family Favorites</h2>
                                <p class="text-gray-200">5 recipes</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Our go-to recipes for family gatherings and special occasions.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Last updated: 2 days ago</span>
                            <div class="flex space-x-2">
                                <button class="text-gray-500 hover:text-primary">
                                    <i data-feather="edit-2" class="w-4 h-4"></i>
                                </button>
                                <button class="text-gray-500 hover:text-primary">
                                    <i data-feather="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Collection 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md collection-card transition duration-300">
                    <div class="h-48 bg-gray-200 relative collection-bg" style="background-image: url('http://static.photos/food/640x360/21')">
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-end p-6">
                            <div>
                                <h2 class="text-2xl font-bold text-white">Quick Snacks</h2>
                                <p class="text-gray-200">3 recipes</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Easy-to-make Filipino street food and snacks for any time of day.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Last updated: 1 week ago</span>
                            <div class="flex space-x-2">
                                <button class="text-gray-500 hover:text-primary">
                                    <i data-feather="edit-2" class="w-4 h-4"></i>
                                </button>
                                <button class="text-gray-500 hover:text-primary">
                                    <i data-feather="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Collection 3 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md collection-card transition duration-300">
                    <div class="h-48 bg-gray-200 relative collection-bg" style="background-image: url('http://static.photos/food/640x360/22')">
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-end p-6">
                            <div>
                                <h2 class="text-2xl font-bold text-white">Party Dishes</h2>
                                <p class="text-gray-200">7 recipes</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Perfect recipes for fiestas, birthdays, and celebrations.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Last updated: 3 weeks ago</span>
                            <div class="flex space-x-2">
                                <button class="text-gray-500 hover:text-primary">
                                    <i data-feather="edit-2" class="w-4 h-4"></i>
                                </button>
                                <button class="text-gray-500 hover:text-primary">
                                    <i data-feather="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Collection 4 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md collection-card transition duration-300">
                    <div class="h-48 bg-gray-200 relative collection-bg" style="background-image: url('http://static.photos/food/640x360/23')">
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-end p-6">
                            <div>
                                <h2 class="text-2xl font-bold text-white">Comfort Food</h2>
                                <p class="text-gray-200">4 recipes</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Warm, comforting dishes for when you need a taste of home.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Last updated: 1 month ago</span>
                            <div class="flex space-x-2">
                                <button class="text-gray-500 hover:text-primary">
                                    <i data-feather="edit-2" class="w-4 h-4"></i>
                                </button>
                                <button class="text-gray-500 hover:text-primary">
                                    <i data-feather="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

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
                        <li><a href="collections.html" class="text-gray-400 hover:text-white font-medium">Collections</a></li>
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
                        <li class="flex items-center text-gray-400"><i data-feather="mail" class="mr-2"></i> hello@pinoyscravings.com</li>
                        <li class="flex items-center text-gray-400"><i data-feather="phone" class="mr-2"></i> +1 (234) 567-890</li>
                        <li class="flex items-center text-gray-400"><i data-feather="map-pin" class="mr-2"></i> Manila, Philippines</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; 2023 PinoysCravings. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Initialize Feather Icons
        feather.replace();
    </script>
</body>
</html>
