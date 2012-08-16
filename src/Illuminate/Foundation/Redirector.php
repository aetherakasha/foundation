<?php namespace Illuminate\Foundation;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Session\Store as SessionStore;

class Redirector {

	/**
	 * The URL generator instance.
	 *
	 * @var Illuminate\Routing\UrlGenerator
	 */
	protected $generator;

	/**
	 * The session store instance.
	 *
	 * @var Illuminate\Session\Store
	 */
	protected $session;

	/**
	 * Create a new Redirector instance.
	 *
	 * @param  Illuminate\Routing\UrlGenerator  $generator
	 * @return void
	 */
	public function __construct(UrlGenerator $generator)
	{
		$this->generator = $generator;
	}

	/**
	 * Create a new redirect response to the given path.
	 *
	 * @param  string  $path
	 * @param  int     $status
	 * @param  array   $headers
	 * @param  bool    $secure
	 * @return Illuminate\Foundation\RedirectResponse
	 */
	public function to($path, $status = 302, $headers = array(), $secure = false)
	{
		$path = $this->generator->to($path, $secure);

		return $this->createRedirect($path, $status, $headers);
	}

	/**
	 * Create a new redirect response to the given HTTPS path.
	 *
	 * @param  string  $path
	 * @param  int     $status
	 * @param  array   $headers
	 * @param  bool    $secure
	 * @return Illuminate\Foundation\RedirectResponse
	 */
	public function secure($path, $status = 302, $headers = array())
	{
		return $this->to($path, $status, $headers, true);
	}

	/**
	 * Create a new redirect response to a named route.
	 *
	 * @param  string  $route
	 * @param  array   $parameters
	 * @param  int     $status
	 * @param  array   $headers
	 * @return Illuminate\Foundation\RedirectResponse
	 */
	public function route($route, $parameters = array(), $status = 302, $headers = array())
	{
		$path = $this->generator->route($route, $parameters);

		return $this->to($path, $status, $headers);
	}

	/**
	 * Create a new redirect response.
	 *
	 * @param  string  $path
	 * @param  int     $status
	 * @param  array   $headers
	 * @return Illuminate\Foundation\RedirectResponse
	 */
	protected function createRedirect($path, $status, $headers)
	{
		$redirect = new RedirectResponse($path, $status, $headers);

		if (isset($this->session))
		{
			$redirect->setSession($session);
		}

		return $redirect;
	}

	/**
	 * Set the active session store.
	 *
	 * @param  Illuminate\Session\Store  $session
	 * @return void
	 */
	public function setSession(SessionStore $session)
	{
		$this->session = $session;
	}

}