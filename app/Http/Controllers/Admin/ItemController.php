<?php

namespace App\Http\Controllers\Admin;


use App\Models\Item;
use App\Models\Type;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ItemRequest;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Item::with(['type', 'brand']);

            return DataTables::of($query)
                ->editColumn('thumbnail', function ($item) {
                    return '<img src="' . $item->thumbnail . '" alt="" class="w-20 mx-auto rounded-md">';
                })
                ->addColumn('action', function ($item) {
                    return '
                        <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                            href="' . route('admin.items.edit', $item->id) . '">
                            Sunting
                        </a>
                        <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.items.destroy', $item->id) . '" method="POST">
                        <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->rawColumns(['action', 'thumbnail'])
                ->make();
        }

        return view('admin.items.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $types = Type::all();

        return view('admin.items.create', [
            'brands' => $brands,
            'types' => $types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        // Upload multiple photos
        if ($request->hasFile('photos')) {
            $photos = [];

            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('assets/item', 'public');

                // Store as json
                array_push($photos, $photoPath);
            }

            $data['photos'] = json_encode($photos);
        }

        Item::create($data);

        return redirect()->route('admin.items.index');
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
    public function edit(Item $item)
    {
        $item->load('type', 'brand');

        $brands = Brand::all();
        $types = Type::all();

        return view('admin.items.edit', compact('item', 'brands', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, Item $item)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        // Upload multiple photos
        if ($request->hasFile('photos')) {
            $photos = [];

            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('assets/item', 'public');

                // Store as json
                array_push($photos, $photoPath);
            }

            $data['photos'] = json_encode($photos);
        }else {
            $data ['photos'] = $item->photos;
        }

       $item->update($data);

        return redirect()->route('admin.items.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('admin.items.index');    }
}
