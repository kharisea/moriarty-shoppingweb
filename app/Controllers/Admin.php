<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\LookbookModel;

class Admin extends BaseController
{
    protected $db;
    protected $productsModel;
    protected $lookbooksModel;

    public function __construct()
    {
        helper('moriarty');
        $this->db = \Config\Database::connect();
        $this->productsModel = new ProductsModel(); 
        $this->lookbookModel = new LookbookModel(); 
        
    }

    public function index()
    {      
        // $products = $this->productsModel->orderBy('id', 'DESC')->paginate(5);
        
        $data = [
            'title' => 'Dashboard',
            'navbar' => ''
        ];


        return view('/admin/index', $data);
    }

    public function role(){
                
        $data = [
            'title' => 'Role',
            'navbar' => '',
            'role' => $this->db->table('users_role')->get()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];


        return view('/admin/role', $data);
    }

    public function addNewRole(){
                
        if(!$this->validate([
            'role' => 'required'
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url().'/admin/role')->withInput()->with('validation', $validation);
        } 
        $builder = $this->db->table('users_role');

        $data = [
            'role' => $this->request->getVar('role')
        ];

        $builder->insert($data);
        
        session()->setFlashdata('pesan', 'Role Added!');

        return redirect()->to(base_url().'/admin/role');
    }

    public function editRole(){
        if(!$this->validate([
            'role' => 'required'
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url().'/admin/role')->withInput()->with('validation', $validation);
        } 
        $builder = $this->db->table('users_role');

        $data = [
            'role' => $this->request->getVar('role')
        ];

        $id = $_POST['id'];
        $builder->where('id', $id)->update($data);
        
        session()->setFlashdata('pesan', 'Role Changed!');

        return redirect()->to(base_url().'/admin/role');
    }

    public function getRole(){
        $builder = $this->db->table('users_role');
        $query = $builder->getWhere(['id' => $_POST['id']])->getFirstRow();

        echo json_encode($query);
    }

    public function deltRole($id){
        $builder = $this->db->table('users_role');

        $builder->where('id', $id)->delete();
        
        session()->setFlashdata('pesan', 'Role Deleted!');

        return redirect()->to(base_url().'/admin/role');
    }

    public function roleAccess($role_id){

        // $usersMenu = $this->db->table('users_menu')->where(['id !=', 1]);
        $data = [
            'title' => 'Role Access', 
            'navbar' => '',
            'role' => $this->db->table('users_role')->getWhere(['id' => $role_id])->getRowArray(),
            'menu' => $this->db->table('users_menu')->getWhere(['id !=' => 1])->getResultArray()
        ];

        return view('/admin/role-access', $data);
    }

    public function changeaccess(){
        $menu_id = $this->request->getVar('menuId');
        $role_id = $this->request->getVar('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->query("SELECT * FROM `users_access_menu`
                                     WHERE `role_id` = $role_id AND `menu_id` = $menu_id");

        // $result = $this->db->table('users_access_menu')->where([$data]);

        if ($result->getNumRows() < 1){
            $this->db->table('users_access_menu')->insert($data);
        }else{
            $this->db->table('users_access_menu')->delete($data);
        }

        session()->setFlashdata('pesan', 'Role Access Changed!');
    }

    public function item(){
        $data = [
            'title' => 'Manage Item',
            'navbar' => '',
            'item' => $this->productsModel->findAll(),
            'validation' => \Config\Services::validation()
            
        ];

        return view('/admin/add-item', $data);
    }

    public function addNewItem(){
        if(!$this->validate([
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'ukuran' => 'required',
            'sampul' => [
                'rules' => 'uploaded[sampul]|max_size[sampul,2048]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar sampul terlebih dahulu',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang di upload bukan gambar',
                    'mime_in' => 'Yang di upload bukan gambar'
                ]
            ]            
        ])){
            // $validation = \Config\Services::validation();
            // return redirect()->to(base_url().'/admin/item')->withInput()->with('validation', $validation);
            return redirect()->to(base_url().'/admin/item')->withInput();
        } 

        //ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        // pindahkan file gambar ke folder img
        $fileSampul->move('img/article');
        // ambil nama file
        $namaSampul = $fileSampul->getName();

        $data = [
            'nama' => $this->request->getVar('nama'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'ukuran' => $this->request->getVar('ukuran'),
            'sampul' => $namaSampul
        ];
        $this->productsModel->save($data);
        
        session()->setFlashdata('pesan', 'Item Added!');

        return redirect()->to(base_url().'/admin/item');
    }

    public function editItem(){
        if(!$this->validate([
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'ukuran' => 'required',
            'sampul' => [
                'rules' => 'max_size[sampul,2048]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang di upload bukan gambar',
                    'mime_in' => 'Yang di upload bukan gambar'
                ]
            ]
        ])){

            return redirect()->to(base_url().'/admin/item')->withInput();
        } 
        $fileSampul = $this->request->getFile('sampul');
        $namaSampul = $this->request->getVar('sampulLama');

        //cek gambar, apakah tetap atau tidak
        if($fileSampul->getError() == 4){
            $namaSampul;
        } else{
            // pindahkan file gambar ke folder img
            $fileSampul->move('img/article');
            // hapus file lama
            unlink('img/article/'. $namaSampul);
            // ambil nama file
            $namaSampul = $fileSampul->getName();
         }

        $data = [
            'id' => $this->request->getVar('id'),
            'nama' => $this->request->getVar('nama'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'ukuran' => $this->request->getVar('ukuran'),
            'sampul' => $namaSampul
        ];
        $this->productsModel->save($data);

        session()->setFlashdata('pesan', 'Item Changed!');

        return redirect()->to(base_url().'/admin/item');
    }

    public function getItem(){
        $query = $this->productsModel->getProducts($_POST['id']);

        echo json_encode($query);
    }
    
    public function deltItem($id){

        // cari gambar berdasarkan id
        $product = $this->productsModel->find($id);

        // cek jika gambar default
        if($product['sampul'] != 'default.png'){
            unlink('img/article/'. $product['sampul']);
        }

        $this->productsModel->delete($id);

        session()->setFlashdata('pesan', 'Item Deleted!');

        return redirect()->to(base_url().'/admin/item');
    }

    public function lookbook(){
        $data = [
            'title' => 'Manage Lookbook',
            'navbar' => '',
            'lookbook' => $this->lookbookModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('/admin/add-lookbook', $data);
    }

    public function addNewLookbook(){
        if(!$this->validate([
            'namalb' => 'required',
            'gambarp' => [
                'rules' => 'uploaded[gambarp]|max_size[gambarp,2048]|is_image[gambarp]|mime_in[gambarp,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar poster terlebih dahulu',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang di upload bukan gambar',
                    'mime_in' => 'Yang di upload bukan gambar'
                ]
            ],
            'gslide1' => [
                'rules' => 'uploaded[gslide1]|max_size[gslide1,2048]|is_image[gslide1]|mime_in[gslide1,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar slideshow1 terlebih dahulu',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang di upload bukan gambar',
                    'mime_in' => 'Yang di upload bukan gambar'
                ]
            ],
            'gslide2' => [
                'rules' => 'uploaded[gslide2]|max_size[gslide2,2048]|is_image[gslide2]|mime_in[gslide2,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar slideshow2 terlebih dahulu',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang di upload bukan gambar',
                    'mime_in' => 'Yang di upload bukan gambar'
                ]
            ],
            'gslide3' => [
                'rules' => 'uploaded[gslide3]|max_size[gslide3,2048]|is_image[gslide3]|mime_in[gslide3,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar slideshow3 terlebih dahulu',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang di upload bukan gambar',
                    'mime_in' => 'Yang di upload bukan gambar'
                ]
            ],
        ])){
            return redirect()->to(base_url().'/admin/lookbook')->withInput();
        } 
        //ambil gambar
        $filePoster = $this->request->getFile('gambarp');
        $fileGslide1 = $this->request->getFile('gslide1');
        $fileGslide2 = $this->request->getFile('gslide2');
        $fileGslide3 = $this->request->getFile('gslide3');
        // pindahkan file gambar ke folder img
        $filePoster->move('img/lookbook/');
        $fileGslide1->move('img/lbdetail/');
        $fileGslide2->move('img/lbdetail/');
        $fileGslide3->move('img/lbdetail/');

        // ambil nama file
        $namaPoster = $filePoster->getName();
        $namaGslide1 = $fileGslide1->getName();
        $namaGslide2 = $fileGslide2->getName();
        $namaGslide3 = $fileGslide3->getName();

        $data = [
            'namalb' => $this->request->getVar('namalb'),
            'gambarp' => $namaPoster,
            'gslide1' => $namaGslide1,
            'gslide2' => $namaGslide2,
            'gslide3' => $namaGslide3
        ];
        $this->lookbookModel->save($data);
        
        session()->setFlashdata('pesan', 'Lookbook Added!');

        return redirect()->to(base_url().'/admin/lookbook');
    }

    public function editLookbook(){
        if(!$this->validate([
            'namalb' => 'required',
            'gambarp' => [
                'rules' => 'max_size[gambarp,2048]|is_image[gambarp]|mime_in[gambarp,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang di upload bukan gambar',
                    'mime_in' => 'Yang di upload bukan gambar'
                ]
            ],
            'gslide1' => [
                'rules' => 'max_size[gslide1,2048]|is_image[gslide1]|mime_in[gslide1,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang di upload bukan gambar',
                    'mime_in' => 'Yang di upload bukan gambar'
                ]
            ],
            'gslide2' => [
                'rules' => 'max_size[gslide2,2048]|is_image[gslide2]|mime_in[gslide2,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang di upload bukan gambar',
                    'mime_in' => 'Yang di upload bukan gambar'
                ]
            ],
            'gslide3' => [
                'rules' => 'max_size[gslide3,2048]|is_image[gslide3]|mime_in[gslide3,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang di upload bukan gambar',
                    'mime_in' => 'Yang di upload bukan gambar'
                ]
            ],
        ])){
            return redirect()->to(base_url().'/admin/lookbook')->withInput();
        } 

        //ambil gambar
        $filePoster = $this->request->getFile('gambarp');
        $fileGslide1 = $this->request->getFile('gslide1');
        $fileGslide2 = $this->request->getFile('gslide2');
        $fileGslide3 = $this->request->getFile('gslide3');
        // ambil gambar lama
        $namaPoster = $this->request->getVar('posterLama');
        $namaGslide1 = $this->request->getVar('gslideLama1');
        $namaGslide2 = $this->request->getVar('gslideLama2');
        $namaGslide3 = $this->request->getVar('gslideLama3');

        // cek apakah ganti gambar
        if($filePoster->getError() == 4){
            $namaPoster;
         } else{
            // pindahkan file gambar ke folder img
            $filePoster->move('img/lookbook/');
            // hapus file lama
            unlink('img/lookbook/'. $namaPoster);
            // ambil nama file
            $namaPoster = $filePoster->getName();
         }
        if($fileGslide1->getError() == 4){
            $namaGslide1;
         } else{
            // pindahkan file gambar ke folder img
            $fileGslide1->move('img/lbdetail/');
            // hapus file lama
            unlink('img/lbdetail/'. $namaGslide1);
            // ambil nama file
            $namaGslide1 = $fileGslide1->getName();
         }
        if($fileGslide2->getError() == 4){
            $namaGslide2;
         } else{
            // pindahkan file gambar ke folder img
            $fileGslide2->move('img/lbdetail/');
            // hapus file lama
            unlink('img/lbdetail/'. $namaGslide2);
            // ambil nama file
            $namaGslide2 = $fileGslide2->getName();
         }
        if($fileGslide1->getError() == 4){
            $namaGslide3;
         } else{
            // pindahkan file gambar ke folder img
            $fileGslide3->move('img/lbdetail/');
            // hapus file lama
            unlink('img/lbdetail/'. $namaGslide3);
            // ambil nama file
            $namaGslide3 = $fileGslide3->getName();
         }

        $data = [
            'id' => $this->request->getVar('id'),
            'namalb' => $this->request->getVar('namalb'),
            'gambarp' => $namaPoster,
            'gslide1' => $namaGslide1,
            'gslide2' => $namaGslide2,
            'gslide3' => $namaGslide3,
        ];
        $this->lookbookModel->save($data);
        
        session()->setFlashdata('pesan', 'Lookbook Added!');

        return redirect()->to(base_url().'/admin/lookbook');
    }

    public function gettingLookbook(){
        $query = $this->lookbookModel->getLookbook($_POST['id']);

        echo json_encode($query);
    }

    public function deltLookbook($id){
        $lookbook = $this->lookbookModel->find($id);

        // cek jika gambar default
        unlink('img/lookbook/'. $lookbook['gambarp']);
        unlink('img/lbdetail/'. $lookbook['gslide1']);
        unlink('img/lbdetail/'. $lookbook['gslide2']);
        unlink('img/lbdetail/'. $lookbook['gslide3']);


        $this->lookbookModel->delete($id);

        session()->setFlashdata('pesan', 'Lookbook Deleted!');

        return redirect()->to(base_url().'/admin/lookbook');
    }

}
