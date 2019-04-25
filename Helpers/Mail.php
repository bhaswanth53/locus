<?php

    namespace Helpers;

    use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	use Flight;

    class Mail {
		public $subject;
		public $body;
		public $args;
		public $from;
		public $to = array();

        public function send()
        {	
            $body = self::render_file("views/mails/" . $this->body, $this->args);
			$mail = new PHPMailer(true);

			try {
				//Server settings
				$mail->SMTPDebug = 0; 
				if(constant("MAIL_SMTP") === true) {              
					$mail->isSMTP(); 
				}  
				$mail->SMTPOptions = array(
					'ssl' => array(
						'verify_peer' => false,
						'verify_peer_name' => false,
						'allow_self_signed' => true
					)
				);                                         
				$mail->Host       = constant('MAIL_HOST');  
				if(constant("MAIL_SMTP") === true) {
					$mail->SMTPAuth   = true;     
				}                              
				$mail->Username   = constant("MAIL_USERNAME");       
				$mail->Password   = constant("MAIL_PASSWORD");       
				$mail->SMTPSecure = constant("MAIL_ENCRYPTION");                  
				$mail->Port       = constant("MAIL_PORT");                         
				$mail->setFrom($this->from['email'], $this->from['name']);
                foreach($this->to as $item)
                {
                    $mail->addAddress($item['email'], $item['name']);
                }
				$mail->isHTML(true);                        
				$mail->Subject = $this->subject;
				$mail->Body    = $body;

				$mail->send();
				return true;
			} catch (Exception $e) {
				return false;
			}
        }

        public function render_file($path, array $args)
		{
			ob_start();
			include($path);
			$var=ob_get_contents(); 
			ob_end_clean();
			return $var;
		}

		public function addAddress($email, $name)
		{
			$this->to[] = array("email" => $email, "name" => $name);
		}
    }