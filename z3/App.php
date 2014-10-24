<?php namespace IIA;

class App {
	public static function env() {
		return getenv("PHP_ENV");
	}
}