<?php

use Ti\Mss\Helpers\File;
use Symfony\Component\HttpFoundation;
use Ti\Mss\Helpers\Encryption;
use Ti\Mss\Helpers\Session;
/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| This file is part of the Telthemweb package.
| 
|
*/



if (!function_exists('redirectTo')) {
    function redirectTo($path)
    {
        //ob_start();
        header("Location: $path");
    }
}

if (!function_exists('flash')) {
    /**
     * Add or get item from session flash bag.
     *
     * @param $key
     * @param null $value
     *
     * @return mixed
     */
    function flash($key, $value = null)
    {
        /*
         * add item to session flash bag
         */
        if ($value) {
            return session()->getFlashBag()->add($key, $value);
        }

        /*
         * get an item from session flash bag
         */
        foreach (session()->getFlashBag()->get($key, []) as $message) {
            return $message ?: null;
        }

        return '';
    }
}





if (!function_exists('config')) {
    /**
     * Get value from environment variable or default.
     *
     * @param $key
     * @param null $default
     *
     * @return array|false|null|string
     */
    function config($key, $default = null)
    {
        return getenv($key) ? getenv($key) : $default;
    }
}

if (!function_exists('filesystem')) {
   
    function filesystem()
    {
        return (new File)->getFileSystem();
    }
}

if (!function_exists('makeMail')) {
    /**
     * Send email from a file.
     *
     * @param $path
     * @param $data
     *
     * @return string
     */
    function makeMail($path, $data)
    {
        extract($data);
        ob_start();

        if (filesystem()->exists(realpath(__DIR__.'./../../Resources/views/'))) {
            include __DIR__.'./../../Resources/views/'.$path;
        } else {
            include __DIR__.'./../../Resources/views/'.$path;
        }

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}

if (!function_exists('session')) {
    /**
     * session instance.
     */
    function session()
    {
        $session = Session::getInstance();
        if (!$session->isStarted()) {
            $session->start();
        }

        return $session;
    }
}

if (!function_exists('csrf_token_field')) {
    /**
     * Generate a CSRF token hidden input field.
     */
    function csrf_token_field()
    {
        echo html_entity_decode('<input type="hidden" name="token" value="'.token().'">');
    }
}

if (!function_exists('token')) {
    /**
     * Generate a CSRF token.
     */
    function token()
    {
        $session = session();

        if ($session->has('token')) {
            return $session->get('token');
        }

        $token = base64_encode(openssl_random_pseudo_bytes(32));
        $session->set('token', $token);

        return $token;
    }
}

if (!function_exists('isRunningFromConsole')) {
    /**
     * Determine if application is running from commandline.
     *
     * @return bool
     */
    function isRunningFromConsole()
    {
        return php_sapi_name() == 'cli' || php_sapi_name() == 'phpdbg';
    }
}

if (!function_exists('secret')) {
    /**
     * Hash a given string.
     *
     * @param $plainText
     *
     * @return bool|string
     */
    function secret($plainText)
    {
        return password_hash(
            base64_encode(hash('sha384', $plainText, true)), PASSWORD_DEFAULT
        );
    }
}

if (!function_exists('verify_secret')) {
    /**
     * Verify that a given string matches stored hash.
     *
     * @param $plainText
     * @param $hash
     *
     * @return bool
     */
    function verify_secret($plainText, $hash)
    {
        return password_verify(
            base64_encode(hash('sha384', $plainText, true)), $hash
        );
    }
}

if (!function_exists('user')) {
    /**
     * Get the authenticated user.
     *
     * @return mixed
     */
    function user()
    {
        $user = \Ti\Mss\Helpers\AuthenticateUser::user();

        // if (!$user) {
        //     $user = \Ti\Mss\helpers\AuthenticateUser::remembered(
        //         \Ti\Mss\helpers\Request::createFromGlobals()
        //     );
        // }

        return $user;
    }
}

if (!function_exists('getConfigPath')) {

    /**
     * get the desired config path.
     *
     * @param $path
     *
     * @return mixed
     */
    function getConfigPath($path, $key = null)
    {
        if (!file_exists(realpath(__DIR__.'/../../../../../config/'.$path.'.php'))) {
            return;
        }
        $path = require realpath(__DIR__.'/../../../../../config/'.$path.'.php');
        if ($key == null) {
            return $path;
        }

        return isset($path[$key]) ? $path[$key] : null;
    }
}

if (!function_exists('encrypt')) {
    /**
     * Encrypt a given value.
     *
     * @param $value
     *
     * @throws Exception
     *
     * @return string
     */
    function encrypt($value)
    {
        return (new Encryption())->encrypt($value);
    }
}
if (!function_exists('decrypt')) {
    /**
     * Decrypt the given data.
     *
     * @param $data
     *
     * @throws Exception
     *
     * @return string
     */
    function decrypt($data)
    {
        return (new Encryption())->decrypt($data);
    }
}

if (!function_exists('setCookie')) {

    /**
     * Easy method to set cookies.
     *
     * @param $name
     * @param null $value
     * @param int  $expire
     *
     * @return array
     */
    function setCookie($name, $value = null, $expire = 0)
    {
        $response = new \Symfony\Component\HttpFoundation\Response();
        $response->headers->setCookie(new \Ti\Mss\Helpers\Cookie($name, $value, $expire));
        $response->send();

        return $response->headers->getCookies();
    }
}

if (!function_exists('readCookie')) {
    /**
     * Read cookie value.
     *
     * @param Ti\Mss\helpers\Request $request
     * @param $name
     *
     * @return mixed
     */
    function readCookie(Ti\Mss\helpers\Request $request, $name)
    {
        return $request->cookies()->get($name);
    }
}
