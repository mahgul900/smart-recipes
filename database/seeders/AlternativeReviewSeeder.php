<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlternativeReview;
use App\Models\User;

class AlternativeReviewSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'admin@smartrecipes.com')->first();

        // Create a couple of extra demo users for realistic reviews
        $user2 = User::firstOrCreate(
            ['email' => 'sara@example.com'],
            ['name' => 'Sara Ahmed', 'password' => bcrypt('password123')]
        );
        $user3 = User::firstOrCreate(
            ['email' => 'ali@example.com'],
            ['name' => 'Ali Raza', 'password' => bcrypt('password123')]
        );
        $user4 = User::firstOrCreate(
            ['email' => 'hina@example.com'],
            ['name' => 'Hina Khan', 'password' => bcrypt('password123')]
        );

        $reviews = [
            // Egg alternatives
            ['user_id' => $user->id,  'ingredient' => 'egg', 'alternative' => 'banana (mashed)',    'stars' => 4, 'comment' => 'Worked really well in banana bread! Did add a slight banana taste but that was fine for me.'],
            ['user_id' => $user2->id, 'ingredient' => 'egg', 'alternative' => 'banana (mashed)',    'stars' => 3, 'comment' => 'Okay for muffins but the texture was a bit dense. Good if you have no eggs though.'],
            ['user_id' => $user3->id, 'ingredient' => 'egg', 'alternative' => 'chia seeds',         'stars' => 5, 'comment' => 'Amazing! Used in chocolate chip cookies and no one could tell the difference.'],
            ['user_id' => $user4->id, 'ingredient' => 'egg', 'alternative' => 'yogurt',             'stars' => 4, 'comment' => 'Used in a cake recipe — it came out very moist. Will use again!'],
            ['user_id' => $user2->id, 'ingredient' => 'egg', 'alternative' => 'flaxseed meal',      'stars' => 5, 'comment' => 'My go-to egg replacement for baking. Holds together perfectly.'],

            // Milk alternatives
            ['user_id' => $user->id,  'ingredient' => 'milk', 'alternative' => 'coconut milk',     'stars' => 5, 'comment' => 'Perfect in kheer and halwa. Adds a lovely creaminess.'],
            ['user_id' => $user3->id, 'ingredient' => 'milk', 'alternative' => 'almond milk',      'stars' => 4, 'comment' => 'Works well in tea and baking. Slightly thinner than regular milk.'],
            ['user_id' => $user4->id, 'ingredient' => 'milk', 'alternative' => 'oat milk',         'stars' => 5, 'comment' => 'The creamiest dairy-free option! Great in chai and porridge.'],
            ['user_id' => $user2->id, 'ingredient' => 'milk', 'alternative' => 'soy milk',         'stars' => 3, 'comment' => 'A bit of a strong taste on its own but fine in recipes where other flavours dominate.'],

            // Butter alternatives
            ['user_id' => $user->id,  'ingredient' => 'butter', 'alternative' => 'coconut oil',    'stars' => 5, 'comment' => 'Fantastic in cookies and halwa. Gives a subtle coconut aroma.'],
            ['user_id' => $user3->id, 'ingredient' => 'butter', 'alternative' => 'olive oil',      'stars' => 4, 'comment' => 'Works perfectly for sautéing and in savory dishes. Would not use for sweets.'],
            ['user_id' => $user4->id, 'ingredient' => 'butter', 'alternative' => 'avocado',        'stars' => 4, 'comment' => 'Used in brownies — they came out incredibly fudgy and rich!'],
            ['user_id' => $user2->id, 'ingredient' => 'butter', 'alternative' => 'greek yogurt',   'stars' => 3, 'comment' => 'Reduces the richness a bit but good for a lighter option in cakes.'],

            // Sugar alternatives
            ['user_id' => $user->id,  'ingredient' => 'sugar', 'alternative' => 'honey',           'stars' => 5, 'comment' => 'Love using honey in my chai and baking. Adds a beautiful floral sweetness.'],
            ['user_id' => $user3->id, 'ingredient' => 'sugar', 'alternative' => 'jaggery (gur)',   'stars' => 5, 'comment' => 'Best for desi desserts! The caramel richness of gur is unmatched in kheer and halwa.'],
            ['user_id' => $user4->id, 'ingredient' => 'sugar', 'alternative' => 'dates (pureed)',  'stars' => 4, 'comment' => 'Naturally sweet and nutritious. Works brilliantly in energy balls and smoothies.'],
            ['user_id' => $user2->id, 'ingredient' => 'sugar', 'alternative' => 'maple syrup',     'stars' => 4, 'comment' => 'Lovely in pancakes and oatmeal. Remember to reduce other liquids slightly.'],

            // Flour alternatives
            ['user_id' => $user->id,  'ingredient' => 'flour', 'alternative' => 'chickpea flour (besan)', 'stars' => 5, 'comment' => 'Essential in Pakistani cooking! Pakoras, batter, binding — besan does it all.'],
            ['user_id' => $user3->id, 'ingredient' => 'flour', 'alternative' => 'almond flour',    'stars' => 4, 'comment' => 'Great for gluten-free baking. Gives a slightly denser but very moist result.'],
            ['user_id' => $user4->id, 'ingredient' => 'flour', 'alternative' => 'oat flour',       'stars' => 4, 'comment' => 'Easy to make at home — just blend oats! Works well in cookies and pancakes.'],

            // Ghee alternatives
            ['user_id' => $user->id,  'ingredient' => 'ghee', 'alternative' => 'coconut oil',      'stars' => 4, 'comment' => 'Good substitute for high-heat cooking. Has a similar smoke point to ghee.'],
            ['user_id' => $user2->id, 'ingredient' => 'ghee', 'alternative' => 'butter',           'stars' => 3, 'comment' => 'Works fine but butter has more moisture so it can change some textures.'],

            // Cream alternatives
            ['user_id' => $user3->id, 'ingredient' => 'cream', 'alternative' => 'coconut cream',   'stars' => 5, 'comment' => 'Absolutely delicious in curries. Rich and thick — almost better than dairy cream!'],
            ['user_id' => $user4->id, 'ingredient' => 'cream', 'alternative' => 'evaporated milk', 'stars' => 4, 'comment' => 'A great budget-friendly substitute. Works really well in pasta sauces and soups.'],

            // Tomato alternatives
            ['user_id' => $user->id,  'ingredient' => 'tomato', 'alternative' => 'tomato paste + water', 'stars' => 4, 'comment' => 'Perfect when fresh tomatoes are not available. Adjust the water to get the right consistency.'],
            ['user_id' => $user2->id, 'ingredient' => 'tomato', 'alternative' => 'tamarind paste', 'stars' => 5, 'comment' => 'Adds such a nice tangy depth to curries and chutneys. A staple in my kitchen!'],

            // Yogurt alternatives
            ['user_id' => $user3->id, 'ingredient' => 'yogurt', 'alternative' => 'sour cream',     'stars' => 4, 'comment' => 'Works perfectly as a marinade for chicken. Very similar texture and tang.'],
            ['user_id' => $user4->id, 'ingredient' => 'yogurt', 'alternative' => 'buttermilk',     'stars' => 5, 'comment' => 'The best substitute for marinating! Makes chicken incredibly tender and juicy.'],
        ];

        foreach ($reviews as $review) {
            AlternativeReview::updateOrCreate(
                [
                    'user_id'     => $review['user_id'],
                    'ingredient'  => $review['ingredient'],
                    'alternative' => $review['alternative'],
                ],
                [
                    'stars'   => $review['stars'],
                    'comment' => $review['comment'],
                ]
            );
        }

        $this->command->info('✅ Alternative reviews seeded: ' . count($reviews) . ' reviews');
    }
}
