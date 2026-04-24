<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            IngredientAlternativesSeeder::class,  // seed alternatives first (no user dependency)
            RecipeSeeder::class,                   // creates admin user + 6 recipes with images
            AlternativeReviewSeeder::class,        // creates demo users + reviews (depends on admin user)
        ]);

        $this->command->info('');
        $this->command->info('🎉 All data seeded successfully!');
        $this->command->info('');
        $this->command->info('Admin login → email: admin@smartrecipes.com | password: password123');
        $this->command->info('Demo users → sara@example.com, ali@example.com, hina@example.com | password: password123');
    }
}
