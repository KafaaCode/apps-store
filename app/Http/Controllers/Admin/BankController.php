<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankRequest;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use RealRashid\SweetAlert\Facades\Alert;

class BankController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_banks')->only(['index']);
        $this->middleware('permission:create_banks')->only(['create', 'store']);
        $this->middleware('permission:update_banks')->only(['edit', 'update']);
        $this->middleware('permission:delete_banks')->only(['delete']);

    }// end of __construct
    public function index()
    {
        $banks = Bank::latest()->paginate(10);
        return view('admin.banks.index', compact('banks'));
    }
    public function create()
    {
        return view('admin.banks.create');
    }
    public function store(BankRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/banks'), $filename);
            $data['image'] = $filename;
        }

        Bank::create($data);

        Alert::success(__('settings.success'), __('createsms'));
        return redirect()->route('ad.banks.index');
    }

    public function edit(Bank $bank)
    {
        return view('admin.banks.edit', compact('bank'));
    }
    public function update(BankRequest $request, Bank $bank)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($bank->image && file_exists(public_path('uploads/banks/' . $bank->image))) {
                unlink(public_path('uploads/banks/' . $bank->image));
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/banks'), $filename);
            $data['image'] = $filename;
        }

        $bank->update($data);

        Alert::success(__('settings.success'), __('editsms'));
        return redirect()->route('ad.banks.index');
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();
        Alert::success(__('settings.success'), __('deletesms'));
        return redirect()->back();
    }
}
