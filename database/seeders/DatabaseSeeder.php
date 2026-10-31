<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Demo users (password for all: 12345678)
        $users = collect([
            ['سلطان', 'sultan@example.com'],
            ['ريم', 'reem@example.com'],
            ['خالد', 'khalid@example.com'],
        ])->map(fn ($u) => User::create([
            'name' => $u[0], 'email' => $u[1], 'password' => Hash::make('12345678'),
        ]));

        $cat = Category::pluck('id', 'slug');

        // [category, text (max 155 chars), user index]
        $quotes = [
            ['wisdom', 'العاقل من اتعظ بغيره، والجاهل من اتعظ بنفسه.', 0],
            ['motivation', 'لا تنتظر الفرصة المناسبة، اصنعها بيدك.', 1],
            ['faith', 'من توكل على الله كفاه، ومن لجأ إليه آواه.', 2],
            ['love', 'الحب الحقيقي أن ترى عيوب من تحب وتحبه كما هو.', 1],
            ['success', 'النجاح ليس نهاية الطريق، والفشل ليس قاتلاً؛ الشجاعة في الاستمرار هي ما يهم.', 0],
            ['life', 'الحياة قصيرة، فلا تضيعها في الندم على ما فات.', 2],
            ['friendship', 'الصديق الصدوق من صدقك لا من صدّقك.', 0],
            ['knowledge', 'اطلبوا العلم من المهد إلى اللحد.', 1],
            ['patience', 'الصبر مفتاح الفرج، ومن صبر ظفر.', 2],
            ['humor', 'أنا لا أنام مبكراً، أنا فقط أمنح هاتفي فرصة أخيرة قبل النوم.', 0],
            ['wisdom', 'لسانك حصانك، إن صنته صانك، وإن خنته خانك.', 1],
            ['motivation', 'ابدأ من حيث أنت، واستخدم ما لديك، وافعل ما تستطيع.', 2],
            ['success', 'ما نيل المطالب بالتمني، ولكن تؤخذ الدنيا غلابا.', 0],
            ['life', 'عش بسيطاً، فأجمل ما في الحياة أبسطه.', 1],
            ['knowledge', 'من لم يتعلم في الصغر لم يتقدم في الكبر.', 2],
        ];

        foreach (array_reverse($quotes) as $i => [$slug, $text, $u]) {
            $q = new Quote(['text' => $text, 'category_id' => $cat[$slug]]);
            $q->user_id = $users[$u]->id;
            $q->created_at = now()->subHours($i * 5);
            $q->updated_at = $q->created_at;
            $q->save();
        }
    }
}
