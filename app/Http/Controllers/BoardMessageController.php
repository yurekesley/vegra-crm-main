<?php

namespace App\Http\Controllers;

use App\Models\BoardMessage;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BoardMessageController extends Controller
{
  public function index(Request $request)
  {
    $pageSize = $request->query('page_size') ?? 8;
    $filter = $request->query('filter');

    if (!empty($filter)) {
      $messages = BoardMessage::sortable('title')
        ->where('title', 'like', '%' . $filter . '%')
        ->paginate($pageSize);
    } else {
      $messages = BoardMessage::sortable('title')
        ->paginate($pageSize);
    }

    return view('board_messages.index')
      ->with('messages', $messages)
      ->with('filter', $filter);
  }

  public function create()
  {
    return view('board_messages.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|max:100|unique:board_messages,title',
      'active' => 'required',
      'start_date' => 'required|date_format:dmY',
      'end_date' => 'required|date_format:dmY',
    ]);

    BoardMessage::create([
      'title' => $request->title,
      'active' => $request->active,
      'start_date' => $request->start_date != null ? substr($request->start_date, 4, 4) . '-' . substr($request->start_date, 2, 2) . '-' . substr($request->start_date, 0, 2) : null,
      'end_date' => $request->end_date != null ? substr($request->end_date, 4, 4) . '-' . substr($request->end_date, 2, 2) . '-' . substr($request->end_date, 0, 2) : null,
      'content' => $request->content
    ]);

    Alert::success('Sucesso', 'Mensagem criada com sucesso');

    return redirect()->route('board_messages.index');
  }

  public function edit(BoardMessage $boardMessage)
  {
    return view('board_messages.edit')
      ->with('message', $boardMessage);
  }

  public function update(BoardMessage $boardMessage, Request $request)
  {
    $request->validate([
      'title' => 'required|max:100|unique:board_messages,title,' . $boardMessage->id,
      'active' => 'required',
      'start_date' => 'required|date_format:dmY',
      'end_date' => 'required|date_format:dmY',
    ]);

    $boardMessage->title = $request->title;
    $boardMessage->active = $request->active;
    $boardMessage->start_date = $request->start_date != null ? substr($request->start_date, 4, 4) . '-' . substr($request->start_date, 2, 2) . '-' . substr($request->start_date, 0, 2) : null;
    $boardMessage->end_date = $request->end_date != null ? substr($request->end_date, 4, 4) . '-' . substr($request->end_date, 2, 2) . '-' . substr($request->end_date, 0, 2) : null;
    $boardMessage->content = $request->content;

    $boardMessage->save();

    Alert::success('Sucesso', 'Mensagem alterada com sucesso');

    return redirect()->route('board_messages.index');
  }

  public function destroy(BoardMessage $boardMessage)
  {
    $boardMessage->delete();

    Alert::success('Sucesso', 'Mensagem removida com sucesso');

    return redirect()->route('board_messages.index');
  }
}
