<?php
if ( ! function_exists('assetImageAndVideo') ){
    function assetImageAndVideo($folder)
    {
        return ( config('app.environment') == "development" ) ?  asset('storage/' . $folder ) . '/' : asset('storage/app/public/' . $folder) . '/';
    }
}
