<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\LookbookModel;
use App\Models\UsersModel;
use CodeIgniter\Cookie\Cookie;


class Pages extends BaseController
{
    protected $productsModel;
    protected $lookbooksModel;
    protected $usersModel;
    protected $db;
    

    public function __construct()
    {
        $this->productsModel = new ProductsModel(); 
        $this->lookbookModel = new LookbookModel(); 
        $this->usersModel = new UsersModel();
        $this->db = \Config\Database::connect();
        
    }

    public function index()
    {      
        // $products = $this->productsModel->orderBy('id', 'DESC')->paginate(5);
        
        $data = [
            'title' => 'Home',
            'navbar' => 'fixed-top',
            'products' => $this->productsModel->getProducts()->orderBy('id', 'DESC')->paginate(5)
        ];


        return view('/pages/index', $data);
    }

    public function shop(){      

        // $products = $this->productsModel->findAll();
        $keyword = $this->request->getVar('keyword');
        if($keyword){
            $products = $this->productsModel->search($keyword);
        }else{
            $products = $this->productsModel;
        }


        $data = [
            'title' => 'Shop',
            'navbar' => '',
            'products' => $products->paginate(10, 'products'),
            'pager' => $this->productsModel->pager
        ];
        return view('/pages/shop', $data);
    }

    public function lookbook(){

        // $lookbooks = $this->lookbookModel->findAll();

        $data = [
            'title' => 'Lookbook',
            'navbar' => '',
            'lookbooks' => $this->lookbookModel->getLookbook()
        ];
        return view('/pages/lookbook', $data);
    }

    public function detail($id){

        $data = [
            'title' => 'LOOKBOOK DETAIL',
            'navbar' => '',
            'lookbook' => $this->lookbookModel->getLookbook($id)
        ];
        return view('/pages/detail', $data);
    }

    public function shipping(){
        $data = [
            'title' => 'Shipping',
            'navbar' => ''
        ];
        return view('/pages/shipping', $data);
    }

    public function about(){
        $data = [
            'title' => 'About',
            'navbar' => ''
        ];
        return view('/pages/about', $data);
    }

    public function cart(){


        $data = [
            'title' => 'Shop Cart',
            'navbar' => '',
        ];
        
        return view('/pages/cart', $data);
    }

    public function getDetail(){
        echo json_encode($this->productsModel->getProducts($_POST['id']));
    }

    public function profile(){    
        $data = [
            'title' => 'My Profile',
            'navbar' => '',
            'user' => $this->usersModel->where(['email' => session()->get('email')])->first()
        ];
        return view('/pages/profile', $data);
    }

    public function editProfile(){
        $data = [
            'title' => 'Edit Profile',
            'navbar' => '',
            'user' => $this->usersModel->where(['email' => session()->get('email')])->first(),
            'validation' => \Config\Services::validation()
        ];
        return view('/pages/edit-profile', $data);
    }
    public function changeProfile(){
        if(!$this->validate([
            'name' => 'required',
            'gambar' => [
                'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang di upload bukan gambar',
                    'mime_in' => 'Yang di upload bukan gambar'
                ]
            ]
        ])){
            return redirect()->to(base_url().'/pages/editProfile')->withInput();
        } 
        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $this->request->getVar('gambarLama');
        // $user = $this->usersModel->where(['email' => session()->get('email')])->first();

        //cek gambar, apakah tetap atau tidak
        if($fileGambar->getError() == 4){
            $namaGambar;
        }else {
            // pindahkan file gambar ke folder img
            $fileGambar->move('img/profile');
             // ambil nama file
            $namaGambar = $fileGambar->getName();
        }
        
        // if($user['gambar'] != 'default.png' ){
        //     unlink('img/profile/'. $namaGambar);
        // }
        // if ($user['gambar'] == ""){
        //     $namaGambar = $this->request->getVar('gambarLama');
        // }
    

        $data = [
            'id' => $this->request->getVar('id'),
            'email' => $this->request->getVar('email'),
            'name' => $this->request->getVar('name'),
            'gambar' => $namaGambar
        ];
        $this->usersModel->save($data);

        session()->setFlashdata('pesan', 'Profile Changed!');

        return redirect()->to(base_url().'/pages/editProfile');
    }

    public function addCart(){
        
        if (isset($_POST['addCart'])){
            if(session()->has('email')){
                $sesCookie = session()->get('email');
                $specialChars = array(" ", "-", "_", ".", ",", '^', '@');
                $sesCookie = str_replace($specialChars,"", $sesCookie);
                $cookieId = $this->request->getVar('cookieId');
                $id = $this->request->getVar('id');
        
                // $cart = isset($_COOKIE['cart']) ? $_COOKIE['cart'] : "[]";
                // $cart = json_decode($cart);
        
                $result = $this->productsModel->getProducts($id);
        
        
                $dataCart = [
                    'nama' => $result['nama'],
                    'harga' => $result['harga'],
                    'stok' => $result['stok'],
                    'ukuran' => $result['ukuran'],
                    'sampul' => $result['sampul']
                ];

                $cart = json_encode($dataCart, true);
                setcookie($sesCookie.$cookieId, $cart);
                

            }
            
        } 
        return redirect()->to(base_url().'/');
    }
    public function addCartShop(){
        
        if (isset($_POST['addCart'])){
            if(session()->has('email')){
                $sesCookie = session()->get('email');
                $specialChars = array(" ", "-", "_", ".", ",", '^', '@');
                $sesCookie = str_replace($specialChars,"", $sesCookie);
                $cookieId = $this->request->getVar('cookieId');
                $id = $this->request->getVar('id');
        
                // $cart = isset($_COOKIE['cart']) ? $_COOKIE['cart'] : "[]";
                // $cart = json_decode($cart);
        
                $result = $this->productsModel->getProducts($id);
        
        
                $dataCart = [
                    'nama' => $result['nama'],
                    'harga' => $result['harga'],
                    'stok' => $result['stok'],
                    'ukuran' => $result['ukuran'],
                    'sampul' => $result['sampul']
                ];

                $cart = json_encode($dataCart, true);
                setcookie($sesCookie.$cookieId, $cart);
                

            }
            
        } 
        return redirect()->to(base_url().'/pages/shop');
    }
    public function deltCookies(){
        $cookieId = $this->request->getVar('cookies');

        setcookie($cookieId, "", time() - 3600); 
        return redirect()->to(base_url().'/pages/cart');
    }

    public function sendMail(){
        if(isset($_POST['join'])){
        $config = [
            'protocol' => 'smtp',
            'SMTPHost' => 'smtp.googlemail.com',
            'SMTPUser' => 'kharisma19@mhs.akba.ac.id',
            'SMTPPass' => '',
            'SMTPPort' => 465,
            'SMTPCrypto' => 'ssl',
            'mailType' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'crlf' => "\r\n",
        ];

        $email = \Config\Services::email();
        $email->initialize($config);
        $to = $this->request->getVar('email');

        $email->setFrom('kharisma19@mhs.akba.ac.id', 'Moriarty');
        $email->setTo($to);
        $email->setSubject('JOIN MORIARTY INFO');
        $email->setMessage('Halo, Terima Kasih Telah Bergabung Ke Member Moriarty, Kami Akan Mengirimkan Anda Terkait Informasi Produk Terbaru Kami');

            if ($email->send()){
                return redirect()->to(base_url().'/pages/joinMember');
            }else {
            echo $email->printDebugger();
            die;
            }
        }else{
                return redirect()->to(base_url().'/');
            }
    
    }
    public function joinMember(){
        return view('/pages/join-member');
    }
    
    public function checkout(){
    if(isset($_POST['checkout'])){
        $sesEmail = session()->get('email');

        $nama = $this->request->getVar('nama[]');
        $harga = $this->request->getVar('harga[]');
        $size = $this->request->getVar('size[]');
        $qty = $this->request->getVar('quantity[]');

        $data = [
            'user' => $this->usersModel->where(['email' => $sesEmail])->first(),
            'nama' => $nama,
            'harga' => $harga,
            'size' => $size,
            'qty' => $qty
        ];

        foreach ($nama as $index => $nm){
            $barang =  $this->productsModel->where(['nama' => $nm])->first();
            $stokBaru = $barang['stok'] -= $qty[$index];
            $updateStok = $this->productsModel->set('stok', $stokBaru)->where('id', $barang['id']);
            $updateStok->update();
        }

        // foreach($nama as $nm){
        //     $barang =  $this->productsModel->where(['nama' => $nm])->first();
        //     $stokBarang = $barang['stok'];
        //     $idBarang = $barang['id'];
            
        //     foreach($qty as $q){
        //         $stokBaru = $stokBarang -= $q;
        //         $updateStok = $this->productsModel->set('stok', $stokBaru)->where('id', $idBarang);
        //         $updateStok->update();

        //     }
        // }
        
        return view('/pages/checkout', $data);
    }
    return redirect()->to(base_url().'/');
}


    // public function sendStruk(){
    //     if(isset($_POST['join'])){
    //     $config = [
    //         'protocol' => 'smtp',
    //         'SMTPHost' => 'smtp.googlemail.com',
    //         'SMTPUser' => 'kharisma19@mhs.akba.ac.id',
    //         'SMTPPass' => 'izxyjzjwqgkamkfs',
    //         'SMTPPort' => 465,
    //         'SMTPCrypto' => 'ssl',
    //         'mailType' => 'html',
    //         'charset' => 'utf-8',
    //         'newline' => "\r\n",
    //         'crlf' => "\r\n",
    //     ];

    //     $email = \Config\Services::email();
    //     $email->initialize($config);
    //     $to = $this->request->getVar('email');

    //     $email->setFrom('kharisma19@mhs.akba.ac.id', 'Moriarty');
    //     $email->setTo($to);
    //     $email->setSubject('JOIN MORIARTY INFO');
    //     $email->setMessage('Halo, Terima Kasih Telah Bergabung Ke Member Moriarty, Kami Akan Mengirimkan Anda Terkait Informasi Produk Terbaru Kami');

    //         if ($email->send()){
    //             return redirect()->to(base_url().'/pages/joinMember');
    //         }else {
    //         echo $email->printDebugger();
    //         die;
    //         }
    //     }else{
    //             return redirect()->to(base_url().'/');
    //         }
    
    // }
}
