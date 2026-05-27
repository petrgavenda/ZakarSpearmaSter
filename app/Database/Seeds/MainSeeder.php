<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        $websiteFile = ROOTPATH . 'Romske_tabulky/website.sql';
        $searchPeopleFile = ROOTPATH . 'Romske_tabulky/search_people.sql';
        $hashFunctionFile = ROOTPATH . 'Romske_tabulky/import_hash_function.sql';
        $websiteHasHashingFunctionFile = ROOTPATH . 'Romske_tabulky/website_has_hashing_function.sql';
        $passwordFile = ROOTPATH . 'Romske_tabulky/import_password.sql';

        $sqlFiles = [
            $websiteFile,
            $searchPeopleFile,
            $hashFunctionFile,
            $passwordFile,
            $websiteHasHashingFunctionFile
        ];

        foreach($sqlFiles as $file){
            if(file_exists($file)){
                $sql = file_get_contents($file);
                $this->db->query($sql);

                echo "File: " . basename($file) . " imported successfully.\n";
            }else{
                echo "Import of " . basename($file) . " failed.\n";
            }
        }
    }
}
