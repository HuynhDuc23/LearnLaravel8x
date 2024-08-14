<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct() {}

    // GET
    public function index()
    {
        return view('clients/categories/list');
    }
    public function getCategory($id) {}
    public function updateCategory($id) {}
    public function deleteCategory($id) {}
    public function createCategory()
    {
        return view('clients/categories/add');
    }
    public function handleCategory()
    {
        return redirect(route('categories.create'));
        //return "Submit them chuyen muc";
    }
    public function showFormCategory($id) {}

    // 31.08 resources : CRUD sinh ra
}
