<?php
// app/Http/Controllers/CashflowController.php

namespace App\Http\Controllers;

use App\Models\Cashflow;
use Illuminate\Http\Request;

class CashflowController extends Controller
{
    // GET /cashflow
    public function index()
    {
        $cashflows = Cashflow::all();
        return response()->json($cashflows);
    }

    // POST /cashflow
    public function store(Request $request)
    {
        $cashflow = new Cashflow();
        $cashflow->from_account_id = $request->from_account_id;
        $cashflow->to_account_id = $request->to_account_id;
        $cashflow->name = $request->name;
        $cashflow->amount = $request->amount;
        $cashflow->on_date = $request->on_date;
        $cashflow->repeat = $request->repeat;
        $cashflow->transfer_type = $request->transfer_type;
        $cashflow->save();

        return response()->json($cashflow);
    }

    // GET /cashflow/{id}
    public function show($id)
    {
        $cashflow = Cashflow::find($id);
        if (!$cashflow) {
            return response()->json(['error' => 'Cashflow not found'], 404);
        }

        return response()->json($cashflow);
    }

    // PUT /cashflow/{id}
    public function update(Request $request, $id)
    {
        $cashflow = Cashflow::find($id);
        if (!$cashflow) {
            return response()->json(['error' => 'Cashflow not found'], 404);
        }

        $cashflow->from_account_id = $request->from_account_id;
        $cashflow->to_account_id = $request->to_account_id;
        $cashflow->name = $request->name;
        $cashflow->amount = $request->amount;
        $cashflow->on_date = $request->on_date;
        $cashflow->repeat = $request->repeat;
        $cashflow->transfer_type = $request->transfer_type;
        $cashflow->save();

        return response()->json($cashflow);
    }

    // DELETE /cashflow/{id}
    public function destroy($id)
    {
        $cashflow = Cashflow::find($id);
        if (!$cashflow) {
            return response()->json(['error' => 'Cashflow not found'], 404);
        }

        $cashflow->delete();
        return response()->json(['message' => 'Cashflow deleted']);
    }
}

