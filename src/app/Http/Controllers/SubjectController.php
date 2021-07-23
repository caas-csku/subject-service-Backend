<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $subjects = Subject::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = new Subject;
        $subject->id = $request->id;
        $subject->code = $request->code;
        $subject->name_th = $request->name_th;
        $subject->name_en = $request->name_en;
        $subject->year = $request->year;
        $subject->save();

        return response()->json([
            'status' => 'success',
            'method' => 'save',
            $subject
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $arr = explode('-', $slug);
        $code = $arr[0];
        if (count($arr) > 1) {
            $year = (int)$arr[1];
            $subject = Subject::where('code', $code)->where('year', $year)->get();
        } else {
            $subject = Subject::where('code', $code)->get();
        }
        return $subject;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //! update use id to update
        
        // $arr = explode('-', $slug);
        // $code = $arr[0];
        // $year = (int)$arr[1];
        // $subject = Subject::where('code', $code)->where('year', $year)->get();
        $subject = Subject::findOrFail($id);

        if ($request->code != null) {
            $subject->code = $request->code;
        }
        if ($request->name_th != null) {
            $subject->name_th = $request->name_th;
        }
        if ($request->name_en != null) {
            $subject->name_en = $request->name_en;
        }
        if ($request->year != null) {
            $subject->year = $request->year;
        }

        $subject->save();

        return $subject;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $arr = explode('-', $slug);
        $code = $arr[0];
        $year = (int)$arr[1];
        Subject::where('code', $code)->where('year', $year)->delete();

        return response()->json([
            'status' => 'success',
            'method' => 'delete'
        ]);
    }
}
