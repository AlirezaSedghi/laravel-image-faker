<?php

namespace Alirezasedghi\LaravelImageFaker;

class Base
{
    /**
     * Service base url
     */
    public string $base_url = '';

    /**
     * Service files default format
     */
    public string $default_format = 'jpg';

    /**
     * Default user agent for curl
     */
    public string $user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0';

    /**
     * SSL verification of service
     */
    public bool $SSL_verify_peer = true;

    /**
     * Generate the URL that will return a random image
     *
     * @param int $width
     * @param int $height
     * @param bool $grayscale
     * @param bool $blur
     * @return string
     */
    public function imageUrl(int $width = 640, int $height = 480, bool $grayscale = false, bool|int $blur = false): string
    {
        if ( empty($this->base_url) || (static::class === "Alirezasedghi\LaravelImageFaker\Base") ) {
            throw new \InvalidArgumentException("Invalid service call. Don't call Base Service directly.");
        }

        $imageOptions = [];
        if ($grayscale === true) {
            $imageOptions["grayscale"] = true;
        }
        if ($blur) {
            $imageOptions["blur"] = ($blur === true) ? true : $blur;
        }

        return $this->makeUrl($width, $height, $imageOptions);
    }

    /**
     * Download a remote random image to disk and return its location
     *
     * Requires curl, or allow_url_fopen to be on in php.ini.
     *
     * @return bool|string
     */
    public function image(string $dir = null, int $width = 640, int $height = 480, bool $fullPath = true, bool $grayscale = false, bool|int $blur = false)
    {
        if ( empty($this->base_url) || (static::class === "Alirezasedghi\LaravelImageFaker\Base") ) {
            throw new \InvalidArgumentException("Invalid service call. Don't call Base Service directly.");
        }

        $dir = null === $dir ? sys_get_temp_dir() : $dir; // GNU/Linux / OS X / Windows compatible

        // Validate directory path
        if (!is_dir($dir) || !is_writable($dir)) {
            throw new \InvalidArgumentException(sprintf('Cannot write to directory "%s"', $dir));
        }

        // Generate a random filename. Use the server address so that a file
        // Generated at the same time on a different server won't have a collision.
        $name = md5(uniqid(empty($_SERVER['SERVER_ADDR']) ? '' : $_SERVER['SERVER_ADDR'], true));
        $filename = sprintf('%s.%s', $name, $this->default_format);
        $filepath = $dir . DIRECTORY_SEPARATOR . $filename;

        $url = static::imageUrl($width, $height, $grayscale, $blur);

        // Save file
        if (function_exists('curl_exec')) {
            // Use cURL
            $fp = fopen($filepath, 'w');
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
            if ( $this->SSL_verify_peer === false )
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $success = curl_exec($ch) && curl_getinfo($ch, CURLINFO_HTTP_CODE) === 200;
            fclose($fp);
            curl_close($ch);

            if (!$success) {
                unlink($filepath);

                // Could not contact the distant URL or HTTP error - fail silently.
                return false;
            }
        } elseif (ini_get('allow_url_fopen')) {
            // Use remote fopen() via copy()
            $success = copy($url, $filepath);

            if (!$success) {
                // could not contact the distant URL or HTTP error - fail silently.
                return false;
            }
        } else {
            return new \RuntimeException('The image formatter downloads an image from a remote HTTP server. Therefore, it requires that PHP can request remote hosts, either via cURL or fopen()');
        }

        return $fullPath ? $filepath : $filename;
    }

    /**
     * Make url to get images
     *
     * @param int $width
     * @param int $height
     * @param array $imageOptions
     * @return string
     */
    protected function makeUrl(int $width = 640, int $height = 480, array $imageOptions = []) {
        return sprintf(
            '%s/%s/%s%s',
            $this->base_url,
            $width,
            $height,
            !empty($imageOptions) ? preg_replace('/\b\=1\b/', '', '?' . http_build_query($imageOptions)) : ''
        );
    }
}
