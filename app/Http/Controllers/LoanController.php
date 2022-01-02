<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request) {        
        
        $loans = Loan::get();

        return view('admin.manageLoans', ['loans' => $loans]);
    }

    public function create() {
        
        $users = User::get();

        return view('admin.createLoan', [
            'users' => $users
        ]); 
    }
    
    public function store(Request $request) {

        $request->validate([
            'user_id' =>'required',
        ]);

        Loan::create($request->all());

        return redirect()->route('loanManagement');

        // $this->validate($request, [
            //         'bid' => 'required|max:10',
            //     ]);
            //     if (Book::where('id', '=', $request->bid)->exists() == 0) {
            //         session()->flash('warning', 'This book doesn\'t exist.');
            //         return back();
            //     }
            //     if (Lent::where('bid', '=', $request->bid)->exists()) {
            //         session()->flash('warning', 'Someone has already borrowed this book.');
            //         return back();
            //     }
            //     if (Auth::user()->debt > 0) {
            //         session()->flash('warning', 'Please pay off your debt first.');
            //         return back();
            //     }
            //     Lent::create([
            //         'uid' => Auth::user()->id,
            //         'bid' => $request->bid,
            //         'lent_at' => Carbon::now(),
            //         'due_at' => Carbon::now()->addMonth(1),
            //     ]);
            //     $book = Book::where('id', '=', $request->bid)->first();
            //     $bookInfo = BookInfo::where('isbn', '=', $book->isbn)->first();
            //     $bookInfo->update([
            //         'available' => $bookInfo->available - 1,
            //     ]);
            //     session()->flash('success', 'Borrowing succeeded.');
            //     return redirect()->route('home');
    }

    public function show(Loan $loan) {     
       
    }

    public function destroy(Loan $loan) {

        $loan->books()->delete();
        $loan->delete();

        return back();
    }

    public function edit(Loan $loan) {

        $users = User::get();

        return view('admin.editLoan', [
            'loan' => $loan,
            'users' => $users
        ]);
    }

    public function update(Loan $loan, Request $request) {

        $request->validate([
            'user_id' =>'required',
        ]);
       
        $loan->update($request->all());

        return redirect()->route('loanManagement');
    }

    public function approve(Loan $loan, Request $request) {

        $loan->update([
            'approved' => 1,
            'from' => now(),
            'to' => now()->addDays(30),
        ]);

        return back();
    }

    public function userCreate(Loan $loan, User $user, Book $book) {

        if($user->loan) {

            $loan = $user->loan;
            $loan->books()->attach($book->id);
            $book->quantity-=1;
        }
        else {

            $loan = Loan::create([
                'user_id' => auth()->user()->id
            ]);
            $loan->books()->sync($book->id);
            $book->quantity-=1;

        }

        return redirect()->route('loanManagement');
    }

    public function loaned(User $user) {

        return view('users.loan', ['user' =>$user]);
    }

    public function renew(Loan $loan) {

        if ($loan->renewed == 0) {

            $newTime = $loan->to->addDays(30);
            $loan->update([
                'due_at' => $newTime,
                'renewed' => 1,
            ]);

            return back();
        }
    }
}
