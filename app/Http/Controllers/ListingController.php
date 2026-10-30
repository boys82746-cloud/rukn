<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListingRequest;
use App\Models\Category;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ListingController extends Controller
{
    /** Home page: public list with search, filters, sorting and pagination. */
    public function index(Request $request)
    {
        $term = trim((string) $request->query('q', ''));
        $category = (string) $request->query('category', '');
        $city = (string) $request->query('city', '');
        $min = $request->query('min');
        $max = $request->query('max');
        $sort = (string) $request->query('sort', 'newest');

        $listings = Listing::query()
            ->with(['user:id,name', 'category'])   // avoids the N+1 query problem
            ->search($term)
            ->when($category !== '', fn ($q) => $q->whereHas('category', fn ($c) => $c->where('slug', $category)))
            ->when(in_array($city, config('marketplace.cities'), true), fn ($q) => $q->where('city', $city))
            ->when(is_numeric($min), fn ($q) => $q->where('price', '>=', (int) $min))
            ->when(is_numeric($max), fn ($q) => $q->where('price', '<=', (int) $max))
            ->ordered($sort)
            ->paginate(config('marketplace.per_page'))
            ->withQueryString();

        return view('listings.index', [
            'listings' => $listings,
            'categories' => Category::orderBy('sort')->get(),
        ]);
    }

    public function show(Listing $listing)
    {
        $listing->load(['user', 'category']);

        $related = Listing::with(['user:id,name', 'category'])
            ->where('category_id', $listing->category_id)
            ->whereKeyNot($listing->id)
            ->latest()
            ->take(3)
            ->get();

        return view('listings.show', compact('listing', 'related'));
    }

    public function create()
    {
        return view('listings.create', [
            'categories' => Category::orderBy('sort')->get(),
        ]);
    }

    public function store(ListingRequest $request)
    {
        $listing = $request->user()->listings()->create($request->validated());

        return redirect()
            ->route('listings.show', $listing)
            ->with('status', __('ui.listing.created'));
    }

    public function edit(Listing $listing)
    {
        Gate::authorize('update', $listing);

        return view('listings.edit', [
            'listing' => $listing,
            'categories' => Category::orderBy('sort')->get(),
        ]);
    }

    public function update(ListingRequest $request, Listing $listing)
    {
        Gate::authorize('update', $listing);

        $listing->update($request->validated());

        return redirect()
            ->route('listings.show', $listing)
            ->with('status', __('ui.listing.updated'));
    }

    public function destroy(Listing $listing)
    {
        Gate::authorize('delete', $listing);

        $listing->delete();

        return redirect()->route('home')->with('status', __('ui.listing.deleted'));
    }
}
