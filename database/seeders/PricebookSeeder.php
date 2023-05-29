<?php

namespace Database\Seeders;

use App\Models\Pricebook;
use App\Models\MaterialStatus;
use Illuminate\Database\Seeder;
use App\Models\MaterialCategory;
use App\Models\MaterialUnitSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PricebookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/material_unit_size.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, null, ",")) !== false) {
            if (!$firstline) {
                MaterialUnitSize::create([
                    "Unit_Size" => $data['0']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);

        $csvFile = fopen(base_path("database/material_category.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, null, ",")) !== false) {
            if (!$firstline) {
                MaterialCategory::create([
                    "Name" => $data['0']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);

        $csvFile = fopen(base_path("database/material_status.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, null, ",")) !== false) {
            if (!$firstline) {
                MaterialStatus::create([
                    "Status" => $data['0']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);

        Pricebook::truncate();
        $csvFile = fopen(base_path("database/pricebook.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, null, ",")) !== false) {
            if (!$firstline) {
                Pricebook::create([
                    "SKU" => $data['0'],
                    "Name" => $data['1'],
                    "fk_unit_size" => $data['2'],
                    "Price" => ($data['3'] !== 'NULL') ? $data['3'] : NULL,
                    "fk_status" => ($data['4'] !== 'NULL') ? $data['4'] : NULL,
                    "Discountable" => $data['5'],
                    "fk_category" => $data['6']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }


}