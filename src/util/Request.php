<?php

namespace abilioj\ToolToDev\util;

/**
 * Description of Request
 * @package category util
 * @version 1.0   
 * This class provides methods to handle HTTP requests, including GET, POST, REQUEST, COOKIE, and SESSION.
 * It also includes methods for sanitizing string inputs by converting special characters to HTML entities.
 * @author Abílio José G Ferreira
 */
class Request {

   public static function Do_GET($VAR, $resuDefat) {
      if (isset($_GET[$VAR])):
         if (empty($_GET[$VAR])):
            $resu = $resuDefat;
         else:
            $resu = trim($_GET[$VAR]);
         endif;
      else:
         $resu = $resuDefat;
      endif;
      return $resu;
   }

   public static function Do_POST($VAR, $resuDefat) {
      if (isset($_POST[$VAR])):
         if (empty($_POST[$VAR])):
            $resu = $resuDefat;
         else:
            $resu = trim($_POST[$VAR]);
         endif;
      else:
         $resu = $resuDefat;
      endif;
      return $resu;
   }

   public static function Do_REQUEST($VAR, $resuDefat) {
      if (isset($_REQUEST[$VAR])):
         if (empty($_REQUEST[$VAR])):
            $resu = $resuDefat;
         else:
            $resu = trim($_REQUEST[$VAR]);
         endif;
      else:
         $resu = $resuDefat;
      endif;
      return $resu;
   }

   public static function Do_GET_STRIMGcaracesp(string $VAR, string $resuDefat): string {
      if (isset($_GET[$VAR])):
         if (empty($_GET[$VAR])):
            $resu = $resuDefat;
         else:
            $resu = htmlspecialchars(trim($_GET[$VAR]), ENT_QUOTES);
         endif;
      else:
         $resu = $resuDefat;
      endif;
      return $resu;
   }

   public static function Do_POST_STRIMGcaracesp(string $VAR, string $resuDefat): string {
      if (isset($_POST[$VAR])):
         if (empty($_POST[$VAR])):
            $resu = $resuDefat;
         else:
            $resu = htmlspecialchars(trim($_POST[$VAR]), ENT_QUOTES);
         endif;
      else:
         $resu = $resuDefat;
      endif;
      return $resu;
   }

   public static function Do_COOKIE($VAR, $resuDefat) {
      if (isset($_COOKIE[$VAR])):
         if (empty($_COOKIE[$VAR])):
            $resu = $resuDefat;
         else:
            $resu = trim($_COOKIE[$VAR]);
         endif;
      else:
         $resu = $resuDefat;
      endif;
      return $resu;
   }

   public static function Do_SESSION($VAR, $resuDefat) {
      if (isset($_SESSION[$VAR])):
         if (empty($_SESSION[$VAR])):
            $resu = $resuDefat;
         else:
            $resu = trim($_SESSION[$VAR]);
         endif;
      else:
         $resu = $resuDefat;
      endif;
      return $resu;
   }

}
