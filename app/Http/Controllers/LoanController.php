<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    }

    public function edit(Loan $loan) {

        $users = User::get();

        return view('admin.editLoan', [
            'books' => $loan->books,
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
        if($book->quantity > 0){
            if($user->loan) {               
                $exist = DB::table('book_loan')
                ->where("book_id", $book->id)
                ->where("loan_id", $user->loan->id)->first();

                if($exist){ //book exist in loan

                } 
                else{ //book dont exist in loan
                    $user->loan->books()->attach($book);
                    $book->quantity-=1;
                    $book->update();
                }
  
            }
            else {            
                $loan = Loan::create([
                    'user_id' => auth()->user()->id
                ]);
                $loan->books()->sync($book);
                $book->quantity-=1;
                $book->update();
            }
        }
        else {
            return back()->withErrors(['msg' => 'mesage']);
        }

        return back();
    }

    public function userDelete(Loan $loan, User $user, Book $book) {

        $loan = $user->loan;
        $loan->books()->detach($book);
        $book->quantity+=1;
        $book->update();

        if(!$loan->books->count()){
            $loan->delete();
        }

        return back();
    }

    public function loaned(User $user) {

        return view('users.loan', ['user' =>$user]);
    }

    public function returnBooks(Loan $loan) {

        foreach ($loan->books as $book) {
            $loan->books()->detach($book);
            $book->quantity+=1;
            $book->update();
        }

        $loan->delete();

        return redirect()->route('loanManagement');
    }

    // public function renew(Loan $loan) {

    //     if ($loan->renewed == 0) {

    //         $newTime = $loan->to->addDays(30);
    //         $loan->update([
    //             'due_at' => $newTime,
    //             'renewed' => 1,
    //         ]);

    //         return back();
    //     }
    // }
}
