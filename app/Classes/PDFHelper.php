<?php

function SendEmail($emailTo = '', $emailSubject = '', $emailBody = '', array $attachments = [], $emailFromName = '', $emailFromEmail = '', $email_cc = '', $email_bcc = '')
{  

    /*$whitelist = array(
        '127.0.0.1',
        '::1',
        'localhost'
    );

    if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
        return;
    }*/

    \Mail::send(
        'Email.Index', 
        ['html' => $emailBody], 
        function($message) 
        use($emailTo, $emailSubject, $attachments, $emailFromName, $emailFromEmail, $email_cc, $email_bcc) 
        {
            $message->from(
                ($emailFromEmail?$emailFromEmail:'paradisetester@gmail.com'), 
                ($emailFromName?$emailFromName:'paradisetester')
            )->subject($emailSubject);

            $message->to(explode(',', $emailTo));

            if ($email_cc) {
                $message->cc(explode(',', $email_cc));
            }
            if ($email_bcc) {
                $message->cc(explode(',', $email_bcc));
            }
            if (empty($attachments) &&  is_array($attachments)) {
                foreach ($attachments as $attachment) {
                    $message->attach($attachment);
                }
            }        
        }
    );
}