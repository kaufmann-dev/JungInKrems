<?php

namespace App\Http\Controllers\Web;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Http\Traits\AccountTrait;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    use AccountTrait;

    public function updateAccount($id)
    {
        $this->validateAdminUpdate(request());
        $account = Account::find($id);
        if(request()->has('PASSWORD')) {
            request()->merge(['PASSWORD' => Hash::make(request()->input('PASSWORD'))]);
        }
        $account->update(request()->all());
    }
}