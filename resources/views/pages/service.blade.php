@extends('layouts.app')

@section('content')

<div class="container products">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="h2">
                О сервисе WATERFREE.RU
            </h2>
        </div>
    </div>
</div>

<div class="service">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<p>Компания ООО «Синтез Групп» представляет сервис <a href="https://waterfree.ru"><b>WATERFREE.RU</b></a> для заказа средств ухода за автомобилем производства компании ООО «ЮНИКС ТОРГ» ( торговая марка "Hub X Group". )</p>

				<p>Компания на рынке автомобильной химии недавно, но разработки ведутся  коллективом компании уже давно. Применяя современные новейшие технологии,  были достигнуты отличные результаты, в чем вы сами сможете убедиться, как только начнете пользоваться нашей продукцией. Автомобиль сейчас является фактически вторым домом для человека, поэтому качественный уход за ним - это сегодня важно и необходимо.</p>

				<p>С удобным сервисом <a href="https://waterfree.ru"><b>WATERFREE.RU</b></a> вы сможете оперативно заказать всю  серию нашей продукции, как для  профессиональных автомоек и станций обслуживания, так и для индивидуального сервиса у себя дома. <b>ООО "Синтез Групп"</b> Генеральный дистрибьютор всей продукции, производимой <b>ООО "ЮНИКС ТОРГ"</b>, по РФ и другим странам и наши представители есть практически в каждом регионе.</p>
			</div>
		</div>
	</div>
</div>

<div class="container service-advantage">
	<div class="row justify-content-center">
		<div class="col-sm-3">
			<img src="{{ asset('images/ico/service/building.svg') }}" alt="" class="service-advantage--ico">

			<h4 class="h4">100+ городов</h4>
		</div>
		<div class="col-sm-3">
			<img src="{{ asset('images/ico/service/star.svg') }}" alt="" class="service-advantage--ico">

			<h4 class="h4">Более 5,000 постоянных клиентов</h4>
		</div>
		<div class="col-sm-3">
			<img src="{{ asset('images/ico/service/meeting.svg') }}" alt="" class="service-advantage--ico">

			<h4 class="h4">300 компаний, которые сотрудничают с нами</h4>
		</div>
	</div>
</div>

@endsection