<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function index(Request $request)
    {
        $query = Courier::query();

        if ($request->sort_by === 'registered_at') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('name', 'asc');
        }

        if ($request->has('level') && $request->level === '2,3') {
            $query->whereIn('level', [2, 3]);
        }

        if ($request->has('search')) {
            $keywords = explode(' ', $request->search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $q->orWhere('name', 'like', '%' . $keyword . '%');
                }
            });
        }

        $couriers = $query->paginate(10)->appends([
            'search' => $request->search,
            'level' => $request->level,
            'sort_by' => $request->sort_by,
        ]);

        return view('couriers.index', compact('couriers'));
    }

    public function show(Courier $courier){
        return view('couriers.show', compact('courier'));
    }

    public function create()
    {
        return view('couriers.create');
    }

    public function store(Request $request){
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:couriers,email',
                'phone' => 'required|string|max:20',
                'level' => 'required|integer|min:1|max:5',
            ],
            [
                'email.unique' => 'The email address is already in use. Please use a different email.',
                'email.required' => 'The email field is required.',
                'name.required' => 'The name field is required.',
            ]
        );
    
        $courier = Courier::create($validated);
    
        return redirect()->route('couriers.index')->with('success', 'Courier added successfully.');
    }

    public function edit(Courier $courier){
        return view('couriers.edit', compact('courier'));
    }

    public function update(Request $request, Courier $courier){
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:couriers,email,' . $courier->id,
                'phone' => 'required|string|max:20',
                'level' => 'required|integer|min:1|max:5',
            ],
            [
                'email.unique' => 'The email address is already in use. Please use a different email.',
                'email.required' => 'The email field is required.',
                'name.required' => 'The name field is required.',
            ]
        );

        $courier->update($validated);

        return redirect()->route('couriers.index')->with('success', 'Courier updated successfully.');
    }

    public function destroy(Courier $courier){
        $courier->delete();

        return redirect()->route('couriers.index')->with('success', 'Courier deleted successfully.');
    }
}
