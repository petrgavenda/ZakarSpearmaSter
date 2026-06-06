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
                website.id AS website_id,
                search_people.firstname AS finder_firstname, 
                search_people.lastname AS finder_lastname,
                search_people.id AS finder_id
            ')
            ->join('website', 'website.id = password.website_id', 'left')
            ->join('search_people', 'search_people.id = password.search_people_id', 'left')
            ->paginate($limit);

        $pager = $this->passwordModel->pager;

        return view('passwords/index', [
            'passwords' => $passwords, 
            'pager' => $pager, 
            'websites' => $this->websiteModel->findAll(), 
            'people' => $this->peopleModel->findAll()
        ]);
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

    public function statistics(){
        $db = \Config\Database::connect();

        $stats = $db->table('password')
            ->select('search_people.firstname, search_people.lastname, COUNT(password.id) as total_discovered')
            ->join('search_people', 'search_people.id = password.search_people_id', 'inner')
            ->groupBy('search_people.id') 
            ->orderBy('total_discovered', 'DESC') 
            ->get()
            ->getResult();

        return view('passwords/statistics', ['stats' => $stats]);
    }

    public function filter($websiteId, $searchPeopleId){
        $passwordModel = new \App\Models\Password();
        $limit = env('PER_PAGE_PASSWORDS');

        $passwords = $passwordModel->select('
                password.id, 
                password.text, 
                website.company AS website_company, 
                search_people.firstname AS finder_firstname, 
                search_people.lastname AS finder_lastname
            ')
            ->join('website', 'website.id = password.website_id', 'left')
            ->join('search_people', 'search_people.id = password.search_people_id', 'left')
            ->where('password.website_id', $websiteId) 
            ->where('password.search_people_id', $searchPeopleId) 
            ->paginate($limit);

        return view('passwords/index', [
            'passwords' => $passwords,
            'pager'     => $passwordModel->pager,
            'websites'  => $this->websiteModel->findAll(),
            'people'    => $this->peopleModel->findAll()
        ]);
    }
    public function processFilter()
    {
        $websiteId = $this->request->getPost('website_id');
        $personId = $this->request->getPost('search_people_id');

        if (!$websiteId || !$personId) {
            return redirect()->to('/passwords')->with('error', 'Musíte vybrat web i objevitele.');
        }

        return redirect()->to('/passwords/filter/' . $websiteId . '/' . $personId);
    }
}