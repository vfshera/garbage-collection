<?php

namespace Database\Seeders;

use App\Models\Waste;
use Illuminate\Database\Seeder;

class WasteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Waste::create([
            "title" => "Residual",
            "cost" => 15,
            "description" => "Single and Multifamily Dwellings Food wastes, paper, cardboard, plastics, textiles, 
            leather, yard wastes, wood, glass, metals, ashes"
        ]);


        Waste::create([
            "title" => "Industrial",
            "cost" => 22,
            "description" => "Light and heavy manufacturing, construction sites, power and chemical plants 
            Housekeeping wastes, packaging, food wastes, construction and demolition materials, hazardous 
            wastes, ashes, special waste"
        ]);


        Waste::create([
            "title" => "Commercial",
            "cost" => 25,
            "description" => "Stores, hotels, restaurants, markets, office buildings Paper, cardboard, plastics, 
            wood, food wastes, glass, metals, special wastes, hazardous wastes, e-wastes"
        ]);


        Waste::create([
            "title" => "Institutional",
            "cost" => 30,
            "description" => " Schools, hospitals (non-medical waste), prisons, government buildings, airports"
        ]);


        Waste::create([
            "title" => "Construction and Demolition",
            "cost" => 40,
            "description" => " New construction sites, road repair, renovation sites, demolition 
            of buildings Wood, steel, concrete, dirt, bricks, tiles"
        ]);



        Waste::create([
            "title" => "Municipal",
            "cost" => 35,
            "description" => " Street cleaning, landscaping, parks, beaches, other recreational areas, water 
            and waste water treatment plants ,Street sweepings, landscape and tree trimmings, general wastes 
            from parks, beaches, and other recreational areas, sludge"
        ]);


        Waste::create([
            "title" => "Process",
            "cost" => 27,
            "description" => "Heavy and light manufacturing, refineries, chemical plants, power plants, mineral 
            extraction processing ,Industrial process wastes, scrap materials, off-specification products, 
            slag"
        ]);



        Waste::create([
            "title" => "Agricultural",
            "cost" => 25,
            "description" => "Crops, orchards, vineyards, dairies, feedlots, farms Spoiled food wastes, 
            agricultural wastes , hazardous wastes"
        ]);




        Waste::create([
            "title" => "Medical",
            "cost" => 40,
            "description" => "hospitals,nursing homes , clinics"
        ]);




        Waste::create([
            "title" => "Infectious",
            "cost" => 45,
            "description" => "bandages, gloves, cultures, swabs, blood 
            and body fluids"
        ]);


        Waste::create([
            "title" => "Hazardous",
            "cost" => 50,
            "description" => "sharps, instruments, chemicals, radioactive waste"
        ]);





    }
}