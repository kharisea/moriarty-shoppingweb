<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Auth extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index(){
        if(session()->has('email') && session()->has('role_id')){
            return redirect()->to(base_url().'/');
        }

        $data = [
            'title' => 'LOGIN | MORIARTY',
            'navbar' => ''
        ];
        return view('/auth/login', $data);
    }
    public function klikLogin(){
        if(!$this->validate([
            'email' => 'required',
            'password' => 'required'
        ])){
            return redirect()->to(base_url().'/auth/login');   
        }

        return $this->successLogin();
    }

    private function successLogin(){

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $this->usersModel->where(['email' => $email])->first();

        // usernya ada
        if($user){
            // usernya aktif
            if($user['is_active'] == 1){
                // cek passwrod
                if(password_verify($password, $user['password'])){
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    session()->set($data);
                    if($data['role_id'] == 1){
                        return redirect()->to(base_url().'/admin');
                    }else{
                    return redirect()->to(base_url().'/');
                    }
                }else{
                    session()->setFlashdata('pesan', 'Password anda salah!');
                    return redirect()->to(base_url().'/auth/login');
                }
            }else{
                session()->setFlashdata('pesan', 'Akun anda belum aktif!');
                return redirect()->to(base_url().'/auth/login');
            }
        }else{
            session()->setFlashdata('pesan', 'Email anda salah!');
            return redirect()->to(base_url().'/auth/login');
        }
    }

    public function register(){
        // session();
        $data = [
            'title' => 'REGISTER | MORIARTY',
            'navbar' => '',
            'validation' => \Config\Services::validation()
        ];
        return view('/auth/register', $data);
    }
    public function registration(){
        if(!$this->validate([
            'email' => 'required|is_unique[users.email]',
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url().'/auth/register')->withInput()->with('validation', $validation);
        }

        $this->usersModel->save([
            'email' => htmlspecialchars($this->request->getVar('email')), 
            'name' => htmlspecialchars($this->request->getVar('name')),
            'gambar' => "default.png",
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role_id' => 2,
            'is_active' => 1
        ]);

        session()->setFlashdata('pesan', 'Akun Berhasil Dibuat!');

        return redirect()->to(base_url().'/auth/register');
    }

    public function logout(){
         session()->remove('email');
         session()->remove('role_id');
         session()->setFlashdata('pesan', 'Anda telah Logout!');
         return redirect()->to(base_url().'/auth/login');  
    }

    public function blocked(){
        return view('/auth/blocked');
    }
}
