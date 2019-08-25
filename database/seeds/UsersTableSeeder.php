<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            'http://larabbs.test/uploads/images/avatars/201908/18/1_1566130303_RqnYz2GHvI.png',
            'http://larabbs.test/uploads/images/avatars/201908/18/1_1566133819_sl62UgV7Be.jpg',
            'http://larabbs.test/uploads/images/avatars/201908/18/1_1566133883_dG2IXnr1CN.jpg',
            'http://larabbs.test/uploads/images/avatars/201908/18/1_1566133910_P1i5xHU5Yo.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'http://larabbs.test/uploads/images/avatars/201908/18/1_1566134047_KsG5dJzviw.jpg',
        ];

        $users = factory(User::class)
                        ->times(10)
                        ->make()
                        ->each(function ($user, $index)
                            use ($faker, $avatars)
                            {
                                // 从头像数组中随机取出一个并赋值
                                $user->avatar = $faker->randomElement($avatars);
                            });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'rember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = "OneZale";
        $user->email = "442342634@qq.com";
        $user->avatar = "http://larabbs.test/uploads/images/avatars/201908/18/1_1566134047_KsG5dJzviw.jpg";
        $user->save();

        // 初始化用户角色， 将 1 号用户指派为【站长】
        $user->assignRole('Founder');

        // 将 2 号用户指派为【管理员】
        $user = User::find(2);
        $user->assignRole('Maintainer');
    }
}
