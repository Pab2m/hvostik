<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Сброс пароля</h2>

		<div>
			Чтобы изменить Ваш пароль, перидите по ссылки: {{ URL::to('password/reset', array($token)) }}.<br/>
			Данная ссылка будет работать {{ Config::get('auth.reminder.expire', 60) }} минут.
		</div>
	</body>
</html>
