<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Dream;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Throwable;

class BoardController extends Controller
{
    public function index()
    {
        $data = Board::orderBy('id', 'DESC')->paginate(20);
        return view('dashboard.board.index', ['data' => $data]);
    }

    public function create()
    {
        return view('dashboard.board.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'string|required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0]);
        }

        try {
            if ($request->publish == true) {
                $publish = true;
                $password = null;
            } else {
                $publish = false;
                $password = $request->password;
            }

            $data = [
                'username' => Auth::user()->username,
                'title' => $request->title,
                'publish' => $publish,
                'password' => $password
            ];

            if (Board::create($data)) {
                return redirect()->route('dashboard.board.index')->with('success', 'Create new board success.');
            }

            return redirect()->route('dashboard.board.create')->with('error', 'Something wrong when store data.');
        } catch (Throwable $e) {
            return back()->with('error', 'We will back again.');
        }
    }

    public function show(string $id)
    {
        try {
            $board = Board::find($id);
            $data = Dream::where('board_id', '=', $id)
                ->orderBy('id', 'DESC')
                ->paginate(20);

            return view('dashboard.board.show', ['title' => $board->title, 'data' => $data]);
        } catch (Throwable $e) {
            return back()->with('error', 'We will back again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        try {
            $data = Board::find($id);
            return view('dashboard.board.edit', ['data' => $data]);
        } catch (Throwable $e) {
            return back()->with('error', 'We will back again.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'string|required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0]);
        }

        try {
            $data = Board::find($id);
            if ($request->publish == true) {
                $publish = true;
                $password = null;
            } else {
                $publish = false;
                $password = $request->password;
            }

            $field = [
                'username' => Auth::user()->username,
                'title' => $request->title,
                'publish' => $publish,
                'password' => $password
            ];

            if ($data->update($field)) {
                return redirect()->route('dashboard.board.index')->with('success', 'Update board success.');
            }

            return redirect()->route('dashboard.board.edit', $id)->with('error', 'Something wrong when update data.');
        } catch (Throwable $e) {
            return back()->with('error', 'We will back again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
