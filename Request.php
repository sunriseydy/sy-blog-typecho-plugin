<?php
/**
 * Request 请求类
 * @author SunriseYDY
 */
class Request
{

    public static function updatePost($cid)
    {
        return self::request($cid, "post", "PUT");
    }

    public static function deletePost($cid)
    {
        return self::request($cid, "post", "DELETE");
    }

    public static function updatePage($cid)
    {
        return self::request($cid, "page", "PUT");
    }

    public static function deletePage($cid)
    {
        return self::request($cid, "page", "DELETE");
    }

    public static function request($cid, $type, $method)
    {
        $opstions = Helper::options()->plugin('SyBlogTypechoPlugin');

        $ci = curl_init(); //初始化CURL句柄
        $url = '';
        if ($type == 'post') {
            $url = $opstions->apiHost . '/post/' . $cid;
        } elseif ($type == 'page') {
            $url = $opstions->apiHost . '/page/' . $cid;
        }
        curl_setopt($ci, CURLOPT_URL, $url); //设置请求的URL
        curl_setopt($ci, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出 
        curl_setopt($ci, CURLOPT_CUSTOMREQUEST, $method); //设置请求方式
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ci, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ci, CURLOPT_USERPWD, $opstions->username . ":" . $opstions->password);
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, 0);
        $output = curl_exec($ci);
        curl_close($ci);
        // return json_decode($output);
        return $output;
    }
}
?>