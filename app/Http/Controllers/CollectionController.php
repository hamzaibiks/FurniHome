<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectionController extends Controller
{
    private function collections()
    {
        return [
            'modern-living' => [
                'slug' => 'modern-living',
                'title' => 'Modern Living',
                'label' => 'Living Room Collection',
                'image' => 'images/collections/modern-living.png',
                'filter' => 'living-room',
                'button' => 'Explore Living Room Products',
                'description' => 'A soft and refined collection created for calm living spaces. Modern Living brings together elegant seating, warm textures, and balanced furniture pieces designed for everyday comfort.',
                'details' => [
                    'Soft curved seating',
                    'Elegant coffee tables',
                    'Warm neutral tones',
                    'Minimal luxury atmosphere',
                ],
            ],

            'bedroom-comfort' => [
                'slug' => 'bedroom-comfort',
                'title' => 'Bedroom Comfort',
                'label' => 'Bedroom Collection',
                'image' => 'images/collections/bedroom-comfort.png',
                'filter' => 'bedroom',
                'button' => 'Explore Bedroom Products',
                'description' => 'A peaceful collection made for restful interiors. Bedroom Comfort focuses on soft bedding, warm wood, calm lighting, and furniture that creates a quiet personal space.',
                'details' => [
                    'Elegant beds',
                    'Soft nightstands',
                    'Warm lighting',
                    'Relaxed neutral mood',
                ],
            ],

            'dining-elegance' => [
                'slug' => 'dining-elegance',
                'title' => 'Dining Elegance',
                'label' => 'Dining Room Collection',
                'image' => 'images/collections/dining-elegance.png',
                'filter' => 'dining-room',
                'button' => 'Explore Dining Products',
                'description' => 'A curated dining collection for refined daily moments and special gatherings. Dining Elegance combines natural materials, comfortable chairs, and balanced table designs.',
                'details' => [
                    'Dining tables',
                    'Comfortable chairs',
                    'Natural wood textures',
                    'Warm gathering atmosphere',
                ],
            ],

            'work-decor' => [
                'slug' => 'work-decor',
                'title' => 'Work & Decor',
                'label' => 'Office and Decor Collection',
                'image' => 'images/collections/work-decor.png',
                'filter' => 'office',
                'button' => 'Explore Office Products',
                'description' => 'A collection of practical workspace pieces and decorative accents. Work & Decor brings character, organization, and natural textures into modern home interiors.',
                'details' => [
                    'Home office pieces',
                    'Decor accents',
                    'Storage details',
                    'Natural visual character',
                ],
            ],
        ];
    }

    public function show($slug)
    {
        $collections = $this->collections();

        if (!array_key_exists($slug, $collections)) {
            abort(404);
        }

        $collection = $collections[$slug];

        return view('collections.show', compact('collection'));
    }
}