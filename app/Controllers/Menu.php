<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Menu extends BaseController
{
    protected $db;
    protected $menuModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->menuModel = new MenuModel();

    }

    public function index()
    {      
        $data = [
            'title' => 'Menu Management | MORIARTY',
            'navbar' => '',
            'menu' =>  $this->db->table('users_menu')->get()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
         
        return view('/menu/index', $data);
    }

    public function addMenu(){
        if(!$this->validate([
            'menu' => 'required'
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url().'/menu/index')->withInput()->with('validation', $validation);
        } 
        $builder = $this->db->table('users_menu');

        $data = [
            'menu' => $this->request->getVar('menu')
        ];

        $builder->insert($data);
        
        session()->setFlashdata('pesan', 'Menu Added!');

        return redirect()->to(base_url().'/menu/index');
    }

    public function editMenu(){
        if(!$this->validate([
            'menu' => 'required'
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url().'/menu/index')->withInput()->with('validation', $validation);
        } 
        $builder = $this->db->table('users_menu');

        $data = [
            'menu' => $this->request->getVar('menu')
        ];

        $id = $_POST['id'];
        $builder->where('id', $id)->update($data);
        
        session()->setFlashdata('pesan', 'Menu Changed!');

        return redirect()->to(base_url().'/menu/index');
    }

    public function getMenu(){
        $builder = $this->db->table('users_menu');
        $query = $builder->getWhere(['id' => $_POST['id']])->getFirstRow();

        echo json_encode($query);
     }

    public function deltMenu($id){
        $builder = $this->db->table('users_menu');

        $builder->where('id', $id)->delete();
        
        session()->setFlashdata('pesan', 'Menu Deleted!');

        return redirect()->to(base_url().'/menu');
     }

     public function submenu(){      
        $data = [
            'title' => 'SubMenu Management | MORIARTY',
            'navbar' => '',
            'subMenu' =>  $this->menuModel->getSubMenu(),
            'menu' =>  $this->db->table('users_menu')->get()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
         
        return view('/menu/submenu', $data);
    }

    public function addSubMenu(){
        if(!$this->validate([
            'title' => 'required',
            'menu_id' => 'required',
            'url' => 'required'
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url().'/menu/submenu')->withInput()->with('validation', $validation);
        } 
        // $builder = $this->db->table('users_sub_menu');

        $data = [
            'title' => $this->request->getVar('title'),
            'menu_id' => $this->request->getVar('menu_id'),
            'url' => $this->request->getVar('url'),
            'is_active' => $this->request->getVar('is_active')
        ];

        $this->menuModel->save($data);
        
        session()->setFlashdata('pesan', 'SubMenu Added!');

        return redirect()->to(base_url().'/menu/submenu');
    }

    public function deltSubMenu($id){
        $this->menuModel->delete($id);

        session()->setFlashdata('pesan', 'SubMenu Deleted!');

        return redirect()->to(base_url().'/menu/submenu');
    }

    public function editSubMenu(){
        if(!$this->validate([
            'title' => 'required',
            'menu_id' => 'required',
            'url' => 'required'
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url().'/menu/submenu')->withInput()->with('validation', $validation);
        } 

        $data = [
            'id' => $this->request->getVar('id'),
            'title' => $this->request->getVar('title'),
            'menu_id' => $this->request->getVar('menu_id'),
            'url' => $this->request->getVar('url'),
            'is_active' => $this->request->getVar('is_active')
        ];
        
        $this->menuModel->save($data);
        
        session()->setFlashdata('pesan', 'SubMenu Changed!');

        return redirect()->to(base_url().'/menu/submenu');
    }

    public function getSubMenu(){
        $builder = $this->db->table('users_sub_menu');
        $query = $builder->getWhere(['id' => $_POST['id']])->getFirstRow();

        echo json_encode($query);
    }

}