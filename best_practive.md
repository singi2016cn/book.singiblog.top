# 最佳实践

## 数据库迁移

1. 生成数据库迁移文件(创建表)

    `php artisan make:migration create_books_table --create=books`

2. 运行迁移文件

    `php artisan migrate`

3. 生成数据库数据填充文件

    `php artisan make:seeder books`

4. 运行数据填充文件

    `php artisan db:seed`

## 控制器

> 使用资源控制器

1. 生成资源控制器

    `php artisan make:controller BooksController --resource`

2. 生成对应超链接(在页面上)
    
    `route('books.store') => 新增操作`
    
    or
    
    `url('books') => 新增操作`
    
## 模型

1. 生成Model

    `php artisan make:model Model/Books`

2. CURD操作
    
    ```php
    DB::table()->inset($request_data);
    DB::table()->insetGetId($request_data);
    DB::table()->upate($request_data);
    DB::table()->where()->value();
    DB::table()->where()->first();
    DB::table()->where()->pluck();
    DB::table()->where()->get();
    DB::table()->where()->delete();
    ```

3. 常用方法
   
   `->toArray()` //对象转换成数组
   `->toSql()` //查看执行的sql语句



