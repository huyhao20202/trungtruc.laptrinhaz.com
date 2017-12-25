<?php
function mailer($toMail,$userId,$activeCode)
{
    $link=DOMAIN.URL::createLink('default','user','activeRegister',null,"completeRegister-$userId-$activeCode.html");
    require TEMPLATE_PATH . '/default/main/phpmailer/PHPMailerAutoload.php';

    //create an instance of PHPMailer
    $mail = new PHPMailer();
    $mail->CharSet="UTF-8";
//set a host
    $mail->Host = "smtp.gmail.com";

//enable SMTP
    $mail->isSMTP();
//$mail->SMTPDebug = 2;

//set authentication to true
    $mail->SMTPAuth = true;

//set login details for Gmail account
    $mail->Username = "nhhao20202@gmail.com";
    $mail->Password = "huyhao100";

//set type of protection
    $mail->SMTPSecure = "ssl"; //or we can use TLS

//set a port
    $mail->Port = 465; //or 587 if TLS
//set subject
    $mail->Subject = "Xác nhận đăng ký tài khoản trên ZendVN";


//set HTML to true
    $mail->isHTML(true);


//set body
    $mail->Body="Thân chào $toMail!<br/>";
    $mail->Body.="<br/>Để sử dụng tài khoản bạn đã đăng ký, xin vui lòng click vào verify bên dưới:<br/>";
    $mail->Body.="<a href='".$link."'>Verify</a><br />";
    $mail->Body.="------------------------------------<br/>";
    $mail->Body.="Hỗ trợ và liên hệ:<a href='mailto:training@zend.vn' target='_blank'>training@zend.vn</a><br/>";
    $mail->Body.="<br/>Skype tư vấn ghi danh: <b>zendvn.help</b><br/>Skype giải đáp nội dung bài học: <b>zendvn.support</b><br/>";
    $mail->Body.="<br/><img src='http://trungtruc.laptrinhaz.com/public/template/default/main/images/zendvn.png' alt='Zendvn'> ";

//    $mail->Body = "Để hoàn tất đăng ký bạn hãy nhấp vào đường link bên dưới:<br /><a href='".$link."'>Verify</a><br /><img src='http://trungtruc.laptrinhaz.com/public/template/default/main/images/zendvn.png' alt='Zendvn'> ";

//add attachment
//$mail->addAttachment(TEMPLATE_PATH."/default/main/images/author/luu-truong-hai-lan.jpg", 'zendvn.jpg');

//set who is sending an email
    $mail->setFrom('nhhao20202@gmail.com', 'zendvn');

//set where we are sending email (recipients)
    $mail->addAddress($toMail);

////send an email
     $mail->send();
}
function mailForgetPass($toMail,$userId){
    $link=DOMAIN.URL::createLink('default','user','activeRegister',null,"changePassword-$toMail-$userId.html");
    require TEMPLATE_PATH . '/default/main/phpmailer/PHPMailerAutoload.php';

    //create an instance of PHPMailer
    $mail = new PHPMailer();
    $mail->CharSet="UTF-8";
//set a host
    $mail->Host = "smtp.gmail.com";

//enable SMTP
    $mail->isSMTP();
//$mail->SMTPDebug = 2;

//set authentication to true
    $mail->SMTPAuth = true;

//set login details for Gmail account
    $mail->Username = "nhhao20202@gmail.com";
    $mail->Password = "huyhao100";

//set type of protection
    $mail->SMTPSecure = "ssl"; //or we can use TLS

//set a port
    $mail->Port = 465; //or 587 if TLS

//set subject
    $mail->Subject = "Xác nhận khôi phục mật khẩu trên ZendVN";

//set HTML to true
    $mail->isHTML(true);

//set body
    $mail->Body="Thân chào $toMail!<br/>";
    $mail->Body.="<br/>Để khôi phục tài khoản của bạn, xin vui lòng click vào verify bên dưới:<br/>";
    $mail->Body.="<a href='".$link."'>Verify</a><br />";
    $mail->Body.="------------------------------------<br/>";
    $mail->Body.="<br/>Hỗ trợ và liên hệ:<a href='mailto:training@zend.vn' target='_blank'>training@zend.vn</a><br/>";
    $mail->Body.="Skype tư vấn ghi danh: <b>zendvn.help</b><br/>Skype giải đáp nội dung bài học: <b>zendvn.support</b><br/>";
    $mail->Body.="<br/><img src='http://trungtruc.laptrinhaz.com/public/template/default/main/images/zendvn.png' alt='Zendvn'> ";
//    $mail->Body = "Để khôi phục mật khẩu bạn vui lòng nhấp vào đường link xác nhận bên dưới:<br /><br /><a href='".$link."'>Verify</a><br/><img src='http://trungtruc.laptrinhaz.com/public/template/default/main/images/zendvn.png' alt=''> ";

//add attachment
//    $mail->addAttachment(TEMPLATE_PATH."/default/main/images/author/luu-truong-hai-lan.jpg", 'zendvn.jpg');

//set who is sending an email
    $mail->setFrom('nhhao20202@gmail.com', 'zendvn');

//set where we are sending email (recipients)
    $mail->addAddress($toMail);

////send an email
    $mail->send();
}


