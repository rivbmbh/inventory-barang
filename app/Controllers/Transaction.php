<?php

namespace App\Controllers;

use App\Models\ItemsModel;
use App\Models\TransactionsModel;
use App\Controllers\BaseController;

class Transaction extends BaseController{
    public function index()
    {
        $session = session();
        $modelTransactions = new TransactionsModel();
        $data = [
            'title' => 'Dashboard || Transactions',
            'subtitle' => 'Transaction',
            'tableTitle' => 'Table Transaction',
            'dataTransaction' => $modelTransactions->getData()
        ];
        
        return view('transactions_view', $data);
    }

    public function addTransaction()
    {
        $modelItems = new ItemsModel();
        $modelTransactions = new TransactionsModel();
        
        $data = [
            'title' => 'Add Transaction',
            'subtitle' => 'Add Transaction',
            'tableTitle' => 'Form Add Transaction',
            'dataTransaction' => $modelTransactions->findAll(),
            'dataItem' => $modelItems->findAll(),
        ];
        
        // Rules untuk validasi form
        $rules = [
            'item_id' => [
                'label' => 'Items',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required.',
                ]
            ],
            'quantity' => [
                'label' => 'Quantity',
                'rules' => 'required|integer|min_length[1]|greater_than[0]',
                'errors' => [
                    'required' => '{field} is required.',
                    'min_length' => '{field} At least 1 digit required!!',
                    'greater_than' => '{field} must be greater than 0 !!',
                ]
            ],
            'type' => [
                'label' => 'Type',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required.',
                ]
            ]
        ];

        // Cek apakah request adalah POST (submit form)
        if ($this->request->getMethod() === 'POST') {
            // Validasi input
            if (!$this->validate($rules)) {
                // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan error
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Jika validasi berhasil, lanjutkan proses
            $item_id = $this->request->getPost('item_id');
            $quantity = $this->request->getPost('quantity');
            $type = $this->request->getPost('type');

            // Update stock berdasarkan jenis transaksi
            $item = $modelItems->find($item_id);
            if ($type === 'in') {
                $newStock = $item['stock'] + $quantity;
            } elseif ($type === 'out') {
                if ($item['stock'] < $quantity) {
                    return redirect()->back()->with('gagal', 'Insufficient stock');
                }
                $newStock = $item['stock'] - $quantity;
            }

            $modelItems->update($item_id, ['stock' => $newStock]);

            // Simpan transaksi
            $modelTransactions->save([
                'item_id' => $item_id,
                'user_id' => session()->get('user_id'),
                'type' => $type,
                'quantity' => $quantity,
            ]);

            // Redirect ke halaman lain setelah berhasil menyimpan
            return redirect()->to('transaction')->with('success', 'Transaction successfully added');
        }

        // Tampilkan form input transaksi jika request adalah GET
        return view('transactions_add', $data);
    }

    public function updateTransaction($id)
    {
        $modelTransactions = new TransactionsModel();
        $modelItems = new ItemsModel();

        // Temukan transaksi berdasarkan ID
        $transaction = $modelTransactions->find($id);
        if (!$transaction) {
            return redirect()->to('transaction')->with('gagal', 'Transaction not found');
        }

        // Jika request adalah POST, lakukan proses update
        if ($this->request->getMethod() === 'POST') {
            // Rules untuk validasi
            $rules = [
                'item_id' => [
                    'label' => 'Items',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required.',
                    ]
                ],
                'quantity' => [
                    'label' => 'Quantity',
                    'rules' => 'required|greater_than[0]',
                    'errors' => [
                        'required' => '{field} is required.',
                        'greater_than' => '{field} must be greater than 0.',
                    ]
                ],
                'type' => [
                    'label' => 'Type',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required.',
                    ]
                ]
            ];

            // Validasi input
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Dapatkan input dari form
            $item_id = $this->request->getPost('item_id');
            $quantity = $this->request->getPost('quantity');
            $type = $this->request->getPost('type');

            // Temukan item terkait
            $item = $modelItems->find($item_id);

            // Hitung ulang stok
            $oldQuantity = $transaction['quantity'];
            if ($transaction['type'] === 'in') {
                $item['stock'] -= $oldQuantity;
            } elseif ($transaction['type'] === 'out') {
                $item['stock'] += $oldQuantity;
            }

            if ($type === 'in') {
                $newStock = $item['stock'] + $quantity;
            } elseif ($type === 'out') {
                if ($item['stock'] < $quantity) {
                    return redirect()->back()->with('gagal', 'Insufficient stock');
                }
                $newStock = $item['stock'] - $quantity;
            }

            // Update stok item
            $modelItems->update($item_id, ['stock' => $newStock]);

            // Update transaksi
            $modelTransactions->update($id, [
                'item_id' => $item_id,
                'user_id' => session()->get('user_id'),
                'type' => $type,
                'quantity' => $quantity,
            ]);

            return redirect()->to('transaction')->with('success', 'Transaction updated successfully');
        }

        // Jika request adalah GET, tampilkan form edit
        $data = [
            'title' => 'Edit Transaction',
            'subtitle' => 'Edit Transaction',
            'tableTitle' => 'Form Edit Transaction',
            'transaction' => $transaction,
            'dataItem' => $modelItems->findAll(),
        ];

        return view('transactions_edit', $data);
    }

    public function deleteTransaction($id)
    {
        $modelTransactions = new TransactionsModel();
        $modelItems = new ItemsModel();

        // Temukan transaksi berdasarkan ID
        $transaction = $modelTransactions->find($id);

        if ($transaction) {
            $item_id = $transaction['item_id'];
            $quantity = $transaction['quantity'];
            $type = $transaction['type'];

            // Temukan item terkait
            $item = $modelItems->find($item_id);

            if ($item) {
                // Kembalikan stok barang berdasarkan jenis transaksi
                if ($type === 'in') {
                    $newStock = $item['stock'] - $quantity;
                } elseif ($type === 'out') {
                    $newStock = $item['stock'] + $quantity;
                }

                // Update stok item
                $modelItems->update($item_id, ['stock' => $newStock]);

                // Hapus transaksi
                $modelTransactions->delete($id);

                // Redirect ke halaman daftar transaksi dengan pesan sukses
                return redirect()->to('transaction')->with('success', 'Transaction deleted successfully');
            }
        }

        // Jika transaksi tidak ditemukan, redirect dengan pesan error
        return redirect()->to('transaction')->with('error', 'Transaction not found');
    }

}