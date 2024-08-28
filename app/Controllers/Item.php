<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ItemsModel;

class Item extends BaseController{
    public function index()
    {
        $session = session();
        $modelItems = new ItemsModel();
        $data = [
            'title' => 'Dashboard || Items',
            'subtitle' => 'Item',
            'tableTitle' => 'Table Item',
            'dataItems' => $modelItems->findAll()
        ];
        
        return view('items_view', $data);
    }

    public function addItem()
    {
        $modelItems = new ItemsModel();
        $data = [
            'title' => 'Add Item | Page',
            'subtitle' => 'Items',
            'tableTitle' => 'Form Add Item',
            'dataItem' => $modelItems->findAll(),
        ];

        // Rules untuk validasi form
        $rules = [
            'name' => [
                'label' => 'Item Name',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required.',
                ]
            ],
            'stock' => [
                'label' => 'Stock',
                'rules' => 'required|integer|greater_than[0]',
                'errors' => [
                    'required' => '{field} is required.',
                    'greater_than' => '{field} must be greater than 0 !!',
                ]
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required.',
                ]
            ]
        ];

        if ($this->request->getMethod() === 'POST') {
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        
            // Dapatkan data dari input
            $name = $this->request->getPost('name');
            $description = $this->request->getPost('description');
            $stock = $this->request->getPost('stock');

            // Simpan data ke database
            $modelItems->save([
                'name' => $name,
                'description' => $description,
                'stock' => $stock,
            ]);

            // Redirect ke halaman view item
            return redirect()->to('item')->with('success', 'Item successfully added');
        }
        
        // Jika bukan POST, kembalikan form
        return view('items_add', $data);
    }

    public function updateItem($id)
    {
        $modelItems = new ItemsModel();
        $item =  $modelItems->find($id);

        if(!$item){
            return redirect()->to('item')->with('errors', 'Item not found');
        }

        if($this->request->getMethod() === 'POST'){
            $rules = [
                'name' => [
                    'label' => 'Item Name',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} is required.',
                    ]
                ],
                'stock' => [
                    'label' => 'Stock',
                    'rules' => 'required|integer|greater_than[0]',
                    'errors' => [
                        'required' => '{field} is required.',
                        'greater_than' => '{field} must be greater than 0 !!',
                    ]
                ],
                'description' => [
                    'label' => 'Description',
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
            $name = $this->request->getPost('name');
            $description = $this->request->getPost('description');
            $stock = $this->request->getPost('stock');

            $modelItems->update( $id, [
                'name' => $name,
                'description' => $description,
                'stock' => $stock,
            ]);

            // Redirect ke halaman lain setelah berhasil menyimpan
            return redirect()->to('item')->with('success', 'Item updated successfully');
        }

        $data = [
            'title' => 'Edit Item | Page',
            'subtitle' => 'Edit Item',
            'tableTitle' => 'Form Edit Item',
            'dataItem' => $item,
        ];

        return view('items_edit', $data);
    }
    
    public function deleteItem($id)
    {
        $modelItems = new ItemsModel();
        $item = $modelItems->find($id);
        if (!$item) {
            return redirect()->to('item')->with('error', 'Item not found');
        }

        $modelItems->delete($id);
        return redirect()->to('item')->with('success', 'Item deleted successfully');
    }
}