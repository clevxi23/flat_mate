<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('website.admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('website.admin.packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pack_name' => 'required|string|max:255',
            'pack_fee' => 'required|numeric|min:0',
            'pack_privillages' => 'required|string',
            'pack_duration' => 'required|string|max:100',
            'pack_status' => 'required|in:active,inactive',
        ]);

        Package::create($request->all());

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package)
    {
        return view('website.admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'pack_name' => 'required|string|max:255',
            'pack_fee' => 'required|numeric|min:0',
            'pack_privillages' => 'required|string',
            'pack_duration' => 'required|string|max:100',
            'pack_status' => 'required|in:active,inactive',
        ]);

        $package->update($request->all());

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
    }
}
