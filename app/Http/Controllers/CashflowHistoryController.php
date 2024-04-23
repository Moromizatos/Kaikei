<?php
// app/Http/Controllers/CashflowHistoryController.php

namespace App\Http\Controllers;

use App\Models\CashflowHistory;
use Illuminate\Http\Request;

class CashflowHistoryController extends Controller
{
    // GET /cashflowHistory
    public function index()
    {
        $cashflowHistories = CashflowHistory::all();
        return response()->json($cashflowHistories);
    }

    // POST /cashflowHistory
    public function store(Request $request)
    {
        $cashflowHistory = new CashflowHistory();
        $cashflowHistory->cashflow_id = $request->cashflow_id;
        $cashflowHistory->from_account_id = $request->from_account_id;
        $cashflowHistory->to_account_id = $request->to_account_id;
        $cashflowHistory->name = $request->name;
        $cashflowHistory->amount = $request->amount;
        $cashflowHistory->on_date = $request->on_date;
        $cashflowHistory->repeat = $request->repeat;
        $cashflowHistory->transfer_type = $request->transfer_type;
        $cashflowHistory->save();

        return response()->json($cashflowHistory);
    }

    // GET /cashflowHistory/{id}
    public function show($id)
    {
        $cashflowHistory = CashflowHistory::find($id);
        if (!$cashflowHistory) {
            return response()->json(['error' => 'CashflowHistory not found'], 404);
        }

        return response()->json($cashflowHistory);
    }

    // PUT /cashflowHistory/{id}
    public function update(Request $request, $id)
    {
        $cashflowHistory = CashflowHistory::find($id);
        if (!$cashflowHistory) {
            return response()->json(['error' => 'CashflowHistory not found'], 404);
        }

        $cashflowHistory->cashflow_id = $request->cashflow_id;
        $cashflowHistory->from_account_id = $request->from_account_id;
        $cashflowHistory->to_account_id = $request->to_account_id;
        $cashflowHistory->name = $request->name;
        $cashflowHistory->amount = $request->amount;
        $cashflowHistory->on_date = $request->on_date;
        $cashflowHistory->repeat = $request->repeat;
        $cashflowHistory->transfer_type = $request->transfer_type;
        $cashflowHistory->save();

        return response()->json($cashflowHistory);
    }

    // DELETE /cashflowHistory/{id}
    public function destroy($id)
    {
        $cashflowHistory = CashflowHistory::find($id);
        if (!$cashflowHistory) {
            return response()->json(['error' => 'CashflowHistory not found'], 404);
        }

        $cashflowHistory->delete();
        return response()->json(['message' => 'CashflowHistory deleted']);
    }
}
