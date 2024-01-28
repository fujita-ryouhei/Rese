<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('category');
            $table->string('image_url');
            $table->text('explanation');
            $table->timestamps();
        });

        DB::table('shops')->insert([
            'name' => '仙人',
            'location' => '東京都',
            'category' => '寿司',
            'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg',
            'explanation' => '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、お客様の満足度を徹底的に追及したお店です。特別な日のお食事、ビジネス接待まで気軽に使用することができます。',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shops')->insert([
            'name' => '牛助',
            'location' => '大府阪',
            'category' => '焼肉',
            'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg',
            'explanation' => '焼肉業界で20年間経験を積み、肉を熟知したマスターによる実力派焼肉店。長年の実績とお付き合いをもとに、なかなか食べられない希少部位も仕入れております。また、ゆったりとくつろげる空間はお仕事終わりの一杯や女子会にぴったりです。',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shops')->insert([
            'name' => '戦慄',
            'location' => '福岡県',
            'category' => '居酒屋',
            'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg',
            'explanation' => '気軽に立ち寄れる昔懐かしの大衆居酒屋です。キンキンに冷えたビールを、なんと199円で。鳥かわ煮込み串は販売総数100000本突破の名物料理です。仕事帰りに是非御来店ください。',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shops')->insert([
            'name' => 'ルーク',
            'location' => '東京都',
            'category' => 'イタリアン',
            'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg',
            'explanation' => '都心にひっそりとたたずむ、古民家を改築した落ち着いた空間です。イタリアで修業を重ねたシェフによるモダンなイタリア料理とソムリエセレクトによる厳選ワインとのペアリングが好評です。ゆっくりと上質な時間をお楽しみください。',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shops')->insert([
            'name' => '志摩屋',
            'location' => '福岡県',
            'category' => 'ラーメン',
            'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg',
            'explanation' => 'ラーメン屋とは思えない店内にはカウンター席はもちろん、個室も用意してあります。ラーメンはこってり系・あっさり系ともに揃っています。その他豊富な一品料理やアルコールも用意しており、居酒屋としても利用できます。ぜひご来店をお待ちしております。',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shops')->insert([
            'name' => '香',
            'location' => '東京都',
            'category' => '焼肉',
            'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg',
            'explanation' => '大小さまざまなお部屋をご用意してます。デートや接待、記念日や誕生日など特別な日にご利用ください。皆様のご来店をお待ちしております。',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shops')->insert([
            'name' => 'JJ',
            'location' => '大阪府',
            'category' => 'イタリアン',
            'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg',
            'explanation' => 'イタリア製ピザ窯芳ばしく焼き上げた極薄のミラノピッツァや厳選されたワインをお楽しみいただけます。女子会や男子会、記念日やお誕生日会にもオススメです。',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shops')->insert([
            'name' => 'らーめん極み',
            'location' => '東京都',
            'category' => 'ラーメン',
            'image_url' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg',
            'explanation' => '一杯、一杯心を込めて職人が作っております。味付けは少し濃いめです。 食べやすく最後の一滴まで美味しく飲めると好評です。',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
