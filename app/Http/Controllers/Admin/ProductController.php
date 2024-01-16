<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use DateTime;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'DESC')->get();

        return view('admin.modules.product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        return view('admin.modules.product.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $product = new Product();

        $file = $request->image;
        $fileName = time() . '-' . $file->getClientOriginalName();

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->content = $request->content;
        $product->category_id = $request->category_id;
        $product->status = $request->status;
        $product->featured = $request->featured;
        $product->image = $fileName;
        $product->user_id = Auth::user()->id;

        $product->save();

        $file->move(public_path('uploads/'), $fileName);


        if (count($request->images) > 0) {
            $count = 0;
            $data_images = [];

            foreach ($request->images as $img_detail) {
                $count++;
                $fileNameDetail = $count . '-' .time() . '-' . $img_detail->getClientOriginalName();
                $img_detail->move(public_path('uploads/'), $fileNameDetail);

                $data_images[] = [
                    'images' => $fileNameDetail,
                    'product_id' => $product->id,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ];
            }

            ProductImages::insert($data_images);

        }

        return redirect()->route('admin.product.index')->with('success', 'Create product successfully');
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
    public function edit(int $id)
    {
        $categories = Category::get();

        $product = Product::with('product_images')->findOrFail($id);

        // dd($product);

        return view('admin.modules.product.edit', [
            'id' => $id,
            'categories' => $categories,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, int $id)
    {
        $product = Product::findOrFail($id);

        $file = $request->image;

        if (!empty($file)) {
            $request->validate([
                'image' => 'required|mimes:jpg,bmp,png,jpeg'
            ], [
                'image.required' => 'Please enter product image',
                'image.mimes' => 'Images must jpg,bmp,png,jpeg'
            ]);

            $old_image_path = public_path('uploads/'. $product->image);
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }

            $fileName = time() . '-' . $file->getClientOriginalName();
            $product->image = $fileName;
            $file->move(public_path('uploads/'), $fileName);
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->content = $request->content;
        $product->category_id = $request->category_id;
        $product->status = $request->status;
        $product->featured = $request->featured;
        $product->user_id = Auth::user()->id;

        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Create product successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);

        $old_image_path = public_path('uploads/'. $product->image);
        if (file_exists($old_image_path)) {
            unlink($old_image_path);
        }

        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Delete product successfully');
    }

    public function uploadFile(Request $request, $id) {
        $file = $request->image;
        $fileName = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path('uploads/'. $fileName));

        $product_image = ProductImages::find($id);

        $file_old_url = public_path('uploads/'. $product_image->images);
        if (file_exists($file_old_url)) {
            unlink($file_old_url);
        }

        $product_image->images = $fileName;
        $product_image->save();

        return reponse()->json([
            'message' => 'Image upload successfully'
        ],200);
    }
}
