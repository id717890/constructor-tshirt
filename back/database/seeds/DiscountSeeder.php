<?php

use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->delete();

		
		DB::table('discounts')->insert([
            'title' => 'Акция «Беззаботный день»',
            'image' => 'discont4.jpg',
            'text' => '<p>
	 Не хотите считать оплату за километраж и этажи? Хотите знать итоговую сумму? Тогда эта акция для вас. Включены услуги грузового автомобиля Газель + работа двух грузчиков. Упаковка, спуск, погрузка, транспортировка и подъем вещей на месте. Расстояние любое. Время 2 часа. Такелаж и доп. часы оплачиваются отдельно.
</p>',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
		
		DB::table('discounts')->insert([
            'title' => 'Акция «Выгодное воскресенье»',
            'image' => 'discont2.jpg',
            'text' => '<p>
	 Дорогие клиенты, при оформлении заказа на воскресенье на сумму более 1950 рублей, мы дарим вам СКИДКУ 15% на транспортные услуги. Оформляйте заказ в рабочие дни и получайте выгоду в воскресенье. Подробности уточняйте у наших менеджеров.
</p>
<noindex><i><span style="font-size: 10pt;">Срок проведения акции с 01.01.2020 г. по 31.12.2020 г. Организатор акции: ООО «Авто-Транс» ИНН 7706743466, Адрес: 119180, г.Москва, ул. Большая Полянка, дом 13/16, стр. 1.</span></i></noindex>
',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
		
        DB::table('discounts')->insert([
            'title' => 'Купон «500 рублей в подарок»',
            'image' => 'discont1.jpg',
            'text' => '<p>
    Дорогие друзья, после покупки в <a title="Интернет-магазин упаковочных материалов" href="https://shop.cargo-avto.ru/" rel="nofollow" target="_blank">интернет-магазине «Авто-Транс»</a>, вы получите купон на 500 рублей! Его можно активировать при заказе <a href="https://cargo-avto.ru/price/" title="Посмотреть услуги" target="_blank">услуг (Транспорт + специалисты)</a> и при <a href="https://cargo-avto.ru/price/#transport" title="Подобрать автомобиль" target="_blank">аренде машины на сумму более 2000 рублей</a>.
</p>',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('discounts')->insert([
            'title' => 'Акция «Выгодные часы»',
            'image' => 'discont2.jpg',
            'text' => '<p>
	 Уважаемые заказчики, спешим сообщить вам о новой акции. Теперь при заказе услуг на любое время с 16.00 до 07.00 вы можете пользоваться услугами нашего автопарка по сниженным тарифным планам.
</p>',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        

        






    }
}
