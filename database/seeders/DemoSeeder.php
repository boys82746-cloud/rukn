<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Demo content for screenshots and the demo video.
 * Every demo user logs in with the password: 12345678
 */
class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $users = collect([
            ['name' => 'سلطان', 'email' => 'sultan@example.com'],
            ['name' => 'ريم', 'email' => 'reem@example.com'],
            ['name' => 'خالد', 'email' => 'khalid@example.com'],
        ])->map(fn (array $u) => User::create($u + ['password' => '12345678']))->values();

        $categoryIds = Category::pluck('id', 'slug');

        // [owner index, category, city, price, title, description, hours ago]
        $ads = [
            [0, 'electronics', 'riyadh', 3200, 'آيفون 14 برو ماكس مستعمل نظيف', 'جهاز بحالة ممتازة، سعة 256 جيجا، البطارية 91%، مع العلبة والشاحن الأصلي.', 2],
            [1, 'vehicles', 'jeddah', 68000, 'تويوتا كامري 2021 فل كامل', 'ماشي 62 ألف كيلو، صيانة دورية بالوكالة، بدون حوادث، جاهزة للفحص في أي وقت.', 5],
            [2, 'real_estate', 'dammam', 36000, 'شقة للإيجار 3 غرف وصالة', 'شقة واسعة في حي هادئ، مطبخ راكب، مكيفات، قريبة من الخدمات والمدارس.', 9],
            [0, 'furniture', 'makkah', 1800, 'كنب مودرن 7 مقاعد', 'كنب بحالة الوكالة، قماش مقاوم للبقع، لون رمادي فاتح، سبب البيع السفر.', 14],
            [1, 'electronics', 'khobar', 450, 'ساعة ذكية رياضية', 'ساعة ذكية مقاومة للماء مع قياس النبض والخطوات، شبه جديدة مع الضمان.', 20],
            [2, 'services', 'riyadh', 250, 'تصميم شعارات وهويات', 'أصمم لك شعاراً احترافياً مع دليل الهوية خلال ثلاثة أيام، وتسليم الملفات المفتوحة.', 26],
            [0, 'kids', 'madinah', 120, 'دراجة هوائية للأطفال', 'مقاس 16 بوصة، حالة جيدة جداً، مع عجلات مساعدة وخوذة مجانية.', 31],
            [1, 'books', 'taif', 90, 'مجموعة كتب أدبية', 'ثلاثة عشر كتاباً بين الروايات والتنمية الذاتية، بحالة ممتازة، والبيع بالمجموعة.', 40],
            [2, 'fashion', 'abha', 150, 'ثوب رجالي شتوي', 'لبسة واحدة فقط، مقاس 58، لون رمادي غامق، قماش ياباني فاخر.', 48],
            [0, 'jobs', 'riyadh', 4500, 'مطلوب مصمم جرافيك', 'مطلوب مصمم جرافيك بدوام جزئي لشركة ناشئة، الخبرة في فوتوشوب وإليستريتور.', 60],
            [1, 'sports', 'tabuk', 600, 'طاولة بينغ بونغ قابلة للطي', 'تأتي مع مضربين وكرات، استخدام خفيف، مناسبة للمنزل أو الاستراحة.', 72],
            [2, 'services', 'buraidah', 80, 'دروس خصوصية في البرمجة', 'دروس في PHP وLaravel للمبتدئين، أونلاين أو حضوري، والحصة الأولى مجانية.', 90],
            [0, 'other', 'jeddah', 0, 'كتب مدرسية للإهداء', 'كتب للمرحلة المتوسطة بحالة جيدة، أرغب بإهدائها لمن يستفيد منها.', 120],
        ];

        foreach ($ads as [$owner, $category, $city, $price, $title, $description, $hoursAgo]) {
            $listing = $users[$owner]->listings()->make([
                'title' => $title,
                'description' => $description,
                'price' => $price,
                'city' => $city,
                'category_id' => $categoryIds[$category],
            ]);

            $listing->created_at = now()->subHours($hoursAgo);
            $listing->save();
        }
    }
}
