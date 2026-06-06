<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Website extends BaseController
{
    public function show($id)
    {
        $db = \Config\Database::connect();

        $website = $db->table('website')->where('id', $id)->get()->getRow();

        $hashingFunctions = $db->table('website_has_hashing_function')
            ->select('hashing_function.name')
            ->join('hashing_function', 'hashing_function.id = website_has_hashing_function.hashing_function_id', 'inner')
            ->where('website_has_hashing_function.website_id', $id)
            ->get()
            ->getResult();

        $leakedPasswordsCount = $db->table('password')
            ->where('website_id', $id)
            ->countAllResults();

        return view('websites/show', [
            'website' => $website,
            'hashingFunctions' => $hashingFunctions,
            'leakedPasswordsCount' => $leakedPasswordsCount
        ]);
    }
}