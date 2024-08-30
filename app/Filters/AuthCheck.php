<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Cek apakah user sudah login
        if (!$session->get('logged_in')) {
            return redirect()->to('auth/login');
        }

        // Dapatkan role user dari session
        $userRole = $session->get('role');

        // Jika user adalah admin, biarkan mengakses semua controller
        if ($userRole === 'admin') {
            return; // lanjutkan akses
        }

        // Jika user adalah non-admin, batasi akses ke controller tertentu
        $controller = $request->getUri()->getSegment(1);

        // Izinkan akses ke controller 
        if (!in_array($controller, ['item', 'transaction'])) {
            return redirect()->to('auth/forbidden'); // Ganti dengan URL yang sesuai jika akses ditolak
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi setelah response
    }
}