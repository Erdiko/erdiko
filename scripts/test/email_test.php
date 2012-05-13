<?php

echo "Email Test\n";
echo "response: ";
echo sendEmail('johnandsweta@gmail.com', 'SES test email', 'This is coming from the server.', 'johnandsweta@gmail.com');
echo "\n";

	function sendEmail($toEmail, $subject, $body, $fromEmail)
		{	
			$headers = "From: $fromEmail\r\n" .
				"Reply-To: $fromEmail\r\n" .
				"X-Mailer: PHP/" . phpversion();

			return mail($toEmail, $subject, $body, $headers);
		}

?>