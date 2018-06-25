<?php
class G
{
    private static function getCurlOpts($url, $dumpHeader=false, $redir=false)
    {
        $agents = array(
            "Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3",
            "Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/532.3 (KHTML, like Gecko) Chrome/4.0.223.11 Safari/532.3",
            "Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/532.8 (KHTML, like Gecko) Chrome/4.0.302.2 Safari/532.8",
            "Mozilla/5.0 (X11; U; Linux i686; zh-CN; rv:1.9.2) Gecko/20100115 Firefox/3.6",
            "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)",
            "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)",
            "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)",
            "Mozilla/4.0 (compatible; MSIE 5.0; Windows NT 5.1; .NET CLR 1.1.4322)",
            "Opera/9.20 (Windows NT 6.0; U; en)",
            "Opera/9.00 (Windows NT 5.1; U; en)",
            "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; en) Opera 8.50",
            "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; en) Opera 8.0",
            "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20060127 Netscape/8.1",
            //"AdsBot-Google (+http://www.google.com/adsbot.html)",
        );
        $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
        $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
        $header[] = "Cache-Control: max-age=0";
        $header[] = "Connection: keep-alive";
        $header[] = "Keep-Alive: 300";
        $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $header[] = "Accept-Language: en-us,en;q=0.5";
        $header[] = "Pragma: "; // browsers keep this blank.
        if (DIRECTORY_SEPARATOR=='/') {
            $cookie = "/tmp/curl_cookie_".self::getDomain($url);
        } else {
            $cookie = dirname(dirname(__FILE__))."\\curl_cookie_".self::getDomain($url);
        }
        $options = array(   CURLOPT_URL             => $url,
                            CURLOPT_REFERER         => 'http://www.google.com/search?hl=en&source=hp&q=coupons&aq=f&aqi=g3&oq=',
                            CURLOPT_RETURNTRANSFER  => 1,
                            CURLOPT_AUTOREFERER     => 1,
                            CURLOPT_FOLLOWLOCATION  => 0,
                            CURLOPT_MAXREDIRS       => 0,//!!! just for fetch 1st jump coupon link
                            CURLOPT_TIMEOUT         => 60,//some pages has big content needed more transfer time
                            CURLOPT_CONNECTTIMEOUT  => 15,
                            CURLOPT_SSL_VERIFYHOST  => 0,
                            CURLOPT_SSL_VERIFYPEER  => 0,
                            CURLOPT_COOKIEJAR       => $cookie,
                            CURLOPT_COOKIEFILE      => $cookie,
                            CURLOPT_USERAGENT       => $agents[array_rand($agents)],
                            CURLOPT_HTTPHEADER      => $header,
                            CURLOPT_ENCODING        => 'gzip,deflate',
                        );  
        if ($dumpHeader) {
            $options[CURLOPT_HEADER] = 1;
            //$options[CURLOPT_NOBODY] = 1;
            //$options[CURLOPT_CUSTOMREQUEST] = 'HEAD';
        } else {
            $options[CURLOPT_HTTPGET] = 1;
        }
        if ($redir) {
            $options[CURLOPT_FOLLOWLOCATION] = 1;
            $options[CURLOPT_MAXREDIRS] = 20;
        }
        $ip = self::getRandomIp();
        if ($ip) $options[CURLOPT_INTERFACE] = $ip;
        return $options;
    }

    public static function readUrl($url, $dumpHeader=false, $redir=false) 
    {
        $ch = curl_init();
        $opts = self::getCurlOpts($url, $dumpHeader, $redir);
        curl_setopt_array($ch, $opts);
        $html = curl_exec($ch);
        $r = 0;
        $msg = curl_error($ch);
        while ($msg && $r<=1) {
            echo "[ " . date('Y-m-d H:i:s') . " ]" . "[ $msg ] on [ $url ]\n";
            echo "[ HTML size ".strlen($html)." ]\n";
            echo "[ Retry after 3s ]\n";
            sleep(1);
            $html = curl_exec($ch);
            $msg = curl_error($ch);
            $r++;
        }
        curl_close($ch);
        @unlink($opts[CURLOPT_COOKIEFILE]);
        return $html;
    }

    public static function getRandomIp() 
    {
        $ip = false;
        if (file_exists(dirname(__FILE__).'/ips.txt')) {
            $x = file(dirname(__FILE__).'/ips.txt');
            $ip = trim($x[array_rand($x)]);
        }
        if (false && DIRECTORY_SEPARATOR=='/') { //is unix or linux
            if (!$x = @unserialize(file_get_contents('/tmp/xhosts'))) {
                exec('/sbin/ifconfig | grep "inet " | cut -d : -f 2 | cut -d " " -f 1', $x, $r); 
                foreach ($x as $k=>$v) {
                    if ($v=='127.0.0.1') unset($x[$k]);
                }
                file_put_contents('/tmp/xhosts', serialize($x));
            }   
            $ip = $x[array_rand($x)];
        }
        //trigger_error('USE IP: '.$ip, E_USER_NOTICE);
        return $ip;
    }

    public static function readUrls($urls, $dumpHeader=false) 
    {
        if (count($urls)==1) {
            return self::readUrl($urls[0]);
        }
        $mh = curl_multi_init();
        $cu = array();
        foreach ($urls as $i => $url) {
            $cu[$i] = curl_init();
            curl_setopt_array($cu[$i], self::getCurlOpts($url, $dumpHeader));
            curl_multi_add_handle($mh, $cu[$i]);
        }
        do {
            $n = curl_multi_exec($mh, $active);
        } while ($active);
        $res = array();
        foreach ($urls as $i => $url) {
            $res[$url] = curl_multi_getcontent($cu[$i]);
            curl_close($cu[$i]);
        }
        curl_multi_close($mh);
        return $res;        
    }

    public static function microtime ($start = 0)
    {
        $t = explode(' ', microtime());
        return number_format($t[0] + $t[1] - $start, 5, '.', '');
    }

    public static function dumpJumpUrl ($url,$all=false)
    {
        //$cmd = "curl -isLI '$url' | grep '^Location' | awk '{print $2}'";
        $i = 0;
        $html = self::readUrl($url, true, $all);
        $m = array();
        while ($i<=3 && strpos($html, "503 Service Temporarily Unavailable")!==false) {
            $i++;
            echo "*";
            sleep($i*2);
            $html = self::readUrl($url, true, $all);
        }
        preg_match_all("%^Location: (.+?)\r$%mi", $html, $m);
        return $m[1];
    }

    public static function dumpJumpUrls ($urls)
    {
        $htmls = self::readUrls($urls, true);
        foreach ($urls as $url) {
            $m = array();
            preg_match_all("%^Location: (.+?)\r$%mi", $htmls[$url], $m);
            $htmls[$url] = $m[1];
        }
        return $htmls;
    }

    public static function getDomain($url)
    {
        $url = strtolower(trim($url));
        if ($url=='') return "";
        if (substr($url,0,1)=='/') $url = substr($url,1);
        if (strpos($url,'http://')!==0 && strpos($url,'https://')!==0) $url = 'http://'.$url;
        $host = parse_url($url, PHP_URL_HOST);
        $ha = explode(".",$host);
        return $host;
        $c = count($ha);
        if ($c<=2) return $host;
        if ($ha[$c-2]=='co' || $ha[$c-2]=='com') return $ha[$c-3].'.'.$ha[$c-2].'.'.$ha[$c-1];//co.uk, co.ca, com.cn
        return $ha[$c-2].'.'.$ha[$c-1];
    }

    public static function dumpDomain($url)
    {
        $jh = self::dumpJumpUrl($url, true);
        $cj = count($jh);
        if ($cj==0) return self::getDomain($url);
        foreach (array_reverse($jh) as $link) {
            if (strpos($link,'http')===0) return self::getDomain($link);
        }
        return self::getDomain($url);
    }

    public static function fetchCode($mname, &$s1, &$s2)
    {
        $splus = "['\"-\.:=”“;!]";
        $badWords = 'on|for|and|here|off|worth|when|needed|during|good|gives|you|will|needed|required|link|links|com';
        $regexp = "%code[:,]?\s+$splus*(?!$badWords)(\S+?)$splus*\s+%msi";
        preg_match($regexp, $s1.' ', $mt);
        preg_match($regexp, $s2.' ', $md);
        $code = trim(strlen($md[1]) > strlen($mt[1]) ? $md[1] : $mt[1]);
        $code = (isset($code) && strlen($code)>2 && strlen($code)<30) ? $code : "";
        if (!$code) {
            $regexp = "%$splus(\S+?)$splus%";
            preg_match($regexp, $s1.' ', $mt);
            preg_match($regexp, $s2.' ', $md);
            $code = trim(strlen($md[1]) > strlen($mt[1]) ? $md[1] : $mt[1]);
            $code = (isset($code) && strlen($code)>2 & strlen($code)<30) ? $code : "";
        }
        if (false && $code) {//do not replace here, will replace when display
            $find = "%(coupon)?\s*(code[:,]?)?\s*$splus*$code$splus*%msi";
            $replace = " $mname coupon codes ";
            $s1 = preg_replace($find, $replace, $s1);
            $s2 = preg_replace($find, $replace, $s2);
        }
        return $code;
    }
}

