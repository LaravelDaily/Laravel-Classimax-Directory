<?php

namespace App\Http\Controllers\Admin;

use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCitiesRequest;
use App\Http\Requests\Admin\UpdateCitiesRequest;

class CitiesController extends Controller
{
    /**
     * Display a listing of City.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('city_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('city_delete')) {
                return abort(401);
            }
            $cities = City::onlyTrashed()->get();
        } else {
            $cities = City::all();
        }

        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating new City.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('city_create')) {
            return abort(401);
        }
        return view('admin.cities.create');
    }

    /**
     * Store a newly created City in storage.
     *
     * @param  \App\Http\Requests\StoreCitiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCitiesRequest $request)
    {
        if (! Gate::allows('city_create')) {
            return abort(401);
        }
        $city = City::create($request->all());



        return redirect()->route('admin.cities.index');
    }


    /**
     * Show the form for editing City.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('city_edit')) {
            return abort(401);
        }
        $city = City::findOrFail($id);

        return view('admin.cities.edit', compact('city'));
    }

    /**
     * Update City in storage.
     *
     * @param  \App\Http\Requests\UpdateCitiesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCitiesRequest $request, $id)
    {
        if (! Gate::allows('city_edit')) {
            return abort(401);
        }
        $city = City::findOrFail($id);
        $city->update($request->all());



        return redirect()->route('admin.cities.index');
    }


    /**
     * Display City.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('city_view')) {
            return abort(401);
        }
        $companies = \App\Company::where('city_id', $id)->get();

        $city = City::findOrFail($id);

        return view('admin.cities.show', compact('city', 'companies'));
    }


    /**
     * Remove City from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('city_delete')) {
            return abort(401);
        }
        $city = City::findOrFail($id);
        $city->delete();

        return redirect()->route('admin.cities.index');
    }

    /**
     * Delete all selected City at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('city_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = City::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore City from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('city_delete')) {
            return abort(401);
        }
        $city = City::onlyTrashed()->findOrFail($id);
        $city->restore();

        return redirect()->route('admin.cities.index');
    }

    /**
     * Permanently delete City from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('city_delete')) {
            return abort(401);
        }
        $city = City::onlyTrashed()->findOrFail($id);
        $city->forceDelete();

        return redirect()->route('admin.cities.index');
    }
}
