<nav class="user-nav firm-nav">
	<a href="{{ route('user.firm.balance.index') }}" class="btn btn-outline-primary {{ Route::is('user.firm.balance.index') ? 'active' : '' }}">Баланс: <span class="badge badge-rounded badge-success">{{ number_format(Auth::user()->balance->balance, 2) }} <i aria-hidden="true" class="fa fa-rub"></i></span></a><br>
	<a href="{{ route('user.firm.setting.index') }}" class="btn btn-primary {{ Route::is('user.firm.setting.index') ? 'active' : '' }}">Настройки</a>
	<a href="{{ route('user.firm.connect.index') }}" class="btn btn-primary {{ Route::is('user.firm.connect.index') ? 'active' : '' }}">Подключение заказов</a>
	<a href="{{ route('user.firm.orders.index') }}" class="btn btn-primary {{ Route::is('user.firm.orders.index') ? 'active' : '' }}">Заказы</a>
	<a href="{{ route('logout') }}"
		onclick="event.preventDefault();
		document.getElementById('logout-form').submit();"
		class="btn btn-danger">Выход</a>
</nav>