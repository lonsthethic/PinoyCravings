<?php
require_once "../backend/connection.php";
require_once "../backend/auth_session.php";
$user = getCurrentUser();
$isLoggedIn = isUserLoggedIn();

// Redirect if not logged in
if (!$isLoggedIn) {
  header("Location: login.php");
  exit();
}

$success = false;
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title']);
  $description = trim($_POST['description']);
  $category = trim($_POST['category']); // Get category from form
  $img = trim($_POST['img']);
  $ingredients = trim($_POST['ingredients']);
  $instructions = trim($_POST['instructions']);

  // Validation
  if (empty($title) || empty($description) || empty($category) || empty($img) || empty($ingredients) || empty($instructions)) {
    $error = "All fields are required!";
  } else {
    // Start transaction
    $conn->begin_transaction();
    
    try {
      // Insert into dish table
      $stmt = $conn->prepare("INSERT INTO dish (title, description, img, category) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("ssss", $title, $description, $img, $category);
      $stmt->execute();
      $dishID = $conn->insert_id;

      // Insert ingredients (split by comma or newline) - each as unique entry
      $ingredientsList = preg_split('/\r\n|\r|\n|,/', $ingredients);
      $ingredientsList = array_filter(array_map('trim', $ingredientsList));
      $ingredientsList = array_unique($ingredientsList); // Remove duplicates
      
      $stmtIngredient = $conn->prepare("INSERT INTO ingredients (ingredients, dishID) VALUES (?, ?)");
      if (!$stmtIngredient) {
        throw new Exception("Ingredient prepare failed: " . $conn->error);
      }
      foreach ($ingredientsList as $ingredient) {
        if (!empty($ingredient)) {
          $stmtIngredient->bind_param("si", $ingredient, $dishID);
          $stmtIngredient->execute();
        }
      }

      // Insert instructions (split by newline) - each as unique entry
      $instructionsList = preg_split('/\r\n|\r|\n/', $instructions);
      $instructionsList = array_filter(array_map('trim', $instructionsList));
      $instructionsList = array_unique($instructionsList); // Remove duplicates
      
      $stmtInstruction = $conn->prepare("INSERT INTO instruction (Instructions, dishID) VALUES (?, ?)");
      if (!$stmtInstruction) {
        throw new Exception("Instruction prepare failed: " . $conn->error);
      }
      foreach ($instructionsList as $instruction) {
        if (!empty($instruction)) {
          $stmtInstruction->bind_param("si", $instruction, $dishID);
          $stmtInstruction->execute();
        }
      }

      $conn->commit();
      $success = true;
      
      // Redirect after 2 seconds
      header("refresh:2;url=categories.php");
    } catch (Exception $e) {
      $conn->rollback();
      $error = "Error adding dish: " . $e->getMessage();
    }
  }
}

// Define available categories
$categories = [
  'Appetizers',
  'Main Dish',
  'Dessert',
  'Breakfast'
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Dish - Pinoys Cravings</title>
  <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <style>
    * {
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
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
      <div class="hidden md:flex space-x-6 gap-20">
        <a href="index.php" class="hover:text-red-200">Home</a>
        <a href="categories.php" class="hover:text-red-200">Categories</a>
        <a href="Favorites.php" class="hover:text-red-200">Favorites</a>
        <a href="collection.php" class="hover:text-red-200">About Us</a>
      </div>
      <div class="flex items-center space-x-4">
        <span class="text-sm">Welcome, <?= htmlspecialchars($user['email']) ?>!</span>
        <a href="../backend/logout.php" class="flex items-center px-4 py-2 rounded-md bg-red-600 hover:bg-red-500">
          <i data-feather="log-out" class="w-4 h-4 mr-2"></i>
          Logout
        </a>
      </div>
    </div>
  </nav>

  <main class="container mx-auto px-4 py-8 max-w-3xl">

    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-gray-800 flex items-center">
        <i data-feather="plus-circle" class="mr-3 text-red-600"></i>
        Add New Dish
      </h1>
      <a class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded transition duration-300 flex items-center" href="categories.php">
        <i data-feather="arrow-left" class="mr-2"></i>
        Back to Categories
      </a>
    </div>

    <?php if ($success): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center">
        <i data-feather="check-circle" class="mr-3"></i>
        <div>
          <strong>Success!</strong> Dish added successfully. Redirecting...
        </div>
      </div>
    <?php endif; ?>

    <?php if ($error): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 flex items-center">
        <i data-feather="alert-circle" class="mr-3"></i>
        <div>
          <strong>Error!</strong> <?= htmlspecialchars($error) ?>
        </div>
      </div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow-md p-8">
      <form method="POST" action="" class="space-y-6">
        
        <!-- Title -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2" for="title">
            <i data-feather="type" class="inline w-4 h-4 mr-1"></i>
            Dish Title *
          </label>
          <input type="text" id="title" name="title" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
            placeholder="e.g., Chicken Adobo"
            value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>">
        </div>

        <!-- Description -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2" for="description">
            <i data-feather="file-text" class="inline w-4 h-4 mr-1"></i>
            Description *
          </label>
          <textarea id="description" name="description" rows="3" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
            placeholder="Brief description of the dish..."><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
        </div>

        <!-- Category -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2" for="category">
            <i data-feather="tag" class="inline w-4 h-4 mr-1"></i>
            Category *
          </label>
          <select id="category" name="category" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
            <option value="">Select a category...</option>
            <?php foreach ($categories as $cat): ?>
              <option value="<?= htmlspecialchars($cat) ?>" 
                <?= (isset($_POST['category']) && $_POST['category'] === $cat) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat) ?>
              </option>
            <?php endforeach; ?>
          </select>
          <p class="text-sm text-gray-500 mt-1">Choose the most appropriate category for your dish</p>
        </div>

        <!-- Image URL -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2" for="img">
            <i data-feather="image" class="inline w-4 h-4 mr-1"></i>
            Image URL *
          </label>
          <input type="url" id="img" name="img" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
            placeholder="https://example.com/image.jpg"
            value="<?= isset($_POST['img']) ? htmlspecialchars($_POST['img']) : '' ?>">
          <p class="text-sm text-gray-500 mt-1">Enter a valid image URL</p>
        </div>

        <!-- Ingredients -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2" for="ingredients">
            <i data-feather="list" class="inline w-4 h-4 mr-1"></i>
            Ingredients *
          </label>
          <textarea id="ingredients" name="ingredients" rows="6" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
            placeholder="Enter each ingredient on a new line or separate with commas:
1 kg chicken
3 cloves garlic
1/2 cup soy sauce"><?= isset($_POST['ingredients']) ? htmlspecialchars($_POST['ingredients']) : '' ?></textarea>
          <p class="text-sm text-gray-500 mt-1">One ingredient per line or separated by commas</p>
        </div>

        <!-- Instructions -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2" for="instructions">
            <i data-feather="clipboard" class="inline w-4 h-4 mr-1"></i>
            Cooking Instructions *
          </label>
          <textarea id="instructions" name="instructions" rows="8" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
            placeholder="Enter each step on a new line:
Heat oil in a pan
Add garlic and sauté until golden
Add chicken and cook until browned"><?= isset($_POST['instructions']) ? htmlspecialchars($_POST['instructions']) : '' ?></textarea>
          <p class="text-sm text-gray-500 mt-1">One instruction step per line</p>
        </div>

        <!-- Submit Button -->
        <div class="flex gap-4">
          <button type="submit"
            class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center">
            <i data-feather="check" class="mr-2"></i>
            Add Dish
          </button>
          <a href="categories.php"
            class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center">
            <i data-feather="x" class="mr-2"></i>
            Cancel
          </a>
        </div>

      </form>
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