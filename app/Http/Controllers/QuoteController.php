<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteRequest;
use App\Models\Category;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuoteController extends Controller
{
    /** Home page: public list with search, category filter, sorting and pagination. */
    public function index(Request $request)
    {
        $term = trim((string) $request->query('q', ''));
        $category = (string) $request->query('category', '');
        $sort = (string) $request->query('sort', 'newest');

        $quotes = Quote::query()
            ->with(['user:id,name', 'category'])   // avoids the N+1 query problem
            ->search($term)
            ->when($category !== '', fn ($q) => $q->whereHas('category', fn ($c) => $c->where('slug', $category)))
            ->ordered($sort)
            ->paginate(config('rukn.per_page'))
            ->withQueryString();

        return view('quotes.index', [
            'quotes' => $quotes,
            'categories' => Category::orderBy('sort')->get(),
        ]);
    }

    public function show(Quote $quote)
    {
        $quote->load(['user', 'category']);

        $related = Quote::with(['user:id,name', 'category'])
            ->where('category_id', $quote->category_id)
            ->whereKeyNot($quote->id)
            ->latest()
            ->take(3)
            ->get();

        return view('quotes.show', compact('quote', 'related'));
    }

    public function create()
    {
        return view('quotes.create', [
            'categories' => Category::orderBy('sort')->get(),
        ]);
    }

    public function store(QuoteRequest $request)
    {
        // The publisher always comes from the session, never from the form
        $quote = $request->user()->quotes()->create($request->validated());

        return redirect()
            ->route('quotes.show', $quote)
            ->with('status', __('ui.quote.created'));
    }

    public function edit(Quote $quote)
    {
        Gate::authorize('update', $quote);

        return view('quotes.edit', [
            'quote' => $quote,
            'categories' => Category::orderBy('sort')->get(),
        ]);
    }

    public function update(QuoteRequest $request, Quote $quote)
    {
        Gate::authorize('update', $quote);

        $quote->update($request->validated());

        return redirect()
            ->route('quotes.show', $quote)
            ->with('status', __('ui.quote.updated'));
    }

    public function destroy(Quote $quote)
    {
        Gate::authorize('delete', $quote);

        $quote->delete();

        return redirect()->route('home')->with('status', __('ui.quote.deleted'));
    }
}
