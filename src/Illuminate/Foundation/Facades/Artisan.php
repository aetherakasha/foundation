<?php namespace Illuminate\Foundation\Facades;

use Illuminate\Support\Facade;

class Artisan extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'artisan'; }

}