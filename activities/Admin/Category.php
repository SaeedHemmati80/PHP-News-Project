<?php

namespace Admin;

use database\Database;

class Category extends Admin{

    // Index
    public function index()
    {
        $db = new DataBase();
        $categories = $db->select('SELECT * FROM categories ORDER BY `id` DESC');
        require_once(BASE_PATH . '/template/admin/categories/index.php');
    }

    // Create
    public function create()
    {
        require_once (BASE_PATH . '/template/admin/categories/create.php');
    }

    // Store
    public function store($request)
    {
        $db = new DataBase();
        $db->insert("categories", array_keys($request), array_values($request));
        $this->redirect('admin/category');
    }

    // Edit
    public function edit($id)
    {
        $db = new DataBase();
        $category = $db->select("SELECT * FROM categories WHERE id=?;", [$id])->fetch();
        require_once (BASE_PATH . '/template/admin/categories/edit.php');
    }

    // Update
    public function update($request, $id)
    {
        $db = new DataBase();
        $db->update('categories',$id , array_keys($request), $request);
        $this->redirect('admin/category');
    }

    // Delete
    public function delete($id)
    {
        $db = new DataBase();
        $db->delete('categories', $id);
        $this->redirect('admin/category');
    }
}