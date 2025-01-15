<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function index()
    {
        $banks = BankAccount::all();
        return view('User.postvacancy.paymentmethod.onlinefundtransfer', compact('banks'));
    }
    public function indexadmin()
    {
        $bankAccounts = BankAccount::all();
        return view('Admin.bank.index', compact('bankAccounts'));
    }

    public function create()
    {
        return view('Admin.bank.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bank_name' => 'required',
            'account_name' => 'required',
            'account_no' => 'required',
            'bank_code' => 'required',
            'branch_code' => 'required',
            'branch_name' => 'required', // Add this line
            'swift_code' => 'nullable',
            'currency' => 'required',
        ]);

        BankAccount::create($validated);
        return redirect()->route('admin.bank-accounts.index')->with('success', 'Bank account created successfully');
    }

    public function edit(BankAccount $bankAccount)
    {
        return view('Admin.bank.edit', compact('bankAccount'));
    }

    public function update(Request $request, BankAccount $bankAccount)
    {
        $validated = $request->validate([
            'bank_name' => 'required',
            'account_name' => 'required',
            'account_no' => 'required',
            'bank_code' => 'required',
            'branch_code' => 'required',
            'branch_name' => 'required', // Add this line
            'swift_code' => 'nullable',
            'currency' => 'required',
        ]);

        $bankAccount->update($validated);
        return redirect()->route('admin.bank-accounts.index')->with('success', 'Bank account updated successfully');
    }

    public function destroy(BankAccount $bankAccount)
    {
        $bankAccount->delete();
        return redirect()->route('admin.bank-accounts.index')->with('success', 'Bank account deleted successfully');
    }
}
