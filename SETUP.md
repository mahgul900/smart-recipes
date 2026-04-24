# Smart Recipes — Setup & Fix Notes

## What Was Fixed

| # | Bug | File |
|---|-----|------|
| 1 | Image upload failing: file pointer consumed before thumbnail generation | `RecipeController.php` |
| 2 | `AlternativeController::show()` method missing (route existed, method didn't) | `AlternativeController.php` |
| 3 | `myReviews()` called `->with('ingredient')` as a relation — it's a plain column | `AlternativeReviewController.php` |
| 4 | `ingredient_alternatives` migration was empty (no columns at all) | `migrations/..._create_ingredient_alternatives_table.php` |
| 5 | `IngredientAlternative` model had no `$fillable` | `IngredientAlternative.php` |
| 6 | `alternatives.review` route defined twice (duplicate named route) | `routes/web.php` |
| 7 | `RecipeImage` model had `$timestamps = false` but migration adds timestamps | `RecipeImage.php` |
| 8 | Missing view: `reviews/alternatives.blade.php` | Created ✅ |
| 9 | Missing view: `recipes/my.blade.php` | Created ✅ |
| 10 | Missing view: `reviews/recipes.blade.php` | Created ✅ |

---

## Setup Instructions

### 1. Install PHP dependencies
```bash
composer install
```

### 2. Copy and configure environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your database credentials:
```
DB_DATABASE=smart_recipes
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 3. Run database migrations
```bash
php artisan migrate
```

### 4. Create the storage symlink (required for image uploads to show)
```bash
php artisan storage:link
```

### 5. Ensure GD extension is enabled
Image thumbnails use PHP's built-in GD library.
Check with: `php -m | grep gd`
If missing, on Ubuntu: `sudo apt install php-gd`

### 6. Start the development server
```bash
php artisan serve
```

---

## How the Two Features Work

### Ingredient Alternatives
- Users search for an ingredient at `/alternatives/search?query=butter`
- Results show community-reviewed alternatives with star ratings
- Logged-in users can rate & comment on any alternative
- Alternatives grow organically through user reviews (no admin seeding needed)

### Recipe Submission with Images
- Logged-in users go to `/recipes/create`
- Fill in title, ingredients, steps, and optionally upload multiple images
- Images are stored in `storage/app/public/recipes/`
- Thumbnails (300px wide) are auto-generated using PHP GD
- Make sure `php artisan storage:link` has been run, otherwise images won't display
