@extends('layouts.app')

@section('content')
<div class="container mt-4 user-cabinet-home">
    <div class="row justify-content-center">
    	<div class="col-md-2">
            @if(Auth::user()->role === 2 || Auth::user()->role === 0)
                @include('layouts.user.nav_firm')
            @else
    		    @include('layouts.user.nav')
            @endif
    	</div>
        <div class="col-md-10">
            <h2 class="mb-3">Ваш профиль</h2>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <td><b>Количество ваших рефералов:</b></td>
                            <td>{{ Auth::user()->referrals()->count() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div>
                Ваша реферальная ссылка: <a href="{{ url('/') . '/?referral=' . Hashid::encode(Auth::user()->id) }}"><mark>{{ url('/') . '/?referral=' . Hashid::encode(Auth::user()->id) }}</mark></a>
            </div>
        </div>
    </div>
</div>
@endsection
