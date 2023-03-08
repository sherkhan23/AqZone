<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Exports\CategoryExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CategoryImport;
use Nette\Utils\Paginator;

class CategoriesController extends Controller
{
    public function getCategories(){
        $categories = Categories::query()->paginate(7);
        \Illuminate\Pagination\Paginator::useBootstrap();
        return view('admin.categories', compact('categories'));
    }

    public function editCategories(Request $request, $id){
        $category = Categories::query()->find($id);
        $category->categoryName = $request->categoryName;
        $category->details = $request->details;
        $category->save();
        return redirect()->back()->with('updateMess','Успешно добавлено');
    }

    public function delCategory($id){
        $category = Categories::query()->find($id)->delete();
        return redirect()->back()->with('updateMess','Успешно удалено');
    }

    public function exportCategory(){
        return Excel::download(new CategoryExport(), 'categories.xlsx');
    }

    public function importCategory(Request $request)
    {
        Excel::import(new CategoryImport(), $request->file('file'));
        return redirect()->back()->with('updateMess','Успешно добавлено');

    }

}
