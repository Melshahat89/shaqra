<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * Seeds the `partners` table with the official "شركاء النجاح" (Success Partners)
 * logos supplied in the Shaqra University deck. Logo image files live in
 * public/uploads/files/{medium,small,} and are referenced by filename only.
 *
 * Re-running this seeder REPLACES all existing partners.
 */
class Partners extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('partners')->truncate();
        Schema::enableForeignKeyConstraints();

        $now = now();
        $rows = [
            ['title' => '{"ar": "شركة التميز لحلول الأعمال", "en": "Excellence Business Solutions (EBS)"}', 'logo' => 'ebs.png', 'sort' => 1],
            ['title' => '{"ar": "شبكتي", "en": "Shabakati"}', 'logo' => 'shabakati.png', 'sort' => 2],
            ['title' => '{"ar": "معهد منظمة التجارة العالمية", "en": "WTO Organization Institute"}', 'logo' => 'wto-org-institute.png', 'sort' => 3],
            ['title' => '{"ar": "مركز التجارة الدولية", "en": "International Trade Centre"}', 'logo' => 'intl-trade-centre.png', 'sort' => 4],
            ['title' => '{"ar": "ريادة الأعمال والمنشآت الصغيرة", "en": "Entrepreneurship and Small Business (ESB)"}', 'logo' => 'esb.png', 'sort' => 5],
            ['title' => '{"ar": "إرنست ويونغ", "en": "EY (Ernst & Young)"}', 'logo' => 'ey.png', 'sort' => 6],
            ['title' => '{"ar": "كلية لندن للأعمال", "en": "London Business School"}', 'logo' => 'london-business-school.png', 'sort' => 7],
            ['title' => '{"ar": "كابي", "en": "KABi"}', 'logo' => 'kabi.png', 'sort' => 8],
            ['title' => '{"ar": "كي بي إم جي", "en": "KPMG"}', 'logo' => 'kpmg.png', 'sort' => 9],
            ['title' => '{"ar": "إنسياد", "en": "INSEAD"}', 'logo' => 'insead.png', 'sort' => 10],
            ['title' => '{"ar": "معهد إدارة المشاريع", "en": "Project Management Institute (PMI)"}', 'logo' => 'pmi.png', 'sort' => 11],
            ['title' => '{"ar": "معهد التجارة العالمي", "en": "World Trade Institute"}', 'logo' => 'world-trade-institute.png', 'sort' => 12],
            ['title' => '{"ar": "تايم كود", "en": "TIME CODE"}', 'logo' => 'time-code.png', 'sort' => 13],
            ['title' => '{"ar": "أدكاس", "en": "ADCAS"}', 'logo' => 'adcas.png', 'sort' => 14],
            ['title' => '{"ar": "برايس ووترهاوس كوبرز", "en": "PwC"}', 'logo' => 'pwc.png', 'sort' => 15],
            ['title' => '{"ar": "أوليفر وايمان", "en": "Oliver Wyman"}', 'logo' => 'oliver-wyman.png', 'sort' => 16],
            ['title' => '{"ar": "بناء المستقبل الرقمي", "en": "Building the Digital Future"}', 'logo' => 'building-the-digital-future.png', 'sort' => 17],
            ['title' => '{"ar": "المركز الوطني للتعليم الإلكتروني", "en": "National eLearning Center"}', 'logo' => 'national-elearning-center.png', 'sort' => 18],
            ['title' => '{"ar": "الاتحاد الدولي لحفظ الطبيعة", "en": "IUCN"}', 'logo' => 'iucn.png', 'sort' => 19],
            ['title' => '{"ar": "علم", "en": "Elm"}', 'logo' => 'elm.png', 'sort' => 20],
            ['title' => '{"ar": "ماكنزي وشركاه", "en": "McKinsey & Company"}', 'logo' => 'mckinsey.png', 'sort' => 21],
            ['title' => '{"ar": "إيه تي كيرني", "en": "AT Kearney"}', 'logo' => 'at-kearney.png', 'sort' => 22],
            ['title' => '{"ar": "ستراتيجي&", "en": "strategy&"}', 'logo' => 'strategy-and.png', 'sort' => 23],
            ['title' => '{"ar": "معهد الأمير نايف للبحوث والخدمات الاستشارية", "en": "Prince Naif Institute for Research and Consulting Services"}', 'logo' => 'prince-naif-institute.png', 'sort' => 24],
            ['title' => '{"ar": "أخصائي تقنية المعلومات", "en": "Information Technology Specialist (ITS)"}', 'logo' => 'its-information-technology.png', 'sort' => 25],
            ['title' => '{"ar": "بيم", "en": "BIM"}', 'logo' => 'bim.png', 'sort' => 26],
            ['title' => '{"ar": "آي إس بي", "en": "isb"}', 'logo' => 'isb.png', 'sort' => 27],
            ['title' => '{"ar": "توبكس", "en": "TopEX"}', 'logo' => 'topex.png', 'sort' => 28],
            ['title' => '{"ar": "تكامل لحلول الأعمال", "en": "Takamol Business Solutions"}', 'logo' => 'takamol.png', 'sort' => 29],
            ['title' => '{"ar": "هايتس", "en": "Heights"}', 'logo' => 'heights.png', 'sort' => 30],
            ['title' => '{"ar": "المؤسسة العامة للتدريب التقني والمهني", "en": "Technical and Vocational Training Corporation (TVTC)"}', 'logo' => 'tvtc.png', 'sort' => 31],
            ['title' => '{"ar": "جامعة الإمام محمد بن سعود الإسلامية", "en": "Imam Muhammad ibn Saud Islamic University"}', 'logo' => 'imam-university.png', 'sort' => 32],
            ['title' => '{"ar": "بيرد لايف إنترناشونال", "en": "BirdLife International"}', 'logo' => 'birdlife-international.png', 'sort' => 33],
            ['title' => '{"ar": "جنرال إلكتريك", "en": "General Electric"}', 'logo' => 'general-electric.png', 'sort' => 34],
            ['title' => '{"ar": "مجموعة بوسطن الاستشارية", "en": "Boston Consulting Group (BCG)"}', 'logo' => 'bcg.png', 'sort' => 35],
            ['title' => '{"ar": "مايكروسوفت", "en": "Microsoft"}', 'logo' => 'microsoft.png', 'sort' => 36],
            ['title' => '{"ar": "كلية هارفارد للأعمال", "en": "Harvard Business School"}', 'logo' => 'harvard-business-school.png', 'sort' => 37],
            ['title' => '{"ar": "الفرسان الأولى للحراسات الأمنية", "en": "AlFursan AlOula Security Guards Co."}', 'logo' => 'alfursan-aloula.png', 'sort' => 38],
            ['title' => '{"ar": "ريو العربية للمقاولات", "en": "RIO Alarabia Contracting Co."}', 'logo' => 'rio-alarabia.png', 'sort' => 39],
            ['title' => '{"ar": "زنجبيل", "en": "Zanjbil"}', 'logo' => 'zanjbil.png', 'sort' => 40],
            ['title' => '{"ar": "فليكرز فيلم", "en": "Flickers Film"}', 'logo' => 'flickers-film.png', 'sort' => 41],
            ['title' => '{"ar": "مود للاتصال المتكامل", "en": "MOOD Integrated Communication"}', 'logo' => 'mood.png', 'sort' => 42],
            ['title' => '{"ar": "حلول الأولى", "en": "Holol AlOula"}', 'logo' => 'holol-aloula.png', 'sort' => 43],
            ['title' => '{"ar": "آيكونكس", "en": "iCONEX"}', 'logo' => 'iconex.png', 'sort' => 44],
        ];

        $hasSort = Schema::hasColumn('partners', 'sort');
        foreach ($rows as $r) {
            $data = [
                'title'      => $r['title'],
                'logo'       => $r['logo'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
            if ($hasSort) {
                $data['sort'] = $r['sort'];
            }
            DB::table('partners')->insert($data);
        }
    }
}
