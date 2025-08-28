<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RiskType;
use App\Models\RiskTaxonomy;
use App\Models\IsoCategory;

class ReferenceSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Strategic', 'Operational', 'Financial', 'Compliance', 'Reputational'] as $v) {
            RiskType::firstOrCreate(['name' => $v]);
        }

        foreach (['Cybersecurity', 'Data Privacy', 'Supply Chain', 'HSE', 'Project Delivery'] as $v) {
            RiskTaxonomy::firstOrCreate(['name' => $v]);
        }

        foreach (['ISO 31000', 'ISO 27001', 'ISO 9001', 'ISO 14001', 'ISO 45001', 'ISO 22301'] as $v) {
            IsoCategory::firstOrCreate(['name' => $v]);
        }
        {
             $this->call(\Database\Seeders\ReferenceSeeder::class);
        }
    }
}
