<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chicken Adobo - PinoysCravings</title>
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
        .ingredient-checkbox:checked + .ingredient-label {
            text-decoration: line-through;
            color: #9CA3AF;
        }
        .instruction-step {
            counter-increment: step-counter;
        }
        .instruction-step:before {
            content: counter(step-counter);
            background-color: #E63946;
            color: white;
            font-weight: bold;
            width: 1.75em;
            height: 1.75em;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }
    </style>
</head>
<body class="bg-secondary min-h-screen">
    <!-- Navigation -->
    <nav class="bg-primary text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="index.php" class="flex items-center space-x-2">
                <i data-feather="heart" class="text-white"></i>
                <span class="font-bold text-xl">PinoysCravings</span>
            </a>
            <div class="hidden md:flex space-x-6">
                <a href="index.php" class="hover:text-gray-200">Home</a>
                <a href="categories.php" class="hover:text-gray-200">Categories</a>
                <a href="favorites.php" class="hover:text-gray-200">Favorites</a>
                <a href="collections.php" class="hover:text-gray-200">Collections</a>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Search recipes..." class="px-4 py-2 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-white">
                    <i data-feather="search" class="absolute right-3 top-2.5 text-gray-500"></i>
                </div>
                <button onclick="location.href='login.php'" class="bg-white text-primary px-4 py-2 rounded-full font-medium hover:bg-gray-100 transition duration-300">Login</button>
                <button class="md:hidden" id="mobile-menu-button">
                    <i data-feather="menu"></i>
                </button>
            </div>
        </div>
        <!-- Mobile menu -->
        <div class="md:hidden hidden bg-primary-dark px-4 py-2" id="mobile-menu">
            <a href="index.php" class="block py-2 hover:text-gray-200">Home</a>
            <a href="categories.php" class="block py-2 hover:text-gray-200">Categories</a>
            <a href="favorites.php" class="block py-2 hover:text-gray-200">Favorites</a>
            <a href="collections.php" class="block py-2 hover:text-gray-200">Collections</a>
        </div>
    </nav>

    <!-- Recipe Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Recipe Header -->
            <div class="mb-8">
                <div class="flex justify-between items-start mb-4">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Chicken Adobo</h1>
                    <button class="text-gray-400 hover:text-red-500">
                        <i data-feather="heart" class="w-8 h-8"></i>
                    </button>
                </div>
                <div class="flex flex-wrap items-center text-gray-600 mb-4">
                    <div class="flex items-center mr-6 mb-2">
                        <i data-feather="clock" class="mr-2"></i>
                        <span>1 hour</span>
                    </div>
                    <div class="flex items-center mr-6 mb-2">
                        <i data-feather="users" class="mr-2"></i>
                        <span>4 servings</span>
                    </div>
                    <div class="flex items-center mr-6 mb-2">
                        <i data-feather="bar-chart-2" class="mr-2"></i>
                        <span>Medium</span>
                    </div>
                    <div class="flex items-center mb-2">
                        <i data-feather="tag" class="mr-2"></i>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">Main Dish</span>
                    </div>
                </div>
                <div class="flex items-center mb-6">
                    <div class="flex text-yellow-400 mr-2">
                        <i data-feather="star" class="fill-current"></i>
                        <i data-feather="star" class="fill-current"></i>
                        <i data-feather="star" class="fill-current"></i>
                        <i data-feather="star" class="fill-current"></i>
                        <i data-feather="star"></i>
                    </div>
                    <span class="text-gray-600">(24 ratings)</span>
                </div>
                <img src="http://static.photos/food/1200x630/1" alt="Chicken Adobo" class="w-full h-96 object-cover rounded-lg shadow-md">
            </div>

            <!-- Recipe Content -->
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Ingredients -->
                <div class="md:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                            <i data-feather="shopping-bag" class="mr-2 text-primary"></i>
                            Ingredients
                        </h2>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <input type="checkbox" id="ing1" class="ingredient-checkbox mt-1 mr-3">
                                <label for="ing1" class="ingredient-label flex-1">1 kg chicken, cut into serving pieces</label>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" id="ing2" class="ingredient-checkbox mt-1 mr-3">
                                <label for="ing2" class="ingredient-label flex-1">1/2 cup soy sauce</label>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" id="ing3" class="ingredient-checkbox mt-1 mr-3">
                                <label for="ing3" class="ingredient-label flex-1">1/2 cup white vinegar</label>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" id="ing4" class="ingredient-checkbox mt-1 mr-3">
                                <label for="ing4" class="ingredient-label flex-1">1 cup water</label>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" id="ing5" class="ingredient-checkbox mt-1 mr-3">
                                <label for="ing5" class="ingredient-label flex-1">5 cloves garlic, crushed</label>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" id="ing6" class="ingredient-checkbox mt-1 mr-3">
                                <label for="ing6" class="ingredient-label flex-1">1 teaspoon whole peppercorns</label>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" id="ing7" class="ingredient-checkbox mt-1 mr-3">
                                <label for="ing7" class="ingredient-label flex-1">3 bay leaves</label>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" id="ing8" class="ingredient-checkbox mt-1 mr-3">
                                <label for="ing8" class="ingredient-label flex-1">2 tablespoons cooking oil</label>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" id="ing9" class="ingredient-checkbox mt-1 mr-3">
                                <label for="ing9" class="ingredient-label flex-1">Salt to taste</label>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Instructions -->
                <div class="md:col-span-2">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                            <i data-feather="book-open" class="mr-2 text-primary"></i>
                            Instructions
                        </h2>
                        <ol class="space-y-4 list-none pl-0" style="counter-reset: step-counter;">
                            <li class="instruction-step flex items-start">
                                <div>
                                    <p class="text-gray-700">In a large bowl, combine chicken, soy sauce, and garlic. Marinate for at least 30 minutes.</p>
                                    <div class="mt-4">
                                        <img src="http://static.photos/food/640x360/24" alt="Marinating chicken" class="rounded-lg shadow-sm">
                                    </div>
                                </div>
                            </li>
                            <li class="instruction-step flex items-start">
                                <div>
                                    <p class="text-gray-700">Heat oil in a pan. Remove chicken from marinade (reserve marinade) and fry until lightly browned on all sides.</p>
                                </div>
                            </li>
                            <li class="instruction-step flex items-start">
                                <div>
                                    <p class="text-gray-700">Pour in the reserved marinade, water, vinegar, peppercorns, and bay leaves. Bring to a boil.</p>
                                </div>
                            </li>
                            <li class="instruction-step flex items-start">
                                <div>
                                    <p class="text-gray-700">Lower heat, cover, and simmer for 30 minutes or until chicken is tender.</p>
                                    <div class="mt-4">
                                        <img src="http://static.photos/food/640x360/25" alt="Simmering adobo" class="rounded-lg shadow-sm">
                                    </div>
                                </div>
                            </li>
                            <li class="instruction-step flex items-start">
                                <div>
                                    <p class="text-gray-700">Remove cover and continue simmering until sauce is reduced and thickened.</p>
                                </div>
                            </li>
                            <li class="instruction-step flex items-start">
                                <div>
                                    <p class="text-gray-700">Season with salt to taste. Serve hot with steamed rice.</p>
                                </div>
                            </li>
                        </ol>
                    </div>

                    <!-- Notes & Tips -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                            <i data-feather="alert-circle" class="mr-2 text-primary"></i>
                            Notes & Tips
                        </h2>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <i data-feather="info" class="text-primary mr-3 mt-1"></i>
                                <p class="text-gray-700">For a richer flavor, use coconut vinegar instead of white vinegar.</p>
                            </div>
                            <div class="flex items-start">
                                <i data-feather="info" class="text-primary mr-3 mt-1"></i>
                                <p class="text-gray-700">You can add hard-boiled eggs to the dish during the last 10 minutes of cooking.</p>
                            </div>
                            <div class="flex items-start">
                                <i data-feather="info" class="text-primary mr-3 mt-1"></i>
                                <p class="text-gray-700">Adobo tastes even better the next day as the flavors continue to develop.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Rating & Reviews -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <i data-feather="star" class="mr-2 text-primary"></i>
                            Ratings & Reviews
                        </h2>
                        
                        <!-- Login Prompt -->
                        <div class="bg-gray-50 rounded-lg p-6 text-center mb-6">
                            <i data-feather="lock" class="w-12 h-12 mx-auto text-gray-400 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Login to Rate This Recipe</h3>
                            <p class="text-gray-600 mb-4">Sign in to leave your review and star rating.</p>
                            <button onclick="location.href='login.php'" class="bg-primary hover:bg-red-700 text-white font-medium py-2 px-6 rounded-full transition duration-300">Sign In</button>
                        </div>

                        <!-- Sample Reviews (hidden when logged out) -->
                        <div class="hidden space-y-6">
                            <!-- Review 1 -->
                            <div class="border-b border-gray-200 pb-6">
                                <div class="flex items-center mb-3">
                                    <img src="http://static.photos/people/200x200/4" alt="User" class="w-10 h-10 rounded-full mr-3">
                                    <div>
                                        <h4 class="font-bold text-gray-800">Maria Santos</h4>
                                        <div class="flex text-yellow-400">
                                            <i data-feather="star" class="fill-current w-4 h-4"></i>
                                            <i data-feather="star" class="fill-current w-4 h-4"></i>
                                            <i data-feather="star" class="fill-current w-4 h-4"></i>
                                            <i data-feather="star" class="fill-current w-4 h-4"></i>
                                            <i data-feather="star" class="fill-current w-4 h-4"></i>
                                        </div>
                                    </div>
                                    <span class="text-gray-500 text-sm ml-auto">2 days ago</span>
                                </div>
                                <p class="text-gray-700">This recipe brought back memories of my lola's cooking. Perfect balance of flavors! I added a bit of sugar to balance the acidity.</p>
                            </div>

                            <!-- Review 2 -->
                            <div class="border-b border-gray-200 pb-6">
                                <div class="flex items-center mb-3">
                                    <img src="http://static.photos/people/200x200/5" alt="User" class="w-10 h-10 rounded-full mr-3">
                                    <div>
                                        <h4 class="font-bold text-gray-800">Juan Dela Cruz</h4>
                                        <div class="flex text-yellow-400">
                                            <i data-feather="star" class="fill-current w-4 h-4"></i>
                                            <i data-feather="star" class="fill-current w-4 h-4"></i>
                                            <i data-feather="star" class="fill-current w-4 h-4"></i>
                                            <i data-feather="star" class="fill-current w-4 h-4"></i>
                                            <i data-feather="star" class="w-4 h-4"></i>
                                        </div>
                                    </div>
                                    <span class="text-gray-500 text-sm ml-auto">1 week ago</span>
                                </div>
                                <p class="text-gray-700">Great recipe! I used chicken thighs instead of whole chicken and it turned out perfect. Will definitely make this again.</p>
                            </div>

                            <!-- Review Form (hidden when logged out) -->
                            <div class="hidden">
                                <h3 class="text-xl font-bold text-gray-800 mb-4">Leave a Review</h3>
                                <form>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">Your Rating</label>
                                        <div class="flex space-x-1">
                                            <button type="button" class="text-gray-300 hover:text-yellow-400">
                                                <i data-feather="star" class="w-6 h-6"></i>
                                            </button>
                                            <button type="button" class="text-gray-300 hover:text-yellow-400">
                                                <i data-feather="star" class="w-6 h-6"></i>
                                            </button>
                                            <button type="button" class="text-gray-300 hover:text-yellow-400">
                                                <i data-feather="star" class="w-6 h-6"></i>
                                            </button>
                                            <button type="button" class="text-gray-300 hover:text-yellow-400">
                                                <i data-feather="star" class="w-6 h-6"></i>
                                            </button>
                                            <button type="button" class="text-gray-300 hover:text-yellow-400">
                                                <i data-feather="star" class="w-6 h-6"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="review" class="block text-gray-700 font-medium mb-2">Your Review</label>
                                        <textarea id="review" rows="4" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Share your experience with this recipe..."></textarea>
                                    </div>
                                    <button type="submit" class="bg-primary hover:bg-red-700 text-white font-medium py-2 px-6 rounded-full transition duration-300">
                                        Submit Review
                                    </button>
                                </form>
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
                        <li><a href="index.php" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="categories.php" class="text-gray-400 hover:text-white">Categories</a></li>
                        <li><a href="favorites.php" class="text-gray-400 hover:text-white">Favorites</a></li>
                        <li><a href="collections.php" class="text-gray-400 hover:text-white">Collections</a></li>
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

        // Checkbox functionality for ingredients
        const checkboxes = document.querySelectorAll('.ingredient-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const label = this.nextElementSibling;
                if (this.checked) {
                    label.classList.add('line-through', 'text-gray-400');
                } else {
                    label.classList.remove('line-through', 'text-gray-400');
                }
            });
        });

        // Initialize Feather Icons
        feather.replace();
    </script>
</body>
    </html>
