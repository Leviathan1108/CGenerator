<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::all();
        return view('subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        return view('subscriptions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ]);

        Subscription::create($request->all());

        return redirect()->route('subscriptions.index')->with('success', 'Subscription created successfully.');
    }

    public function edit(Subscription $subscription)
    {
        return view('subscriptions.edit', compact('subscription'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ]);

        $subscription->update($request->all());

        return redirect()->route('subscriptions.index')->with('success', 'Subscription updated successfully.');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('subscriptions.index')->with('success', 'Subscription deleted successfully.');
    }
}
