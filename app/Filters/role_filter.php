<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class role_filter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $conn = mysqli_connect("localhost", "root", "", "moriarty");
        $db = \Config\Database::connect();
    
        $role_id = session()->get('role_id');

        $request = \Config\Services::request();
        $menu = $request->uri->getSegment(1);

        $queryMenu = $db->table('users_menu')->getWhere(['menu' => $menu])->getRowArray();
        $menu_id = $queryMenu['id'];

        // $userAccess = $db->table('users_access_menu')->getWhere(['role_id' => $role_id, 'menu_id' => $menu_id]);
        
        // $userAccess = "SELECT * FROM `users_access_menu`
        //                 WHERE `role_id` = $role_id AND `menu_id` = $menu_id";
        // $result = mysqli_query($conn, $userAccess);

        $userAccess = $db->query("SELECT * FROM `users_access_menu`
                                    WHERE `role_id` = $role_id AND `menu_id` = $menu_id");
        // if (mysqli_num_rows($result) < 1) {
        //     return redirect()->to(base_url().'/auth/blocked');
        // }

        // if($userAccess->num_rows() < 1){
        //     return redirect()->to(base_url().'/auth/blocked');
        // }

        if($userAccess->getNumRows() < 1){
            return redirect()->to(base_url().'/auth/blocked');
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}