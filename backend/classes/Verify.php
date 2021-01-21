<?php

class Verify{

    private $pdo;
    private $user;
    public function __construct(){
        $this->pdo=Database::instance();
        $this->user=new User;

    }

    public function generateLink(){
        return str_shuffle(substr(md5(time().mt_rand().time()),0,25));
    }

    public function verifyCode($targetColumn,$code){
        return $this->user->get('verification',$targetColumn,array('code'=>$code));
    }

    public function getVerifyStatus($targetColumn,$user_id){
        return $this->user->get('verification',$targetColumn,array('user_id'=>$user_id));
    }


    public function sendToMail($email,$message,$subject){
        $mail=new PHPMailer\PHPMailer\PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth=true;
        $mail->SMTPDebug=0;
        $mail->Host=M_HOST;
        $mail->Username=M_USERNAME;
        $mail->Password=M_PASSWORD;
        $mail->SMPTSecure=M_STMPSECURE;
        $mail->Port=M_PORT;

        if(!empty($email)){
            $mail->From="christopherglikpoqwesi@gmail.com";
            $mail->FromName="TWITTER";
            $mail->addReplyTo("no-reply@gmail.com");
            $mail->addAddress($email);
            
            $mail->Subject=$subject;
            $mail->Body=$message;
            $mail->AltBody=$message;

            if(!$mail->send()){
                return false;
            }else{
                return true;
            }
        }
    }
}