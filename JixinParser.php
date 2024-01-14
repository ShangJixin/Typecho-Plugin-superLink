<?php
class JixinParser{

    /**
     * superLink
     * 主实现函数
     * 
     * @param $content HTML格式文本
     * @return $content 解析完毕后返回
     */
    public function superLink($content){
        if(preg_match_all('/<a(.*?)href="(.*?)"(.*?)>(.*?)<\/a>/is',$content,$matches)){
            
            /*
            if ($matches[2] != $matches[4]){
                //如果href的值不等于a标签包裹的值，直接把内容丢回去，下面的解析就不执行了
                return $content;
            }
            */
            
            //DEBUG
            //echo '<pre>';
            //print_r($matches);
            //echo '</pre>';
            
            //让包裹着a标签的url的array进行foreach的操作
            foreach ($matches[0] as $child){

                //$strip_child 为去HTML标签之后的url，方便下面进行匹配
                $strip_child = strip_tags($child);
            
                if($this->media_bilibili($strip_child)){
                    //echo '解析成功';
                    $content = preg_replace('/'.preg_quote($child,'/').'/i',$this->pregBilibili($strip_child,$this->media_bilibili($strip_child)),$content);
                }
                
                if($this->card_github($strip_child)){
                    //echo '解析成功';
                    $content = preg_replace('/'.preg_quote($child,'/').'/i',$this->pregGithub($strip_child),$content);
                }

                if($this->media_neteasemusic($strip_child)){
                    //echo '解析成功';
                    $content = preg_replace('/'.preg_quote($child,'/').'/i',$this->pregNeteasemusic($strip_child,$this->media_neteasemusic($strip_child)),$content);
                }

            }
        }
        
        //解析完毕，丢回去
        return $content;
    }

    /**
     * media_bilibili
     * 对B站视频进行相关的解析
     * https://gitee.com/ComsenzDiscuz/DiscuzX/blob/master/upload/source/function/media/media_bilibili.php
     * 
     * @param $url 视频网站链接，丢进去进行判断，用于转换成iframe的url
     * @param $type 0:返回iframe 1|other:返回AV|BV号
     * @return $iframe 若解析成功返回iframe的内容，失败的话返回布朗值0
     */
    private function media_bilibili($url,$type = 0) {
        $quality_request = "&as_wide=1&high_quality=1";
        if(preg_match("/https?:\/\/(m.|www.|)bilibili.(com|tv)\/video\/(a|b)v([A-Za-z0-9]+)(\/?.*?&p=|\/?\?p=)?(\d+)?/i", $url, $matches)) {
            $vid = (is_numeric($matches[4]) ? 'aid='.$matches[4] : 'bvid='.$matches[4]) . (empty($matches[6]) ? '' : '&page='.intval($matches[6]));
            $iframe = 'https://player.bilibili.com/player.html?'.$vid.$quality_request;
            if ($type == 0) {
                return $iframe;
            } else {
                $vid = str_replace("bvid=","BV",$vid);
                $vid = str_replace("aid=","AV",$vid);
                return $vid;
            }
        } else if(preg_match("/https?:\/\/(www.|)(acg|b23).tv\/(a|b)v([A-Za-z0-9]+)(\/?.*?&p=|\/?\?p=)?(\d+)?/i", $url, $matches)) {
            $vid = (is_numeric($matches[4]) ? 'aid='.$matches[4] : 'bvid='.$matches[4]) . (empty($matches[6]) ? '' : '&page='.intval($matches[6]));
            $iframe = 'https://player.bilibili.com/player.html?'.$vid.$quality_request;
            if ($type == 0) {
                return $iframe;
            } else {
                $vid = str_replace("bvid=","BV",$vid);
                $vid = str_replace("aid=","AV",$vid);
                return $vid;
            }
        } else {
            return 0;
        }
    }

    /**
     * pregBilibili
     * 解析形如Bilibili的iframe的内容
     * 
     * @param $url 视频网站的跳转地址
     * @param $iframe 传入解析完毕的iframe地址
     * @return 解析好待替换的HTML内容
     */
    private function pregBilibili($url,$iframe){
        return '<div class="JixinParser-card bilibili" data-src="'.$iframe.'"><div class="JixinParser-card-meta"><a href="'.$url.'" target="_blank" rel="external nofollow">'.$this->media_bilibili($url,"1").'</a><span class="fold">展开/收起</span></div><div class="iframe-container"></div></div>';
    }
    
    /**
     * card_github
     * 判断 是否符合github repo卡片的解析条件
     * 
     * @param $url 需要进行判断的url
     * @return boolean
     */
    private function card_github($url){
        if (preg_match("/https?:\/\/github.com\/(.*?)\/(.*?)/is",$url,$matches)){
            if (preg_match("/https?:\/\/github.com\/blog\/(.*?)/is",$url,$matches)){
                return 0;
            }
            if (preg_match("/https?:\/\/github.com\/(.*?)\/(.*?)\/(.*?)\//is",$url,$matches)){
                return 0;
            }
            return 1;
        } else {
            return 0;
        }
    }
    
    /**
     * pregGithub
     * 处理Github卡片的HTML
     * 
     * @param $url 经判断为仓库首页的URL
     * @param $iframe 此形参不起作用
     * @return 解析好待替换的HTML内容
     */
    private function pregGithub($url,$iframe = NULL){
        $iframe = preg_replace('/https?:\/\/github.com\//is','https://api.github.com/repos/',$url);
        $repo = preg_replace('/https?:\/\/github.com\//is','',$url);
        return '<div class="JixinParser-card github" data-src="'.$iframe.'"><div class="JixinParser-card-meta"><a href="'.$url.'" target="_blank" rel="external nofollow">'.$repo.'</a><span>Github</span></div><div class="iframe-container">Loading...</div></div>';
    }

    /**
     * media_neteasemusic
     * 
     * @param $url 网站链接，丢进去进行判断，用于转换成iframe的url
     * @param $type 0:返回iframe 1|other:返回id
     * @return $iframe 若解析成功返回iframe的内容，失败的话返回布朗值0
     */
    private function media_neteasemusic($url,$type = 0) {

        if(preg_match("/^https:\/\/music\.163\.com\/#\/song\?id=(\d+)$/is", $url, $matches)) {
            $sid = $matches[1];
            $iframe = 'https://music.163.com/outchain/player?type=2&id='.$sid.'&height=66';
            if ($type == 0) {
                return $iframe;
            } else {
                return $sid;
            }
        } else if(preg_match("/^https:\/\/music\.163\.com\/#\/playlist\?id=(\d+)$/is", $url, $matches)) {
            $sid = $matches[1];
            $iframe = 'https://music.163.com/outchain/player?type=0&id='.$sid;
            if ($type == 0) {
                return $iframe;
            } else {
                return $sid;
            }
        } else {
            return 0;
        }
    }

    /**
     * pregNeteasemusic
     * 解析形如网易云音乐的iframe的内容
     * 
     * @param $url 网站的跳转地址
     * @param $iframe 传入解析完毕的iframe地址
     * @return 解析好待替换的HTML内容
     */
    private function pregNeteasemusic($url,$iframe){
        if(preg_match("/^https:\/\/music\.163\.com\/#\/song\?id=(\d+)$/is", $url, $matches)) {
            $class = 'JixinParser-card neteasemusic single';
        } else {
            $class = 'JixinParser-card neteasemusic';
        }
        return '<div class="'.$class.'" data-src="'.$iframe.'"><div class="JixinParser-card-meta"><a href="'.$url.'" target="_blank" rel="external nofollow">网易云音乐 · '.$this->media_neteasemusic($url,"1").'</a><span class="fold">展开/收起</span></div><div class="iframe-container"></div></div>';
    }

}
