<?php

namespace Admin;

use database\Database;

class Post extends Admin
{

    // Index
    public function index()
    {
        $db = new DataBase();
        $posts = $db->select('
                                    SELECT php_news.posts.*, php_news.categories.name as `cat_name`, php_news.users.username as `user_name`
                                    FROM php_news.posts 
                                    LEFT JOIN php_news.categories ON php_news.posts.cat_id = php_news.categories.id
                                    LEFT JOIN php_news.users ON php_news.posts.user_id = php_news.users.id
                                    ;');
        require_once(BASE_PATH . '/template/admin/posts/index.php');
    }

    // Create
    public function create()
    {
        $db = new Database();
        $categories = $db->select('SELECT * FROM `categories` order by id;');
        require_once(BASE_PATH . '/template/admin/posts/create.php');
    }

    // Store
    public function store($request)
    {
        $db = new DataBase();
        $db->insert("posts", array_keys($request), array_values($request));
        $this->redirect('admin/post');
    }

    // Edit
    public function edit($id)
    {
        $db = new DataBase();
        $category = $db->select("SELECT * FROM `posts` WHERE id=?;", [$id])->fetch();
        require_once(BASE_PATH . '/template/admin/posts/edit.php');
    }

    // Update
    public function update($request, $id)
    {
        $db = new DataBase();
        $db->update('posts', $id, array_keys($request), $request);
        $this->redirect('admin/post');
    }

    // Delete
    public function delete($id)
    {
        $db = new DataBase();
        $db->delete('posts', $id);
        $this->redirect('admin/post');
    }
}