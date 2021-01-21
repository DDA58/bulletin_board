<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AdCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (1, 'bit_electro', 'Бытовая электроника', '', 0, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (2, 'tov4comp', 'Товары для компьютера', '', 1, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (3, 'keyboards', 'Клавиатуры', '', 2, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (4, 'mouses', 'Мыши', '', 2, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (5, 'accessories', 'Комплектующие', '', 2, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (6, 'cd_dvd', 'CD и DVD', '', 5, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (7, 'videocards', 'Видеокарты', '', 5, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (8, 'blocks', 'Корпусы', '', 5, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (9, 'power_supplies', 'Блоки питания', '', 5, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (13, 'power_supplies_1000', '1000Вт', '', 9, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (12, 'power_supplies_900', '900Вт', '', 9, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (10, 'power_supplies_700', '700Вт', '', 9, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (11, 'power_supplies_800', '800Вт', '', 9, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (15, 'phone_acer', 'Acer', '', 14, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (16, 'phone_huawei', 'Huawei', '', 14, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (17, 'phone_iphone', 'iPhone', '', 14, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (14, 'phones', 'Телефоны', '', 1, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (18, 'animals', 'Животные', '', 0, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (19, 'animals_dogs', 'Собаки', '', 18, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (20, 'animals_cats', 'Кошки', '', 18, 1, NULL, NULL, NULL);
            INSERT INTO public.ad_categories (id, code, title, description, parent_id, order_num, created_at, updated_at, deleted_at) VALUES (21, 'animals_birds', 'Птицы', '', 18, 1, NULL, NULL, NULL);
        ");
    }
}
