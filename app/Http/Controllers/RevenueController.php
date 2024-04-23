<?php
// app/Http/Controllers/RevenueController.php

namespace App\Http\Controllers;

use App\Models\Revenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    // GET /revenue
    public function index()
    {
        $revenue = Revenue::all();
        return response()->json($revenue);
    }

    // POST /revenue
    public function store(Request $request)
    {
        $revenue = new Revenue();
        $revenue->user_id = $request->user_id;
        $revenue->hours = $request->hours;
        $revenue->pay_rate = $request->pay_rate;
        $revenue->week_number = $request->week_number;
        $revenue->week_start = $request->week_start;
        $revenue->payday = $request->payday;
        $revenue->save();

        return response()->json($revenue);
    }

    // GET /revenue/{id}
    public function show($id)
    {
        $revenue = Revenue::find($id);
        if (!$revenue) {
            return response()->json(['error' => 'Revenue not found'], 404);
        }

        return response()->json($revenue);
    }

    // PUT /revenue/{id}
    public function update(Request $request, $id)
    {
        $revenue = Revenue::find($id);
        if (!$revenue) {
            return response()->json(['error' => 'Revenue not found'], 404);
        }

        $revenue->user_id = $request->user_id;
        $revenue->hours = $request->hours;
        $revenue->pay_rate = $request->pay_rate;
        $revenue->week_number = $request->week_number;
        $revenue->week_start = $request->week_start;
        $revenue->payday = $request->payday;
        $revenue->save();

        return response()->json($revenue);
    }

    // DELETE /revenue/{id}
    public function destroy($id)
    {
        $revenue = Revenue::find($id);
        if (!$revenue) {
            return response()->json(['error' => 'Revenue not found'], 404);
        }

        $revenue->delete();
        return response()->json(['message' => 'Revenue deleted']);
    }
}

