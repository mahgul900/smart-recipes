<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\RecipeImage;
use App\Models\User;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        // Make sure an admin/demo user exists
        $user = User::firstOrCreate(
            ['email' => 'admin@smartrecipes.com'],
            [
                'name'     => 'Smart Recipes Admin',
                'password' => bcrypt('password123'),
                'is_admin' => true,
            ]
        );

        $recipes = [
            [
                'title'       => 'Chicken Biryani',
                'image'       => 'biryani.jpg',
                'ingredients' => "500g basmati rice
800g chicken pieces (bone-in)
2 large onions, thinly sliced
1 cup plain yogurt
4 tbsp oil or ghee
2 tsp biryani masala
1 tsp cumin seeds
4 cloves garlic, minced
1 inch ginger, grated
2 tomatoes, chopped
1/2 cup fresh mint leaves
1/2 cup fresh coriander leaves
4 green cardamoms
2 black cardamoms
1 cinnamon stick
4 cloves
Salt to taste
A pinch of saffron in 1/4 cup warm milk",
                'steps'       => "1. Wash and soak basmati rice for 30 minutes. Drain and set aside.

2. Heat oil in a heavy-bottomed pot. Fry onions until golden brown and crispy. Remove half and set aside for garnish.

3. In the same pot, add cumin seeds, cardamoms, cinnamon and cloves. Sauté for 30 seconds.

4. Add garlic and ginger paste. Cook for 2 minutes until raw smell disappears.

5. Add chicken pieces and fry on high heat for 5 minutes until lightly browned.

6. Add tomatoes, biryani masala and salt. Cook until tomatoes soften and oil separates.

7. Stir in yogurt, half the mint and half the coriander. Cook on medium heat for 10 minutes.

8. Parboil the rice in salted boiling water until 70% cooked. Drain.

9. Layer parboiled rice over the chicken. Drizzle saffron milk on top. Add remaining mint and coriander.

10. Cover tightly with foil and then the lid. Cook on low heat (dum) for 25 minutes.

11. Gently mix before serving. Garnish with fried onions and serve hot with raita.",
            ],
            [
                'title'       => 'Chicken Karahi',
                'image'       => 'karahi.jpg',
                'ingredients' => "1 kg chicken, cut into pieces
4 tbsp oil
3 medium tomatoes, roughly chopped
4 cloves garlic, minced
1 inch ginger, julienned
2 green chillies, slit
1 tsp cumin seeds
1 tsp coriander powder
1/2 tsp turmeric
1 tsp red chilli powder
1/2 tsp garam masala
Salt to taste
Fresh coriander and ginger for garnish",
                'steps'       => "1. Heat oil in a karahi or wok on high heat until smoking hot.

2. Add chicken pieces and fry on high flame for 8–10 minutes, turning frequently, until edges start to brown.

3. Add garlic and half the ginger. Stir fry for 2 minutes.

4. Add tomatoes and all dry spices: cumin, coriander, turmeric, red chilli, and salt.

5. Cook on high flame, stirring constantly, for 10 minutes until tomatoes break down and oil separates.

6. Reduce heat to medium. Add green chillies and cook for another 5 minutes until chicken is fully tender.

7. Sprinkle garam masala and mix well.

8. Garnish with fresh coriander, julienned ginger, and green chillies.

9. Serve hot directly from the karahi with naan or chapati.",
            ],
            [
                'title'       => 'Daal Makhani',
                'image'       => 'daal.jpg',
                'ingredients' => "1 cup whole black lentils (urad daal)
1/4 cup rajma (kidney beans)
3 tbsp butter
1 tbsp oil
1 large onion, finely chopped
3 cloves garlic, minced
1 inch ginger, grated
2 tomatoes, pureed
1/2 cup fresh cream
1 tsp cumin seeds
1 tsp coriander powder
1/2 tsp red chilli powder
1/2 tsp garam masala
Salt to taste
Fresh coriander for garnish",
                'steps'       => "1. Wash lentils and rajma. Soak overnight in plenty of water.

2. Pressure cook with 4 cups water and salt for 6–8 whistles until completely soft. Set aside without draining.

3. Heat butter and oil in a pan. Add cumin seeds and let them splutter.

4. Add onions and fry until deep golden brown — this is important for flavour.

5. Add garlic and ginger. Cook for 2 minutes.

6. Add tomato puree, coriander powder, and red chilli powder. Cook until oil separates, about 8 minutes.

7. Pour in the cooked lentils with their water. Mix well and simmer on low heat for 20–25 minutes, stirring occasionally.

8. Add fresh cream and garam masala. Simmer for another 5 minutes.

9. Adjust consistency — daal makhani should be thick and creamy.

10. Serve hot garnished with a swirl of cream and fresh coriander alongside rice or naan.",
            ],
            [
                'title'       => 'Suji Halwa (Semolina Dessert)',
                'image'       => 'halwa.jpg',
                'ingredients' => "1 cup semolina (suji / rawa)
3/4 cup sugar
3 tbsp ghee
2.5 cups water
1/4 cup milk
1/4 tsp cardamom powder
10 cashews
10 almonds, sliced
10 raisins
A pinch of saffron (optional)
A few drops of kewra essence (optional)",
                'steps'       => "1. Heat water in a pan, add sugar and stir until dissolved. Add milk and bring to a gentle simmer. Keep warm.

2. Heat ghee in a heavy pan on medium heat. Add cashews, almonds, and raisins. Fry for 2 minutes until lightly golden. Remove and set aside.

3. In the same ghee, add semolina. Roast on medium-low heat, stirring continuously, for 8–10 minutes until it turns golden and gives off a nutty aroma.

4. Carefully pour the warm sugar-water mixture into the roasted semolina. It will splutter — be careful!

5. Stir continuously to prevent lumps from forming.

6. Add cardamom powder and saffron if using. Mix well.

7. Cover and cook on low heat for 3–4 minutes until water is fully absorbed and halwa leaves the sides of the pan.

8. Add kewra essence if using. Mix gently.

9. Garnish with the fried nuts and raisins.

10. Serve hot. Halwa is best enjoyed fresh.",
            ],
            [
                'title'       => 'Beef Nihari',
                'image'       => 'nihari.jpg',
                'ingredients' => "1 kg beef shank or nihari cut
4 tbsp oil or ghee
2 large onions, thinly sliced
1/4 cup whole wheat flour (aata)
3 tbsp nihari masala (store-bought or homemade)
1 tsp ginger powder
1 tsp fennel seeds (saunf)
Salt to taste
Water as needed
For garnish: fresh ginger julienned, green chillies, fresh coriander, fried onions, lemon wedges",
                'steps'       => "1. Heat oil in a large heavy pot. Fry onions until deep golden brown. Remove and set aside.

2. In the same oil, add beef and fry on high heat for 5 minutes until sealed.

3. Add nihari masala, ginger powder, fennel seeds, and salt. Mix well.

4. Add fried onions back to the pot. Add enough water to fully cover the meat (about 4–5 cups).

5. Bring to a boil, then reduce to the lowest heat. Cover tightly and cook for 3–4 hours, or until meat is fall-off-the-bone tender. Check occasionally and add water if needed.

6. Mix flour with 1/2 cup water to make a smooth paste. Slowly stir into the nihari to thicken the gravy.

7. Simmer for another 15–20 minutes, stirring gently, until gravy reaches a thick, silky consistency.

8. Adjust salt as needed.

9. Serve in deep bowls, generously garnished with ginger, green chillies, fried onions, fresh coriander and a squeeze of lemon.

10. Best enjoyed with naan or kulcha for breakfast or brunch.",
            ],
            [
                'title'       => 'Rice Kheer',
                'image'       => 'kheer.jpg',
                'ingredients' => "1.5 litres full-fat milk
1/4 cup basmati rice
1/2 cup sugar (adjust to taste)
1/4 tsp cardamom powder
10 almonds, blanched and sliced
10 pistachios, sliced
10 cashews, halved
1 tbsp raisins
A pinch of saffron in 2 tbsp warm milk
1 tsp rose water (optional)
Silver leaf (warq) for garnish — optional",
                'steps'       => "1. Wash basmati rice and soak for 30 minutes. Drain.

2. Bring milk to a boil in a heavy-bottomed pan, stirring constantly to avoid sticking.

3. Add drained rice to the boiling milk. Reduce heat to medium-low.

4. Stir frequently and cook for 35–45 minutes until rice is completely soft and milk thickens considerably. Scrape the sides of the pan as you go — that malai adds richness.

5. Add sugar and stir until fully dissolved. Cook for another 5 minutes.

6. Add cardamom powder, saffron milk, and most of the nuts and raisins. Reserve some for garnish.

7. Add rose water if using. Mix gently.

8. Remove from heat. Kheer thickens further as it cools.

9. Serve warm or chilled. Chilled kheer is especially delicious in summer.

10. Garnish with reserved nuts, pistachios, and silver leaf before serving.",
            ],
        ];

        foreach ($recipes as $data) {
            $recipe = Recipe::create([
                'user_id'     => $user->id,
                'title'       => $data['title'],
                'ingredients' => $data['ingredients'],
                'steps'       => $data['steps'],
            ]);

            // Attach the image from storage
            RecipeImage::create([
                'recipe_id' => $recipe->id,
                'path'      => 'recipes/' . $data['image'],
            ]);

            $this->command->info("✅ Added recipe: {$data['title']}");
        }
    }
}
