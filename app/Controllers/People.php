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
        $limit = env('PER_PAGE_PEOPLE'); 

        $data = [
            'people' => $this->peopleModel->paginate($limit),
            'pager' => $this->peopleModel->pager,
        ];

        return view('people/people', $data);
    }

    public function delete($id){
        $person = $this->peopleModel->find($id);

        if($person){
            $this->peopleModel->delete($id);

            return redirect()->to(base_url('people'))->with('success', 'Osoba byla úspěšně smazána.');
        }

        return redirect()->to(base_url('people'))->with('error', 'Osoba nebyla smazána.');
    }

    public function create(){
        return view('people/create');
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
            $file->move(FCPATH . 'uploads/profiles', $newName);

            $data['profile_picture'] = $newName; 
        }

        if($this->peopleModel->insert($data)){
            return redirect()->to(base_url('people'))->with('success', 'Osoba byla úspěšně vytvořena.');
        }else{
            return redirect()->back()->withInput()->with('error', 'Osoba nebyla vytvořena.');
        }
    }

    public function edit($id){
        helper('form');

        $person = $this->peopleModel->find($id);

        if(!$person){
            return redirect()->to(base_url('people'))->with('error', 'Osoba nebyla nalezena.');
        }

        return view('people/edit', ['person' => $person]);
    }

    public function update($id){
        $person = $this->peopleModel->find($id);

        if(!$person){
            return redirect()->to(base_url('people'))->with('error', 'Osoba nebyla nalezena.');
        }

        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'lastname' => $this->request->getPost('lastname'),
            'born' => $this->request->getPost('born'),
            'biography' => $this->request->getPost('biography'),
        ];

        $file = $this->request->getFile('profile_picture');

        if($file && $file->isValid() && !$file->hasMoved()){
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/profiles', $newName);

            if($person['profile_picture']){
                unlink(FCPATH . 'uploads/profiles/' . $person['profile_picture']);
            }

            $data['profile_picture'] = $newName; 
        }

        if($this->peopleModel->update($id, $data)){
            return redirect()->to(base_url('people'))->with('success', 'Osoba byla úspěšně aktualizována.');
        }else{
            return redirect()->back()->withInput()->with('error', 'Osoba nebyla aktualizována.');
        }
    }
}
