<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['account', 'unitAds'])->latest('review_id')->get();
        return view('website.admin.reviews', compact('reviews'));
    }

    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return redirect()->route('admin.reviews')->with('success', 'Review deleted successfully.');
    }
}
