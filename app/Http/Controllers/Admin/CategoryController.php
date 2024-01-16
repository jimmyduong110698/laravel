<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listItems()
    {
        $categories = Category::get();
        return view('admin.modules.item.index',['categories' => $categories]);
    }
    public function listAvailableBids()
    {
        $categories = Category::get();
        return view('admin.modules.bid.listAvailableBid',['categories' => $categories]);
    }
    public function listHistoryBids()
    {
        $categories = Category::get();
        return view('admin.modules.bid.listOldBid',['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
    
        $category = new Category();
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();
    
        return redirect()->route('admin.category.index')->with('success','Create Category ID');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Category::findOrFail($id);

        return view('.admin.modules.category.edit',[
            'id' => $id,
            'category_data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $data = [
            'name' => $request->name,
            'status' => $request->status,
        ];
        Category::where('id', $id)->update($data);
    
        return redirect()->route('admin.category.index')->with('success','Update Category ID');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_old = Category::findOrFail($id);

        Category::where('id', $id)->delete();
    
        return redirect()->route('admin.category.index')->with('success','Delete Category');
    }
}
