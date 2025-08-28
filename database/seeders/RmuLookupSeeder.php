<?php

namespace Database\Seeders;

use App\Models\IsoCategory;
use App\Models\RiskSource;
use App\Models\RiskType;
use Illuminate\Database\Seeder;

class RmuLookupSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Operational','Strategic','Compliance','Financial'] as $i => $name) {
            RiskType::firstOrCreate(['name'=>$name], ['sort'=>$i]);
        }
        foreach (['ISO 9001','ISO 14001','ISO 27001','ISO 45001','ISO 22301'] as $i => $name) {
            IsoCategory::firstOrCreate(['name'=>$name], ['sort'=>$i]);
        }
        foreach (['Internal','External','Third-Party','Regulatory'] as $i => $name) {
            RiskSource::firstOrCreate(['name'=>$name], ['sort'=>$i]);
        }
    }
}
