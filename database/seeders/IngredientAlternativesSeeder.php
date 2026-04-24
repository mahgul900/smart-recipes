<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IngredientAlternative;

class IngredientAlternativesSeeder extends Seeder
{
    public function run(): void
    {
        $alternatives = [
            // Egg substitutes
            ['ingredient' => 'egg',      'alternative' => 'banana (mashed)',    'notes' => 'Use 1/4 cup mashed banana per egg. Best for baking like cakes and muffins.'],
            ['ingredient' => 'egg',      'alternative' => 'yogurt',             'notes' => 'Use 3 tbsp plain yogurt per egg. Adds moisture and works well in cakes.'],
            ['ingredient' => 'egg',      'alternative' => 'chia seeds',         'notes' => 'Mix 1 tbsp chia seeds with 3 tbsp water, let sit 5 mins. Great binding agent.'],
            ['ingredient' => 'egg',      'alternative' => 'flaxseed meal',      'notes' => 'Mix 1 tbsp ground flaxseed + 3 tbsp water per egg. Works great in cookies.'],
            ['ingredient' => 'egg',      'alternative' => 'unsweetened applesauce', 'notes' => 'Use 1/4 cup per egg. Adds sweetness so reduce sugar slightly.'],

            // Milk substitutes
            ['ingredient' => 'milk',     'alternative' => 'almond milk',        'notes' => 'Works 1:1 in most recipes. Lighter taste, slightly nutty flavour.'],
            ['ingredient' => 'milk',     'alternative' => 'coconut milk',       'notes' => 'Richer and creamier. Great for curries, desserts, and smoothies.'],
            ['ingredient' => 'milk',     'alternative' => 'soy milk',           'notes' => 'Closest to dairy milk in protein. Works well in baking and cooking.'],
            ['ingredient' => 'milk',     'alternative' => 'oat milk',           'notes' => 'Creamy and slightly sweet. Perfect for tea, coffee, and baking.'],
            ['ingredient' => 'milk',     'alternative' => 'evaporated milk',    'notes' => 'Use half the amount + half water. Works well in most cooked dishes.'],

            // Butter substitutes
            ['ingredient' => 'butter',   'alternative' => 'coconut oil',        'notes' => 'Use same quantity. Adds a subtle coconut flavour. Great for baking.'],
            ['ingredient' => 'butter',   'alternative' => 'olive oil',          'notes' => 'Use 3/4 the amount of butter. Best for savory cooking, not baking.'],
            ['ingredient' => 'butter',   'alternative' => 'margarine',          'notes' => 'Direct 1:1 replacement. Works for most baking and cooking purposes.'],
            ['ingredient' => 'butter',   'alternative' => 'greek yogurt',       'notes' => 'Use half the amount. Reduces fat while keeping moisture in cakes.'],
            ['ingredient' => 'butter',   'alternative' => 'avocado',            'notes' => 'Use same quantity mashed. Adds healthy fats, works well in brownies.'],

            // Sugar substitutes
            ['ingredient' => 'sugar',    'alternative' => 'honey',              'notes' => 'Use 3/4 cup per 1 cup sugar. Reduce liquid slightly and add baking soda.'],
            ['ingredient' => 'sugar',    'alternative' => 'maple syrup',        'notes' => 'Use 3/4 cup per 1 cup sugar. Reduce other liquids by 3 tbsp.'],
            ['ingredient' => 'sugar',    'alternative' => 'stevia',             'notes' => 'Much sweeter than sugar. Use only 1 tsp per 1 cup of sugar.'],
            ['ingredient' => 'sugar',    'alternative' => 'dates (pureed)',     'notes' => 'Blend soaked dates into paste. Natural sweetener packed with nutrients.'],
            ['ingredient' => 'sugar',    'alternative' => 'jaggery (gur)',      'notes' => 'Use same amount. Rich caramel flavour, great in Pakistani desserts.'],

            // Flour substitutes
            ['ingredient' => 'flour',    'alternative' => 'almond flour',       'notes' => 'Use 1:1 but add extra egg for binding. Gluten-free and protein-rich.'],
            ['ingredient' => 'flour',    'alternative' => 'coconut flour',      'notes' => 'Use 1/4 the amount — it absorbs more liquid. Great for keto baking.'],
            ['ingredient' => 'flour',    'alternative' => 'oat flour',          'notes' => 'Blend oats into fine powder. Use 1:1 replacement for whole wheat flour.'],
            ['ingredient' => 'flour',    'alternative' => 'chickpea flour (besan)', 'notes' => 'Great for pakoras, rotis, and binding in desi cooking.'],

            // Oil substitutes
            ['ingredient' => 'oil',      'alternative' => 'butter',             'notes' => 'Use 7/8 cup butter per 1 cup oil. Adds richer flavour.'],
            ['ingredient' => 'oil',      'alternative' => 'applesauce',         'notes' => 'Use half amount. Reduces fat in baked goods while keeping them moist.'],
            ['ingredient' => 'oil',      'alternative' => 'greek yogurt',       'notes' => 'Use half the amount of oil. Adds protein and moisture to baked items.'],

            // Cream substitutes
            ['ingredient' => 'cream',    'alternative' => 'coconut cream',      'notes' => 'Use same amount. Works perfectly in curries, soups, and desserts.'],
            ['ingredient' => 'cream',    'alternative' => 'evaporated milk',    'notes' => 'Use same amount. Good for soups and sauces when cream is unavailable.'],
            ['ingredient' => 'cream',    'alternative' => 'milk + butter',      'notes' => 'Mix 3/4 cup milk + 1/3 cup melted butter to replace 1 cup cream.'],

            // Yogurt substitutes
            ['ingredient' => 'yogurt',   'alternative' => 'sour cream',         'notes' => 'Direct 1:1 swap. Works well in marinades, dips, and baked goods.'],
            ['ingredient' => 'yogurt',   'alternative' => 'buttermilk',         'notes' => 'Use same amount. Great for marinating chicken and making cakes.'],
            ['ingredient' => 'yogurt',   'alternative' => 'coconut yogurt',     'notes' => 'Dairy-free option. Works well in smoothies, dips, and marinades.'],

            // Ghee substitutes
            ['ingredient' => 'ghee',     'alternative' => 'butter',             'notes' => 'Direct 1:1 substitute. Butter has more water content but works fine.'],
            ['ingredient' => 'ghee',     'alternative' => 'coconut oil',        'notes' => 'Same quantity. High smoke point makes it great for frying like ghee.'],
            ['ingredient' => 'ghee',     'alternative' => 'olive oil',          'notes' => 'Use same amount for cooking. Healthier but changes the flavour slightly.'],

            // Salt substitutes
            ['ingredient' => 'salt',     'alternative' => 'soy sauce',          'notes' => 'Adds saltiness plus umami depth. Great in stir-fries and marinades.'],
            ['ingredient' => 'salt',     'alternative' => 'lemon juice',        'notes' => 'Brightens flavour and reduces need for salt. Great for salads.'],

            // Tomato substitutes
            ['ingredient' => 'tomato',   'alternative' => 'tomato paste + water', 'notes' => 'Mix 1 tbsp paste + 1/2 cup water to replace 1 medium tomato.'],
            ['ingredient' => 'tomato',   'alternative' => 'red bell pepper',    'notes' => 'Provides sweetness and colour. Best in curries and sauces.'],
            ['ingredient' => 'tomato',   'alternative' => 'tamarind paste',     'notes' => 'Adds sourness. Use sparingly — great in desi chutneys and curries.'],

            // Onion substitutes
            ['ingredient' => 'onion',    'alternative' => 'shallots',           'notes' => 'Milder and sweeter. Use same amount, great raw or cooked.'],
            ['ingredient' => 'onion',    'alternative' => 'leek',               'notes' => 'Use white part only. Milder taste, works in soups and cooked dishes.'],
            ['ingredient' => 'onion',    'alternative' => 'onion powder',       'notes' => 'Use 1/4 tsp powder per medium onion. Best for dry rubs and sauces.'],
        ];

        foreach ($alternatives as $alt) {
            IngredientAlternative::updateOrCreate(
                ['ingredient' => $alt['ingredient'], 'alternative' => $alt['alternative']],
                ['notes' => $alt['notes']]
            );
        }

        $this->command->info('✅ Ingredient alternatives seeded: ' . count($alternatives) . ' entries');
    }
}
