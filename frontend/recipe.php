<?php
require_once "../backend/auth_session.php";
$user = getCurrentUser();
$isLoggedIn = isUserLoggedIn();
?>

<?php
include "../backend/connection.php";

// Get the dish ID from URL
$dishID = isset($_GET['id']) ? intval($_GET['id']) : (isset($_GET['dish']) ? intval($_GET['dish']) : 0);

// If no valid ID, redirect to collection page
if ($dishID <= 0) {
    header("Location: collection.php");
    exit();
}

// Fetch dish details
$dishQuery = "SELECT * FROM dish WHERE dishID = ?";
$stmt = $conn->prepare($dishQuery);
$stmt->bind_param("i", $dishID);
$stmt->execute();
$dishResult = $stmt->get_result();

if ($dishResult->num_rows === 0) {
    header("Location: collection.php");
    exit();
}

$dish = $dishResult->fetch_assoc();

// Check if this dish is favorited by the current user
$isFavorited = false;
if ($isLoggedIn) {
    $favCheckStmt = $conn->prepare("SELECT dishID FROM favorites WHERE id = ? AND dishID = ?");
    $favCheckStmt->bind_param("ii", $user['id'], $dishID);
    $favCheckStmt->execute();
    $favCheckResult = $favCheckStmt->get_result();
    $isFavorited = $favCheckResult->num_rows > 0;
}

// Fetch ingredients
$ingredientsQuery = "SELECT ingredients FROM ingredients WHERE dishID = ?";
$stmtIng = $conn->prepare($ingredientsQuery);
$stmtIng->bind_param("i", $dishID);
$stmtIng->execute();
$ingredientsResult = $stmtIng->get_result();

// Fetch instructions
$instructionsQuery = "SELECT Instructions FROM instruction WHERE dishID = ? ORDER BY InstructionID";
$stmtInst = $conn->prepare($instructionsQuery);
$stmtInst->bind_param("i", $dishID);
$stmtInst->execute();
$instructionsResult = $stmtInst->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($dish['title']) ?> - PinoysCravings</title>
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
<body class="bg-secondary min-h-screen">
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

    <!-- Recipe Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="javascript:history.back()" class="inline-flex items-center text-red-600 hover:text-red-700 font-medium">
                    <i data-feather="arrow-left" class="mr-2"></i>
                    Back
                </a>
            </div>

            <!-- Recipe Header -->
            <div class="mb-8">
                <div class="flex justify-between items-start mb-4">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                        <?= htmlspecialchars($dish['title']) ?>
                    </h1>
                    <?php if ($isLoggedIn): ?>
                        <button onclick="toggleFavorite(this)" 
                                data-dish-id="<?= htmlspecialchars($dishID) ?>"
                                class="cursor-pointer">
                            <i data-feather="heart" 
                               class="w-8 h-8 transition-colors <?= $isFavorited ? 'heart-filled' : 'heart-outline' ?>"></i>
                        </button>
                    <?php else: ?>
                        <button onclick="showToast('Please login to add favorites'); setTimeout(() => { window.location.href='login.php'; }, 1500);" 
                                class="cursor-pointer">
                            <i data-feather="heart" class="w-8 h-8 heart-outline"></i>
                        </button>
                    <?php endif; ?>
                </div>
                
                <div class="flex flex-wrap items-center text-gray-600 mb-4">
                    <div class="flex items-center mb-2">
                        <i data-feather="tag" class="mr-2"></i>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                            <?= htmlspecialchars($dish['category'] ?? 'Main Dish') ?>
                        </span>
                    </div>
                </div>

                <img src="<?= htmlspecialchars($dish['img']) ?>" 
                     alt="<?= htmlspecialchars($dish['title']) ?>" 
                     class="w-full h-96 object-cover rounded-lg shadow-md"
                     loading="lazy">
            </div>

            <!-- Description -->
            <?php if (!empty($dish['description'])): ?>
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">About This Recipe</h2>
                <p class="text-gray-700"><?= htmlspecialchars($dish['description']) ?></p>
            </div>
            <?php endif; ?>

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
                            <?php 
                            $ingCount = 0;
                            while ($ingredient = $ingredientsResult->fetch_assoc()): 
                                $ingCount++;
                            ?>
                            <li class="flex items-start">
                                <input type="checkbox" 
                                       id="ing<?= $ingCount ?>" 
                                       class="ingredient-checkbox mt-1 mr-3">
                                <label for="ing<?= $ingCount ?>" 
                                       class="ingredient-label flex-1">
                                    <?= htmlspecialchars($ingredient['ingredients']) ?>
                                </label>
                            </li>
                            <?php endwhile; ?>
                            
                            <?php if ($ingCount === 0): ?>
                            <li class="text-gray-500 italic">No ingredients listed</li>
                            <?php endif; ?>
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
                            <?php 
                            $instCount = 0;
                            while ($instruction = $instructionsResult->fetch_assoc()): 
                                $instCount++;
                            ?>
                            <li class="instruction-step flex items-start">
                                <div>
                                    <p class="text-gray-700">
                                        <?= htmlspecialchars($instruction['Instructions']) ?>
                                    </p>
                                </div>
                            </li>
                            <?php endwhile; ?>
                            
                            <?php if ($instCount === 0): ?>
                            <li class="text-gray-500 italic">No instructions available</li>
                            <?php endif; ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 mt-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i data-feather="book-open" class="w-6 h-6 text-red-500"></i>
                        <span class="text-xl font-bold">Pinoys Cravings</span>
                    </div>
                    <p class="text-gray-400">Celebrating the rich and diverse flavors of Filipino cuisine.</p>
                    <div class="flex space-x-4 mt-4">
                        <a href="https://www.facebook.com/" class="text-gray-400 hover:text-white">
                            <i data-feather="facebook" class="w-5 h-5"></i>
                        </a>
                        <a href="https://www.instagram.com/" class="text-gray-400 hover:text-white">
                            <i data-feather="instagram" class="w-5 h-5"></i>
                        </a>
                        <a href="https://www.youtube.com/" class="text-gray-400 hover:text-white">
                            <i data-feather="youtube" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Explore</h3>
                    <ul class="space-y-2">
                        <li><a href="index.php" class="text-gray-400 hover:text-white">Recipes</a></li>
                        <li><a href="categories.php" class="text-gray-400 hover:text-white">Categories</a></li>
                        <li><a href="collection.php" class="text-gray-400 hover:text-white">Collections</a></li>
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
                        <li class="flex items-center text-gray-400">
                            <i data-feather="mail" class="mr-2"></i> BSIT2.1B@pinoyscravings.com
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i data-feather="phone" class="mr-2"></i> +64 0995658323
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i data-feather="map-pin" class="mr-2"></i> Dasmarinas, Cavite, Philippines
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>© 2023 Pinoys Cravings. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
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

        // Toggle favorite function
        function toggleFavorite(element) {
            const dishID = element.getAttribute('data-dish-id');
            const heartIcon = element.querySelector('i[data-feather="heart"]');
            
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
                        heartIcon.classList.remove('heart-outline');
                        heartIcon.classList.add('heart-filled');
                        showToast('Added to favorites!');
                    } else {
                        heartIcon.classList.remove('heart-filled');
                        heartIcon.classList.add('heart-outline');
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