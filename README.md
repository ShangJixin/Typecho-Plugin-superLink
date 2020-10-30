superLink - 无需再记忆短代码，只要输入符合解析规则的链接，就可解析为对应的卡片😎

## superLink 现在支持哪些解析
- [V1.0]Bilibili 视频
后台编辑器：
```
https://www.bilibili.com/video/av43526
```
经过 Typecho 的 Markdown 解析后
```HTML
<a href="https://www.bilibili.com/video/av43526">https://www.bilibili.com/video/av43526</a>
```
在 Typecho Markdown 解析的基础上，`superLink`再次对其解析
![Bilibili-Parser.png](https://i.loli.net/2020/10/30/nCPVLlwQIURX16i.png)

- [V1.0]Github 仓库首页卡片
后台编辑器：
```
https://github.com/ShangJixin/Typecho-Plugin-fancyboxJQ
```
经过 Typecho 的 Markdown 解析后
```HTML
<a href="https://github.com/ShangJixin/Typecho-Plugin-fancyboxJQ">https://github.com/ShangJixin/Typecho-Plugin-fancyboxJQ</a>
```
在 Typecho Markdown 解析的基础上，`superLink`再次对其解析
![Github-Parser.png](https://i.loli.net/2020/10/30/FrJjHfoXPt4VYCx.png)

- 更多功能等待更新中...

## 插件使用说明
是否加载 jQuery：为了防止重复引用 jQuery，给站点带来不必要的加载开销，所以设置此功能。如果你已经在主题内或者是其他插件已经加载过 jQuery，那就无需再次加载。

**注：jQuery 引入依赖于 jsdelivr CDN**

**下载完后，请务必将本插件的文件夹的名字改为`superLink`，否则会出错！！**
