<?php

namespace App\Http\Controllers;

//import model categorie
use App\Models\Categorie; 

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\Request;

//import Http Request
use Illuminate\Http\RedirectResponse;

//import Facades Storage
use Illuminate\Support\Facades\Storage;

class CategorieController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index() : View
    {
        //get all categories
        $categories = Categorie::latest()->paginate(10);

        //render view with categories
        return view('categories.index', compact('categories'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * store
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name'         => 'required|min:3',
            'description'  => 'required|min:5'
        ]);

        //create category
        Categorie::create([
            'name'         => $request->name,
            'description'  => $request->description
        ]);

        //redirect to index
        return redirect()->route('categories.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * show
     *
     * @param  string $id
     * @return View
     */
    public function show(string $id): View
    {
        //get category by ID
        $categorie = Categorie::findOrFail($id);

        //render view with category
        return view('categories.show', compact('categorie'));
    }
    
    /**
     * edit
     *
     * @param  string $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get category by ID
        $categorie = Categorie::findOrFail($id);

        //render view with category
        return view('categories.edit', compact('categorie'));
    }
        
    /**
     * update
     *
     * @param  Request $request
     * @param  string $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'name'         => 'required|min:3',
            'description'  => 'required|min:5'
        ]);

        //get category by ID
        $categorie = Categorie::findOrFail($id);

        //update category
        $categorie->update([
            'name'         => $request->name,
            'description'  => $request->description
        ]);

        //redirect to index
        return redirect()->route('categories.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    
    /**
     * destroy
     *
     * @param  string $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get category by ID
        $categorie = Categorie::findOrFail($id);

        //delete category
        $categorie->delete();

        //redirect to index
        return redirect()->route('categories.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
