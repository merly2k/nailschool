<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace seo;
use \SplFileObject;
use \Exception;

/**
 * Description of keywords
 *
 * @author merly
 */
class keywords {
    //put your code here

  public $contents;
  /**
   * Encoding
   * @var string
   */
  public $encoding = 'utf-8';
  /**
   * Language code of input string
   * Needed for exclusion of useless words (ignored words).
   * @var string
   */
  public $lang = 'en';
  /**
   * If length of input string is less than this, the whole input
   * string becomes the signle keyword phrase.
   * @var integer
   */
  public $inputMinimumLength = 36;
  #===================================================================
  /**
   * Minimum word length for inclusion into the 1-word keyword set
   * @var integer
   * Value 0 ..... disable 1-word keywords
   */
  public $OneWordsMinimumLength = 5;
  /**
   * Minimum word occurence for inclusion into the 1-word keyword set
   * @var integer
   * Value 0 ..... disable 1-word keywords
   */
  public $OneWordsFrequency     = 5;
  #===================================================================
  /**
   * Minimum word length for inclusion into the 2-word keyword set
   * @var integer
   * Value 0 ..... disable 2-word keywords
   */
  public $TwoWordsMinimumLength = 4;
  /**
   * Minimum word occurence for inclusion into the 2-word keyword set
   * @var integer
   * Value 0 ..... disable 2-word keywords
   */
  public $TwoWordsFrequency     = 3;
  #===================================================================
  /**
   * Minimum word length for inclusion into the 3-word keyword set
   * @var integer
   * Value 0 ..... disable 3-word keywords
   */
  public $ThrWordsMinimumLength = 4;
  /**
   * Minimum word occurence for inclusion into the 3-word keyword set
   * @var integer
   * Value 0 ..... disable 3-word keywords
   */
  public $ThrWordsFrequency     = 3;
  #===================================================================
  /**
   * Generates keywords
   * @var    string
   * @return string
   */
  public function generateKW($str) {
    if (preg_match('/^\s*$/', $str)) {
      return '';
    }
    $str = mb_strtolower($str, $this->encoding);
    $str = $this->StripHtml($str);
    $str = $this->StripNumerals($str);
    $str = $this->StripHyphens($str);
    $str = $this->StripPossessions($str);
    $str = $this->StripShortWords($str);
    $str = $this->StripIgnoredWords($str);
    if (mb_strlen($str) < $this->inputMinimumLength) {
      $str = $this->StripPunctuations($str);
      $str = $this->StripLineBreaks($str);
      return $str;
    }
    $arr = $this->SegmentString($str);
    if (empty($arr)) {
      return '';
    }
    $wordsOne = $this->ParseOneWords($arr);
    $wordsTwo = $this->ParseTwoWords($arr);
    $wordsThr = $this->ParseThrWords($arr);
    #----
    # remove 2-word phrases if same single words exist
    if ($wordsOne !== false && $wordsTwo !== false) {
      $cnt = count($wordsOne);
      for ($i = 0; $i < $cnt-1; $i++) {
        foreach ($wordsTwo as $key => $phrase) {
          if ($wordsOne[$i].' '.$wordsOne[$i+1] === $phrase) {
            unset($wordsTwo[$key]);
          }
        }
      }
    }
    #----
    # remove 3-word phrases if same single words exist
    if ($wordsOne !== false && $wordsThr !== false) {
      $cnt = count($wordsOne);
      for ($i = 0; $i < $cnt-2; $i++) {
        foreach ($wordsThr as $key => $phrase) {
          if ($wordsOne[$i].' '.$wordsOne[$i+1].' '.$wordsOne[$i+2] === $phrase) {
            unset($wordsThr[$key]);
          }
        }
      }
    }
    #----
    # remove duplicate ENGLISH plural words
    if (substr($this->lang, 0, 2) == 'en') {
      if ($wordsOne !== false) {
        $cnt = count($wordsOne);
        for ($i = 0; $i < $cnt-1; $i++) {
          for ($j = $i+1; $j < $cnt; $j++) {
            if (array_key_exists($i, $wordsOne) && array_key_exists($j, $wordsOne)) {
              if ($wordsOne[$i].'s' == $wordsOne[$j]) {
                unset($wordsOne[$j]);
              }
              if (array_key_exists($j, $wordsOne)) {
                if ($wordsOne[$i] == $wordsOne[$j].'s') {
                  unset($wordsOne[$i]);
                }
              }
            }
          }
        }
      }
    }
    #----
    $onew_kw = '';
    $twow_kw = '';
    $thrw_kw = '';
    #----
    if ($wordsOne !== false) {
      $onew_kw = implode(',', $wordsOne) .',';
    }
    #----
    if ($wordsTwo !== false) {
      $twow_kw = implode(',', $wordsTwo) .',';
    }
    #----
    if ($wordsThr !== false) {
      $thrw_kw = implode(',', $wordsThr) .',';
    }
    #----
    $keywords = $onew_kw . $twow_kw . $thrw_kw;
    return rtrim($keywords, ',');
  }
  #===================================================================
  /**
   * Segments string according to line breaks and punctuations.
   * @var    string
   * @return array
   */
  private function SegmentString($str) {
    $arrA = explode("\n", $str);
    foreach ($arrA as $key => $value) {
      if (strpos($value, '.') !== false) $arrB[$key] = explode('.', $value);
      else $arrB[$key] = $value;
    }
    $arrB = $this->ArrayFlatten($arrB);
    unset($arrA);
    foreach ($arrB as $key => $value) {
      if (strpos($value, '!') !== false) $arrC[$key] = explode('!', $value);
      else $arrC[$key] = $value;
    }
    $arrC = $this->ArrayFlatten($arrC);
    unset($arrB);
    foreach ($arrC as $key => $value) {
      if (strpos($value, '?') !== false) $arrD[$key] = explode('?', $value);
      else $arrD[$key] = $value;
    }
    $arrD = $this->ArrayFlatten($arrD);
    unset($arrC);
    foreach ($arrD as $key => $value) {
      if (strpos($value, ',') !== false) $arrE[$key] = explode(',', $value);
      else $arrE[$key] = $value;
    }
    $arrE = $this->ArrayFlatten($arrE);
    unset($arrD);
    foreach ($arrE as $key => $value) {
      if (strpos($value, ';') !== false) $arrF[$key] = explode(';', $value);
      else $arrF[$key] = $value;
    }
    $arrF = $this->ArrayFlatten($arrF);
    unset($arrE);
    foreach ($arrF as $key => $value) {
      if (strpos($value, ':') !== false) $arrG[$key] = explode(':', $value);
      else $arrG[$key] = $value;
    }
    $arrG = $this->ArrayFlatten($arrG);
    unset($arrF);
    return $arrG;
  }
  #===================================================================
  private function StripIgnoredWords($str) {
    $ignoredWordsFile = __DIR__.'/ignore_'.$this->lang.'.txt';
    if (!file_exists($ignoredWordsFile)) {
      throw new Exception('Unable to read file '.$ignoredWordsFile);
    }
    $fileObj = new SplFileObject($ignoredWordsFile);
    while (!$fileObj->eof()) {
      $line = $fileObj->fgets();
      $line = trim($line);
      $str = preg_replace('/\ '. $line .'\ /', ' ', $str);
    }
    return $str;
  }
  #===================================================================
  private function ParseOneWords($arr) {
    if ($this->OneWordsMinimumLength == 0) {
      return false;
    }
    $new = array();
    $arr = implode(' ', $arr);
    $arr = $this->StripPunctuations($arr);
    $arr = $this->StripLineBreaks($arr);
    $arr = explode(' ', $arr);
    foreach($arr as $val) {
      if (mb_strlen($val, $this->encoding) >= $this->OneWordsMinimumLength) {
        $new[] = $val;
      }
    }
    return $this->FrequencyFilter($new, $this->OneWordsFrequency);
  }
  #===================================================================
  private function ParseTwoWords($arr) {
    if ($this->TwoWordsMinimumLength == 0) {
      return false;
    }
    $new = array();
    foreach ($arr as $key => $str) {
      $str = $this->StripPunctuations($str);
      $arr[$key] = explode(' ', $str); # 2-dimensional array
    }
    $lines = count($arr);
    for ($a = 0; $a < $lines; $a++) {
      $words = count($arr[$a]);
      for ($i = 0; $i < $words-1; $i++) {
        if ((mb_strlen($arr[$a][$i], $this->encoding) >= $this->TwoWordsMinimumLength) && (mb_strlen($arr[$a][$i+1], $this->encoding) >= $this->TwoWordsMinimumLength)) {
          $new[] = $arr[$a][$i] .' '. $arr[$a][$i+1];
        }
      }
    }
    return $this->FrequencyFilter($new, $this->TwoWordsFrequency);
  }
  #===================================================================
  private function ParseThrWords($arr) {
    if ($this->ThrWordsMinimumLength == 0) {
      return false;
    }
    $new = array();
    foreach ($arr as $key => $str) {
      $str = $this->StripPunctuations($str);
      $arr[$key] = explode(' ', $str); # 2-dimensional array
    }
    $lines = count($arr);
    for ($a = 0; $a < $lines; $a++) {
      $words = count($arr[$a]);
      for ($i = 0; $i < $words-2; $i++) {
        if (mb_strlen($arr[$a][$i], $this->encoding) >= $this->ThrWordsMinimumLength && mb_strlen($arr[$a][$i+1], $this->encoding) >= $this->ThrWordsMinimumLength && mb_strlen($arr[$a][$i+2], $this->encoding) >= $this->ThrWordsMinimumLength) {
          $new[] = $arr[$a][$i] .' '. $arr[$a][$i+1] .' '. $arr[$a][$i+2];
        }
      }
    }
    return $this->FrequencyFilter($new, $this->ThrWordsFrequency);
  }
  #===================================================================
  /**
   * Takes an array of keywords (keyword phrases), counts keyword
   * frequency.
   * If minimum frequency requirement is met, that keyword is put
   * into the output (returned) array.
   *
   */
  private function FrequencyFilter($arr, $min) {
    $arr = array_count_values($arr);
    $new = array();
    foreach ($arr as $word => $freq) {
      if ($freq >= $min) {
        $new[] = $word;
      }
    }
    return $new;
  }
  #===================================================================
  /**
   * Takes multidimensional array and returns 1-dimensional array.
   *
   */
  private function ArrayFlatten($array, $flat = false) {
    if (!is_array($array) || empty($array)) {
      return array();
    }
    if (empty($flat)) {
      $flat = array();
    }
    foreach ($array as $key => $val) {
      if (is_array($val)) {
        $flat = $this->ArrayFlatten($val, $flat);
      }
      else {
        $flat[] = $val;
      }
    }
    return $flat;
  }
  #===================================================================
  private function StripHtml($str) {
    if (empty($str)) {
      return '';
    }
    $str = html_entity_decode($str);
    # EOL
    $str = $this->SingleLineBreak($str);
    $str = preg_replace("#<br\ ?/?>(\n)?#i", "\n", $str);
    # Strip HTML
    $str = preg_replace('#<head[^>]*?>.*?</head>#siu',        '', $str);
    $str = preg_replace("/(<\/p>\s*<p>|<\/div>\s*<div>|<\/li>\s*<li>|<\/td>\s*<td>|<br>|<br\ ?\/>)/siu", "\n", $str); # we use \n to segment words
    $str = preg_replace('#<style[^>]*?>.*?</style>#siu',      '', $str);
    $str = preg_replace('#<script[^>]*?.*?</script>#siu',     '', $str);
    $str = preg_replace('#<object[^>]*?.*?</object>#siu',     '', $str);
    $str = preg_replace('#<embed[^>]*?.*?</embed>#siu',       '', $str);
    $str = preg_replace('#<applet[^>]*?.*?</applet>#siu',     '', $str);
    $str = preg_replace('#<noframes[^>]*?.*?</noframes>#siu', '', $str);
    $str = preg_replace('#<noscript[^>]*?.*?</noscript>#siu', '', $str);
    $str = preg_replace('#<noembed[^>]*?.*?</noembed>#siu',   '', $str);
    $str = preg_replace('#<figcaption>.+</figcaption>#siu',   '', $str);
    $str = strip_tags($str);
    $unwanted = array('"', '“', '„', '<', '>', '/', '*', '[', ']', '+', '=', '#');
    $str = str_replace($unwanted, ' ', $str);
    # Trim whitespace
    $str = str_replace("\t", '', $str);
    $str = preg_replace('/\ +/', ' ', $str);
    return trim($str);
  }
  #===================================================================
  private function SingleLineBreak($str) {
    $str = str_replace("\r\n", "\n", $str);
    $str = str_replace("\r", "\n", $str);
    return preg_replace("/\n\n+/", "\n", $str);
  }
  #===================================================================
  private function StripLineBreaks($str) {
    $str = str_replace("\n", ' ', $str);
    return preg_replace("/\s\s+/", ' ', $str);
  }
  #===================================================================
  private function StripNumerals($str) {
    return preg_replace('/[0-9\,\.:]/', '', $str);
  }
  #===================================================================
  private function StripShortWords($str) {
    $str = ' '. $str .' ';
    $str = preg_replace('/\ [a-z]{1,2}\ /i', ' ', $str);
    return trim($str);
  }
  #===================================================================
  /**
   * Strips hyphens, as in "ice-cream" -> "ice cream".
   * @var string
   */
  private function StripHyphens($str) {
    return str_replace('-', ' ', $str);
  }
  #===================================================================
  /**
   * Strips possessions (apostrophe), as in "mother's" -> "mother".
   * @var string
   */
  private function StripPossessions($str) {
    return preg_replace("/([a-z]{2,})('|’)s/", '\\1', $str);
  }
  #===================================================================
  /**
   * Strips punctuations and other useless characters.
   * @var string
   */
  private function StripPunctuations($str) {
    $punct = array('"',"'",'’','˝','„','`','.',',',';',':','+','±','-','_','=','(',')','[',']','<','>','{','}','/','\\','|','?','!','@','#','%','^','&','§','$','¢','£','€','¥','₣','฿','*','~','。','，','、','；','：','？','！','…','—','·','ˉ','ˇ','¨','‘','’','“','”','々','～','‖','∶','＂','＇','｀','｜','〃','〔','〕','〈','〉','《','》','「','」','『','』','．','〖','〗','【','】','（','）','［','］','｛','｝','／','“','”');
    $str = str_replace($punct, ' ', $str);
    return preg_replace('/\s\s+/', ' ', $str);
  }
  #===================================================================
  public function RemoveDuplicates($str) {
    if (empty($str)) {
      return '';
    }
    $str = trim(mb_strtolower($str));
    $kw_arr = explode(',', $str); # array
    foreach ($kw_arr as $key => $val) {
      $kw_arr[$key] = trim($val);
      if ($kw_arr[$key] == '') {
        unset($kw_arr[$key]);
      }
    }
    $kw_arr = array_unique($kw_arr);
    # remove duplicate ENGLISH plural words
    if (substr($this->lang, 0, 2) == 'en') {
      $cnt = count($kw_arr);
      for ($i = 0; $i < $cnt; $i++) {
        for ($j = $i+1; $j < $cnt; $j++) {
          if (array_key_exists($i, $kw_arr) && array_key_exists($j, $kw_arr)) {
            if ($kw_arr[$i].'s' == $kw_arr[$j]) {
              unset($kw_arr[$j]);
            }
            elseif ($kw_arr[$i] == $kw_arr[$j].'s') {
              unset($kw_arr[$i]);
            }
            elseif (preg_match('#ss$#', $kw_arr[$j])) {
              if ($kw_arr[$i] === $kw_arr[$j].'es') {
                unset($kw_arr[$i]); # addresses VS address
              }
            }
            elseif (preg_match('#ss$#', $kw_arr[$i])) {
              if ($kw_arr[$i].'es' === $kw_arr[$j]) {
                unset($kw_arr[$j]); # address VS addresses
              }
            }
          }
          $kw_arr = array_values($kw_arr);
        }
        $kw_arr = array_values($kw_arr);
      }
    }
    return implode(',', $kw_arr);
  }
  #===================================================================
}