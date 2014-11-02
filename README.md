#Tieba Cloud Stable
![test](http://img.shields.io/appveyor/ci/gruntjs/grunt.svg)![test](http://img.shields.io/badge/license-GPL-orange.svg)
贴吧云用于百度各种服务.目前完美支持独立服务器/vps/虚拟主机/京东云.

##环境要求
1. php服务器需开启curl扩展以及支持文件写入.
2. mysql需要支持create,update,select,delete命令.

##安装
上传程序后进入`/install`目录即可进行安装.<br><br>

提醒:完成安装后你需要为cron.php添加一个监控任务,否则云签到不能使用.<br>
这里推荐使用[阿里云监控](http://www.aliyun.com/product/jiankong/)和[360云监控](http://jk.cloud.360.cn/)

更多问题请访问[racalinux.cn](http://www.racalinux.cn)

##其他相关
* 源码遵守GPL发布.
* 签到脚本每次执行5个吧签到,每次执行大概用时2s.<br>
  可取消签到脚本时间限制并自行修改代码一次签到更多吧(默认每次5个吧))
  ![img](http://pic.yupoo.com/racaljk/E6W6ljde/medish.jpg)
* 默认贴吧云签到上限是每天7200个贴吧
  如果数目太多则需要对cron.php多添加几个监控任务

© 2014 racaljk,the great eld ones.
