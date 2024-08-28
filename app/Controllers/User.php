<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UsersModel;

class User extends BaseController{
    public function index()
    {
        $session = session();
        $modelUser = new UsersModel();
        $data = [
            'title' => 'User | Page',
            'subtitle' => 'User',
            'tableTitle' => 'Table User',
            'dataUsers' => $modelUser->findAll(),
        ];
        return view('users_view' ,$data);
    }

    public function updateUser($id)
    {
        $modelUser =  new UsersModel();
        $user = $modelUser->find($id);

        if(!$user){
            return redirect()->to('user')->with('errors', 'User not found');
        }

        if($this->request->getMethod() === 'POST'){
            $rules = [
                'email' => [
                    'label' => 'Email',
                    'rules' => "required|valid_email|is_unique[users.email,id,{$id}]",
                    'errors' => [
                        'required' => "{field} is required!",
                        'valid_email' => "{field} must be a valid email address!",
                        'is_unique' => "This {field} is already registered!"
                    ],
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'permit_empty|min_length[3]', //permit_empty allows the field to be empty
                    'errors' => [
                        'min_length' => "{field} At least 3 characters required !!",
                    ],
                ],
                'role' => [
                    'label' => 'Role',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required.',
                    ]
                ]
            ];

            // cek Validasi input
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Dapatkan data dari input
            $email = $this->request->getPost('email');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $role = $this->request->getPost('role');
            
            // Cek apakah password yang diinputkan sama dengan password lama
            if (!empty($password)) {
                // Jika password baru berbeda, lakukan hashing
                if (!password_verify($password, $user['password'])) {
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                } else {
                    // Jika sama, gunakan password lama
                    $hashedPassword = $user['password'];
                }
            } else {
                // Jika password kosong, tetap gunakan password lama
                $hashedPassword = $user['password'];
            }
            
            $modelUser->update($id, [
                'email' => $email,
                'username' => $username,
                'password' => $hashedPassword,
                'role' => $role,
            ]);

            // Redirect ke halaman lain setelah berhasil menyimpan
            return redirect()->to('user')->with('success', 'User updated successfully');
        }
        
        $data = [
            'title' => 'User Update| Page',
            'subtitle' => 'Users',
            'tableTitle' => 'Form Users',
            'dataUser' => $user,
        ];

        return view('users_edit', $data);
    }

    public function deleteUser($id)
    {
        $modelUser = new UsersModel();
        $user = $modelUser->find($id);
        if (!$user) {
            return redirect()->to('user')->with('error', 'User not found');
        }

        $modelUser->delete($id);
        return redirect()->to('user')->with('success', 'User deleted successfully');
    }
}