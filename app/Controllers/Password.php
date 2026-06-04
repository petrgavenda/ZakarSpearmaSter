<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Website;
use App\Models\SearchPeople;

class Password extends BaseController
{
    protected $peopleModel;
    protected $websiteModel;
    protected $passwordModel;

    public function __construct(){
        $this->peopleModel = new SearchPeople();
        $this->websiteModel = new Website();
        $this->passwordModel = new \App\Models\Password();
    }

    public function index(){
        $limit = env('PER_PAGE_PASSWORDS');

        $passwords = $this->passwordModel->select('
                password.id, 
                password.text, 
                website.company AS website_company, 
                search_people.firstname AS finder_firstname, 
                search_people.lastname AS finder_lastname
            ')
            ->join('website', 'website.id = password.website_id', 'left')
            ->join('search_people', 'search_people.id = password.search_people_id', 'left')
            ->paginate($limit);

        $pager = $this->passwordModel->pager;

        return view('passwords/index', ['passwords' => $passwords, 'pager' => $pager]);
    }
    public function create()
    {
        $data = [
            'websites' => $this->websiteModel->findAll(),
            'people'   => $this->peopleModel->findAll()
        ];

        return view('passwords/create', $data);
    }

    public function store(){
        $plainPassword = $this->request->getPost('password_value');
        $websiteId = $this->request->getPost('website_id');
        $searchPeopleId = $this->request->getPost('search_people_id');

        $data = [
            'website_id'       => $websiteId,
            'search_people_id' => $searchPeopleId,
            'text'             => $plainPassword, 
            'hash_md5'         => hash('md5', $plainPassword),
            'hash_sha256'      => hash('sha256', $plainPassword),
            'hash_ripemd'      => hash('ripemd160', $plainPassword)
        ];

        $this->passwordModel->insert($data);

        return redirect()->to(base_url('passwords'))->with('success', 'Heslo bylo úspěšně zaznamenáno a zahašováno.');
    }
}