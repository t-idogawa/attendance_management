<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use App\Services\ValidationService;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    protected $validationService;

    public function __construct(ValidationService $validationService)
    {
        $this->validationService = $validationService;
    }

    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        $stores = Store::all();

        return Inertia::render('Auth/Register', ['stores' => $stores]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        logger('request', [$request]);
        // バリデーション
        $validator = $this->validationService->validateUserRegistration($request);

        // バリデーションが失敗した場合はリダイレクト
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // dd($request->store_id);
        

        $userId = Str::Ulid();

        $user = User::create([
            'id' => $userId,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'last_name_kana' => $request->last_name_kana,
            'first_name_kana' => $request->first_name_kana,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'store_id' => $request->store_id,
            'hire_date' => Carbon::now('Asia/Tokyo'),
            'post_number' => 1,
            'hourly_pay' => 1000,
            'password' => Hash::make($request->password),
            'created_account_id' => $userId,
            'created_at' => Carbon::now('Asia/Tokyo'),
            'updated_account_id' => $userId,
            'updated_at' => Carbon::now('Asia/Tokyo'),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
