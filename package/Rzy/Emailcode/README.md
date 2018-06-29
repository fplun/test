## 安装步骤

1 php artisan vendor:publish --provider="Rzy\Emailcode\EmailServieProvider" 发布 Email 配置文件
2 php artisan migrate 迁移数据表
3 EmailTrait 具体发送逻辑
