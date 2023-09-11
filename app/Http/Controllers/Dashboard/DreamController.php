<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Dream;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Throwable;

class DreamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $board_id)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0]);
        }

        $board = Board::find($board_id);
        if ($board->publish == false) {
            if ($request->session()->get('password') !== $board->password) {
                return back()->with('error', 'Unauthorized.');
            }
        }

        try {
            if ($request->incognito) {
                $username = null;
                $incognito = true;
            } else {
                $username = Auth::user()->username;
                $incognito = false;
            }

            $color = $request->color ? $request->color : null;
            $background = $request->background ? $request->background : null;

            $data = [
                'board_id' => $board_id,
                'user_id' => Auth::user()->id,
                'username' => $username,
                'text' => $request->text,
                'incognito' => $incognito,
                'background' => $background,
                'color' => $color
            ];

            if (Dream::create($data)) {
                return back()->with('success', 'Create new dream success.');
            }

            return redirect()->route('dashboard.board.create')->with('error', 'Something wrong when store data.');
        } catch (Throwable $e) {
            return back()->with('error', 'We will back again.');
        }
    }

    public function openaccess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'string|required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0]);
        }

        try {
            $request->session()->put('password', $request->password);
            return back();
        } catch (Throwable $e) {
            return back()->with('error', 'We will back again.');
        }
    }
}
