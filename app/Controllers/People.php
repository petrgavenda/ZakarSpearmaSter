<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SearchPeople;

class People extends BaseController
{
    protected $peopleModel;

    public function __construct(){
        $this->peopleModel = new SearchPeople();
    }

    public function index()
    {
        $limit = env('PAGINATION_LIMIT', 12);

        $data = [
            'people' => $this->peopleModel->paginate($limit),
            'pager' => $this->peopleModel->pager,
        ];

        return view('people.php', $data);
    }

    public function delete($id){
        $person = $this->peopleModel->find($id);

        if($person){
            $this->peopleModel->delete($id);

            return redirect()->to('people')->with('success', 'Osoba byla úspěšně smazána.');
        }

        return redirect()->to('people')->with('error', 'Osoba nebyla smazána.');
    }

    public function create(){
        return view('create');
    }

    public function store(){
        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'lastname' => $this->request->getPost('lastname'),
            'born' => $this->request->getPost('born'),
            'biography' => $this->request->getPost('biography'),
        ];

        $file = $this->request->getFile('profile_picture');

        if($file && $file->isValid() && !$file->hasMoved()){
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/profiles' . $newName);

            $data['profile_picture'] = $newName;
        }

        if($this->peopleModel->insert($data)){
            return redirect()->to('people')->with('success', 'Osoba byla úspěšně vytvořena.');
        }else{
            return redirect()->to('people')->with('error', 'Osoba nebyla vytvořena.');
        }
    }
}
