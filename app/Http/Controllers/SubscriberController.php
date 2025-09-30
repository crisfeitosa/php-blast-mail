<?php

namespace App\Http\Controllers;

use App\Models\EmailList;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(EmailList $emailList)
    {
        $search = request()->search;

        return view('subscribers.index', [
            'emailList' => $emailList,
            'subscribers' => $emailList
                ->subscribers()
                ->when($search, fn($query) => $query->where('email', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('id', '=', $search)
                )
               ->paginate(),
            'search' => $search
        ]);
    }
}
