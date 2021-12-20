<?php

namespace Modules\Wallet\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Wallet\Entities\Wallet;
use Modules\Wallet\Services\WalletService;

class WalletController extends Controller
{
    // public function __construct(){
    //     $this->middleware('permission:wallet-create',   ['only' => ['create','store']]);
    //     $this->middleware('permission:wallet-edit',     ['only' => ['edit','update']]);
    //     $this->middleware('permission:wallet-list',     ['only' => ['show', 'index']]);
    //     $this->middleware('permission:wallet-delete',   ['only' => ['destroy']]);
    // }
    // /**
    //  * Display a listing of the resource.
    //  * @return Renderable
    //  */
    public function index()
    {
        $wallets=Wallet::get();
        return view('wallet::dashboard.wallets.index',compact('wallets'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $users =User::get();
        return view('wallet::dashboard.wallets.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'    => 'required|int|unique:wallets,user_id',
            'balance'    => 'required',
        ]);

        $wallet = new WalletService();
        $wallet ->setUserID($request->user_id)
                ->setBalance($request->balance)
                ->createWallet();

        return redirect()->route("wallets.index")->with('success', 'تم اضافة  بنجاح');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $wallet =Wallet::find($id);
        if (!$wallet) {
            return redirect()->route('dashboard')->with('failed',"wallet Not Found");
        }
        $users =User::get();
        return view('wallet::dashboard.wallets.edit',['wallet'=>$wallet,'users'=>$users]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
    $request->validate([
            'user_id'    => 'required|int|unique:wallets,user_id,'.$id,
            'balance'    => 'required',
        ]);

        $wallet = Wallet::find($id);
        if(!$wallet){
            return redirect()->route('dashboard')->with('failed',"wallet Not Found");
        }

        $walletUpdate  = new WalletService();
        $walletUpdate  ->setUserID($request->user_id)
                       ->setBalance($request->balance)
                       ->updateWallet($wallet);

        return redirect()->route("wallets.index")->with('success', 'تم التعديل  بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $wallet=Wallet::find($id);
        if (!$wallet) {
            return redirect()->route('dashboard')->with('failed',"wallet Not Found");
        }
        $wallet->delete();
    }
}
