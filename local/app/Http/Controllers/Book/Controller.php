<?php

namespace App\Http\Controllers\Book;

use App\Book;
use App\Category;
use App\Library;
use App\UserEvaluations;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Exception\ExecutionTimeoutException;
use  Maatwebsite\Excel\Facades\Excel;

class Controller extends BaseController
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
        return view('Books.create');
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
            $book = new Book();
            $book->fill($request->all());

            $book->image = image_upload($request->file('image'), 'book')['data'];
//            dd(image_upload($request->file('image'), 'book'));
            $book->save();
            success_message(trans('book.stored_successfully'));
        } catch (\Exception $exception) {
            error_message(trans('book.stored_error'));
        }
        return redirect()->route('book.show');
    }

    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('Books.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        if (!$book) {
            error_message(trans('book.not_found'));
            return redirect()->route('book.show');
        }
        try {
            $book['evaluations'] = self::calculateTotalEvaluations($book->evaluations()->sum('evaluate'), $book->evaluations()->count());
            return view('Books.update', compact('book'));
        } catch (\Exception $exception) {
            error_message(trans('book.edit_error'));
            return redirect()->route('book.show');
        }

    }

    public function showEvaluations(Request $request, $book_id = null)
    {
        $book = Book::find($book_id);
        if (!$book) {
            error_message(trans('book.not_found'));
            return redirect()->route('book.show');
        }
        try {
            $book['evaluations'] = self::calculateTotalEvaluations($book->evaluations()->sum('evaluate'), $book->evaluations()->count());
            return view('Books.evaluations', compact('book'));
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            error_message(trans('book.evaluations_error'));
            return redirect()->route('book.show');
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
        $this->validate($request, self::rules(2), self::messages());
        $book = Book::find($id);
        if (!$book) {
            error_message(trans('book.not_found'));
            return redirect()->route('book.show');
        }
        try {
            $oldImage = $book->image;
            $book->fill($request->all());
            $book->image = image_update($oldImage, $request->file('image'), 'book')['data'];
            $book->update();
            success_message(trans('book.updated_successfully'));
        } catch (\Exception $exception) {
            error_message(trans('book.updated_error'));
        }
        return redirect()->route('book.show');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $book = Book::find($id);
        if (!$book)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('book.not_found')]);
        try {
            $book->delete();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('book.deleted_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('book.deleted_error')]);
        }

    }

    public function changeAmount($id = null, $new_amount = null)
    {
        $book = Book::find($id);
        if (!$book)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('book.not_found')]);
        if (!is_numeric($new_amount))
            return response()->json(['status' => VALIDATION_ERROR, 'message' => trans('book.check_amount_value')]);
        try {
            $book->amount = $new_amount;
            $book->update();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('book.amount_changed_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('book.amount_changed_error')]);
        }

    }

    /**
     *
     *  calculate the total evaluation number of book
     * @param $sum
     * @param $count
     * @return float|int
     */
    public function calculateTotalEvaluations($sum, $count)
    {
        if ($count == 0)
            return 0;

        return $sum / $count;
    }


    public function getAllBooks(Request $request)
    {
        try {

            $books = Book::orderBy('arrange', 'asc')->where([]);
            if ($request->input('category_id') && $request->input('category_id') != '-1') {
                $books = $books->orWhere('category_id', '=', $request->input('category_id'));
            }
            if ($request->input('name') && trim($request->input('name')) != '') {
                $books = $books->orWhere('name', 'like', '%' . $request->input('name') . '%');
            }

            $books = $books->get()->map(function ($item) {
                $item->category;
                return $item;
            });
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('book.show_successfully'), 'data' => $books]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('book.show_error'), 'data' => []]);
        }
    }


    public function getAllEvaluations(Request $request, $book_id = null)
    {
        $book = Book::find($book_id);
        if (!$book)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('book.not_found'), 'data' => []]);
        try {
            $evaluations = $book->evaluations();
            if ($request->input('request_identifier')) {
                $evaluations = UserEvaluations::byRequest($request->input('request_identifier'));
            }
            if ($request->input('client_name')) {
                $evaluations = UserEvaluations::byClient($request->input('client_name'));
            }
            if ($request->input('client_phone')) {
                $evaluations = UserEvaluations::byClient($request->input('client_phone'));
            }
            if ($request->input('form')) {
                $evaluations = UserEvaluations::byRequest($request->input('from'));
            }

            $evaluations = $evaluations->get()->map(function ($item) {
                $item->client;
                $item->driver;
                $item->request;
                return $item;
            });
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('book.request_evaluations_show_successfully'), 'data' => $evaluations]);
        } catch (\Exception $exception) {
//            return response()->json(['status' =>  SERVER_ERROR, 'message' => trans('book.request_evaluations_show_error'), 'data' => []]);
            return response()->json(['status' => SERVER_ERROR, 'message' => $exception->getMessage(), 'data' => []]);
        }

    }

    /**
     * import books from excel file
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadFile(Request $request)
    {
//        dd($request->file('book_file'));
        $validator = Validator::make($request->all(), [
            'book_file' => 'required|mimes:csv,xlsx,xls',
        ]);

        if ($validator->fails()) {
            error_message(trans('book.check_extension'));
            return redirect()->back();
        }
        $path = $request->file('book_file')->getRealPath();
        try {
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                foreach ($data->toArray() as $key => $value) {
                    if (!empty($value)) {
                        foreach ($value as $v) {
                            $inserts[] = ['publisher' => $v['publisher'],
                                'name' => $v['name'],
                                'arrange' => $v['arrange'],
                                'amount' => $v['amount'],
                                'writer' => $v['writer'],
                                'publish_date' => $v['inquisitor'],
                                'description' => $v['description'],
                                'price' => $v['price'],
                                'category' => $v['category'],
                                'library' => $v['library']];
                        }
                    }
                }
                foreach ($inserts as $book) {
                    $category = Category::where(['name' => $book['category']])->first();
                    if (!$category)
                    {
                        error_message(str_replace('{category_name}' , $book['category'] ,trans('book.category_not_found')));
                        return redirect()->back();
                    }
                    $library = Library::where(['name' => $book['library']])->first();
                    if (!$library){
                        error_message(str_replace('{library_name}' , $book['library'] ,trans('book.library_not_found')));
                        return redirect()->back();
                    }
                    $newBook = new Book();
                    $newBook->fill($book);
                    $newBook->category_id = $category->id;
                    $newBook->library_id = $library->id;
                    $newBook->save();
                }


            }

            success_message(trans('book.imported_successfully'));
        } catch (\Exception $exception) {
            error_message(trans('book.imported_error'));
        }
        return redirect()->back();
    }

    public function rules($flag = -1)
    {
        $rules = [
            'name' => 'required|string',
            'publish_date' => 'required',
            'writer' => 'required',
            'publisher' => 'required',
            'library_id' => 'required|exists:libraries,id',
            'category_id' => 'required|exists:categories,id',
            'arrange' => 'required|numeric',
            'price' => 'required|numeric',
            'inquisitor' => 'required|string',
        ];

        if ($flag == -1)
            $rules['image'] = 'required';
        return $rules;
    }

    public
    function messages()
    {
        return [
            'name.required' => trans('book.name_required'),
            'name.string' => trans('book.name_string'),
            'publish_date.required' => trans('book.publish_date_required'),
            'writer.required' => trans('book.writer_required'),
            'publisher.required' => trans('book.publisher_required'),
            'library_id.required' => trans('book.library_required'),
            'library_id.exists' => trans('book.library_exists'),
            'category_id.exists' => trans('book.category_exists'),
            'category_id.required' => trans('book.category_required'),
            'arrange.required' => trans('book.arrange_exists'),
            'arrange.numeric' => trans('book.arrange_numeric'),
            'price.numeric' => trans('book.price_numeric'),
            'price.required' => trans('book.price_required'),
            'inquisitor.required' => trans('book.inquisitor_required'),
            'inquisitor.string' => trans('book.inquisitor_string'),
            'image.required' => trans('book.image_required'),
        ];
    }


}
