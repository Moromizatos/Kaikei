<?php
// app/Http/Controllers/AccountsController.php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    // GET /accounts
    public function index()
    {
        $accounts = Accounts::all();
        return response()->json($accounts);
    }

    // POST /accounts
    public function store(Request $request)
    {
        $account = new Accounts();
        $account->name = $request->name;
        $account->balance = $request->balance;
        $account->is_joint = $request->is_joint;
        $account->currency = $request->currency;
        $account->account_type = $request->account_type;
        $account->save();

        return response()->json($account);
    }

    // GET /accounts/{id}
    public function show($id)
    {
        $account = Accounts::find($id);
        if (!$account) {
            return response()->json(['error' => 'Account not found'], 404);
        }

        return response()->json($account);
    }

    // PUT /accounts/{id}
    public function update(Request $request, $id)
    {
        $account = Accounts::find($id);
        if (!$account) {
            return response()->json(['error' => 'Account not found'], 404);
        }

        $account->name = $request->name;
        $account->balance = $request->balance;
        $account->is_joint = $request->is_joint;
        $account->currency = $request->currency;
        $account->account_type = $request->account_type;
        $account->save();

        return response()->json($account);
    }

    // DELETE /accounts/{id}
    public function destroy($id)
    {
        $account = Accounts::find($id);
        if (!$account) {
            return response()->json(['error' => 'Account not found'], 404);
        }

        $account->delete();
        return response()->json(['message' => 'Account deleted']);
    }
}
