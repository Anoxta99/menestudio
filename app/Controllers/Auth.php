<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login(): mixed
    {
        if (session()->get('logged_in')) {
            $role = session()->get('role');
            if ($role === '1') {
                return redirect()->to(base_url('/admin/dashboard'));
            } else if ($role === '2') {
                return redirect()->to(base_url());
            }
        }
        return view('auth/login');
    }
    public function regist(): string
    {
        helper(['form']);
        $data = [];
        return view('auth/register', $data);
    }

    public function login_process()
    {
        $userModel = new UserModel();

        $usernameOrEmail = $this->request->getVar('username_or_email');
        $password = $this->request->getVar('password');

        $user = $userModel->where('username', $usernameOrEmail)
            ->orWhere('email', $usernameOrEmail)
            ->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                session()->set([
                    'id_user' => $user['id_user'],
                    'username' => $user['username'],
                    'nama_lengkap' => $user['nama_lengkap'],
                    'email' => $user['email'],
                    'alamat' => $user['alamat'],
                    'no_hp' => $user['no_hp'],
                    'foto_profil' => $user['foto_profil'],
                    'role' => $user['role'],
                    'logged_in' => TRUE
                ]);

                if ($user['role'] === '1') {
                    return redirect()->to(base_url('/admin/dashboard'));
                } else if ($user['role'] === '2') {
                    return redirect()->to(base_url());
                }
            } else {
                session()->setFlashdata('error', 'Password salah.');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Username atau Email salah.');
            return redirect()->back()->withInput();
        }
    }
    public function create()
    {
        helper(['form']);

        $rules = [
            'username' => [
                'rules' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
                'errors' => [
                    'is_unique' => 'Username sudah ada, silahkan gunakan username yang lain.'
                ]
            ],
            'nama_lengkap' => 'required|min_length[3]|max_length[30]',
            'email' => [
                'rules' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'errors' => [
                    'is_unique' => 'Email sudah ada, silakan gunakan email yang lain.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[200]',
                'errors' => [
                    'min_length' => 'Password minimal 5 karakter'
                ]
            ],
            'no_hp' => 'permit_empty|min_length[10]|max_length[20]',
            'alamat' => 'permit_empty|max_length[255]',
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            $nama = ucwords($this->request->getVar('nama_lengkap'));
            $data = [
                'username' => $this->request->getVar('username'),
                'nama_lengkap' => $nama,
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getVar('role'),
                'no_hp' => $this->request->getVar('no_hp'),
                'alamat' => $this->request->getVar('alamat'),
            ];
            $model->save($data);
            session()->setFlashdata('sukses', 'Registrasi Berhasil, silahkan Login');
            return redirect()->to(base_url('/register'));
        } else {
            $data['validation'] = $this->validator;
            return view('auth/register', $data);
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }

    public function noauth()
    {
        return view('auth/505');
    }
}