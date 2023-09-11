<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Dream;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Throwable;

class APIBoardController extends BaseController
{
    public function dreamer($board_id, $dream_id)
    {

        try {
            $board = Board::find($board_id);
            if ($board->username == Auth::user()->username) {
                $data = Dream::where('id', '=', $dream_id)
                    ->where('board_id', '=', $board_id)
                    ->first();

                return $this->send_response('Fetching data success.', $data);
            }
            return $this->send_error('Unauthorized.', null, 401);
        } catch (Throwable $e) {
            return $this->send_error('Something Wrong.', $e, 404);
        }
    }

    public function rmdreamer($board_id, $dream_id)
    {
        try {
            $board = Board::find($board_id);
            $dream = Dream::find($dream_id);
            if ($board->username == Auth::user()->username || $dream->user_id == Auth::user()->id) {
                $data = $dream->delete();
                return $this->send_response('Delete data success.', $data);
            }
            return $this->send_error('Unauthorized.', null, 401);
        } catch (Throwable $e) {
            return $this->send_error('Something Wrong.', $e, 404);
        }
    }

    public function dreamposition(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'top' => 'integer|required',
            'left' => 'integer|required',
            'board_id' => 'integer|required',
            'dream_id' => 'integer|required',
        ]);

        if ($validator->fails()) {
            return $this->send_error($validator->messages()->all()[0], null, 404);
        }

        $board_id = $request->board_id;
        $dream_id = $request->dream_id;

        try {
            $board = Board::find($board_id);
            $dream = Dream::find($dream_id);
            if ($board->username == Auth::user()->username || $dream->user_id == Auth::user()->id) {
                $field = [
                    'top' => $request->top,
                    'left' => $request->left,
                ];

                $data = $dream->update($field);
                return $this->send_response('Update data success.', $data);
            }
            return $this->send_error('Unauthorized.', null, 401);
        } catch (Throwable $e) {
            return $this->send_error('Something Wrong.', $e, 404);
        }
    }
}
