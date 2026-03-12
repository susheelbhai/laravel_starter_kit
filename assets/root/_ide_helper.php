<?php

/**
 * IDE helper for Pest: tell the language server that PHPUnit's TestCase
 * (what Pest binds $this to in closures) actually has all the Laravel
 * testing helpers from Illuminate\Foundation\Testing\TestCase.
 *
 * This file is for static analysis only; it is never loaded at runtime.
 */

namespace PHPUnit\Framework {

    /**
     * @mixin \Illuminate\Foundation\Testing\TestCase
     * @mixin \Tests\TestCase
     *
     * @method \Illuminate\Testing\TestResponse get(string $uri, array $headers = [])
     * @method \Illuminate\Testing\TestResponse post(string $uri, array $data = [], array $headers = [])
     * @method \Illuminate\Testing\TestResponse put(string $uri, array $data = [], array $headers = [])
     * @method \Illuminate\Testing\TestResponse patch(string $uri, array $data = [], array $headers = [])
     * @method \Illuminate\Testing\TestResponse delete(string $uri, array $data = [], array $headers = [])
     * @method $this actingAs(\Illuminate\Contracts\Auth\Authenticatable $user, $guard = null)
     * @method $this assertAuthenticatedAs(\Illuminate\Contracts\Auth\Authenticatable $user, $guard = null)
     * @method $this assertGuest($guard = null)
     * @method \Illuminate\Testing\TestResponse from(string $url)
     * @method mixed call(string $method, string $uri, array $parameters = [], array $cookies = [], array $files = [], array $server = [], $content = null)
     * @method $this assertRedirect(string $uri = null)
     * @method $this assertOk()
     * @method $this assertNotFound()
     * @method $this assertDatabaseHas(string $table, array $data)
     * @method $this assertDatabaseMissing(string $table, array $data)
     * @method $this seed($class = null)
     */
    abstract class TestCase
    {
    }
}
