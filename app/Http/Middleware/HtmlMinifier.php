<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class HtmlMinifier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if( config('appConfig.enable_minifier')){

            $buffer = $response->getContent();
            if(strpos($buffer,'<pre>') !== false)
            {
                $replace = array(
                    '/<!--[^\[](.*?)[^\]]-->/s' => '',
                    "/<\?php/"                  => '<?php ',
                    "/\r/"                      => '',
                    "/>\n</"                    => '><',
                    "/>\s+\n</"                 => '><',
                    "/>\n\s+</"                 => '><',
                );
            }
            else
            {
                $replace = array(
                    '/<!--[^\[](.*?)[^\]]-->/s' => '',
                    "/<\?php/"                  => '<?php ',
                    "/\n([\S])/"                => '$1',
                    "/\r/"                      => '',
                    "/\n/"                      => '',
                    "/\t/"                      => '',
                    "/ +/"                      => ' ',
                );
            }
            $buffer = preg_replace(array_keys($replace), array_values($replace), $buffer);
            $response->setContent($buffer);
            ini_set('zlib.output_compression', 'On'); // If you like to enable GZip, too!
        }

        return $response;
    }

    /*
     public function handle($request, Closure $next)
    {
        $response = $next($request);

        $contentType = $response->headers->get('Content-Type');
        if(strpos($contentType, 'text/html') !== false){
            $response->setContent($this->minify($response->getContent()));
        }

        return $response;
    }

    public function minify($input){
        $search = ['/\>\s+/s', '/\s+</s'];

        $replace = ['> ', ' <'];

        return preg_replace($search, $replace, $input);
    }
    */
}