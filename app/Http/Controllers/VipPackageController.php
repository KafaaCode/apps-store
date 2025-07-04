<?php

namespace App\Http\Controllers;

use App\Models\VipPackage;
use Illuminate\Http\Request;

class VipPackageController extends Controller
{
    public function index()
    {
        $packages = VipPackage::latest()->get();
        return view('admin.vip_packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.vip_packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
        ]);

        VipPackage::create($request->all());

        return redirect()->route('ad.vip-packages.index')->with('success', 'تمت إضافة الباقة بنجاح');
    }

    public function edit(VipPackage $vipPackage)
    {
        return view('admin.vip_packages.edit', compact('vipPackage'));
    }

    public function update(Request $request, VipPackage $vipPackage)
    {
        $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
        ]);

        $vipPackage->update($request->all());

        return redirect()->route('ad.vip-packages.index')->with('success', 'تم التعديل بنجاح');
    }

    public function destroy(VipPackage $vipPackage)
    {
        $vipPackage->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
}
