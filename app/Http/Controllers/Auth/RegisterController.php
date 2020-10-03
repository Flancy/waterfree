<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Illuminate\Auth\Events\Registered;

use Cookie;

use ElfSundae\Laravel\Hashid\Facades\Hashid;

use App\User;
use App\Models\Token;
use App\Models\Balance;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationCityForm() {
        return view('auth.register_city');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['sometimes', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'unique:users'],
            'city_id' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $cookie = Cookie::get('referral');

        $referred_by = $cookie ? Hashid::decode($cookie) : null;

        $user = User::create([
            'name' => $data['name'],
            'activate' => 0,
            'role' => $data['role'],
            'email' => $data['email'] ? $data['email'] : '',
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'city_id' => $data['city_id'],
            'referred_by' => $referred_by[0]
        ]);

        Balance::create([
            'user_id' => $user->id
        ]);

        return $user;
    }

    public function code()
    {
        return view('auth.code');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $token = Token::create([
            'user_id' => $user->id
        ]);


        if ($token->sendCode()) {
            session()->put("token_id", $token->id);
            session()->put("user_id", $user->id);

            return redirect()->route('code')
                ->with('success', 'Вам на телефон отправлен код подтверждения.');
        }

        $token->delete();

        return redirect('/register')->withErrors([
            "Невозможно отправить код подтверждения."
        ]);
    }

     public function showCodeForm()
    {
        if (! session()->has("token_id")) {
            return redirect("login");
        }

        return view("auth.code");
    }

    /**
     * Store and verify user second factor.
     */
    public function storeCodeForm(Request $request)
    {
        if (! session()->has("token_id", "user_id")) {
            return redirect("login");
        }

        $token = Token::find(session()->get("token_id"));

        if (! $token ||
            ! $token->isValid() ||
            $request->code !== $token->code ||
            (int)session()->get("user_id") !== $token->user->id
        ) {
            return redirect("code")->withErrors(["Некорректный код"]);
        }

        $token->used = true;
        $token->save();

        $user = User::findOrFail(session()->get("user_id"));
        $user->activate = 1;
        $user->save();

        session()->forget('token_id', 'user_id');

        return redirect('login');
    }
}
