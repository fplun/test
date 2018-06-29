<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        \DB::table('permissions')->insert([
            ['name' => '新闻公告管理', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '内部消息管理', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '注册新会员', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '未开通会员', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '冻结会员管理', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '所有会员列表', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '配套管理', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '推荐网络查看', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '接点网络查看', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '分享补贴查看', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '会员账号维护', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '会员充值管理', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '会员提款管理', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '账户明细查询', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '拨出率统计', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '授权账号管理', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '管理员密码修改', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '系统开关设置', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '系统安全设置', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '奖金参数设置', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '股数交易流设置', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '数据结算管理', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '会员日志查看', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '管理员日志查看', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '数据导入', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
