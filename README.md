##Tieba Cloud

![test](http://img.shields.io/badge/language-php-orange.svg)    ![test](http://img.shields.io/badge/building-10%-green.svg)<br>
这个项目用于完成百度系列服务

##源码说明
* src-drop    未完成(drop?!)的云签到以及UI
* tieba-sign
  * cron.php    可以调用```lets_do_it($cookie)```函数实现签到，运行效率与用户喜欢的贴吧数成线性关系。
  * func.sign.php    实现签到的库