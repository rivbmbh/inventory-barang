<?php

namespace App\Controllers;

use App\Models\UsersModel;
// use CodeIgniter\Controller;

class Auth extends BaseController
{
    public function login()
    {
        $session = session();
        $modelUser = new UsersModel();
        $data = [
            'title' => 'Form Login'
        ];
        // Definisikan aturan validasi
        $validation = \Config\Services::validation();
        $rules = [
            'email' => [
                'label' => 'Email address',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} is required.',
                    'valid_email' => '{field} must be a valid email address.'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required.'
                ]
            ],
        ];

        if ($this->request->getMethod() === 'POST') {
            // Validasi input
            if (!$this->validate($rules)) {
                // Jika validasi gagal, kembalikan ke form login dengan error
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // Cari user berdasarkan email
            $user = $modelUser->where('email', $email)->first();

            if ($user) {
                // Verifikasi password
                if (password_verify($password, $user['password'])) {
                    // Set session data
                    $session->set([
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'role' => $user['role'],
                        'logged_in' => true,
                    ]);

                    // Redirect ke halaman dashboard
                    return redirect()->to('home');
                } else {
                    // Password salah
                    return redirect()->back()->with('gagal', 'Password is incorrect')->withInput();
                }
            } else {
                // User tidak ditemukan
                return redirect()->back()->with('gagal', 'Email not found')->withInput();
            }
        }

        // Tampilkan form login
        return view('login', $data);
    }

    public function register()
    {
        $modelUser = new UsersModel();
        $data = [
            'title' => 'Register | Page',
            'subtitle' => 'Register PAGE',
            'tableTitle' => 'Form Register',
        ];

        // Aturan validasi
        $validation = \Config\Services::validation();
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} is required.',
                    'min_length' => '{field} must be at least 3 characters long.',
                    'max_length' => '{field} cannot exceed 20 characters.',
                    'is_unique' => '{field} is already taken.',
                ]
            ],
            'email' => [
                'label' => 'Email address',
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} is required.',
                    'valid_email' => '{field} must be a valid email address.',
                    'is_unique' => '{field} is already registered.',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} is required.',
                    'min_length' => '{field} must be at least 8 characters long.',
                ]
            ],
            'password_confirm' => [
                'label' => 'Confirm Password',
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => '{field} does not match the Password.',
                ]
            ],
        ];

        if ($this->request->getMethod() === 'POST') {
            if (!$this->validate($rules)) {
                // Validasi gagal
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Simpan user baru ke database
            $newData = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'role' => 'user', // Default role sebagai 'user'
            ];
            $modelUser->save($newData);

            return redirect()->to('auth/login')->with('success', 'Registration successful. You can now login.');
        }

        return view('register', $data);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('auth/login')->with('success', 'Logout successful');
    }
}