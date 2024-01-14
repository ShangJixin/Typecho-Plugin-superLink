superLink - 无需再记忆短代码，只要输入符合解析规则的链接，就可解析为对应的卡片😎

## superLink 现在支持哪些解析
### [V1.0] Bilibili 视频
后台编辑器：
```
https://www.bilibili.com/video/av43526
```
经过 Typecho 的 Markdown 解析后
```HTML
<a href="https://www.bilibili.com/video/av43526">https://www.bilibili.com/video/av43526</a>
```
在 Typecho Markdown 解析的基础上，`superLink`再次对其解析，效果如下图

![Bilibili-Parser](https://github.com/ShangJixin/Typecho-Plugin-superLink/assets/21075413/fb6d9fb2-3b41-4e55-a2a6-ec79d3d01dea)

### [V1.0] Github 仓库首页卡片
后台编辑器：
```
https://github.com/ShangJixin/Typecho-Plugin-fancyboxJQ
```
经过 Typecho 的 Markdown 解析后
```HTML
<a href="https://github.com/ShangJixin/Typecho-Plugin-fancyboxJQ">https://github.com/ShangJixin/Typecho-Plugin-fancyboxJQ</a>
```
在 Typecho Markdown 解析的基础上，`superLink`再次对其解析，效果如下图

![Github-Parser](https://github.com/ShangJixin/Typecho-Plugin-superLink/assets/21075413/2953aa8a-b879-4c20-9e67-1c4d4c6f7cfc)

### [V1.5] 网易云音乐
后台编辑器：
```
https://music.163.com/#/playlist?id=70118292

https://music.163.com/#/song?id=1375725396
```
经过 Typecho 的 Markdown 解析后
```HTML
<a href="https://music.163.com/#/playlist?id=70118292">https://music.163.com/#/playlist?id=70118292</a>

<a href="https://music.163.com/#/song?id=1375725396">https://music.163.com/#/song?id=1375725396</a>
```
在 Typecho Markdown 解析的基础上，`superLink`再次对其解析，效果如下图

![NetEaseMusic-Parser](https://github.com/ShangJixin/Typecho-Plugin-superLink/assets/21075413/60cb44dc-96ce-4cb3-b79e-fd59be95f546)


- 更多功能等待更新中...

## 插件使用说明

**下载完后，请务必将本插件的文件夹的名字改为`superLink`，否则会出错！！**
