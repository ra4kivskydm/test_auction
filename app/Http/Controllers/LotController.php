<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lot;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = Category::all();
        $lots = Lot::all()->sortDesc();

        return view('index', compact('lots','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Category::all();

        return view('lot.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        /** @var Lot $lot */
        $lot = Lot::query()->create(['name' => $request->input('name', []), 'description' => $request->input('description', [])]);
        $lot->categories()->attach($request->input('idcategory'));

        return redirect()->route('index');
    }

    /**
     * Summary of show
     * @param mixed $id
     * @return Factory|View
     */
    public function show($id)
    {
        $categories = Category::all();
        $lot = Lot::query()->findOrFail($id);

        return view('lot', compact('lot', 'categories'));
    }

    /**
     * Filter lots by categories
     *
     * @param Request $request
     * @return View
     */
    public function filter(Request $request): View
    {
        $categories = Category::all();
        $inputOfCategoryIds = $request->input('idcategory', []);
        $lots = Lot::query()->when($inputOfCategoryIds, function (Builder $query, $inputOfCategoryIds) {
            return $query->whereHas('categories', function (Builder $query) use ($inputOfCategoryIds) {
                $query->whereIn('id', $inputOfCategoryIds);
            });
        })->get()->sortDesc();

        return view('index', compact('lots', 'categories'));
    }

    /**
     * Summary of edit
     * @param mixed $id
     * @return View
     */
    public function edit($id): View
    {
        $categories = Category::all();
        /** @var Lot $lot */
        $lot = Lot::query()->find($id);
        $lotCategoryIds = $lot->categories()->get(['id']);
        $lotCategoryIdsArray = [];
        foreach ($lotCategoryIds as $lotCategory) {
            $lotCategoryIdsArray[] = $lotCategory->id;
        }

        return view('lot.edit', compact('lot', 'lotCategoryIdsArray', 'categories'));
    }

    /**
     * Update lot
     * @param Request $request
     * @param mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        /** @var Lot $lot */
        $lot = Lot::query()->findOrFail($id);
        $lot->fill(['name' => $request->input('name', []), 'description' => $request->input('description', [])])->save();

        if ($request->input('idcategory')) {
            $lot->categories()->sync($request->input('idcategory', []));
        } else {
            $lot->categories()->detach();
        }

        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $lot = Lot::query()->findOrFail($id);
        $lot->delete();

        return redirect()->route('index');
    }
}
