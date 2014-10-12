#Tieba Cloud

![test](http://img.shields.io/badge/language-php-orange.svg)    ![test](http://img.shields.io/badge/building-90%-green.svg)<br>
贴吧云用于百度各种服务;现在暂时只支持贴吧云签到

##环境要求
1. php服务器需开启curl扩展以及支持文件写入.
2. mysql需要支持create,update,select命令

##安装
* 独立服务器/VPS/虚拟主机
 * 上传所有文件,进入/install目录进行安装即可.
* sae
 * 创建应用后上传所有文件即可.
* 京东云
 * 上传文件后/install安装即可，数据库地址请填写`mysql.jae.jd.com:4066`.

更多问题请参考help.html文件.

##其他相关
* 源码遵守GPL发布.
* 签到脚本每次执行5个吧签到,每次执行大概用时2s.<br>
  可取消签到脚本时间限制并自行修改代码一次签到更多吧(默认每次5个吧))
  ![img](http://pic.yupoo.com/racaljk/E6W6ljde/medish.jpg)
* 对于独立服务器和虚拟主机的用户可以取消注释````//set_time_limit(0);````

© 2014 racaljk,the great eld ones.