<?php

namespace application\components;

class Mailer extends \CApplicationComponent {
	
	
	public function send($package){
		if (is_array($package)) { 
			$mailBuilder = $this->getMailBuilder();
			foreach ($package as $p) {
				$mailBuilder->$p($p);
			}
		} elseif ( $package instanceof MailBuilder ) {
			$mailBuilder = $package;
		} else {
			throw new InvalidArgumentException('Expecting parameter 1 to be an array or MailBuilder, '. gettype($package). ' given.');
		}
		
		foreach ($mailBuilder->populateMails() as $mail) {
			$this->sendMail($mail);
		}
	}
	
	private function sendMail(Mail $mail){
		
		
	}
	
	
}


class MailBuilder{
	
	private $_mailer;
	private $_params=array();
	
	public function __construct(Mailer $mailer){
		$this->_mailer = $mailer;
	}
	
	public function send(){
		return $this->_mailer->send($this);
	}
	
	public function from($from){
		$this->_params['from'] = $from;
	}
	
	public function to($to){
		$this->_pramas['to'] = $to;
	}
	
	public function cc($cc){
		$this->_params['cc'] = $cc;
	}
	
	public function bcc($bcc){
		$this->_params['bcc'] = $bcc;
	}
	
	public function subject($subject){
		$this->_params['subject'] = $subject;
	}
	
	public function body($body){
		$this->_params['body'] = $body;
	}
	
	public function needTrack($flag){
		$this->_params['needTrack'] = (boolean)$flag;
	}


}


class Mail{
	
}