<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PropertyController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::get();
        $currentAdmin = $this->currentAdmin;

        return view('admin.pages.properties.list', compact('properties', 'currentAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereStatus('1')->get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.properties.create', compact('categories', 'currentAdmin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyRequest $request)
    {
        $request['name_property'] = strtolower($request->name_property);
        $array_type_input = ['type_input' => $request->type_input];
        if ($request->type_input == 'select') {
            $textarea_select_input = $request->validate([
                'textarea_select_input' => ['required'],
            ]);
            foreach (explode('|', $textarea_select_input['textarea_select_input']) as $row) {
                $key = str_replace(' ', '_', trim($row));
                $array_type_input[$key] = trim($row);
            }
            $request['type_input'] = $array_type_input;
        } else {
            $request['type_input'] = $array_type_input;
        }

        $array_have_unit = [];
        if ($request->have_unit == 'check') {
            $array_have_unit = ['have_unit' => true];
            $textarea_unit = $request->validate([
                'textarea_unit' => ['required'],
            ]);
            foreach (explode('|', $textarea_unit['textarea_unit']) as $row) {
                $key = str_replace(' ', '_', trim($row));
                $array_have_unit[$key] = trim($row);
            }
            $request['have_unit'] = $array_have_unit;
        } else {
            $request['have_unit'] = ['have_unit' => false];
        }
        $property = Property::create($request->all());

        if ($request->category != null) {
            $property->categories()->attach($request->category);
        }
        return redirect(route('properties.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.properties.edit', compact('property', 'currentAdmin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyRequest $request, Property $property)
    {
        $request['name_property'] = strtolower($request->name_property);
        $array_type_input = ['type_input' => $request->type_input];
        if ($request->type_input == 'select') {
            $textarea_select_input = $request->validate([
                'textarea_select_input' => ['required'],
            ]);
            foreach (explode('|', $textarea_select_input['textarea_select_input']) as $row) {
                $key = str_replace(' ', '_', trim($row));
                $array_type_input[$key] = trim($row);
            }
            $request['type_input'] = $array_type_input;
        } else {
            $request['type_input'] = $array_type_input;
        }

        $array_have_unit = [];
        if ($request->have_unit == 'check') {
            $array_have_unit = ['have_unit' => true];
            $textarea_unit = $request->validate([
                'textarea_unit' => ['required'],
            ]);
            foreach (explode('|', $textarea_unit['textarea_unit']) as $row) {
                $key = str_replace(' ', '_', trim($row));
                $array_have_unit[$key] = trim($row);
            }
            $request['have_unit'] = $array_have_unit;
        } else {
            $request['have_unit'] = ['have_unit' => false];
        }
        if ($request->status == 0) {
            Session::flash('message', count($property->categories()->get()) . ' تا دسته بندی این ویژگی از بین رفت ');
            $property->categories()->detach();
        }
        $property->update($request->all());
        return redirect(route('properties.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return redirect(route('properties.index'));
    }
}
