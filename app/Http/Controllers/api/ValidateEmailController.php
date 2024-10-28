<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ValidateEmailController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index($hashed_id)
    {
        $id = decrypt($hashed_id);

        $user = $this->user->find(intval($id));

        if ($user->email_verified_at == null) {
            $user->email_verified_at = now();
            $user->save();
        }

        return redirect()->away('http://leader-cms.test/auth/login?email_verified=true');
    }
}
