<?php

$isSuccessSendMail = false;

if (isset($_POST['inquirySend'])) {
  $_SendMail = new SendMail();
  // お問合せ送信
  if ($_SendMail->Inquiry($_POST))
    $isSuccessSendMail = true;
  else
    $isSuccessSendMail = false;

  $actionType = 'inquirySend';
}
  

class SendMail {
  // 送信先アドレス
  private const TO_MAIL_ADDRESS = 'lowtone03@gmail.com';
  private const FROM_MAIL_ADDRESS = 'lowtone03@yururito.gradation.jp';
  private const FROM = 'KAYUMI';
  private const FROM_NAME = 'KAYUMI COMMUNITY';
  
  // お問合せ送信
  public function Inquiry($inputs) {
    try {
      mb_language('japanese');
      mb_internal_encoding('UTF-8');

      $subject = '【KAYUMI COMMUNITYからのお問合せ】';
      $body = "*********************************************************\n\n"
              . '■返信先メールアドレス：' . $inputs['txtMailAddress'] . "\n"
              . '■お問合せ内容：' . "\n" . $inputs['txtInquiryContent'] . "\n\n"
              . "*********************************************************\n";
      $to = self::TO_MAIL_ADDRESS;
      $header = 'Content-Type: text/plain' . "\r\n"
                . 'Return-Path: ' . self::FROM_MAIL_ADDRESS . " \r\n"
                . 'From: ' . self::FROM . " \r\n"
                . 'Sender: ' . self::FROM . " \r\n"
                . 'Reply-To: ' . self::FROM_MAIL_ADDRESS . " \r\n"
                . 'Organization: ' . self::FROM_NAME . " \r\n"
                . 'X-Sender: ' . self::FROM_MAIL_ADDRESS . " \r\n"
                . 'X-Priority: 3' . " \r\n";

      return mb_send_mail($to, $subject, $body, $header);
    } catch (Exception $e) {
      return false;
    }
  }
}