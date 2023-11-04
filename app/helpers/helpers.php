<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\GeneralSetting;
use App\Models\SocialNetwork;

/** SEND EMAIL FUNCTION USING PHPMAILER LIBRARY */
if( !function_exists('sendEmail') ){
    function sendEmail($mailConfig){
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = ('sandbox.smtp.mailtrap.io');
        $mail->SMTPAuth = true;
        $mail->Username = ('df4659f6dfda0b');
        $mail->Password = ('23321cf0f01502');
        $mail->SMTPSecure = ('SSL');
        $mail->Port = ('587');
        $mail->setFrom('info@laravecom.test','laravecom');
        $mail->addAddress($mailConfig['mail_recipient_email'],$mailConfig['mail_recipient_name']);
        $mail->isHTML(true);
        $mail->Subject = $mailConfig['mail_subject'];
        $mail->Body = $mailConfig['mail_body'];
        if($mail->send()){
            return true ;
        }else{
            return false ;
        }
    }
}

/** GET GENERAL SETTINGS */
if( !function_exists('get_settings') ){
    function get_settings(){
        $results = null;
        $settings = new GeneralSetting();
        $settings_data = $settings->first();

        if($settings_data){
            $results = $settings_data;
        }else{
            $settings->insert([
                'site_name'=>'Laravecom',
                'site_email'=>'info@laravecom.test'
            ]);
            $new_settings_data = $settings->first();
            $results = $new_settings_data;
        }
        return $results; 
    }
}

/** GET SOCIAL NETWORKS */
if(!function_exists("get_social_network")) {
    function get_social_network(){
        $results = null;
        $social_network = new SocialNetwork();
        $social_network_data = $social_network->first();

        if( $social_network_data ){
            $results = $social_network_data;
        }else{
            $social_network->insert([
                'facebook_url'=>null,
                'twitter_url'=>null,
                'instagram_url'=>null,
                'youtube_url'=>null,
                'github_url'=>null,
                'linkedin_url'=>null,
            ]);
            $new_social_network_data = $social_network->first();
            $results = $new_social_network_data;
        }
        return $results;
    }
}