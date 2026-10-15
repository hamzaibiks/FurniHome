<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class FurniHomeSeeder extends Seeder
{
    public function run(): void
    {
        $categoriesData = [
            [
                'name' => 'Living Room',
                'description' => 'Elegant sofas, coffee tables, TV stands, and lounge furniture for comfortable living spaces.',
                'image' => 'images/categories/living-room.png',
            ],
            [
                'name' => 'Bedroom',
                'description' => 'Comfortable beds, wardrobes, nightstands, and bedroom furniture for peaceful interiors.',
                'image' => 'images/categories/bedroom.png',
            ],
            [
                'name' => 'Dining Room',
                'description' => 'Dining tables, chairs, sideboards, and refined furniture for beautiful dining areas.',
                'image' => 'images/categories/dining-room.png',
            ],
            [
                'name' => 'Office',
                'description' => 'Desks, ergonomic chairs, bookshelves, and workspace furniture for productive home offices.',
                'image' => 'images/categories/office.png',
            ],
            [
                'name' => 'Storage',
                'description' => 'Smart storage cabinets, drawers, shelves, and organized furniture solutions.',
                'image' => 'images/categories/storage.png',
            ],
            [
                'name' => 'Chairs',
                'description' => 'Accent chairs, lounge chairs, dining chairs, and seating pieces for every room.',
                'image' => 'images/categories/chairs.png',
            ],
            [
                'name' => 'Lighting',
                'description' => 'Floor lamps, table lamps, and wall lighting to create a warm home atmosphere.',
                'image' => 'images/categories/lighting.png',
            ],
            [
                'name' => 'Decor',
                'description' => 'Mirrors, rugs, vases, and decorative accessories to complete your home style.',
                'image' => 'images/categories/decor.png',
            ],
        ];

        $categories = [];

        foreach ($categoriesData as $categoryData) {
            $category = Category::updateOrCreate(
                ['name' => $categoryData['name']],
                [
                    'description' => $categoryData['description'],
                    'image' => $categoryData['image'],
                ]
            );

            $categories[$categoryData['name']] = $category;
        }

        $products = [
            [
                'category' => 'Living Room',
                'folder' => 'modern-sofa',
                'name' => 'Modern Sofa',
                'description' => 'A comfortable modern sofa designed with clean lines and soft upholstery for elegant living rooms.',
                'price' => 4200,
                'old_price' => 4800,
                'material' => 'Fabric and solid wood',
                'width' => 220,
                'height' => 85,
                'depth' => 95,
                'weight' => 45,
            ],
            [
                'category' => 'Living Room',
                'folder' => 'wooden-coffee-table',
                'name' => 'Wooden Coffee Table',
                'description' => 'A warm wooden coffee table with a minimal design, perfect for modern living room styling.',
                'price' => 1200,
                'old_price' => 1450,
                'material' => 'Natural wood',
                'width' => 110,
                'height' => 42,
                'depth' => 60,
                'weight' => 18,
            ],
            [
                'category' => 'Living Room',
                'folder' => 'tv-stand',
                'name' => 'TV Stand',
                'description' => 'A modern TV stand with practical storage space and a refined design for living room setups.',
                'price' => 1800,
                'old_price' => 2100,
                'material' => 'Engineered wood',
                'width' => 160,
                'height' => 50,
                'depth' => 40,
                'weight' => 28,
            ],

            [
                'category' => 'Bedroom',
                'folder' => 'bed-frame',
                'name' => 'Bed Frame',
                'description' => 'A modern bed frame with a refined structure, designed to create a calm and elegant bedroom.',
                'price' => 3500,
                'old_price' => 4000,
                'material' => 'Wood and upholstered fabric',
                'width' => 160,
                'height' => 110,
                'depth' => 200,
                'weight' => 55,
            ],
            [
                'category' => 'Bedroom',
                'folder' => 'wardrobe',
                'name' => 'Wardrobe',
                'description' => 'A spacious wardrobe with a clean modern design for organized and elegant bedroom storage.',
                'price' => 3900,
                'old_price' => 4500,
                'material' => 'Engineered wood',
                'width' => 180,
                'height' => 220,
                'depth' => 60,
                'weight' => 85,
            ],
            [
                'category' => 'Bedroom',
                'folder' => 'nightstand',
                'name' => 'Nightstand',
                'description' => 'A compact bedside nightstand with elegant storage and a warm modern finish.',
                'price' => 750,
                'old_price' => 900,
                'material' => 'Wood',
                'width' => 45,
                'height' => 55,
                'depth' => 40,
                'weight' => 10,
            ],

            [
                'category' => 'Dining Room',
                'folder' => 'dining-table',
                'name' => 'Dining Table',
                'description' => 'A refined dining table designed for family meals, modern interiors, and elegant dining rooms.',
                'price' => 3200,
                'old_price' => 3700,
                'material' => 'Oak wood',
                'width' => 180,
                'height' => 76,
                'depth' => 90,
                'weight' => 48,
            ],
            [
                'category' => 'Dining Room',
                'folder' => 'chair',
                'name' => 'Dining Chair',
                'description' => 'A comfortable dining chair with a modern profile and refined finish for stylish dining spaces.',
                'price' => 650,
                'old_price' => 800,
                'material' => 'Wood and fabric',
                'width' => 48,
                'height' => 86,
                'depth' => 52,
                'weight' => 7,
            ],
            [
                'category' => 'Dining Room',
                'folder' => 'sideboard',
                'name' => 'Sideboard',
                'description' => 'A modern sideboard with storage space, ideal for dining rooms and elegant interior organization.',
                'price' => 2800,
                'old_price' => 3300,
                'material' => 'Wood',
                'width' => 150,
                'height' => 80,
                'depth' => 45,
                'weight' => 42,
            ],
            [
                'category' => 'Dining Room',
                'folder' => 'bar-chair',
                'name' => 'Bar Chair',
                'description' => 'A stylish bar chair suitable for kitchen islands, counters, and modern dining corners.',
                'price' => 600,
                'old_price' => 750,
                'material' => 'Metal, wood, and fabric',
                'width' => 45,
                'height' => 105,
                'depth' => 50,
                'weight' => 9,
            ],

            [
                'category' => 'Office',
                'folder' => 'office',
                'name' => 'Office Desk',
                'description' => 'A refined office desk with a practical surface, perfect for modern home workspaces.',
                'price' => 2100,
                'old_price' => 2500,
                'material' => 'Wood and metal',
                'width' => 140,
                'height' => 76,
                'depth' => 70,
                'weight' => 35,
            ],
            [
                'category' => 'Office',
                'folder' => 'ergonomic-chair',
                'name' => 'Ergonomic Chair',
                'description' => 'A comfortable ergonomic office chair designed for support, productivity, and daily work.',
                'price' => 1300,
                'old_price' => 1600,
                'material' => 'Mesh, fabric, and metal',
                'width' => 62,
                'height' => 115,
                'depth' => 60,
                'weight' => 14,
            ],
            [
                'category' => 'Office',
                'folder' => 'bookshelf',
                'name' => 'Bookshelf',
                'description' => 'A modern bookshelf with open storage for books, decor, and organized home office styling.',
                'price' => 1600,
                'old_price' => 1900,
                'material' => 'Wood',
                'width' => 90,
                'height' => 180,
                'depth' => 35,
                'weight' => 30,
            ],

            [
                'category' => 'Storage',
                'folder' => 'drawer',
                'name' => 'Drawer Chest',
                'description' => 'A practical drawer chest with multiple storage compartments for bedrooms and living spaces.',
                'price' => 1400,
                'old_price' => 1700,
                'material' => 'Engineered wood',
                'width' => 85,
                'height' => 100,
                'depth' => 45,
                'weight' => 32,
            ],
            [
                'category' => 'Storage',
                'folder' => 'wallshelf',
                'name' => 'Wall Shelf',
                'description' => 'A clean wall shelf for displaying decor, books, and small essentials in modern interiors.',
                'price' => 650,
                'old_price' => 800,
                'material' => 'Wood',
                'width' => 100,
                'height' => 30,
                'depth' => 25,
                'weight' => 8,
            ],

            [
                'category' => 'Chairs',
                'folder' => 'arm-chair',
                'name' => 'Arm Chair',
                'description' => 'A refined arm chair with a comfortable shape, ideal for living rooms, bedrooms, and reading areas.',
                'price' => 1450,
                'old_price' => 1750,
                'material' => 'Wood and fabric',
                'width' => 72,
                'height' => 85,
                'depth' => 78,
                'weight' => 15,
            ],
            [
                'category' => 'Chairs',
                'folder' => 'lounge-chair',
                'name' => 'Lounge Chair',
                'description' => 'A premium lounge chair with a soft seat and elegant design for comfortable home corners.',
                'price' => 1700,
                'old_price' => 1950,
                'material' => 'Fabric and wood',
                'width' => 75,
                'height' => 82,
                'depth' => 80,
                'weight' => 16,
            ],

            [
                'category' => 'Lighting',
                'folder' => 'floor-lamp',
                'name' => 'Floor Lamp',
                'description' => 'A modern floor lamp that adds warm ambient lighting and elegance to any room.',
                'price' => 850,
                'old_price' => 1000,
                'material' => 'Metal and fabric',
                'width' => 35,
                'height' => 160,
                'depth' => 35,
                'weight' => 6,
            ],
            [
                'category' => 'Lighting',
                'folder' => 'table-lamp',
                'name' => 'Table Lamp',
                'description' => 'A decorative table lamp with a soft glow, ideal for bedrooms, side tables, and reading spaces.',
                'price' => 450,
                'old_price' => 600,
                'material' => 'Ceramic and fabric',
                'width' => 30,
                'height' => 50,
                'depth' => 30,
                'weight' => 4,
            ],
            [
                'category' => 'Lighting',
                'folder' => 'wall-lamp',
                'name' => 'Wall Lamp',
                'description' => 'A stylish wall lamp designed to add warm lighting and visual comfort to modern interiors.',
                'price' => 500,
                'old_price' => 650,
                'material' => 'Metal and glass',
                'width' => 25,
                'height' => 35,
                'depth' => 18,
                'weight' => 3,
            ],

            [
                'category' => 'Decor',
                'folder' => 'mirror',
                'name' => 'Wall Mirror',
                'description' => 'A decorative wall mirror that brings brightness, depth, and elegance to modern home spaces.',
                'price' => 700,
                'old_price' => 850,
                'material' => 'Glass and metal frame',
                'width' => 80,
                'height' => 100,
                'depth' => 4,
                'weight' => 9,
            ],
            [
                'category' => 'Decor',
                'folder' => 'rug',
                'name' => 'Area Rug',
                'description' => 'A soft area rug that adds comfort, texture, and warmth to living rooms and bedrooms.',
                'price' => 1100,
                'old_price' => 1350,
                'material' => 'Woven textile',
                'width' => 200,
                'height' => 2,
                'depth' => 300,
                'weight' => 12,
            ],
            [
                'category' => 'Decor',
                'folder' => 'vase',
                'name' => 'Decorative Vase Set',
                'description' => 'A refined decorative vase set for shelves, tables, consoles, and elegant interior styling.',
                'price' => 350,
                'old_price' => 450,
                'material' => 'Ceramic',
                'width' => 25,
                'height' => 40,
                'depth' => 25,
                'weight' => 3,
            ],
        ];

        foreach ($products as $productData) {
            $folder = $productData['folder'];

            $product = Product::updateOrCreate(
                ['name' => $productData['name']],
                [
                    'category_id' => $categories[$productData['category']]->id,
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'old_price' => $productData['old_price'],
                    'material' => $productData['material'],
                    'color' => 'Multiple variants',
                    'width' => $productData['width'],
                    'height' => $productData['height'],
                    'depth' => $productData['depth'],
                    'weight' => $productData['weight'],
                    'stock_quantity' => 15,
                    'status' => 'available',
                    'main_image' => "images/products/{$folder}/variant-1.jpg",
                ]
            );

            $variantImages = [
                1 => "images/products/{$folder}/variant-1.jpg",
                2 => "images/products/{$folder}/variant-2.png",
                3 => "images/products/{$folder}/variant-3.png",
            ];

            for ($i = 1; $i <= 3; $i++) {
                ProductVariant::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'color_name' => "Variant {$i}",
                    ],
                    [
                        'color_code' => null,
                        'image' => $variantImages[$i],
                        'stock_quantity' => 5,
                        'price' => null,
                    ]
                );
            }
        }
    }
}