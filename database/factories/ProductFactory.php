<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $article = $this->faker->numberBetween(1, 1000);
        $productName = $this->getName();
        $description = $this->faker->text();
        return [
            'title' => $productName,
            'article_num' => $article,
            'price' => $this->faker->numberBetween(15, 125),
            'stock' => $this->faker->numberBetween(1, 25),
            'reorder_point' => 5,
            'image' => json_encode([
                [
                    'url' => $this->getImage(),
                    'alt' => 'Image Alt Text 1',
                ],
                [
                    'url' => $this->getImage(),
                    'alt' => 'Image Alt Text 2',
                ],
                [
                    'url' => $this->getImage(),
                    'alt' => 'Image Alt Text 3',
                ],
            ]),
            'discount' => $this->getDiscount(),
            'description' => json_encode([
                'heading' => $productName,
                'sub_heading' => $productName,
                'paragraph' => $description,
            ]),
            'barcode' => 'P' . $this->faker->numberBetween(123456789, 123726899),
            'colors' => json_encode([$this->generateRandomColorHash(), $this->generateRandomColorHash(), $this->generateRandomColorHash()]),
            'sizes' => json_encode([$this->getRandomLetter(), $this->getRandomLetter(), $this->getRandomLetter()]),
            'slug' => strtolower(str_replace(' ', '-', $productName)),
            'meta' => json_encode([
                'title' => $productName,
                'description' => $description,
                'keywords' => 'Levis 501 Jeans, Levi`s Iconic 501 Series, Classic Jeans, Denim Fashion, Straight-Leg Jeans, Button Fly, Red Color, Size M, Timeless Style, Durable Denim, Clothing, Fashion, Shop, Buy Online',
            ]),
            'sku' => $article,
        ];
    }
    function generateRandomColorHash()
    {
        $letters = '0123456789ABCDEF';
        $colorHash = '#';
        $availableIndices = range(0, 15); // Array of available indices

        for ($i = 0; $i < 6; $i++) {
            $selectedIndex = array_rand($availableIndices); // Select a random index from available indices
            $selectedValue = $availableIndices[$selectedIndex]; // Get the value at the selected index

            $colorHash .= $letters[$selectedValue]; // Append the selected value to the color hash

            // Remove the selected index from the available indices array
            unset($availableIndices[$selectedIndex]);

            // Re-index the available indices array
            $availableIndices = array_values($availableIndices);
        }

        return $colorHash;
    }
    function getDiscount() {
        $discounts = [0, 5, 10, 15];
        return $discounts[array_rand($discounts)];
    }
    function getRandomLetter()
    {
        $sizes = ['XS', 'S', 'M', 'L', 'XL', '2XL', '3XL'];

        if (empty($sizes)) {
            return null; // Return null if all sizes have been used
        }

        $selectedIndex = array_rand($sizes); // Select a random index from available sizes
        $selectedSize = $sizes[$selectedIndex]; // Get the selected size

        // Remove the selected size from the sizes array
        unset($sizes[$selectedIndex]);

        return $selectedSize;
    }
    function getName()
    {
        $names = ['Levis 501 Jeans', 'Nike Air Max Sneakers', 'Adidas Superstar Shoes', 'Lululemon Align Leggings', 'The North Face Denali Jacket', 'Patagonia Better Sweater', 'Ralph Lauren Polo Shirt', 'Converse Chuck Taylor All Star', 'Calvin Klein Underwear', 'Tommy Hilfiger Oxford Shirt', 'Sleek Denim Jacket', 'Elegant Evening Gown', 'Comfy Cashmere Sweater', 'Athletic Performance Leggings', 'Vintage Denim Overalls', 'Chic Tailored Blazer', 'Casual Weekend T-Shirt', 'Bohemian Maxi Dress'];
        return $names[array_rand($names)];
    }
    function getImage()
    {
        $names = [
            "https://i.pinimg.com/236x/fe/1b/cb/fe1bcbd442fa3534c759b9af6f396c60.jpg",
            "https://i.pinimg.com/564x/fe/1b/cb/fe1bcbd442fa3534c759b9af6f396c60.jpg",
            "https://i.pinimg.com/75x75_RS/7e/2e/54/7e2e54d706e7bb762b0de255b20a4741.jpg",
            "https://i.pinimg.com/75x75_RS/e2/f3/fa/e2f3facfd802a9bf2c8d006bafac6e2b.jpg",
            "https://i.pinimg.com/75x75_RS/70/ad/c2/70adc22291ea0eb34bb98bc45c8f2b01.jpg",
            "https://i.pinimg.com/236x/37/99/50/379950aff0bd541f13c4ed047bad9d76.jpg",
            "https://i.pinimg.com/236x/93/14/1d/93141df4bd7d865d2d0aa5711a0d07cd.jpg",
            "https://i.pinimg.com/236x/bc/58/6d/bc586d84971d11459587bf5c8b2773f9.jpg",
            "https://i.pinimg.com/236x/42/43/7e/42437e0daaea602fa7ad0ad721f18ad7.jpg",
            "https://i.pinimg.com/236x/8b/4a/06/8b4a064309ee0e15f5b94ecb4e0aab61.jpg",
            "https://i.pinimg.com/236x/8f/38/ba/8f38ba243e7566da65e1987d06802324.jpg",
            "https://i.pinimg.com/236x/3c/41/da/3c41dae4904b833833d40d76b49b3570.jpg",
            "https://i.pinimg.com/236x/17/5b/46/175b4603221fe819237cf0e463bfb50c.jpg",
            "https://i.pinimg.com/236x/b0/93/52/b09352731903e701ea7f0b39679806a4.jpg",
            "https://i.pinimg.com/236x/0a/78/ac/0a78acc0af3cf4fb6fde47781a89ba14.jpg",
            "https://i.pinimg.com/236x/11/22/3b/11223ba930eca0c2cf86de14a6da9921.jpg",
            "https://i.pinimg.com/236x/10/2b/ef/102bef07b13074c6a97b0e166245cf65.jpg",
            "https://i.pinimg.com/236x/5b/ee/c8/5beec87c1bfd2b7c3f533564b156c844.jpg",
            "https://i.pinimg.com/236x/08/c3/8c/08c38cb63896ca0254fe84dc906260cd.jpg",
            "https://i.pinimg.com/236x/f9/af/49/f9af49d6c7a4a2abbfa7f4131b38be38.jpg",
            "https://i.pinimg.com/236x/e9/06/52/e90652f62165177b19b96988be769839.jpg",
            "https://i.pinimg.com/236x/73/3e/30/733e30d2a2aa88397cb1ab67adb1e9d0.jpg",
            "https://i.pinimg.com/236x/e4/d3/f4/e4d3f442ec3c68fb6d382050f4d2c691.jpg",
            "https://i.pinimg.com/236x/00/33/ef/0033efff126d468e22d949c6a7d5f60d.jpg",
            "https://i.pinimg.com/236x/a1/ab/19/a1ab19af75c5c13a3ed88f40d0a107f7.jpg",
            "https://i.pinimg.com/236x/b6/54/c6/b654c6752a128db2439648646e0b3201.jpg",
            "https://i.pinimg.com/236x/13/69/69/1369693cae53600d6b41a2671ac27ac8.jpg",
            "https://i.pinimg.com/236x/3d/b4/7c/3db47cb8ab13097549e34e8caf8926dc.jpg",
            "https://i.pinimg.com/236x/3e/d3/6b/3ed36b0a1ee44da004908a41c46a975c.jpg",
            "https://i.pinimg.com/236x/0b/5e/c9/0b5ec902b20488161e4d837146a27ae1.jpg",
            "https://i.pinimg.com/474x/35/92/3a/35923aa366b4ec02fe7c08782e843d0e.jpg"
        ]
        ;
        return $names[array_rand($names)];
    }
}