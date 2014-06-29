<?php

/**
 * Class helper
 *
 * Stuart Sillitoe
 * Basic Globally Used Helper Functions
 */


class helper {



	public static function pre($what)
	{
		$out = '<pre>';
			$out.= print_r($what, 1);
		$out.= '</pre>';

		echo $out;
	}




	public static function flatToKeyValArray($flatList)
	{
		$out = array();
		foreach ($flatList as $item)
		{
			$out[$item] = $item;
		}
		return $out;
	}



	public static function niceDate($date, $time = false)
	{
		$out = '';

		// if its a empty date 0000
		if ( stristr($date, '0000') )
		{
			return 'N/A';
		}

		if ( is_numeric($date) ) // its a U timestamp
		{
			if ( $time )
				$out = date("d/m/Y H:iA", $date);
			else
				$out = date("d/m/Y", $date);
		}
		else
		{
			if ( $time )
				$out = date("d/m/Y H:iA", strtotime($date));
			else
				$out = date("d/m/Y",  strtotime($date));
		}

		return $out;

	}


	public static function niceDateLong($date, $withDay = false)
	{
		if ( is_numeric($date) ) // its a U timestamp
		{
			return date(($withDay?'l, ':'') ."jS F Y", $date);
		}
		else
		{
			return date(($withDay?'l, ':'') ."jS F Y", strtotime($date));
		}
	}




	public static function dayNames()
	{
		return array(
			'monday' => 'Monday',
			'tuesday' => 'Tuesday',
			'wednesday' => 'Wednesday',
			'thursday' => 'Thursday',
			'friday' => 'Friday',
			'saturday' => 'Saturday',
			'sunday' => 'Sunday',
		);
	}



	public static function isWeekend($timestamp)
	{
		return (date('N', $timestamp) >= 6);
	}



	public static function dateRange($dateFrom, $dateTo)
	{
		$out = array();
		if ( !empty($dateFrom) && !empty($dateTo) )
		{
			if ( !is_int($dateFrom) ) $dateFrom = strtotime($dateFrom);
			if ( !is_int($dateTo) ) $dateTo = strtotime($dateTo);

			$dateRange = \Fuel\Core\Date::range_to_array($dateFrom, $dateTo);
			foreach ($dateRange as $date)
			{
				$out[] = date("Y-m-d", $date->get_timestamp());
			}
		}
		return $out;
	}



	static function skipperBadge($status)
	{
		$label = '';
		if ( $status=='pending' ) $label = 'warning';
		if ( $status=='accepted' ) $label = 'success';
		if ( $status=='rejected' ) $label = 'danger';
		return '<span class="label label-' .$label .'">' .$status .'</span>';
	}



	public static function sendActivationEmail($user)
	{
		$emailContent = Model_Emailcontent::find_by_key('account_activation');

		$activationLinkURL = \Fuel\Core\Uri::base() .'activate/' .urlencode($user->email) .'/' .$user->activate_hash;
		$activationLink = '<a href="' .$activationLinkURL .'">' .$activationLinkURL .'</a>';

		$email = \Email\Email::forge();
		$email->to($user->email, $user->Name(true));
		$email->subject($emailContent->subject);
		$data['body'] = nl2br(str_replace(array('{name}', '{link}'), array($user->Name(true), $activationLink), $emailContent->body));
		$email->html_body(View::forge('email/template', $data, false));

		$email->from(Model_Setting::getByKey('email'), Model_Setting::getByKey('company_short'));
		$email->reply_to(Model_Setting::getByKey('email'), Model_Setting::getByKey('company_short'));
		try {$email->send();}
		catch(\EmailSendingFailedException $e) {die('1. The driver could not send the mail.');}
		catch(\EmailValidationFailedException $e) {die('1. One or more email addresses failed validation.');}
	}

	public static function sendRejectionEmail($user)
	{
		$emailContent = Model_Emailcontent::find_by_key('account_rejection');

		$email = \Email\Email::forge();
		$email->to($user->email, $user->Name(true));
		$email->subject($emailContent->subject);
		$data['body'] = nl2br(str_replace(array('{name}'), array($user->Name(true)), $emailContent->body));
		$email->html_body(View::forge('email/template', $data, false));

		$email->from(Model_Setting::getByKey('email'), Model_Setting::getByKey('company_short'));
		$email->reply_to(Model_Setting::getByKey('email'), Model_Setting::getByKey('company_short'));
		try {$email->send();}
		catch(\EmailSendingFailedException $e) {die('1. The driver could not send the mail.');}
		catch(\EmailValidationFailedException $e) {die('1. One or more email addresses failed validation.');}
	}




	public static function sendUserRegistrationNotificationEmailToAdmin()
	{
		$email = \Email\Email::forge();
		$email->to(Model_Setting::getByKey('email'));
		$email->subject('Charter Account Registration');
		$email->html_body('Someone has registered a charter account. See admin to view the details.');

		$email->from(Model_Setting::getByKey('email_from'), Model_Setting::getByKey('company_short'));
		$email->reply_to(Model_Setting::getByKey('email_from'), Model_Setting::getByKey('company_short'));
		try {$email->send();}
		catch(\EmailSendingFailedException $e) {die('1. The driver could not send the mail.');}
		catch(\EmailValidationFailedException $e) {die('1. One or more email addresses failed validation.');}
	}



	public static function sendSkipperNotificationEmailToAdmin()
	{
		$email = \Email\Email::forge();
		$email->to(Model_Setting::getByKey('email'));
		$email->subject('Skipper Added');
		$email->html_body('A plain sailing user has added a skipper.  See admin to view the details.');

		$email->from(Model_Setting::getByKey('email_from'), Model_Setting::getByKey('company_short'));
		$email->reply_to(Model_Setting::getByKey('email_from'), Model_Setting::getByKey('company_short'));
		try {$email->send();}
		catch(\EmailSendingFailedException $e) {die('1. The driver could not send the mail.');}
		catch(\EmailValidationFailedException $e) {die('1. One or more email addresses failed validation.');}
	}




}