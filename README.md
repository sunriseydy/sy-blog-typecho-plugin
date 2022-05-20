# sy blog typecho plugin

这是 `sy-blog` 项目中的 `typecho` 插件，主要功能是在 `typecho` 发布/删除文章或页面之后调用 [`sy-blog-java`](https://github.com/sunriseydy/sy-blog-java) 的更新/删除文章或页面缓存的接口。

## 使用

1. 克隆或下载本项目到 `typecho`安装目录 的 `usr/plugins` 目录下，并将目录重命名为 `SyBlogTypechoPlugin`。
2. 在 `typecho` 插件管理中启用 `SyBlogTypecho` 插件。
3. 在 `typecho` 插件管理中配置 `SyBlogTypecho` 插件：
    * 回调地址： `sy-blog-java` 服务的地址，例如 `https://blog-api.sunriseydy.dev`。注意最后不要`/`。
    * 用户名： `sy-blog-java` 服务配置的用户名，用于访问 `sy-blog-java` 服务中需授权的接口。
    * 密码： `sy-blog-java` 服务配置的密码，用于访问 `sy-blog-java` 服务中需授权的接口。

## 日志

插件会将最新的接口返回存储在 `/tmp/pgp.log` 文件中，如果不需要则可以注释掉 `Plugin.php` 中的相关代码。