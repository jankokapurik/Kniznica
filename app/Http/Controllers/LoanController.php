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
            'user_id' =>'required|unique:loans,user_id',     
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
        // $request->validate([
        //     'user_id' =>'required',
        // ]);
        
        $user = User::find($request->user_id);
        
        // dd($loan);

        $loan->books()->detach();
        if($request->books){
            foreach($request->books as $booksid){
                $loan->books()->attach(Book::find($booksid));
            }
        }
       
        $loan->update($request->all());

        
        return redirect()->route('loanManagement');
    }

    public function approve(Loan $loan, Request $request) {        
        $loan->update([
            'approved' => 1,
            'from' => now(),
            'to' => now()->addDays(30),
            'reserved_until' => null
        ]);

        return back();
    }

    public function userCreate(User $user, Book $book) {
        
            if($user->loan) 
            {       
                if($user->loan->books()->count() < 11) 
                {
                    if($book->quantity > 0) 
                    {
                        $exist = DB::table('book_loan')
                        ->where("book_id", $book->id)
                        ->where("loan_id", $user->loan->id)->first();
                        
                        if($exist){ //book exist in loan
                        return back()->with('msg', 'Táto kniha už je vypožičaná');
                        } 
                        else{ //book dont exist in loan
                            $user->loan->books()->attach($book);
                            $book->quantity-=1;
                            $book->update();
                        }
                    }
                    if($book->quantity == 0) 
                    {
                        $exist = DB::table('book_loan')
                        ->where("book_id", $book->id)
                        ->where("loan_id", $user->loan->id)->first();
                        
                        if($exist){ //book exist in loan
                        return back()->with('msg', 'Táto kniha už je vypožičaná');
                        } 
                        else{ //book dont exist in loan
                            $user->loan->books()->attach($book);
                            $book->quantity-=1;
                            $book->reserved_by = auth()->user()->id;
                            $book->update();

                        }
                    }
                }        
  
            }
            else 
            {            
                $loan = Loan::create([
                    'user_id' => auth()->user()->id,
                    'reserved_until' => now()->addHour()
                ]);
                $loan->books()->sync($book);
                $book->quantity-=1;
                $book->update();
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

    public function renew(Loan $loan) {
        // if
        // {
        //     foreach($loan->books() as $book)
        //     {
        //         if
        //     }
        // }

        if ($loan->renewed == 0) 
        {

            $newTime = $loan->to->addDays(30);
            $loan->update([
                'to' => $newTime,
                'renewed' => 1,
            ]);

            return back();
        }

        if ($loan->renewed == 1) 
        {
            $newTime = $loan->to->addDays(30);
            $loan->update([
                'to' => $newTime,
                'renewed' => 2,
            ]);

            return back();
        }
    }

    public function userConfirm (Loan $loan) {

        $loan->update([
            'user_confirmed' => 1,
            'reserved_until' => now()->addDays(10)
        ]);

        return back();
    }
}
