# 狼介短址

## 狼介所使用的环境
    CentOS 7.6  
    Nginx 1.20.2  
    MySQL 5.6.50  
    PHP 7.4  
    宝塔面板 7.7.0
# 0x00_使用方法
0x01__下载源码  
0x02__新建站点  
0x03__**修改 Nginx 配置文件** ，在配置文件中加入以下代码，如图所示

    location ~^/(.*)/$ {
    root /www/wwwlogs/f0f.cc;#f0f.cc改成你的域名
    }
    location / {
        if (!-f $request_filename){
            rewrite (.*) /index.php;
        }
    }
![Markdown][3]
0x04__上传源码  
0x05__**编辑 index.php 文件**，仅仅只需要修改 7-14 行的这些代码即可运行

    $ht_pass = "wolf4096";      //设置网站后台密码
    $xs_beia = "";              //设置网站备案号

    //设置数据库参数
    $db_addr = "localhost";     //主机地址(一般不改)
    $db_user = "0l6_cc";        //数据库用户名
    $db_pass = "wolf64";        //数据库密码
    $db_name = "0l6_cc";        //数据库名
0x06__打开主页  
0x07__完成配置  

## END

# 0x10_以下是网站的 _help

**狼介短址** 是由 **[狼介(WOLF4096)][1]** 开发的一个 **[开源的短链接项目][2]**，使用简单，核心代码不到 30KB（包含前后端及后台）  
如有遇到 Bug 可联系 **狼介**  邮箱：wolf4096@foxmail.com

# 0x11_创建短址
**使用方法**：输入 链接、文本 以及 Markdown  
一、**链接**：输入/粘贴 链接 → 生成短址  
二、**文本**：输入/粘贴 文本 → 生成短址  
三、**Markdown**：输入/粘贴 Markdown → 生成短址，头部必须包含 "**&lt;!--markdown--&gt;**" 字符  
**Markdown示例：**<br />  
![Markdown][4]

# 0x12_查询短址

**使用方法**：输入短址 或 编号  
一、**短址**：输入/粘贴 短址-->查询短址  
例如：**http://f0f.cc/1**  
二、**编号**：输入/粘贴 编号-->查询短址  
例如：**1**  

# 0x13_关于链接
网站后台有一张标记表，用于标记链接状态

|  值   | 状态  |
|  ----  | ----  |
| 0  | 怀疑 |
| 1  | 信任 |
| 2  | 拒绝 |

若域名标记为0，则弹出中间页面（默认为0）  
若域名标记为1，直接跳转目标url  
若域名标记为2，则不显示链接  
需要 **管理员** 进入网站 **[后台][5]** 才能修改

  [1]: https://blog.wolf4096.top
  [2]: https://github.com/WOLF4096
  [3]: https://vkceyugu.cdn.bspapp.com/VKCEYUGU-9a8cc5dd-fdd4-4b4b-a15d-b62edf64e883/df3f2248-cbd8-4b22-a720-2f6a7830aeea.png
  [4]: https://vkceyugu.cdn.bspapp.com/VKCEYUGU-9a8cc5dd-fdd4-4b4b-a15d-b62edf64e883/ade1b15d-2059-403b-bfc0-2f977f96595b.png
  [5]: http://f0f.cc/_admin
