#Tieba Cloud

![test](http://img.shields.io/badge/language-php-orange.svg)    ![test](http://img.shields.io/badge/building-80%-green.svg)<br>
贴吧云用于百度各种服务;现在暂时只支持贴吧云签到

##环境要求
1. php服务器(需开启curl)
2. 支持mysql的服务器

##安装
* 独立服务器/VPS/虚拟主机
 * 上传所有文件,进入/install目录进行安装即可.
* sae
 * 创建应用后上传所有文件即可.


##其他相关
* 源码遵守GPL发布.
* 签到脚本每次执行5个吧签到,每次执行大概用时2s.<br>
  可取消签到脚本时间限制并自行修改代码一次签到更多吧(默认每次5个吧))
  ![img](http://pic.yupoo.com/racaljk/E6W6ljde/medish.jpg)
* 对于独立服务器和虚拟主机的用户可以取消注释````//set_time_limit(0);````

© 2014 racaljk,the great eld ones.