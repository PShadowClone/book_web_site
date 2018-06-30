<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseContoller;

const UPDATE_FLAG = 1;
class Controller extends BaseContoller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, self::rules(), self::messages());
        try {
            Category::create([
                'name' => $request->input('name'),
                'arrange' => $request->input('arrange'),
                'image' => image_upload($request->file('image'), 'category')['data']
            ]);
            success_message(trans('category.stored_successfully'));
        } catch (\Exception $exception) {
            error_message(trans('category.stored_error'));
        }
        return redirect()->route('category.show');

    }

    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('Categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        $category = Category::find($id);
        if (!$category) {
            error_message(trans('category.not_found'));
            return redirect()->route('category.show');
        }
        try {
            return view('Categories.update', compact('category'));
        } catch (\Exception $exception) {
            error_message(trans('category.show_error'));
            return redirect()->route('category.show');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        $this->validate($request, self::rules(UPDATE_FLAG), self::messages());
        $category = Category::find($id);
        if (!$category) {
            error_message(trans('category.not_found'));
            return redirect()->route('category.show');
        }
        try {
            $category->name = $request->input('name');
            $category->arrange = $request->input('arrange');
            $category->image = image_update($category->image, $request->file('image'), 'category')['data'];
            $category->updated_at = Carbon::now();
            $category->update();
            success_message(trans('category.updated_successfully'));
        } catch (\Exception $exception) {
            error_message(trans('category.updated_error'));
            return redirect()->back();
        }
        return redirect()->route('category.show');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['status' => NOT_FOUND, 'message' => trans('category.not_found')]);
        }
        try {
            $category->delete();
            return response()->json(['status' => SUCCESS_STATUS , 'message' => trans('category.deleted_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR , 'message' => trans('category.deleted_error')]);
        }
    }


    public function getAllCategories(Request $request)
    {
        try {
            $categories = Category::orderBy('arrange', 'asc')->where([]);
            if ($request->input('name'))
                $categories = $categories->orWhere('name', 'like', '%' . $request->input('name') . '%');
            $categories = $categories->get();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('category.show_successfully'), 'data' => $categories]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('category.show_error'), 'data' => []]);
        }
    }

    /**
     *
     * category required rules
     *
     * @param int $flag
     * @return array
     */
    private function rules($flag = -1)
    {
        if ($flag == -1)
            return [
                'name' => 'required|string',
                'arrange' => 'required|numeric',
                'image' => 'required',
            ];
        else
            return [
                'name' => 'required|string',
                'arrange' => 'required|numeric',
            ];
    }

    /**
     * category's validation messages
     *
     * @return array
     *
     */
    private function messages()
    {
        return [
            'name.required' => trans('category.name_required'),
            'name.string' => trans('category.name_string'),
            'arrange.required' => trans('category.arrange_required'),
            'arrange.numeric' => trans('category.arrange_numeric'),
            'image.required' => trans('category.image_required'),
            'image.image' => trans('category.image_image'),
        ];
    }


}
