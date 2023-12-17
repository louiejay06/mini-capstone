<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\Motor;
use App\Models\Purchase;
use App\Models\User;
use App\Notifications\MotorPurchasedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MotorController extends Controller
{
    public function index()
    {
        $motors = Motor::all();
        return view('motors.index', compact('motors'));
    }

    public function create()
    {
        return view('motors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|integer',
            'power' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation rules
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }

        // Create motor with image path
        $motorData = array_merge($request->all(), ['image_path' => $imagePath]);
        $motor = Motor::create($motorData);

        $log_entry = Auth::user()->name . " added a motor " . $motor->brand . " " . $motor->model . " with the id# " . $motor->id;
        event(new UserLog($log_entry));

        return redirect()->route('motors.index')->with('success', 'Motor created successfully');
    }

    public function show(Motor $motor)
    {
        return view('motors.show', compact('motor'));
    }

    public function edit(Motor $motor)
    {
        return view('motors.edit', compact('motor'));
    }

    public function update(Request $request, Motor $motor)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|integer',
            'power' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation rules
        ]);

        // Handle image update
        $imagePath = $motor->image_path;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }

        // Update motor with new data and image path
        $data = array_merge($request->only(['brand', 'model', 'year', 'power']), ['image_path' => $imagePath]);
        $motor->update($data);

        $log_entry = Auth::user()->name . " updated a motor " . $motor->brand . " " . $motor->model . " with the id# " . $motor->id;
        event(new UserLog($log_entry));

        return redirect()->route('motors.index')->with('success', 'Motor updated successfully');
    }

    public function destroy(Motor $motor)
    {
        $motor->delete();
        $log_entry = Auth::user()->name . " deleted a motor " . $motor->brand . " " . $motor->model . " with the id# " . $motor->id;
        event(new UserLog($log_entry));

        return redirect()->route('motors.index')->with('success', 'Motor deleted successfully');
    }

    public function purchaseForm(Motor $motor)
    {
        return view('motors.purchase', compact('motor'));
    }

    public function purchase(Request $request, Motor $motor)
    {
        $request->validate([
            'buyer_name' => 'required',
            'contact_number' => 'required',
        ]);

        // Handle image retrieval from the motor
        $imagePath = $motor->image_path;

        $purchase = Purchase::create([
            'motor_id' => $motor->id,
            'buyer_name' => $request->input('buyer_name'),
            'contact_number' => $request->input('contact_number'),
            'motor_image_path' => $imagePath, // Save the image path with the purchase record
        ]);

        $user = User::find(1); // Replace with your notifiable entity retrieval logic
        $user->notify(new MotorPurchasedNotification($motor, $purchase));

        return redirect()->route('motors.purchase.show', ['motor' => $motor, 'purchase' => $purchase])
            ->with('success', 'Motor purchased successfully');
    }

    public function purchaseShow(Motor $motor, Purchase $purchase)
    {
        return view('motors.purchased', compact('motor', 'purchase'));
    }

    public function purchasedMotors()
    {
        $purchasedMotors = Purchase::with('motor')->get(); // Assuming there's a relationship between Purchase and Motor models

        return view('motors.purchased.index', compact('purchasedMotors'));
    }
}
